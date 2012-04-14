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
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * AllIcons View
 */
class AllIconsViewAllIcon extends JView
{
	protected $state;
	protected $script;
	protected $item;
	protected $form;
	
	/**
	 * display method of Allicons view
	 * @return void
	 */
	public function display($tpl = null) 
	{
		// get the Data
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->script = $this->get('Script');  // get validation script
		$this->state = $this->get('State');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}		
		
		// Set the toolbar
		$this->addToolBar();
 
		// Display the template
		parent::display($tpl);
		
		// Set the document
		$this->setDocument();
	}
 
	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId = $user->id;
		$isNew = ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo = AllIconsHelper::getActions($this->item->id, 0);
		
		JToolBarHelper::title($isNew ? JText::_('COM_ALLICONS_MANAGER_ALLICONS_NEW')
		                             : JText::_('COM_ALLICONS_MANAGER_ALLICONS_EDIT'), 'allicons');
									 
		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit')||(count($user->getAuthorisedCategories('com_allicons', 'core.create')))))
		{
			JToolBarHelper::apply('allicon.apply');
			JToolBarHelper::save('allicon.save');
		}
		if (!$checkedOut && (count($user->getAuthorisedCategories('com_allicons', 'core.create')))){
			JToolBarHelper::save2new('allicon.save2new');
		}
		
		// If an existing item, can save to a copy.
		if (!$isNew && (count($user->getAuthorisedCategories('com_allicons', 'core.create')) > 0)) {
			JToolBarHelper::save2copy('allicon.save2copy');
		}
		
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('allicon.cancel');
		}
		else {
			JToolBarHelper::cancel('allicon.cancel', 'JTOOLBAR_CLOSE');
		}

	}
	
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$isNew = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_ALLICONS_CREATING')
		                           : JText::_('COM_ALLICONS_EDITING'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_allicons"
		                                  . "/views/allicon/submitbutton.js");
		JText::script('COM_ALLICONS_ERROR_UNACCEPTABLE');								   
	}	
}