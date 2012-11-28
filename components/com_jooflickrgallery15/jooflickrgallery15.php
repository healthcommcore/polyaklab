<?php
/**
* Author: Zasha M.
* @copyright (C) 2010 eShiok.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.helper');
require_once( JApplicationHelper::getPath( 'html' ) );
$mainframe->setPageTitle( "JoomFlickr Elegant Photo Gallery" );

switch ($task) {
	case 'createjooflickrgallery15':
		createjooflickrgallery15();
		
		break;
	
	default:
		createjooflickrgallery15();
		break;
}

function createjooflickrgallery15() {
	HTML_jooflickrgallery15::createjooflickrgallery15();
	
}
?>