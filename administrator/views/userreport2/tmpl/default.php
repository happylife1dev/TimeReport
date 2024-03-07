<?php
 
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');

$users			= timereportHelper::getTimeUsers();
$user_id 		= JRequest::getVar('user_id');
$year	 		= JRequest::getVar('year',0);


$user_lists = $users;
$option = new stdClass();
$option->user_id = null;
$option->name = '';
array_unshift($user_lists, $option);

?>
<form action="<?php echo JRoute::_('index.php?option=com_timereport&view=userreport2'); ?>"
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
						<th style="text-align:center">Jan</th>
						<th style="text-align:center">Feb</th>
						<th style="text-align:center">Mar</th>
						<th style="text-align:center">Apr</th>
						<th style="text-align:center">May</th>
						<th style="text-align:center">June</th>
						<th style="text-align:center">July</th>
						<th style="text-align:center">Aug</th>
						<th style="text-align:center">Sept</th>
						<th style="text-align:center">Oct</th>
						<th style="text-align:center">Nov</th>
						<th style="text-align:center">Dec</th>
						<th style="text-align:center">YTD Totals</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($users as $user){ 	
						if($user_id AND $user->user_id != $user_id){
							continue;
						}
						$ytd1 	= timereportHelper::getItemsYtdBtUser($user->user_id, 1, $year);
						$ytd2 	= timereportHelper::getItemsYtdBtUser($user->user_id, 2, $year);
						$ytd3 	= timereportHelper::getItemsYtdBtUser($user->user_id, 3, $year);
						$ytd4 	= timereportHelper::getItemsYtdBtUser($user->user_id, 4, $year);
						$ytd5 	= timereportHelper::getItemsYtdBtUser($user->user_id, 5, $year);
						$ytd6 	= timereportHelper::getItemsYtdBtUser($user->user_id, 6, $year);
						$ytd7 	= timereportHelper::getItemsYtdBtUser($user->user_id, 7, $year);
						$ytd8 	= timereportHelper::getItemsYtdBtUser($user->user_id, 8, $year);
						$ytd9 	= timereportHelper::getItemsYtdBtUser($user->user_id, 9, $year);
						$ytd10 	= timereportHelper::getItemsYtdBtUser($user->user_id, 10, $year);
						$ytd11 	= timereportHelper::getItemsYtdBtUser($user->user_id, 11, $year);
						$ytd12 	= timereportHelper::getItemsYtdBtUser($user->user_id, 12, $year);
					?>
					<tr>
						<td style="text-align:left"><b><?php echo $user->name; ?></b></td>
						<td style="text-align:center"><?php echo $ytd1; ?></td>
						<td style="text-align:center"><?php echo $ytd2; ?></td>
						<td style="text-align:center"><?php echo $ytd3; ?></td>
						<td style="text-align:center"><?php echo $ytd4; ?></td>
						<td style="text-align:center"><?php echo $ytd5; ?></td>
						<td style="text-align:center"><?php echo $ytd6; ?></td>
						<td style="text-align:center"><?php echo $ytd7; ?></td>
						<td style="text-align:center"><?php echo $ytd8; ?></td>
						<td style="text-align:center"><?php echo $ytd9; ?></td>
						<td style="text-align:center"><?php echo $ytd10; ?></td>
						<td style="text-align:center"><?php echo $ytd11; ?></td>
						<td style="text-align:center"><?php echo $ytd12; ?></td>
						<td style="text-align:center"><?php echo ($ytd1+$ytd2+$ytd3+$ytd4+$ytd5+$ytd6+$ytd7+$ytd8+$ytd9+$ytd10+$ytd11+$ytd12); ?></td>
					</tr>
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