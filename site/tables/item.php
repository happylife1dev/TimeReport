<?php


// No direct access
defined('_JEXEC') or die('Restricted access');
 

class timereportTableitem extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__timereport_item', 'id', $db);
	}
	
}