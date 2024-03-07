<?php



// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_timereport')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

require_once JPATH_SITE.'/administrator/components/com_timereport/helpers/timereport.php';

$controller	= JControllerLegacy::getInstance('timereport');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();