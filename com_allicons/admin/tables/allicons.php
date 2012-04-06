<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * AllIcons Table class
 */
class AllIconsTableAllIcons extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__allicons', 'id', $db);
	}

	/**
	 * Overloaded bind function
	 *
	 * @param       array           named array
	 * @return      null|string     null is operation was satisfactory, otherwise returns an error
	 * @see JTable:bind
	 * @since 1.5
	 */
	public function bind($array, $ignore = '') 
	{
		if (isset($array['params']) && is_array($array['params'])) {
			// Convert the params field to a string.
			$parameter = new JRegistry();
			$parameter->loadArray($array['params']);
			$array['params'] = (string)$parameter;
		}
		return parent::bind($array, $ignore);
	}
 
	
	/**
	 * Method to compute the default name of the asset.
	 * The default name is in the form `table_name.id`
	 * where id is the value of the primary key of the table.
	 *
	 * @return	string
	 * @since	2.5
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_allicons.icon.'.(int) $this->$k;
	}
 
	/**
	 * Method to return the title to use for the asset table.
	 *
	 * @return	string
	 * @since	2.5
	 */
	protected function _getAssetTitle()
	{
		return $this->label;
	}
 
	/**
	 * Get the parent asset id for the record
	 *
	 * @return	int
	 * @since	2.5
	 */
	protected function _getAssetParentId()
	{
		$asset = JTable::getInstance('Asset');
		$asset->loadByName('com_allicons');
		return $asset->id;
	}	
}