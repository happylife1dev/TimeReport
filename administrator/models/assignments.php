<?php


defined('_JEXEC') or die('Restricted access');
 

 
class timereportModelassignments extends JModelList
{
	
	
	public function __construct($config = array())	
	{		
		if (empty($config['filter_fields'])){			
			$config['filter_fields'] = array(
				'id', 'a.id'
			);		
		} 		
		parent::__construct($config);	
	}	
	

	
	protected function getListQuery()
	{
		
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
 
		$query->select('a.*');
		$query->from('#__timereport_assignment as a');

		$orderCol	= $this->state->get('list.ordering', 'id');		
		$orderDirn 	= $this->state->get('list.direction', 'DESC'); 		
		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
		 
		return $query;
	}
	
	
	protected function populatarea($ordering = null, $direction = null) {
		parent::populatarea('id', 'ASC');
	}	
	
}