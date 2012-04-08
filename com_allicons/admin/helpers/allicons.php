<?php
// No direct access to this file
defined('_JEXEC') or die;
 
/**
 * AllIcons component helper.
 */
abstract class AllIconsHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($submenu) 
	{
		JSubMenuHelper::addEntry(JText::_('COM_ALLICONS_SUBMENU_ICONS'),
		                         'index.php?option=com_allicons&view=allicons', $submenu == 'allicons');
		JSubMenuHelper::addEntry(JText::_('COM_ALLICONS_SUBMENU_CATEGORIES'),		'index.php?option=com_categories&view=categories&extension=com_allicons',                 $submenu == 'categories');
		// set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-allicons ' .
		                               '{background-image: url(../media/com_allicons/images/allicons-48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_ALLICONS_ADMINISTRATION_CATEGORIES'));
		}
	}
	
	/**
	 * Get the actions
	 */
	public static function getActions($categoryId = 0)
	{	
		jimport('joomla.access.access');
		$user	= JFactory::getUser();
		$result	= new JObject;
 
		if (empty($categoryId)) {
			$assetName = 'com_allicons';
		}
		else {
			$assetName = 'com_allicons.category.'.(int) $categoryId;
		}
 
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}
 
		return $result;
	}	
}