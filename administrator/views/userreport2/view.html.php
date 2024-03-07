<?php

defined('_JEXEC') or die('Restricted access');
 

class timereportViewuserreport2 extends JViewLegacy
{
 

	public function display($tpl = null)
	{
 
		timereportHelper::addSubmenu('userreport2');
		$this->addToolBar();
 
		parent::display($tpl);
		$this->setDocument();
	}
 

	protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', false);
		JToolBarHelper::title('User Report 2');
		//JToolBarHelper::apply('overview.save');
		JToolBarHelper::custom('userreport2.report', 'download.png', 'download_f2.png', 'Export to Excel', false);


	}
	
	
	protected function setDocument() 	{		
		$document = JFactory::getDocument();		
		$document->setTitle('User Report 2');	
	}	
	
}