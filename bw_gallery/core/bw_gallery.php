<?php
include "bw_gallery_build.php";
$bw_gallery_info = build_bw_gallery();
?>
<style type="text/css">
@import "<?=$bw_gallery_info['webdr']."/core/bw_gallery.css";?>";
</style>
<script type="text/javascript" src="<?=$bw_gallery_info['webdr']."/core/bw_gallery.js";?>"></script>
<script type="text/javascript">
var bw_gallery_images = <?=json_encode($bw_gallery_info['images']);?>;
var bw_gallery_images_num = <?=count($bw_gallery_info['images']);?>;
var bw_gallery_images_count = 0;
</script>
<div id="bw_gallery_wrapper">
	<div id="bw_gallery_tcontainer">
    	<div id="bw_gallery_previous" style="background-image:url(<?=$bw_gallery_info['webdr']."/core/previous.png";?>);"></div>
        <div id="bw_gallery_next" style="background-image:url(<?=$bw_gallery_info['webdr']."/core/next.png";?>);"></div>
        <div id="bw_gallery_tbox">
        	<ul id="bw_gallery_tlist">
            	<?=$bw_gallery_info['thumb'];?>
            </ul>
        </div>
    </div>
    <div id="bw_gallery_imgdisplay">
    	<?=$bw_gallery_info['display'];?>
    </div>
</div>