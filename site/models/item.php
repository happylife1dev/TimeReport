<?php


defined('_JEXEC') or die('Restricted access');
use Joomla\Utilities\ArrayHelper;
JTable::addIncludePath(JPATH_ROOT . '/components/com_timereport/tables');


class timereportModelitem extends JModelAdmin
{


	public function getTable($type = 'item', $prefix = 'timereportTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
 

	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm(
			'com_timereport.item',
			'item',
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
		
	
	public function getItem($pk = null)
	{
		
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('item.id');
		if (!isset($this->item))
		{
			$this->item = false;		
			$table = JTable::getInstance('item', 'timereportTable');
			$table->load($pk);
			$properties = $table->getProperties(1);
			$this->item = ArrayHelper::toObject($properties, 'JObject');
		}

		return $this->item;
	}	
 
 
	protected function loadFormData()
	{
		$id = JFactory::getApplication()->input->getInt('id');
		if($id){
			$data = $this->getItem();
		} else {
			$data = JFactory::getApplication()->getUserState('com_timereport.edit.item.data',array());
			if (empty($data))
			{
				$data = $this->getItem();
			}
		}
		return $data;
	}
	
	
	public function getId() {
		return JFactory::getApplication()->input->getInt('id');
	}	
	
	
	public function save($data)
	{
		$db = JFactory::getDBO();
		JFactory::getApplication()->input->set('id', $data['id']);
		$user = JFactory::getUser();
		$data['user_id'] = $user->id;
		
		$time1 = $data['time_so'];
		$time2 = $data['time_od'];
		
		$x_time1 = explode(':', $time1);
		$x_time2 = explode(':', $time2);
		if(count($x_time1) < 2){
			$time1 = "$time1:00";
			$data['time_so'] = $time1;
		}
		if(count($x_time2) < 2){
			$time2 = "$time2:00";
			$data['time_od'] = $time2;
		}		
		
		$datetime1 = new DateTime($time1);
		$datetime2 = new DateTime($time2);			
	    $interval = $datetime1->diff($datetime2);
		$data['hours'] = $interval->format('%H:%I:%S');		
		
		if (parent::save($data))
		{	
			$id = $this->getState($this->getName() . '.id');
			JFactory::getApplication()->input->set('id', $id);						
			
			try {
				$query = "INSERT INTO #__timereport_user (`user_id`,`unitno`,`name`,`email`) VALUES 
				('$user->id','$user->id','$user->name','$user->email')";
				$db->setQuery($query);
				$db->query();
			} catch(Exception $e) {}			
			
			return true;
		}
		
		return false;
	}	
	
	
	public function delete(&$cid)
	{
		if (parent::delete($cid))
		{		
			return true;
		}
		
		return false;
	}
	
}