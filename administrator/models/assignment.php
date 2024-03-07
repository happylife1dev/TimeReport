<?php


defined('_JEXEC') or die('Restricted access');
 

class timereportModelassignment extends JModelAdmin
{

	public function getTable($type = 'assignments', $prefix = 'timereportTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
 

	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm(
			'com_timereport.assignment',
			'assignment',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);
 
		if (empty($form))
		{
			return false;
		}
 
		return $form;
	}
 

	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState(
			'com_timereport.edit.assignment.data',array()
		);
 
		if (empty($data))
		{
			$data = $this->getItem();
		}
 
		return $data;
	}
	
	
}