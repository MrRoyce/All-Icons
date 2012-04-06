<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>
<tr>
	<th width="5">
		<?php echo JText::_('COM_ALLICONS_HEADING_ID'); ?>
	</th>
	<th width="1%">
		<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
	</th>			
	<th>
		<?php echo JText::_('COM_ALLICONS_HEADING_LABEL'); ?>
	</th>
	<th>
		<?php echo JText::_('COM_ALLICONS_HEADING_CATEGORY'); ?>
	</th>
	<th>
		<?php echo JText::_('COM_ALLICONS_HEADING_LINK'); ?>
	</th>
	<th width="10%">
		<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>

			<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'allicons.saveorder'); ?>

	</th>	
	<th>
		<?php echo JText::_('COM_ALLICONS_HEADING_STATUS'); ?>
	</th>
	<th width="10%">
		<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ACCESS', 'access_level', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JText::_('COM_ALLICONS_HEADING_ICON'); ?>
	</th>
	<th>
		<?php echo JText::_('COM_ALLICONS_HEADING_DESC'); ?>
	</th>
</tr>