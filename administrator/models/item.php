<?php


defined('_JEXEC') or die('Restricted access');
use Joomla\Utilities\ArrayHelper;
 

class timereportModelitem extends JModelAdmin
{

	public function getTable($type = 'items', $prefix = 'timereportTable', $config = array())
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
 

	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState(
			'com_timereport.edit.item.data',array()
		);
 
		if (empty($data))
		{
			$data = $this->getItem();
		}
 
		return $data;
	}
	
	
	
	public function getItem($pk = null)
	{
		
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('item.id');
		if (!isset($this->item))
		{
			$this->item = false;		
			$table = JTable::getInstance('items', 'timereportTable');
			$table->load($pk);
			$properties = $table->getProperties(1);
			$this->item = ArrayHelper::toObject($properties, 'JObject');
			
			if($this->item->id){
				
				$user_id = $this->item->user_id;
				$db = JFactory::getDBO();
				$query = "SELECT * FROM #__timereport_user WHERE user_id = '$user_id'";
				$db->setQuery($query);
				$user = $db->loadObject();	
				
				$this->item->name = $user->name;
				$this->item->email = $user->email;
				
				try {
					$fid = timereportHelper::GetFieldID('unitno');
					$unitno = timereportHelper::GetField($this->item->user_id, $fid);				
					$this->item->unitno = $unitno;
				} catch(Exception $e) {
					
				}	
			}
		}

		return $this->item;
	}		
	
	
	
	public function save($data)
	{
		$db = JFactory::getDBO();
		$time1 = $data['time_so'];
		$time2 = $data['time_od'];
		
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
		
		
		if(parent::save($data)){
			$id = $this->getState($this->getName() . '.id');
			JFactory::getApplication()->input->set('id', $id);		
			if(!$data['id'] AND !$data['user_id']) {
				$datas = array(
					"id"=> 0,
					"name"=> $data['name'],
					"username"=> $data['email'],
					"password"=> $data['email'],
					"password2"=> $data['email'],
					"email"=> $data['email'],
					"groups"=>array("2")
				);
				$user = JUser::getInstance(0);
				
				if(!$user->bind($datas)) {
					$this->setError($user->getError());
					return false; 
				} elseif (!$user->save()) {
					$this->setError($user->getError());
					return false;	
				} 
				$user_id = $user->id;
				$query = "UPDATE #__timereport_item SET `user_id`='$user_id' WHERE `id`= '$id'";
				$db->setQuery($query);
				$db->query();	

				$query = "INSERT INTO #__timereport_user (`user_id`,`unitno`,`name`,`email`) VALUES 
				('$user_id','".$data['unitno']."','".$data['name']."','".$data['email']."')";
				$db->setQuery($query);
				$db->query();					
		
			} else {
				$user_id = $data['user_id'];
				try {
					$query = "INSERT INTO #__timereport_user (`user_id`,`unitno`,`name`,`email`) VALUES 
					('$user_id','".$data['unitno']."','".$data['name']."','".$data['email']."')";
					$db->setQuery($query);
					$db->query();
				} catch(Exception $e) {}
			}
			
			JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
			JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_fields/models', 'FieldsModel');
			$fields = FieldsHelper::getFields('com_users.user');
			foreach($fields as $field){
				if($field->name == 'unitno'){
					$fieldId = $field->id;
				}			
			}			
			$fieldModel = JModelLegacy::getInstance('Field', 'FieldsModel', array('ignore_request' => true));
			$fieldModel->setFieldValue($fieldId, $user_id, $data['unitno']);
			
			return true;
		}
		return false;
	}	
	
	
}