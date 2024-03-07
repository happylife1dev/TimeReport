<?php


// No direct access
defined('_JEXEC') or die('Restricted access');
 

class timereportTableassignments extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__timereport_assignment', 'id', $db);
	}
	
}