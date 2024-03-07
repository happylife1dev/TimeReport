<?php


defined('_JEXEC') or die('Restricted access');
 

 
class timereportControllerAssignments extends JControllerAdmin
{
	
	public function getModel($name = 'assignment', $prefix = 'timereportModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}