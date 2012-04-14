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

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$user		= JFactory::getUser();
$canOrder	= $user->authorise('core.edit.state', 'com_weblinks.category');
$saveOrder	= $listOrder == 'a.ordering';
?>
<tr>
	<th width="5">
		<?php echo JText::_('COM_ALLICONS_HEADING_ID'); ?>
	</th>
	<th width="1%">
		<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
	</th>			
	<th>
		<?php echo JHtml::_('grid.sort', 'COM_ALLICONS_HEADING_LABEL', 'a.label', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', 'COM_ALLICONS_HEADING_CATEGORY', 'category_title', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', 'COM_ALLICONS_HEADING_LINK', 'a.link', $listDirn, $listOrder); ?>
	</th>
	<th width="10%">
		<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>
		<?php if ($canOrder && $saveOrder) :?>
			<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'allicons.saveorder'); ?>
		<?php endif; ?>
	</th>	
	<th>
		<?php echo JText::_('COM_ALLICONS_HEADING_STATUS'); ?>
	</th>
	<th width="10%">
		<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ACCESS', 'a.access', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', 'COM_ALLICONS_HEADING_ICON', 'a.description', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', 'COM_ALLICONS_HEADING_DESC', 'a.icon', $listDirn, $listOrder); ?>
	</th>
</tr>