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

$user		= JFactory::getUser();

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_allicons.category');
$saveOrder	= $listOrder == 'a.ordering';
?>
<?php foreach($this->items as $i => $item):
	$ordering	= ($listOrder == 'a.ordering');
	$canCreate	= $user->authorise('core.create', 'com_allicons.category.'.$item->catid);
	$canEdit	= $user->authorise('core.edit',	'com_allicons.category.'.$item->catid);
	$canCheckin	= $user->authorise('core.manage', 'com_checkin') || $item->checked_out == $user->get('id') || $item->checked_out==0;
	$canChange	= $user->authorise('core.edit.state', 'com_allicons.category.'.$item->catid) && $canCheckin;  ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $item->id; ?>
		</td>
		<td class="center">
			<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td>
			<?php if ($item->checked_out) : ?>
				<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'allicons.', $canCheckin); ?>
			<?php endif; ?>
			<?php if ($canEdit) : ?>
				<a href="<?php echo JRoute::_('index.php?option=com_allicons&task=allicon.edit&id='.(int) $item->id); ?>">
					<?php echo $this->escape($item->label); ?></a>
			<?php else : ?>
					<?php echo $this->escape($item->label); ?>
			<?php endif; ?>
		</td>
		<td>
			<?php echo $item->category_title; ?>
		</td>		
		<td>
			<?php echo $item->link; ?>
		</td>
		<td class="order">
			<?php if ($canChange) : ?>
				<?php if ($saveOrder) :?>
					<?php if ($listDirn == 'asc') : ?>
						<span><?php echo $this->pagination->orderUpIcon($i, ($item->ordering == @$this->items[$i-1]->ordering), 'allicons.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
						<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, ($item->ordering == @$this->items[$i+1]->ordering), 'allicons.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
					<?php elseif ($listDirn == 'desc') : ?>
						<span><?php echo $this->pagination->orderUpIcon($i, ($item->ordering == @$this->items[$i-1]->ordering), 'allicons.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
						<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, ($item->ordering == @$this->items[$i+1]->ordering), 'allicons.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
					<?php endif; ?>
				<?php endif; ?>
				<?php $disabled = $saveOrder ?  '' : 'disabled="disabled"'; ?>
				<input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="text-area-order" />
			<?php else : ?>
				<?php echo $item->ordering; ?>
			<?php endif; ?>
		</td>		
		<td class="center">
			<?php echo JHtml::_('jgrid.published', $item->published, $i, 'allicons.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
		</td>
		<td class="center">
			<?php echo $this->escape($item->access_level); ?>
		</td>
		<td>
			<?php echo $item->icon; ?>
		</td>
		<td>
			<?php echo $item->description; ?>
		</td>
	</tr>
<?php endforeach; ?>