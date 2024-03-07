<?php


defined('_JEXEC') or die();
defined('JPATH_BASE') or die;

jimport('joomla.html.html');


class JFormFieldassignments extends JFormField {
	
	protected $type = 'assignments';
	
	protected function getInput()
	{
		
		$attr = ''; 
		$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';
		$attr .= $this->element['multiple']=='true' ? ' multiple="multiple"' : '';
		$db 	= JFactory::getDBO();
		$query = "SELECT * FROM #__timereport_assignment WHERE published = 1 ORDER BY `ordering` ASC ";
		$db->setQuery($query);
		$results = $db->loadObjectList();
		
		foreach($results as $result){
			$options[] = array('text' => $result->name,'value' => $result->id);
		}	
		
		$html = JHTML::_('select.genericlist', $options, $this->name, trim($attr), 'value', 'text', $this->value);
		return ($html);	
	}
}
?>