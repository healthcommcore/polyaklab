<?php
/**
* Author: Zasha M.
* @copyright (C) 2010 eShiok.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.helper');

switch ($task) {
  case "info":
		info($option);
		break;
	case "save":
		update();
		info($option);
		break;
	default:
		info($option);
		break;
}

function update() {	    
    global $database, $mainframe;   
    
    $galleryHeight = trim(JRequest::getVar( 'galleryHeight','0', 'post', 'string'));
    $userFlickr = trim(JRequest::getVar( 'userFlickr','true', 'post', 'string'));
    $useFlickrLargeSize = trim(JRequest::getVar( 'useFlickrLargeSize','true', 'post', 'string'));
    $flickrAPIKey = trim(JRequest::getVar( 'flickrAPIKey','a22b1a90b000578e1854ebdb3a3b5ba7', 'post', 'string'));
    $photosetID = trim(JRequest::getVar( 'photosetID','72157603505606537', 'post', 'string'));
    $per_page = trim(JRequest::getVar( 'per_page','30', 'post', 'string'));
    $useHoverIntent = trim(JRequest::getVar( 'useHoverIntent','true', 'post', 'string'));
    $useLightBox = trim(JRequest::getVar( 'useLightBox','300', 'true', 'string'));
    $myPhotoFolder = trim(JRequest::getVar( 'myPhotoFolder','stories', 'post', 'string'));
    
  	$database =& JFactory::getDBO();
    $query = "UPDATE #__jooflickrgallery15 SET galleryHeight = '$galleryHeight', userFlickr = '$userFlickr', useFlickrLargeSize = '$useFlickrLargeSize', flickrAPIKey = '$flickrAPIKey', photosetID = '$photosetID', per_page = '$per_page', useHoverIntent = '$useHoverIntent', useLightBox = '$useLightBox', myPhotoFolder = '$myPhotoFolder'";
    $database->setQuery( $query );
    $database->query();    
	  echo "<p><b>Flickr Gallery Setting is Updated</b></p>";
}

function info($option) {
	 global $mosConfig_live_site, $database;
	 $database =& JFactory::getDBO();
	 $query = "SELECT galleryHeight, userFlickr, useFlickrLargeSize, flickrAPIKey, photosetID, per_page, useHoverIntent, useLightBox, myPhotoFolder FROM #__jooflickrgallery15";      
		$database->setQuery( $query );       
		$row = $database->loadRow();       
		$galleryHeight = $row[0];
		$userFlickr = $row[1];
		$useFlickrLargeSize = $row[2];
		$flickrAPIKey = $row[3];
		$photosetID = $row[4];
		$per_page = $row[5];
		$useHoverIntent = $row[6];
		$useLightBox = $row[7];
		$myPhotoFolder = $row[8];
?>
<div align="left">
<p>JoomFlickr Elegant Photo Gallery allows you to showcase the photographs that you have uploaded into Flickr.com (without need to store your images &amp; photos on your own server) but alternatively, you can opt to  still upload into your own hosting server in Joomla, so it is working like swiss-army to showcase your photo &amp; images collections. </p>
<p>JoomFlickr is a ported work which extends cool works done by some of other authors who are worthed to mention:</p>
<ol>
  <li>Steven Dugas, original author of <a href="http://userfriendlythinking.com/_CustomFiles/flickrGallery/Example-3a-Small-Auto.html" target="_blank">Elegant Photo Gallery</a>  </li>
  <li> Leandro Vieira Pinho, author of <a href="http://leandrovieira.com/projects/jquery/lightbox/" target="_blank">Lightbox</a> </li>
  <li> Brian Cherne, author of <a href="http://cherne.net/brian/resources/jquery.hoverIntent.html" target="_blank">hoverIntent</a> </li>
  <li>Sunento Wu, author of <a href="http://vivociti.com" target="_blank">Joomla Meebo Component</a></li>
</ol>
<hr/>
<h2>Instructions:</h2>
<ol>
  <li>If you would like to show your Flickr Photos, ensure you have applied for API Key by visiting <a href="http://www.flickr.com/services/api/keys/apply/" target="_blank">Flickr API Website</a> and set &quot;Use Flickr Or Local Folder&quot; option to True. </li>
  <li>Fill in your Flickr API Key to &quot;Flickr API&quot; text field and other neccessaries fields below (If you are not sure, then just leave it to use the default setting). </li>
  <li>If you prefer to host your own images and photos instead of retrieving them from Flickr, you can create a new folder under : [Joomla Root Folder]/images/[new folder] , upload all photos &amp; images into that folder, set &quot;Use Flickr Or Local Folder&quot; option to False and fill in the folder's name in  Local Photos Folder Name text field below. </li>
</ol>
<h2>Settings:</h2>
<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr>
      <td width="20%">Use Flickr Or Local Folder</td>
      <td width="3%">:</td>
      <td width="77%"><select name="userFlickr" size="1" id="userFlickr">
        <option value="true" <?php if ($userFlickr == "true") 
        	echo 'selected="selected"'; ?>>true</option>
        <option value="false" <?php if ($userFlickr == "false") 
        	echo 'selected="selected"'; ?>>false</option>
      </select>      </td>
  	</tr>
	  <tr>
      <td width="20%">Flickr API Key </td>
      <td width="3%">:</td>
      <td width="77%"><input name="flickrAPIKey" type="text" size="35" maxlength="50" value="<?php echo $flickrAPIKey; ?>"/></td>	  
    </tr>
    <tr>
      <td width="20%">Flickr Photo Set ID</td>
      <td width="3%">:</td>
      <td width="77%"><input name="photosetID" type="text" size="35" maxlength="50" value="<?php echo $photosetID; ?>"/></td>	  
    </tr>
    <tr>
      <td width="20%">Local Folder Name </td>
      <td width="3%">:</td>
      <td width="77%"><input name="myPhotoFolder" type="text" size="50" maxlength="200" value="<?php echo $myPhotoFolder; ?>"/></td>	  
    </tr>
	<tr>
      <td width="20%">Gallery Height</td>
      <td width="3%">:</td>
      <td width="77%"><input name="galleryHeight" type="text" value="<?php echo $galleryHeight; ?>"  size="5" maxlength="3" /> 
      - 0 is Default Value </td>	  
    </tr>
	<tr>
      <td width="20%">Photos per page</td>
      <td width="3%">:</td>
      <td width="77%"><input name="per_page" type="text" value="<?php echo $per_page; ?>" size="5" maxlength="3" />      </td>	  
    </tr>
	<tr>
      <td width="20%">Use Flickr Large Size</td>
      <td width="3%">:</td>
      <td width="77%"><select name="useFlickrLargeSize" size="1" id="useFlickrLargeSize">
        <option value="true" <?php if ($useFlickrLargeSize == "true") echo 'selected="selected"'; ?>>true</option>
        <option value="false" <?php if ($useFlickrLargeSize == "false") echo 'selected="selected"'; ?>>false</option>
      </select>      </td>
  	</tr>
	<tr>
      <td width="20%">Use Hover Intent Effect</td>
      <td width="3%">:</td>
      <td width="77%"><select name="useHoverIntent" size="1" id="useHoverIntent">
        <option value="true" <?php if ($useHoverIntent == "true") echo 'selected="selected"'; ?>>true</option>
        <option value="false" <?php if ($useHoverIntent == "false") echo 'selected="selected"'; ?>>false</option>
      </select>      </td>
  	</tr>
	<tr>
      <td width="20%">Use Lightbox Effect</td>
      <td width="3%">:</td>
      <td width="77%"><select name="useLightBox" size="1" id="useLightBox">
        <option value="true" <?php if ($useLightBox == "true") echo 'selected="selected"'; ?>>true</option>
        <option value="false" <?php if ($useLightBox == "false") echo 'selected="selected"'; ?>>false</option>
      </select>      </td>
  	</tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
<?php 
 	// Option (current component folder name) is available
	// as global variable
	echo '<input type="hidden" name="option" value="'.$option.'">';

	// Act is also available as global variable
	echo '<input type="hidden" name="act" value="'.$act.'">';

	// The value of task will be set by Mambo upon submit,
	// depending on which button is clicked
	echo '<input type="hidden" name="task" value="' . $task. '">'; 
?>
</form>
</div>
<p>To appreciate my work, it takes your few minutes to support me by Voting for this component at <a href="http://extensions.joomla.org/index.php?option=com_mtree&task=listcats&cat_id=1779&Itemid=35" target="_blank">Joomla Extensions Community Directory.</a>. Thanks !</p>
<p>&nbsp;</p>

	
<?php } 

?>