<?php
 
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');

$users 			= timereportHelper::getTimeUsers();
$assignments 	= timereportHelper::getAssignments();
$user_id		= 0;
$user_id1 		= JRequest::getVar('user_id1');
$user_id2 		= JRequest::getVar('user_id2');
$user_id3 		= JRequest::getVar('user_id3');
$year 			= JRequest::getVar('year', 0);
$month 			= JRequest::getVar('month',0);
if($user_id1 OR $user_id2 OR $user_id3){
	$user_id = ( $user_id1 ? $user_id1 : ($user_id2 ? $user_id2 : $user_id3));
}

$option = new stdClass();
$option->user_id = null;
$option->name = '';
array_unshift($users, $option);

$years = array();
for($i = 1980;$i <= date('Y'); $i++){
	$years[] = array('id'=>$i, 'name'=>$i);
}

$option = array();
$option['id'] = null;
$option['name'] = '';
array_unshift($years, $option);

$months = array();
$months[0] = array('id'=>1, 'name'=>'Jan');
$months[1] = array('id'=>2, 'name'=>'Feb');
$months[2] = array('id'=>3, 'name'=>'Mar');
$months[3] = array('id'=>4, 'name'=>'Apr');
$months[4] = array('id'=>5, 'name'=>'May');
$months[5] = array('id'=>6, 'name'=>'June');
$months[6] = array('id'=>7, 'name'=>'July');
$months[7] = array('id'=>8, 'name'=>'Aug');
$months[8] = array('id'=>9, 'name'=>'Sept');
$months[9] = array('id'=>10, 'name'=>'Oct');
$months[10] = array('id'=>11, 'name'=>'Nov');
$months[11] = array('id'=>12, 'name'=>'Dec');

$option = array();
$option['id'] = null;
$option['name'] = '';
array_unshift($months, $option);

?>
<form action="<?php echo JRoute::_('index.php?option=com_timereport&view=overview'); ?>"
    method="post" name="adminForm" id="adminForm">
    <div class="form-horizontal">

	<div class="row-fluid">
		<div class="span12">
		
			<div class="form-inline" style="min-height:90px;maring-bottom:5px;">
				<div class="row-fluid">
					<div class="form-group span4">
						<label for="user_id">Unit No: </label>
						<?php echo JHTML::_('select.genericlist', $users, 'user_id1', 'class="form-control"  data-placeholder="Unit no" onchange="changeFilter(1);" ', 'user_id', 'unitno', $user_id); ?>					
					</div>
					<div class="form-group span4">
						<label for="user_id">Name: </label>
						<?php echo JHTML::_('select.genericlist', $users, 'user_id2', 'class="form-control"  data-placeholder="Name" onchange="changeFilter(2);" ', 'user_id', 'name', $user_id); ?>					
					</div>
					<div class="form-group span4">
						<label for="user_id">Email: </label>
						<?php echo JHTML::_('select.genericlist', $users, 'user_id3', 'class="form-control"  data-placeholder="Email" onchange="changeFilter(3);" ', 'user_id', 'email', $user_id); ?>					
					</div>
				</div>
				<div class="row-fluid" style="margin-top:10px;">
					<div class="form-group span4">
						<label for="user_id">Year: </label>
						<?php echo JHTML::_('select.genericlist', $years, 'year', 'class="form-control"  data-placeholder="Year" onchange="changeFilter(0);" ', 'id', 'name', $year); ?>					
					</div>
					<div class="form-group span4">
						<label for="user_id">Month: </label>
						<?php echo JHTML::_('select.genericlist', $months, 'month', 'class="form-control"  data-placeholder="Month" onchange="changeFilter(0);" ', 'id', 'name', $month); ?>					
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="text-align:left">Type</th>
						<?php if(!$month){ ?>
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
						<?php } else { ?>
						<th style="text-align:center"><?php echo date("F",mktime(0,0,0,$month,1,2020)); ?></th>
						<?php } ?>
						<th style="text-align:center">YTD Totals</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$t1=0;
					$t2=0;
					$t3=0;
					$t4=0;
					$t5=0;
					$t6=0;
					$t7=0;
					$t8=0;
					$t9=0;
					$t10=0;
					$t11=0;
					$t12=0;
					foreach($assignments as $assignment){ 
						if(!$month){ 
							$ytd1 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 1, $year);
							$ytd2 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 2, $year);
							$ytd3 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 3, $year);
							$ytd4 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 4, $year);
							$ytd5 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 5, $year);
							$ytd6 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 6, $year);
							$ytd7 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 7, $year);
							$ytd8 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 8, $year);
							$ytd9 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 9, $year);
							$ytd10 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 10, $year);
							$ytd11 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 11, $year);
							$ytd12 	= timereportHelper::getItemsYtd($assignment->id, $user_id, 12, $year);
							$t1 	+= $ytd1;
							$t2 	+= $ytd2;
							$t3 	+= $ytd3;
							$t4 	+= $ytd4;
							$t5 	+= $ytd5;
							$t6 	+= $ytd6;
							$t7 	+= $ytd7;
							$t8 	+= $ytd8;
							$t9 	+= $ytd9;
							$t10 	+= $ytd10;
							$t11 	+= $ytd11;
							$t12 	+= $ytd12;
						} else {
							$ytd1 	= timereportHelper::getItemsYtd($assignment->id, $user_id, $month, $year);
							$t1 	+= $ytd1;							
						}
					?>
					<tr>
						<td style="text-align:left"><b><?php echo $assignment->name; ?></b></td>
						<?php if(!$month){ ?>
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
						<?php } else { ?>
						<td style="text-align:center"><?php echo $ytd1; ?></td>
						<?php } ?>
						<td style="text-align:center"><?php echo ($ytd1+$ytd2+$ytd3+$ytd4+$ytd5+$ytd6+$ytd7+$ytd8+$ytd9+$ytd10+$ytd11+$ytd12); ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="text-align:left"><b>Total</b></td>
						<?php if(!$month){ ?>
						<td style="text-align:center;font-weight:bold;"><?php echo $t1; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t2; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t3; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t4; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t5; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t6; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t7; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t8; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t9; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t10; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t11; ?></td>
						<td style="text-align:center;font-weight:bold;"><?php echo $t12; ?></td>
						<?php } else { ?>
						<td style="text-align:center;font-weight:bold;"><?php echo $t1; ?></td>
						<?php } ?>
						<td style="text-align:center;font-weight:bold;"><?php echo ($t1+$t2+$t3+$t4+$t5+$t6+$t7+$t8+$t9+$t10+$t11+$t12); ?></td>
					</tr>					
				</tbody>
			</table>
			
		</div>
	</div>	

    </div>
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
</form>


<script type="text/javascript">

	function changeFilter(val){
		if(val == 1){
			jQuery("#user_id2").val("");
			jQuery("#user_id3").val("");
		} if(val == 2){
			jQuery("#user_id1").val("");
			jQuery("#user_id3").val("");			
		} if(val == 3){
			jQuery("#user_id1").val("");
			jQuery("#user_id2").val("");			
		}		
		Joomla.submitbutton('overview.search');
	};
   
</script>