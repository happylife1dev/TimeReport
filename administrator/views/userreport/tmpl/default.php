<?php
 
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');

$users			= timereportHelper::getTimeUsers();
$user_id 		= JRequest::getVar('user_id');

$user_lists = $users;
$option = new stdClass();
$option->user_id = null;
$option->name = '';
array_unshift($user_lists, $option);

?>
<form action="<?php echo JRoute::_('index.php?option=com_timereport&view=userreport'); ?>"
    method="post" name="adminForm" id="adminForm">
    <div class="form-horizontal">

	<div class="row-fluid">
		<div class="span12">
		
			<div class="form-inline" style="min-height:50px;maring-bottom:5px;">
				<div class="row-fluid">
					<div class="form-group span4">
						<label for="user_id">Name: </label>
						<?php echo JHTML::_('select.genericlist', $user_lists, 'user_id', 'class="form-control"  data-placeholder="User" onchange="Joomla.submitbutton(\'userreport.search\');" ', 'user_id', 'name', $user_id); ?>					
					</div>
				</div>

				<div class="clearfix"></div>
			</div>
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="text-align:left">User</th>						
						<th style="text-align:left">Assignment</th>						
						<th style="text-align:left">Month</th>						
						<th style="text-align:left">Hours</th>						
					</tr>
				</thead>
				<tbody>
					<?php foreach($users as $user){ 
						if($user_id AND $user->user_id != $user_id){
							continue;
						}
					?>
					<tr>
						<td style="text-align:left" colspan="4"><b><?php echo $user->name; ?></b></td>
					</tr>
						<?php $assignments = timereportHelper::getAssignmentsUser($user->user_id); ?>
						<?php foreach($assignments as $assignment){ ?>
							<tr>
								<td style="text-align:left"></td>
								<td style="text-align:left" colspan="3"><b><?php echo $assignment->name; ?></b></td>
							</tr>	
							<?php $dates = timereportHelper::getDateWorkUser($user->user_id, $assignment->id); ?>
							<?php foreach($dates as $date){ ?>
							<tr>
								<td style="text-align:left" colspan="2"></td>
								<td style="text-align:left"><b><?php echo timereportHelper::convToMonth(date("m",strtotime($date->date))); ?></b></td>
								<td style="text-align:left"><b><?php echo timereportHelper::getTimeFloat($date->hours); ?></b></td>
							</tr>							
							<?php } ?>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
			
		</div>
	</div>	

    </div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
</form>


<script type="text/javascript">

   
</script>