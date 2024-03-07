<?php

 
defined('_JEXEC') or die;

class timereportController extends JControllerLegacy
{

	public function display($cachable = false, $urlparams = false)
	{
		
		$view = JFactory::getApplication()->input->getCmd('view', 'overview');
        JFactory::getApplication()->input->set('view', $view);
		parent::display($cachable, $urlparams);
		return $this;
	}
}
