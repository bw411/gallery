<?php
$bwgallery_dr = dirname(dirname(__FILE__));
$bwgallery_webdr = str_replace($_SERVER['DOCUMENT_ROOT'],"",dirname(dirname(__FILE__)));
$bwgallery_img = scandir($bwgallery_dr."/images",1);
$bwgallery_ext_search = array("jpg","jpeg","gif","png");
$bwgallery_thumb = "";
$bwgallery_display = "";
foreach($bwgallery_img as $k=>$v) {
	$ext = pathinfo($v, PATHINFO_EXTENSION);
	if (in_array($ext,$bwgallery_ext_search)) {
		$size = getimagesize($bwgallery_dr."/images/".$v);
		$w = $size[0];
		$h = $size[1];
		$bwgallery_images[] = array('img'=>$v,'width'=>$size[0],'height'=>$size[1]);
	}
}
$bwgallery_descriptions = array();
if (($handle = fopen($bwgallery_dr."/bw_gallery.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        //echo "<pre>";var_dump($data);echo "</pre>";
		$bwgallery_descriptions[$data[0]] = $data[1];
    }
    fclose($handle);
}
foreach($bwgallery_images as $k=>$v) {
	$style = "";
	$bwgallery_thumb .= "<li class=\"bw_gallery_titem\" rel=\"bw_gallery_imgdisplay_item".$k."\"><img src=\"".$bwgallery_webdr."/images/".$v['img']."\" rel=\"bw_gallery_imgdisplay_item".$k."\" /></li>";
	/*if ($v['width'] != 0 || $v['height'] != 0) {
		if ($v['width']/$v['height'] > 1.8) {
			if ($v['width'] > 900) {
				$style .= "width:900px;";
			} else {
				$style .= "width:".$v['width']."px;";
			}
		} else {
			if ($v['height'] > 500) {
				$style .= "height:500px;";
			} else {
				$style .= "height:".$v['height']."px;";
			}
		}*/
		if ($k == 0) {
			$style .= "display:block;";
		}
		$bwgallery_display .= "<div class=\"bw_gallery_imgdisplay_item bw_gallery_imgdisplay_item".$k."\" style=\"".$style."\"><img src=\"".$bwgallery_webdr."/images/".$v['img']."\" /><div class=\"bw_gallery_imgdisplay_item_description\">".$bwgallery_descriptions[$v['img']]."</div></div>";
	/*} else {
		$bwgallery_display .= "<div class=\"bw_gallery_imgdisplay_item\"><img src=\"".$bwgallery_webdr."/images/".$v['img']."\" class=\"bw_gallery_display".$k."\" style=\"max-height:500px;\" /></div>";
	}*/
}
?>
<style type="text/css">
p {margin:0px;}
</style>
<style type="text/css">
@import "<?=$bwgallery_webdr."/core/bw_gallery.css";?>";
</style>
<script type="text/javascript" src="<?=$bwgallery_webdr."/core/bw_gallery.js";?>"></script>
<script type="text/javascript">
var bw_gallery_images = <?=json_encode($bwgallery_images);?>;
var bw_gallery_images_num = <?=count($bwgallery_images);?>;
var bw_gallery_images_count = 0;
//console.log(bw_gallery_images);
</script>
<div id="bw_gallery_wrapper">
	<div id="bw_gallery_tcontainer">
    	<div id="bw_gallery_previous" style="background-image:url(<?=$bwgallery_webdr."/core/previous.png";?>);"></div>
        <div id="bw_gallery_next" style="background-image:url(<?=$bwgallery_webdr."/core/next.png";?>);"></div>
        <div id="bw_gallery_tbox">
        	<ul id="bw_gallery_tlist">
            	<?=$bwgallery_thumb;?>
            </ul>
        </div>
    </div>
    <div id="bw_gallery_imgdisplay">
    	<?=$bwgallery_display;?>
    </div>
</div>