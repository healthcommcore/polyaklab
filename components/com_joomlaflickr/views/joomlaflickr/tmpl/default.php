<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

echo "<strong>" . sizeof($this->albumsList) . "</strong>" . " " . JText::_('Jf_albums_present') . " " . "<strong>" . $this->params->get('flickrUsername') . "</strong><br /><br />";

foreach($this->albumsList as $album){
	$albumTitle = $album['title'];
	$albumId = $album['id'];
	$link = JRoute::_('index.php?option=com_joomlaflickr&view=album&album=' .  $albumId . '&page=1');
	echo "<a href=" . $link . ">" . $albumTitle . "</a><br/>";
}
echo "<br />"
?>
