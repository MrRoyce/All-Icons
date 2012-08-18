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
 * AllIconss View
 */
class AllIconsViewAllIcons extends JViewLegacy
{

	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * AllIcons view display method
	 * @return void
	 */
	function display($tpl = null) 
	{

		// Assign data to the view
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
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
		$canDo = AllIconsHelper::getActions();
		
		JToolBarHelper::title(JText::_('COM_ALLICONS_ALLICONS_MANAGER'), 'allicons');
		
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('allicon.add');
		}
		
		if ($canDo->get('core.edit')){
			JToolBarHelper::editList('allicon.edit');
		}
		
		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'allicons.delete');
		}
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_allicons');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_ALLICONS_ADMINISTRATION'));
	}
}