<?php


defined('_JEXEC') or die('Restricted access');
 

 
class timereportControlleritems extends JControllerAdmin
{
	
	public function getModel($name = 'item', $prefix = 'timereportModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}