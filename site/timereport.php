<?php


defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

require_once JPATH_SITE.'/administrator/components/com_timereport/helpers/timereport.php';


// Execute the task.
$controller	= JControllerLegacy::getInstance('timereport');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();