<?php


defined('_JEXEC') or die;

jimport('joomla.application.component.view');


class timereportViewOverview extends JViewLegacy {

	
    public function display($tpl = null) {  
	
		$user = JFactory::getUser();
		$app  = JFactory::getApplication();	
		if (!$user->id)
		{
			$app->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'error');
			$app->setHeader('status', 403, true);
		}	
			
        parent::display($tpl);
    }
       
    
}
