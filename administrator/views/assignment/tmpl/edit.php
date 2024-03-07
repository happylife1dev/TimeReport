<?php
 
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');
?>
<form action="<?php echo JRoute::_('index.php?option=com_timereport&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm">
    <div class="form-horizontal">

	<div class="row-fluid">
		<div class="span12">
			<?php foreach ($this->form->getFieldset() as $field) : ?>
				<div class="control-group <?php echo $field->id; ?>">
					<div class="control-label"><?php echo $field->label; ?></div>
					<div class="controls"><?php echo $field->input; ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>	

    </div>
    <input type="hidden" name="task" value="assignment.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>
