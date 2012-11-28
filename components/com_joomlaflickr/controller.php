<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class JoomlaFlickrController extends JController
{

	function display()
	{

		// Retrieve the current view
		$document =& JFactory::getDocument();
		$viewName = JRequest::getWord( 'view', 'display' );
		$viewType = $document->getType();
		$view = & $this->getView($viewName, $viewType);

		// Set the correct model for the view
		$model  = & $this->getModel('joomlaflickr');
 		$view->setModel( $model, true );

		// Display the view
		parent::display();

	}

}

?>

