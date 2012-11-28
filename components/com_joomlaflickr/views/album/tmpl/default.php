<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

if ($this->params->get('flickrLightboxEnabled') == '1'){
   $script1 = "<script type='text/javascript' src='" . $this->baseurl . "/components/com_joomlaflickr/libraries/lightbox/js/prototype.js'></script>";
   $script2 = "<script type='text/javascript' src='" . $this->baseurl . "/components/com_joomlaflickr/libraries/lightbox/js/scriptaculous.js?load=effects,builder'></script>";
   $script3 = "<script type='text/javascript' src='" . $this->baseurl . "/components/com_joomlaflickr/libraries/lightbox/js/lightbox.js'></script>";
   $script4 = "<link rel='stylesheet' href='" . $this->baseurl . "/components/com_joomlaflickr/libraries/lightbox/css/lightbox.css' type='text/css' media='screen' />";


   $mainframe->addCustomHeadTag($script1);
   $mainframe->addCustomHeadTag($script2);
   $mainframe->addCustomHeadTag($script3);
   $mainframe->addCustomHeadTag($script4);
}

if ($this->params->get('flickrInstantEnabled') == '1'){
   $script1 = "<script type='text/javascript' src='" . $this->baseurl . "/components/com_joomlaflickr/libraries/instant/instant.js'></script>";
   $mainframe->addCustomHeadTag($script1);
}

$db =& JFactory::getDBO();

$maxPhotosPerPage = $this->params->get('flickrMaxPhotosPerPage');
$currentPage = $db->getEscaped(JRequest::getVar('page'));
$totPages = ceil ($this->numPhotos / $maxPhotosPerPage);
$tiltArray=array("itiltleft", "itiltnone", "itiltright");

$db =& JFactory::getDBO();

echo "<h1>" . $this->albumTitle  . "</h1>";

echo JText::_('Jf_album_contains') . " <strong>" . $this->numPhotos . "</strong> " . JText::_('Jf_photos');
echo " (<a href='http://www.flickr.com/photos/". $this->nsid . "/sets/" . $this->albumId . "/show/" . "'>" . JText::_('Jf_slideshow') . "</a>)";

echo "<div align='center'>";

echo " " . JText::_('Jf_page') . " " . $currentPage . "/" . $totPages . " <br />";

echo "<table>";
echo "<tr>";
for ($i = 0; $i < sizeof($this->photosList); $i++){
	$photo = $this->photosList[$i];
	if ($i % $this->params->get('flickrMaxPhotosPerRow') == 0)
		echo "<tr>";
	echo "<td>";
	echo "<a href = '" . $photo['photoURL'] . "?imgmax=400' ";
	if ($this->params->get('flickrLightboxEnabled') == '1')
		echo "rel='lightbox[" . $db->getEscaped(JRequest::getVar('album')) . "]'";
	echo ">";
	echo "<img ";
	if ($this->params->get('flickrInstantEnabled') == '1')
		echo " class=\"instant " . $tiltArray[array_rand($tiltArray)] . "\" ";
	echo "src='" . $photo['thumbnailURL'] . "' alt='". $photo['photoTitle'] . "' /></a>";
	echo "</td>";
	if ( ($i + $this->params->get('flickrMaxPhotosPerRow') + 1) % $this->params->get('flickrMaxPhotosPerRow') == 0)
		echo "</tr>";
}
echo "</table>";

if ($currentPage > 1){
	echo "<a href=" . JRoute::_( 'index.php?option=com_joomlaflickr&view=album&album=' . $db->getEscaped(JRequest::getVar('album')) . '&page='. ($currentPage-1) ) . ">";
}
echo JText::_('JF_prev');
if ($currentPage > 1){
	echo "</a>";
}

echo " | ";

if ($currentPage < $totPages){
	echo "<a href=" . JRoute::_( 'index.php?option=com_joomlaflickr&view=album&album=' . $db->getEscaped(JRequest::getVar('album')) . '&page='. ($currentPage+1) ) . ">";
}
echo JText::_('JF_next');
if ($currentPage < $totPages){
	echo "</a>";
}


echo "</div>";

?>
