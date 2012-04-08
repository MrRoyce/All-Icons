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
	
		// Set the submenu
		AllIconsHelper::addSubmenu(JRequest::getCmd('view', 'allicons'));
		
		$view		= JRequest::getCmd('view', 'allicons');
		$layout 	= JRequest::getCmd('layout', 'default');
		$id			= JRequest::getInt('id');  // Stored in session variable by controllerform.php

		// Check for edit form.
		if ($view == 'allicon' && $layout == 'edit' && !$this->checkEditId('com_allicons.edit.allicon', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_alliconss&view=allicons', false));

			return false;
		}

		parent::display();
		return $this;  // this objectg can be used for chaining
	}
}