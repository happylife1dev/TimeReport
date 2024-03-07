<?php
 
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');
?>
<script src="<?php echo JURI::root().'administrator/components/com_timereport/assets/js/jquery.mask.min.js'; ?>"></script>
<form action="<?php echo JRoute::_('index.php?option=com_timereport&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm">
    <div class="form-horizontal">

	<div class="row-fluid">
		<div class="span12">
			<?php if($this->item->id){ ?>
				<?php foreach ($this->form->getFieldset('olduser') as $field) : ?>
					<div class="control-group <?php echo $field->id; ?>">
						<div class="control-label"><?php echo $field->label; ?></div>
						<div class="controls"><?php echo $field->input; ?></div>
					</div>
				<?php endforeach; ?>			
			<?php } else { ?>
				<?php foreach ($this->form->getFieldset('newuser') as $field) : ?>
					<div class="control-group <?php echo $field->id; ?>">
						<div class="control-label"><?php echo $field->label; ?></div>
						<div class="controls"><?php echo $field->input; ?></div>
					</div>
				<?php endforeach; ?>			
			<?php } ?>
			<?php foreach ($this->form->getFieldset('default') as $field) : ?>
				<div class="control-group <?php echo $field->id; ?>">
					<div class="control-label"><?php echo $field->label; ?></div>
					<div class="controls"><?php echo $field->input; ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>	

    </div>
    <input type="hidden" name="task" value="item.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>

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