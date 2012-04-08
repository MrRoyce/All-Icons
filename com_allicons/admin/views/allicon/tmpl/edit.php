<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<form action="<?php echo JRoute::_('index.php?option=com_allicons&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="allicons-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_ALLICONS_NEW_ICON') : JText::sprintf('COM_ALLICONS_EDITING', $this->item->id); ?></legend>
			<ul class="adminformlist">
	<?php foreach($this->form->getFieldset('details') as $field): ?>
		<?php if (!$field->hidden): ?>
				<li><?php echo $field->label;echo $field->input;?></li>
		<?php endif; ?>
	<?php endforeach; ?>
			</ul>
		</fieldset>
	</div>
	<div class="width-40 fltrt">
		<?php echo JHtml::_('sliders.start', 'allicons-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

		<?php echo JHtml::_('sliders.panel', JText::_('COM_ALLICONS_GROUP_LABEL_BASIC_OPTIONS'), 'publishing-details'); ?>
			<fieldset class="panelform">
			<ul class="adminformlist">
				<?php foreach($this->form->getFieldset('basic') as $field): ?>
					<?php if (!$field->hidden): ?>
					<li><?php echo $field->label; ?>
						<?php echo $field->input; ?></li>
					<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			</fieldset>

		<?php echo JHtml::_('sliders.end'); ?>	
	</div>
	<div>
		<input type="hidden" name="task" value="allicons.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<div class="clr"></div>
</form>