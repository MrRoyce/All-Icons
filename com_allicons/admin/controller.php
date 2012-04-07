<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controller library
jimport('joomla.application.component.controller');
 
/**
 * General Controller of AllIcons component
 */
class AllIconsController extends JController
{
	/**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false, $urlparams = array())
	{
		// set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'AllIcons'));
 
		// call parent behavior
		parent::display($cachable);
		
		// Set the submenu
		AllIconsHelper::addSubmenu('icons');
	}
}