<?php

defined('_JEXEC') or die('Restricted access');
 

class timereportViewitem extends JViewLegacy
{

	protected $form = null;
	
	public function display($tpl = null)
	{
	
		$user = JFactory::getUser();
		$app  = JFactory::getApplication();	
		if (!$user->id)
		{
			$app->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'error');
			$app->setHeader('status', 403, true);
		}	
			
			
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');

		parent::display($tpl);
	}

}