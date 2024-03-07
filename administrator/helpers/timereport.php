<?php


// No direct access
defined('_JEXEC') or die;


class timereportHelper
{
	
	public static function addSubmenu($vName = '')
	{	
		JSubMenuHelper::addEntry(
			'Overview',
			'index.php?option=com_timereport&view=overview',
			$vName == 'overview'
		);
		JSubMenuHelper::addEntry(
			'Times Entry',
			'index.php?option=com_timereport&view=items',
			$vName == 'items'
		);
		JSubMenuHelper::addEntry(
			'User Report',
			'index.php?option=com_timereport&view=userreport',
			$vName == 'userreport'
		);	
		JSubMenuHelper::addEntry(
			'User Report 2',
			'index.php?option=com_timereport&view=userreport2',
			$vName == 'userreport2'
		);		
		JSubMenuHelper::addEntry(
			'Assignments',
			'index.php?option=com_timereport&view=assignments',
			$vName == 'assignments'
		);	

	}	


	public function getTimeUsers(){
		$db = JFactory::getDBO();
		$query = "SELECT * FROM #__timereport_user ORDER BY name ASC";
		$db->setQuery($query);
		$results = $db->loadObjectList();
		return $results;		
	}


	public function getAssignments(){
		$db = JFactory::getDBO();
		$query = "SELECT * FROM #__timereport_assignment WHERE published = 1 ORDER BY ordering ASC";
		$db->setQuery($query);
		$results = $db->loadObjectList();
		return $results;		
	}


	public function getAssignmentsUser($user_id){
		$db = JFactory::getDBO();
		$query = "SELECT  ass.id, ass.name
		FROM #__timereport_item as a 
		INNER JOIN #__timereport_assignment as ass ON ass.id = a.assignment_id
		WHERE a.user_id = '$user_id'
		GROUP BY a.assignment_id";
		$db->setQuery($query);
		$results = $db->loadObjectList();
		return $results;		
	}


	public function getDateWorkUser($user_id, $assignment_id = false){
		$db = JFactory::getDBO();
		$query = "SELECT  date, SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) AS hours  
		FROM #__timereport_item 
		WHERE user_id = '$user_id' ";
		if($assignment_id){
			$query .= " AND assignment_id = '$assignment_id'";
		}
		$query .= "GROUP BY date";
		$db->setQuery($query);
		$results = $db->loadObjectList();
		return $results;		
	}



	public function getItemsYtd($assignment_id, $user_id, $month, $year = null){
		$db = JFactory::getDBO();
		if(!$year){
			$year = date('Y');
		}
		$query = "SELECT hours
		FROM #__timereport_item 
		WHERE assignment_id = '$assignment_id' AND YEAR(date) = $year AND MONTH(date) = $month ";
		if($user_id){
			$query .= " AND user_id = '$user_id'";
		}
		$db->setQuery($query);
		$results = $db->loadObjectList();
		$ytd = 0;
		foreach($results as $result){
			$ytd += $result->hours;
		}
		return $ytd;		
	}


	public function getItemsYtdBtUser($user_id, $month, $year = null){
		$db = JFactory::getDBO();
		if(!$year){
			$year = date('Y');
		}
		$query = "SELECT hours
		FROM #__timereport_item 
		WHERE user_id = '$user_id' AND YEAR(date) = $year AND MONTH(date) = $month ";
		$db->setQuery($query);
		$results = $db->loadObjectList();
		$ytd = 0;
		foreach($results as $result){
			$ytd += $result->hours;
		}
		return $ytd;		
	}
	
		
	function GetFieldID($Alias)
	{
		$db = JFactory::getDBO();
		$db->setQuery($db->getQuery(true)
			->select('id')
			->from('#__fields')
			->where("context = 'com_users.user'")->where("name='".$Alias."'"));
		return $db->loadResult();
	}	
	
	
	function GetField($UserID, $FieldID)
	{
		$db = JFactory::getDBO();
		$db->setQuery($db->getQuery(true)
			->select('value')
			->from('#__fields_values')
			->where("field_id = $FieldID")->where("item_id=$UserID"));
		return $db->loadResult();
	}
	
	
	function getTimeFloat($time){
		$hours = explode(':',$time); 
		return number_format($hours[0].'.'.$hours[1], 1);
	}


	function convToMonth($month){
		if($month == 1){
			return 'Jan';
		} else if($month == 2){
			return 'Feb';
		} else if($month == 3){
			return 'Mar';
		} else if($month == 4){
			return 'Apr';
		} else if($month == 5){
			return 'May';
		} else if($month == 6){
			return 'June';
		} else if($month == 7){
			return 'July';
		} else if($month == 8){
			return 'Aug';
		} else if($month == 9){
			return 'Sept';
		} else if($month == 10){
			return 'Oct';
		} else if($month == 11){
			return 'Nov';
		} else if($month == 12){
			return 'Dec';
		}
	}
	
}
