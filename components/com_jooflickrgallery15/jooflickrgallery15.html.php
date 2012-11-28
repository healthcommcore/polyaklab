<?php
/**
* Author: Zasha M.
* @copyright (C) 2010 eShiok.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.helper');

class HTML_jooflickrgallery15 {
	
  
	function createjooflickrgallery15() {		
		global $database, $mosConfig_absolute_path;
	  $database =& JFactory::getDBO();
		$query = "SELECT galleryHeight, userFlickr, useFlickrLargeSize, flickrAPIKey, photosetID, per_page, useHoverIntent, useLightBox, myPhotoFolder FROM #__jooflickrgallery15";      
		$database->setQuery( $query );       
		$row = $database->loadRow();       
		$galleryHeight = trim($row[0]);
		$userFlickr = trim($row[1]);
		$useFlickrLargeSize = trim($row[2]);
		$flickrAPIKey = trim($row[3]);
		$photosetID = trim($row[4]);
		$per_page = trim($row[5]);
		$useHoverIntent = trim($row[6]);
		$useLightBox = trim($row[7]);
		$myPhotoFolder = trim($row[8]);
		echo "\n";
	?>
	
<link href="<?php echo JURI::root();?>components/com_jooflickrgallery15/flickrGallery-large.css" type="text/css" rel="stylesheet" />
<link href="<?php echo JURI::root();?>components/com_jooflickrgallery15/flickrGallery-small.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo JURI::root();?>components/com_jooflickrgallery15/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="<?php echo JURI::root();?>components/com_jooflickrgallery15/jquery-ui-personalized-1.6rc2.min.js"></script>
<script type="text/javascript" src="<?php echo JURI::root();?>components/com_jooflickrgallery15/jquery.flickr-1.0.js"></script>
<script type="text/javascript" src="<?php echo JURI::root();?>components/com_jooflickrgallery15/jquery.lightbox-0.5.min.js"></script>
<script type="text/javascript" src="<?php echo JURI::root();?>components/com_jooflickrgallery15/jquery.hoverIntent.minified.js"></script>

<script type="text/javascript" src="<?php echo JURI::root();?>components/com_jooflickrgallery15/jquery.flickrGallery-1.0.2.js"></script>
<?php 
	if ($userFlickr == "true") { 
?>
<script type="text/javascript">
$().ready(function(){
	$('#flickrPhoto').flickrGallery({ 
		<?php 
			if ($galleryHeight == "0") {
				echo "galleryHeight : 'auto',";
			} else {
				echo "galleryHeight : $galleryHeight,";
			}
		?>		
		useFlickr: '<?php echo trim($userFlickr); ?>',
		useFlickrLargeSize: '<?php echo trim($useFlickrLargeSize); ?>',
		useHoverIntent: '<?php echo trim($useHoverIntent); ?>',
		useLightBox: '<?php echo trim($useLightBox); ?>',
		flickrAPIKey: '<?php echo trim($flickrAPIKey); ?>',
		photosetID: '<?php echo trim($photosetID); ?>',
		per_page: <?php echo trim($per_page); ?>
	}); 
});
</script>
<div id="flickrPhoto"></div>
<?php } else { //if standalone 
		if ($folder = opendir("images/" .$myPhotoFolder)) {
          while (($f = readdir($folder)) !== false) {
	         if((substr(strtolower($f),-3) == 'jpg') || (substr(strtolower($f),-3) == 'gif') || (substr(strtolower($f),-3) == 'png')) {
	              $totalimages++;
    	          $images[] = array('filename' => $f);
	              array_multisort($images, SORT_ASC, SORT_REGULAR); 
	         }
          }
          closedir($folder);
        }
?>
<script type="text/javascript">
$().ready(function(){
	$('#Gallery').flickrGallery({
		<?php 
			if ($galleryHeight == "0") {
				echo "galleryHeight : 'auto',";
			} else {
				echo "galleryHeight : $galleryHeight,";
			}
		?>	
	});

});
</script>
<style>
#largeImageWrap { background:url(images/ajax-loader.gif) center 65px no-repeat; }
#Creditfooter {
   position:absolute;
   bottom:0;
   width:100%;
   height:60px;   /* Height of the footer */
   
}
</style>
<div id="Gallery">
    <ul id="thumbs_1" class="thumbs">
    <?php 
    		for($a = 0;$a<$totalimages;$a++) {
		     	if($images[$a]['filename'] != '') {
		     			echo "<li><img src=\"". JURI::root() . "images/$myPhotoFolder/" . $images[$a]['filename'] . "\" title=\"" . $images[$a]['filename'] . "\"/></li> \n";
		     		}
		     	}
	  ?>		     			
    </ul>
</div>

<?php		
	} //end of selection which solution to be displayed  
?>
<br/>
<div class="forAuthor"><a href="#" onClick="$(".creditToAuthor").show("slow"); return false;"><img src="<?php echo JURI::root() ?>components/com_jooflickrgallery15/images/info.png" border="0"/></a></div>
<script>
  $(document).ready(function(){
     $(".forAuthor a").click(function () {
      $(".creditToAuthor").show("slow");
       $(".forAuthor a").hide("slow");
    });

  });
  </script>
<!--- License: http://creativecommons.org/licenses/by-nc-sa/3.0/  
Do not remove this link without prior notice to authors --->
<div class="creditToAuthor" style="display: none">Free JoomFlickr Elegant Photo Gallery by <a href="http://www.eshiok.com" target="_blank">Zasha M.</a></div>
<div class="creditToAuthor" style="display: none"><b>With big credits to:</b></div>
<div class="creditToAuthor" style="display: none">Steven Dugas, original author of <a href="http://userfriendlythinking.com/_CustomFiles/flickrGallery/Example-3a-Small-Auto.html" target="_blank">Elegant Photo Gallery</a></div>
  <div class="creditToAuthor" style="display: none">Leandro Vieira Pinho, author of <a href="http://leandrovieira.com/projects/jquery/lightbox/" target="_blank">Lightbox</a> </div>
  <div class="creditToAuthor" style="display: none">Brian Cherne, author of <a href="http://cherne.net/brian/resources/jquery.hoverIntent.html" target="_blank">hoverIntent</a> </div>
  <div class="creditToAuthor" style="display: none">Sunento Wu, author of  <a href="http://vivociti.com" target="_blank">Joomla Meebo Component</a></div>
<?php 
	} //end of function createjooflickrgallery15()	
} //end of class HTML_jooflickrgallery15
?>
