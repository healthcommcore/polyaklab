<?php

jimport( 'joomla.application.component.view');

class JoomlaFlickrViewAlbum extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		$params = &$mainframe->getParams();
		$this->assignRef( 'params', $params );

		$album = $this->get('Album');
                $nsid = $this->get('Nsid');
                $this->assignRef('nsid', $nsid['id']);
		$this->assignref('albumTitle', $album['albumTitle']);
		$this->assignref('albumId', $album['albumId']);
		$this->assignref('numPhotos', $album['numPhotos']);
		$this->assignref('photosList', $album['photosList']);

		parent::display($tpl);
	}
}

?>
