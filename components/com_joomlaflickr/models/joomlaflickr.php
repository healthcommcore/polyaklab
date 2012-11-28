<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class JoomlaFlickrModelJoomlaFlickr extends JModel
{

	function loadPhpFlickrClasses()
	{
		global $mainframe;

		ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR . JPATH_COMPONENT . DS . 'libraries');

		require_once('phpFlickr' . DS . 'phpFlickr.php');

	}

	function getService()
	{
		// Singleton Pattern
		//if (!isset($service)){
			$this->loadPhpFlickrClasses();
			$flickrKey = $this->getFlickrKey();
			$service = new phpFlickr($flickrKey);
		//}
		return $service;
	}

	function getFlickrKey()
	{
		global $mainframe;
		$params = &$mainframe->getParams();
		$flickrKey = $params->get('flickrKey');
		return $flickrKey;
	}

	function getFlickrUsername()
	{
		global $mainframe;
		$params = &$mainframe->getParams();
		$flickrUsername = $params->get('flickrUsername');
		return $flickrUsername;
	}

	function getMaxPhotosPerPage()
	{
		global $mainframe;
		$params = &$mainframe->getParams();
		$maxPhotosPerPage = $params->get('flickrMaxPhotosPerPage');
		return $maxPhotosPerPage;
	}

	// FIXME
	// This should FIX the T_OPERATOR_OBJECT error
	// Waiting for feedbacks
	function getNsid()
	{
		$flickrUsername = $this->getFlickrUsername();
		$service = $this->getService();
		$nsid = $service->people_findByUsername($flickrUsername);
		return $nsid;
	}

	function getAlbumslist()
	{
		$nsid = $this->getNsid();
		$service = $this->getService();
		$photoSets = $service->photosets_getList($nsid['id']);
		$albumsList = $photoSets['photoset'];
		return $albumsList;
	}

	function getAlbum()
	{
		$db =& JFactory::getDBO();
		$albumId = $db->getEscaped(JRequest::getVar('album'));
		$service = $this->getService();
		$albumInfo = $service->photosets_getInfo($albumId);
		$albumTitle = $albumInfo['title'];
		$numPhotos = $albumInfo['photos'];
		$currentPage = $db->getEscaped(JRequest::getVar('page'));
		$service = $this->getService();
		$photos = $service->photosets_getPhotos($albumId, NULL, NULL, $this->getMaxPhotosPerPage(), $currentPage);
		$photosList = array();
		foreach($photos['photoset']['photo'] as $photo){
			$photoTitle = $photo['title'];
			$photoURL = "http://static.flickr.com/" . $photo['server'] . "/" . $photo['id'] . "_" .$photo['secret'].".jpg";
			$photoId = $photo['id'];
			$thumbnailURL = $service->buildPhotoURL($photo, "Square");
			$photoObject = array('photoTitle' => $photoTitle, 'photoURL' => $photoURL, 'thumbnailURL' => $thumbnailURL);
			$photosList[] = $photoObject;
		}
		return array('albumId' => $albumId, 'albumTitle' => $albumTitle, 'numPhotos' => $numPhotos, 'photosList' => $photosList);
	}

}
