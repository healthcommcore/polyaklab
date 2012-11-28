<?php
/**
* Author: Zasha M.
* @copyright (C) 2010 eShiok.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


// DEVNOTE: Pull in the class that will be used to actually display our toolbar.
require_once( JApplicationHelper::getPath( 'toolbar_html' ) );


switch ($task) {
  default:
		// Buttons: Add, Delete
    TOOLBAR_jooflickrgallery15::defaultButtons();
    break; 
		
}