Copyright 2013
Brandon Designs
Brandon Williams

Must have permission to use this gallery or pay for services.

Instructions:

1. Add bw_gallery folder to web server in the public folder structure.

2. On the page you want to add the gallery, include the primary php file:
	If you added the bw_gallery to the main directory, it will look like this
	<?php
	include "bw_gallery/core/bw_gallery.php";
	?>
	
	Or if in another folder, such as an include folder it me look like this
	<?php
	include "include/bw_gallery/core/bw_gallery.php";
	?>

3. Add the images to the image folder in bw_gallery.

4. Add description (optional) to the bw_gallery.csv file in the bw_gallery folder. The first column is the name of the image in the images folder and the second column is the description.

Send questions to brandon@crazysix.com