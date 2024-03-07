<?php

defined('_JEXEC') or die('Restricted access');
 

class timereportViewuserreport extends JViewLegacy
{
 

	public function display($tpl = null)
	{

		//$this->item = $this->get('Item');
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
 
		timereportHelper::addSubmenu('userreport');
		$this->addToolBar();
 
		parent::display($tpl);
		$this->setDocument();
	}
 

	protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', false);
		JToolBarHelper::title('User Report');
		//JToolBarHelper::apply('overview.save');
		JToolBarHelper::custom('userreport.report', 'download.png', 'download_f2.png', 'Export to Excel', false);


	}
	
	
	protected function setDocument() 	{		
		$document = JFactory::getDocument();		
		$document->setTitle('User Report');	
	}	
	
}