<?php
 
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');

JHtml::_('behavior.modal');
JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'item.cancel' || document.formvalidator.isValid(document.getElementById('adminForm'))) {
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
	}
");


?>

<script src="<?php echo JURI::root().'components/com_timereport/assets/js/jquery.mask.min.js'; ?>"></script>


<div class="row-fluid">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="box">
			
			<form action="<?php echo JRoute::_('index.php?option=com_timereport'); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal" enctype="multipart/form-data">
				<div class="box-body">
					<?php foreach ($this->form->getFieldset() as $field) : ?>
						<div class="form-group" style="margin-bottom:12px;">
							<div class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $field->label; ?></div>
							<div class="col-md-6 col-sm-6 col-xs-12"><?php echo $field->input; ?></div>
						</div>
						<div class="clearfix"></div>
					<?php endforeach; ?>												
				</div>
				<div class="box-footer" style="margin-top:20px;">
					<input type="submit" class="btn btn-primary pull-right" onclick="Joomla.submitbutton('item.saveAndNew')" value="Save And New" />					
					<input type="submit" class="btn btn-success pull-right" onclick="Joomla.submitbutton('item.save')" value="Save" />					
					<a href="<?php echo JRoute::_('index.php?option=com_timereport&view=items'); ?>" class="btn btn-default pull-right">Cancel</a>
				</div>
				<input type="hidden" name="Itemid" value="<?php echo JRequest::getVar('Itemid'); ?>" />
				<input type="hidden" name="option" value="com_timereport" />
				<input type="hidden" name="task" value="item.save" />
				<?php echo JHtml::_('form.token'); ?>	
			</form>
			
		</div>
	</div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($)
    {
		
        var options = {
            onKeyPress: function (time, e, field, op) {
                if (time.length > 1) return;


                // allow input hours between from 00 to 19
                var hour_pattern = /[0-9]/;

                // allow input hours between from 20 to 23
                var first_char_of_hour = time[0];
                if (first_char_of_hour == '2') hour_pattern = /[0-3]/;

                // overwrite translation
                options.translation['h'] = {pattern: hour_pattern};

                // reset mask
                field.unmask();
                field.mask('Hh:M0', options);
            },

            translation: {
                'H': {
                    pattern: /[0-2]/
                },
                'M': {
                    pattern: /[0-5]/
                },
            },

            placeholder: '__:__',
        };

        $('.time').mask('H0:M0', options);


		$("#adminForm").submit(function() {
			//$(".time").unmask();
		});			
		
    });    
</script>