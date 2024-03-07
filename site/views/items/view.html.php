<?php


defined('_JEXEC') or die;

jimport('joomla.application.component.view');


class timereportViewitems extends JViewLegacy {

	
    public function display($tpl = null) {  
	
		$user = JFactory::getUser();
		$app  = JFactory::getApplication();	
		if (!$user->id)
		{
			$app->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'error');
			$app->setHeader('status', 403, true);
		}	
			
		$model = $this->getModel();
		$items = $model->getItems();		
		$this->assignRef('items', $items);
		$this->pagination = $this->get('Pagination'); 	
        parent::display($tpl);
    }
       
    
}
