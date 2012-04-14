<?php
/*------------------------------------------------------------------------
# mod_allicons - All Icons Module
# ------------------------------------------------------------------------
# author Royce Harding - Total Design and Technology
# copyright Copyright (C) 2012 tdandt.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.tdandt.com
# Technical Support: - https://github.com/MrRoyce/All-Icons
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

class modAllIconsHelper
{

	protected static $buttons = array();

	/**
	 * Helper method to return button list.
	 *
	 * This method returns the array by reference so it can be
	 * used to add custom buttons or remove default ones.
	 *
	 * @param	JRegistry	The module parameters.
	 *
	 * @return	array	An array of buttons
	 */
	public static function &getButtons($params)
	{

		$catid = $params->get('catid', 0); // get any catid if specified

		$key = (string)$params;
		if (!isset(self::$buttons[$key])) {
			$context = $params->get('context', 'mod_allicons');
			if ($context == 'mod_allicons')
			{
				// Load mod_allicons language file in case this method is called before rendering the module
				JFactory::getLanguage()->load('mod_allicons');
				
				$tmp_buttons = self::getButtonObjects($catid);

				if ($tmp_buttons)
				{
					//echo '<pre>'; print_r($tmp_buttons); echo '</pre>';

					self::$buttons[$key] = array();
					foreach ($tmp_buttons AS $index => $button)
					{						
						self::$buttons[$key][] = array(
							'link' => JRoute::_($button->link),
							'image' => trim('header/' . $button->icon),
							'text' => JText::_($button->label),
							'target' => JText::_($button->target)
							// no access parameters defined for the button - 
							// access is restricted through the peceding SQL query 
							// and the module rightsmodule rights	
							// see logic in
							// libraries\cms\html\icons.php							
						);							
					}

				} else {
					self::$buttons[$key] = array();
				}
			}
			else
			{
				self::$buttons[$key] = array();
			}

			
		}

		return self::$buttons[$key];
	}
	
	private static function getButtonObjects($catid)
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(TRUE);	// TRUE create a new query
		$query->select('a.id, a.label, a.link, a.target, a.icon, a.description, a.published, a.catid,  a.access, a.ordering');
		
		$user = JFactory::getuser();
		
		$query->from($db->quoteName('#__allicons').' AS a');
		
		// Join over the language
		$query->select('l.title AS language_title');
		$query->join('LEFT', $db->quoteName('#__languages').' AS l ON l.lang_code = a.language');

		// Join over the users for the checked out user.
		$query->select('uc.name AS editor');
		$query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');

		// Join over the asset groups.
		$query->select('ag.title AS access_level');
		$query->join('LEFT', '#__viewlevels AS ag ON ag.id = a.access');

		// Join over the categories.
		$query->select('c.title AS category_title');
		$query->join('LEFT', '#__categories AS c ON c.id = a.catid');

		// Implement View Level Access
		if (!$user->authorise('core.admin'))
		{
		    $groups	= implode(',', $user->getAuthorisedViewLevels());
			$query->where('a.access IN (' . $groups . ')');
		}

		// Filter by published state.
		$query->where('a.published = 1');

		if ( ($catid) AND (is_array($catid) AND (($catid[0] != 0)))) {
			$query->where('a.catid IN (' . implode(',', $catid) . ')');
		}

		$query->order('a.ordering');
		
		$db->setQuery((string)$query);
		return $db->loadObjectList();
	}

	/**
	 * Get the alternate title for the module
	 *
	 * @param	JRegistry	The module parameters.
	 * @param	object		The module.
	 *
	 * @return	string	The alternate title for the module.
	 */
	public static function getTitle($params, $module)
	{
		$key = $params->get('context', 'mod_allicons') . '_title';
		if (JFactory::getLanguage()->hasKey($key))
		{
			return JText::_($key);
		}
		else
		{
			return $module->title;
		}
	}
}
