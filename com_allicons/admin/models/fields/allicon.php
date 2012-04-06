<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * AllIcon Form Field class for the AllIcon component
 */
class JFormFieldAllIcon extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'AllIcon';
 
	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions() 
	{
		$db = JFactory::getDBO();
 
		$query = $db->getQuery(true);
 
		$query->select('#__allicons.id AS id, label, #__categories.title AS category, catid');
		$query->from('#__allicons');
		$query->leftJoin('#__categories on catid = #__categories.id');
		$db->setQuery((string)$query);
		$messages = $db->loadObjectList();
		$options = array();
		if ($messages)
		{
			foreach ($messages AS $message) 
			{
				$options[] = JHtml::_('select.option', $message->id, $message->label .
				                      ($message->catid ? ' (' . $message->category . ')' : ''));
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}