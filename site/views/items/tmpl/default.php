<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidator');
jimport('joomla.html.html');

$app = JFactory::getApplication();
$items = $this->items;
$menu = $app->getMenu();
$title = $menu->getActive()->title;
$active = $menu->getActive();
$Itemid = $active->id;

?>

<form  action="<?php echo JRoute::_('index.php?option=com_timereport&view=items&Itemid='.$Itemid); ?>" method="post" id="adminForm" name="adminForm">
	
	<!-- Tables -->
	<div class="row-fluid">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="box">
				<div class="box-header" style="margin-bottom:15px;">
					<button type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Add" onclick="Joomla.submitbutton('item.add');" >Add Time</button>
				</div>			
				<div class="box-body">	
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="table_head">
								<tr> 
									<th width="1%">#</th>									
									<th>Assignment</th>																																																									
									<th>Date</th>																																																									
									<th>Time S.O.</th>																																																									
									<th>Time O.D.</th>																																																									
									<th>Hours</th>																																																									
								</tr>
							</thead>									
							
							<tbody class="table_body">
								<?php foreach($items as $i => $item){ 
									$link = JRoute::_('index.php?option=com_timereport&view=item&id=' . $item->id);
								?>
									<tr>
										<td>
											<?php echo $this->pagination->getRowOffset($i); ?>						
										</td>																		
										<td><a href="<?php echo $link; ?>"><?php echo $item->assignment; ?></a></td>												
										<td><a href="<?php echo $link; ?>"><?php echo JHTML::_('date',$item->date, 'Y/m/d'); ?></a></td>												
										<td><a href="<?php echo $link; ?>"><?php echo $item->time_so; ?></a></td>												
										<td><a href="<?php echo $link; ?>"><?php echo $item->time_od; ?></a></td>												
										<td><a href="<?php echo $link; ?>"><?php echo $item->hours; ?></a></td>												
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="box-footer clearfix">
					<?php echo $this->pagination->getListFooter(); ?>
				</div>				
			</div>
		</div>
	</div>
	<!-- End Tables -->

	<input type="hidden" name="task" value=""/>	
	<input type="hidden" name="boxchecked" value="0"/>	
	<input type="hidden" name="view" value="items" />
	<input type="hidden" name="option" value="com_timereport" />
</form>


