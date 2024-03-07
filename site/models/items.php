<?php
// No direct access.
defined('_JEXEC') or die;
jimport('joomla.application.component.modelitem');
jimport('joomla.event.dispatcher');

class timereportModelitems extends JModelItem
{

	function __construct()
    {
		parent::__construct();
		$this->setState('limit', JRequest::getVar('limit', 20, '', 'int'));
		$this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));
    }

	
	function getItems(){
		$app = JFactory::getApplication();	
        $db = JFactory::getDBO();
		$user = JFactory::getUser();
		$user_id = $user->id;

        $query = "SELECT a.*, ass.name as assignment, u.unitno
		FROM #__timereport_item as a
		LEFT JOIN #__timereport_assignment as ass ON a.assignment_id = ass.id
		INNER JOIN #__timereport_user as u ON a.user_id = u.user_id
		WHERE a.user_id = '$user_id' ";
		$query .= " ORDER BY a.id DESC";
        $db->setQuery($query);
        $this->items = $db->loadObjectList();

		$this->_total = count($this->items);
		if ($this->getState('limit') > 0) {
			$this->items = array_splice($this->items, $this->getState('limitstart'), $this->getState('limit'));
	    }
		
		return $this->items;		
	}
	
	
    public function getPagination()
    {
		jimport('joomla.html.pagination');
		$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		return $this->_pagination;
    }
   
   
    function getTotal()
    {
		return $this->_total;
    }


}