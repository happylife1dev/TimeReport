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

$saveOrderingUrl = 'index.php?option=com_timereport&task=assignments.saveOrderAjax&tmpl=component';
JHtml::_('sortablelist.sortable', 'assigmentsList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);

?>

<form action="index.php?option=com_timereport&view=assignments" method="post" id="adminForm" name="adminForm">


	<table class="table table-striped table-hover" id="assigmentsList">
		<thead>
		<tr>	
			<th width="1%" class="nowrap center hidden-phone">
				<?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
			</th>			
			<th width="1%"><?php echo JText::_('#'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>		
			<th width="96%">
				<?php echo JHtml::_('grid.sort', 'name', 'a.name', $listDirn, $listOrder); ?>
			</th>		
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="7">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php $canChange = JFactory::getUser()->authorise('core.manage', 'com_timereport'); ?>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
						$link = JRoute::_('index.php?option=com_timereport&task=assignment.edit&id=' . $row->id);
				?>
				
					<tr class="row<?php echo $i % 2; ?>" sortable-group-id="1">
						<td class="order nowrap center hidden-phone">
							<?php $iconClass = ' active tip-top hasTooltip" title="' . JHtml::_('tooltipText', 'JORDERINGDISABLED'); ?>
							<span class="sortable-handler<?php echo $iconClass ?>">
								<span class="icon-menu" aria-hidden="true"></span>
							</span>

							<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="width-20 text-area-order" />

						</td>					
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
					
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('name'); ?>">
								<?php echo $row->name; ?>
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
