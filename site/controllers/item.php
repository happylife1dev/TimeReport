<?php


defined('_JEXEC') or die('Restricted access');
use Joomla\Utilities\ArrayHelper; 

 
class timereportControlleritem extends JControllerForm
{
	
	
	public function save($key = NULL, $urlVar = NULL)
	{
		$app    = JFactory::getApplication();
		$data   = $this->input->post->get('jform', array(), 'array');
		$model  = $this->getModel();
		$result = $model->save($data);	
		$id = $model->getId();
		
		if($result === true)
		{
			$app->setUserState('com_timereport.edit.item.data', null);
			$this->setRedirect(JRoute::_('index.php?option=com_timereport&view=items', false),"The item was successfully saved");
		} else {
			
			$app->setUserState('com_timereport.edit.item.data', $data);
			$message = $model->getError();			
			$this->setRedirect(JRoute::_('index.php?option=com_timereport&view=item&id='.$id, false),$message,"error");
		}	
		
		return $result;
	}
	
	
	public function saveAndNew($key = NULL, $urlVar = NULL)
	{
		$app    = JFactory::getApplication();
		$data   = $this->input->post->get('jform', array(), 'array');
		$model  = $this->getModel();
		$result = $model->save($data);	
		$id = $model->getId();
		
		if($result === true)
		{
			$app->setUserState('com_timereport.edit.item.data', null);
			$this->setRedirect(JRoute::_('index.php?option=com_timereport&view=item', false),"The item was successfully saved");
		} else {
			
			$app->setUserState('com_timereport.edit.item.data', $data);
			$message = $model->getError();			
			$this->setRedirect(JRoute::_('index.php?option=com_timereport&view=item&id='.$id, false),$message,"error");
		}	
		
		return $result;
	}	
	
	
		
	
	public function add()
	{
		$app = JFactory::getApplication();
		$app->setUserState('com_timereport.edit.item.data', null);
		$this->setRedirect(JRoute::_('index.php?option=com_timereport&view=item', false));
	}
	
	
	
	
}

?>