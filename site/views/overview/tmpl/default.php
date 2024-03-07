<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidator');
jimport('joomla.html.html');

$app = JFactory::getApplication();
$menu = $app->getMenu();
$title = $menu->getActive()->title;
$active = $menu->getActive();
$Itemid = $active->id;

$user = JFactory::getUser();
$user_id = $user->id;
$assignments 	= timereportHelper::getAssignments();
?>

<form  action="<?php echo JRoute::_('index.php?option=com_timereport&view=overview&Itemid='.$Itemid); ?>" method="post" id="adminForm" name="adminForm">
	
	<!-- Tables -->
	<div class="row-fluid">
		<div class="col-md-12 col-sm-12 col-xs-12">
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="text-align:left">Type</th>
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
					?>
					<tr>
						<td style="text-align:left"><b><?php echo $assignment->name; ?></b></td>
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
					<tr>
						<td style="text-align:left"><b>Total</b></td>
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
						<td style="text-align:center;font-weight:bold;"><?php echo ($t1+$t2+$t3+$t4+$t5+$t6+$t7+$t8+$t9+$t10+$t11+$t12); ?></td>
					</tr>					
				</tbody>
			</table>

			
		</div>
	</div>
	<!-- End Tables -->

	<input type="hidden" name="task" value=""/>	
	<input type="hidden" name="boxchecked" value="0"/>	
	<input type="hidden" name="view" value="overview" />
	<input type="hidden" name="option" value="com_timereport" />
</form>


