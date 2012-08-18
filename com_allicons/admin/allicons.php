<?php
/*------------------------------------------------------------------------
# com_allicons - All Icons Component
# ------------------------------------------------------------------------
# author Royce Harding - Total Design and Technology
# copyright Copyright (C) 2012 tdandt.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.tdandt.com
# Technical Support: - https://github.com/MrRoyce/All-Icons
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

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
$controller = JControllerLegacy::getInstance('AllIcons');
 
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();