<?php

jimport( 'joomla.application.component.view');

class JoomlaFlickrViewJoomlaFlickr extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		$params = &$mainframe->getParams();
		$this->assignRef( 'params', $params );

		$albumsList = $this->get( 'AlbumsList' );
		$this->assignRef( 'albumsList',	$albumsList );

		parent::display($tpl);

	}
}

?>
