<?php


defined('_JEXEC') or die('Restricted Access');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$user		= JFactory::getUser();
$userId		= $user->get('id');
$doc = JFactory::getDocument();


?>

<form action="index.php?option=com_timereport&view=items" method="post" id="adminForm" name="adminForm">


	<table class="table table-striped table-hover">
		<thead>
		<tr>	
			
			<th width="1%"><?php echo JText::_('#'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>		
			<th width="32%">
				<?php echo JHtml::_('grid.sort', 'Assignment', 'a.assignment_id', $listDirn, $listOrder); ?>
			</th>
			<th width="15%">
				<?php echo JHtml::_('grid.sort', 'Date', 'a.date', $listDirn, $listOrder); ?>
			</th>
			<th width="10%">
				<?php echo JHtml::_('grid.sort', 'Time S.O.', 'a.time_so', $listDirn, $listOrder); ?>
			</th>
			<th width="10%">
				<?php echo JHtml::_('grid.sort', 'Time O.D.', 'a.time_od', $listDirn, $listOrder); ?>
			</th>
			<th width="10%">
				<?php echo JHtml::_('grid.sort', 'Hours', 'a.hours', $listDirn, $listOrder); ?>
			</th>
			<th width="20%">
				<?php echo JHtml::_('grid.sort', 'Unit No', 'a.unitno', $listDirn, $listOrder); ?>
			</th>		
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="8">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php $canChange = JFactory::getUser()->authorise('core.manage', 'com_timereport'); ?>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
						$link = JRoute::_('index.php?option=com_timereport&task=item.edit&id=' . $row->id);
				?>
				
					<tr class="row<?php echo $i % 2; ?>" sortable-group-id="1">					
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
					
						<td>
							<a href="<?php echo $link; ?>">
								<?php echo $row->assignment; ?>
							</a>
						</td>
						<td>
							<a href="<?php echo $link; ?>">
								<?php echo JHTML::_('date',$row->date, 'Y/m/d'); ?>
							</a>
						</td>	
						<td>	
							<a href="<?php echo $link; ?>">
								<?php echo $row->time_so; ?>
							</a>	
						</td>
						<td>	
							<a href="<?php echo $link; ?>">
								<?php echo $row->time_od; ?>
							</a>	
						</td>
						<td>	
							<a href="<?php echo $link; ?>">
								<?php echo $row->hours; ?>
							</a>	
						</td>
						<td>	
						<?php 
							try { 
								$fid = timereportHelper::GetFieldID('unitno');
								$unitno = timereportHelper::GetField($row->user_id, $fid);
							} catch(Exception $e) {
								$unitno = $row->unitno;
							}
						?>
							<a href="<?php echo $link; ?>">
								<?php echo $unitno; ?>
							</a>	
						</td>
					
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	
	<input type="hidden" name="task" value=""/>	
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>	
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>	
	<?php echo JHtml::_('form.token'); ?>	
</form>
