<?php

defined('_JEXEC') or die('Restricted access');
 

class timereportViewitem extends JViewLegacy
{

	protected $form = null;
 

	public function display($tpl = null)
	{

		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
 
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
 
		$this->addToolBar();
 
		parent::display($tpl);
		$this->setDocument();
	}
 

	protected function addToolBar()
	{
		$layout = JRequest::getVar('layout');
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);
 
		$isNew = ($this->item->id == 0);
 
		if ($isNew)
		{
			$title = JText::_('new');
		}
		else
		{
			$title = JText::_('edit');
		}

		JToolBarHelper::title($title, 'item');
		JToolBarHelper::save('item.save');
		JToolBarHelper::save2new('item.save2new');
		JToolBarHelper::apply('item.apply');
		JToolBarHelper::cancel(
			'item.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
		
	}
	
	
	protected function setDocument() 	{		
		$isNew = ($this->item->id < 1);		
		$document = JFactory::getDocument();		
		$document->setTitle($isNew ? JText::_('new') : JText::_('edit'));	
	}	
	
}