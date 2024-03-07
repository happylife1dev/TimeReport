<?php


 
defined('_JEXEC') or die('Restricted access');

 
class timereportViewassignments extends JViewLegacy
{

	function display($tpl = null)
	{
		$app = JFactory::getApplication();		
		$context = "assignment.list.admin.assignment";
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
		
		timereportHelper::addSubmenu('assignments');
		$this->addToolBar();				
		parent::display($tpl);
	}
	
	
	protected function addToolBar()
	{
		$title = JText::_('assignments'); 				
		JToolBarHelper::title($title, 'assignment');		
		JToolBarHelper::addNew('assignment.add');	
		JToolBarHelper::editList('assignment.edit');		
		JToolBarHelper::deleteList('', 'assignments.delete');
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