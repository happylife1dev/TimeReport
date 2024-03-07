<?php


 
defined('_JEXEC') or die('Restricted access');

 
class timereportViewitems extends JViewLegacy
{

	function display($tpl = null)
	{
		$app = JFactory::getApplication();		
		$context = "item.list.admin.item";
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state			= $this->get('State');		
		$this->filter_order 	= $app->getUserStateFromRequest($context.'filter_order', 'filter_order', 'name', 'cmd');		
		$this->filter_order_Dir = $app->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');	

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		
		timereportHelper::addSubmenu('items');
		$this->addToolBar();				
		parent::display($tpl);
	}
	
	
	protected function addToolBar()
	{
		$title = JText::_('items'); 				
		JToolBarHelper::title($title, 'item');		
		JToolBarHelper::addNew('item.add');	
		JToolBarHelper::editList('item.edit');		
		JToolBarHelper::deleteList('', 'items.delete');
		JToolbarHelper::divider();	
		JToolbarHelper::preferences('com_timereport');		
	}	
	

	protected function getSortFields()
	{
		return array(
			'id' => JText::_('JGRID_HEADING_ID')
		);
	}	

}