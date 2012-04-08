<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_allicons')) 
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// require helper file
JLoader::register('AllIconsHelper', dirname(__FILE__) . '/helpers/allicons.php');

// Set some global property
$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-48-allicons {background-image: url(../media/com_allicons/images/allicons-48.png);}');
 
// import joomla controller library
jimport('joomla.application.component.controller');
 
// Get an instance of the controller prefixed by AllIcons
$controller = JController::getInstance('AllIcons');
 
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();