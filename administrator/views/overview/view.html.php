<?php

defined('_JEXEC') or die('Restricted access');
 

class timereportViewoverview extends JViewLegacy
{
 

	public function display($tpl = null)
	{

		//$this->item = $this->get('Item');
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
 
		timereportHelper::addSubmenu('overview');
		$this->addToolBar();
 
		parent::display($tpl);
		$this->setDocument();
	}
 

	protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', false);
		JToolBarHelper::title('overview');
		//JToolBarHelper::apply('overview.save');
		JToolBarHelper::custom('overview.report', 'download.png', 'download_f2.png', 'Export to Excel', false);


	}
	
	
	protected function setDocument() 	{		
		$document = JFactory::getDocument();		
		$document->setTitle('overview');	
	}	
	
}