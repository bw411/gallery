<?php
/**
*
* build_bw_gallery gathers image information and prepares html bocks for the gallery display
*
**/
function build_bw_gallery () {
	/**
	* Start by collecting path and setup information
	**/
	$bwgallery_dr = dirname(dirname(__FILE__)); //directory of gallery core files
	$bwgallery_webdr = str_replace($_SERVER['DOCUMENT_ROOT'],"",dirname(dirname(__FILE__))); //relative path
	$bwgallery_img = scandir($bwgallery_dr."/images",1); //gather list of files from images folder
	$bwgallery_ext_search = array("jpg","jpeg","gif","png"); //list of acceptable file extensions
	$bwgallery_thumb = ""; 
	$bwgallery_display = "";
	
	/**
	* prepare image list
	**/
	foreach($bwgallery_img as $k=>$v) {
		$ext = pathinfo($v, PATHINFO_EXTENSION); //identify file extensions
		if (in_array($ext,$bwgallery_ext_search)) { //weed out non-image files
			$size = getimagesize($bwgallery_dr."/images/".$v); //get image size
			$w = $size[0];
			$h = $size[1];
			$bwgallery_images[] = array('img'=>$v,'width'=>$size[0],'height'=>$size[1]);
		}
	}
	
	/**
	*get image information from csv if exists
	**/
	$bwgallery_descriptions = array();
	if (($handle = fopen($bwgallery_dr."/bw_gallery.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$bwgallery_descriptions[$data[0]] = $data[1];
		}
		fclose($handle);
	}
	
	/**
	* build html blocks for gallery
	**/
	foreach($bwgallery_images as $k=>$v) {
		$style = "";
		$bwgallery_thumb .= "<li class=\"bw_gallery_titem\" rel=\"bw_gallery_imgdisplay_item".$k."\"><img src=\"".$bwgallery_webdr."/images/".$v['img']."\" rel=\"bw_gallery_imgdisplay_item".$k."\" /></li>";
			if ($k == 0) {
				$style .= "display:block;";
			}
			$bwgallery_display .= "<div class=\"bw_gallery_imgdisplay_item bw_gallery_imgdisplay_item".$k."\" style=\"".$style."\"><img src=\"".$bwgallery_webdr."/images/".$v['img']."\" /><div class=\"bw_gallery_imgdisplay_item_description\">".$bwgallery_descriptions[$v['img']]."</div></div>";
	}
	
	/**
	* return variables for gallery display
	**/
	return array(
		'webdr'=>$bwgallery_webdr,
		'images'=>$bwgallery_images,
		'thumb'=>$bwgallery_thumb,
		'display'=>$bwgallery_display
	);
}
?>