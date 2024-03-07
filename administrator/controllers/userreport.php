<?php


defined('_JEXEC') or die;


class timereportControlleruserreport extends JControllerLegacy
{

	public function report()
	{
		
		ini_set('include_path', ini_get('include_path').';../Classes/');
		include JPATH_SITE.'/administrator/components/com_timereport/library/PHPExcel.php';
		include JPATH_SITE.'/administrator/components/com_timereport/library/PHPExcel/Writer/Excel2007.php';
		
		$users			= timereportHelper::getTimeUsers();
		$user_id 		= JRequest::getVar('user_id');		

		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("export to excel");
		$objPHPExcel->getProperties()->setLastModifiedBy("export to excel");
		$objPHPExcel->getProperties()->setTitle("export to excel");
		$objPHPExcel->getProperties()->setSubject("export to excel");
		$objPHPExcel->getProperties()->setDescription("export to excel");

		$style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
		'font'  => array('bold'  => false,'color' => array('rgb' => '000000'),'size'  => 13,'name'  => 'arial'));
		$objPHPExcel->getDefaultStyle()->applyFromArray($style);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

		
		$i = 0 ;
        $objPHPExcel->getActiveSheet()->setCellValue('A' . (string)($i + 1), 'User'); 
        $objPHPExcel->getActiveSheet()->setCellValue('B' . (string)($i + 1), 'Assignment'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('C' . (string)($i + 1), 'Month'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('D' . (string)($i + 1), 'Hours'); 	

		
		$count = count($users) + 1;
		$row = 1;

		for ($i = 1; $i < $count; $i++){
			$user = $users[$i - 1];
			if($user_id AND $user->user_id != $user_id){
				continue;
			}			
			
			$objPHPExcel->getActiveSheet()->setCellValue('A' . (string)($row + 1), (string)$user->name);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . (string)($row + 1), '');
			$objPHPExcel->getActiveSheet()->setCellValue('C' . (string)($row + 1), '');
			$objPHPExcel->getActiveSheet()->setCellValue('D' . (string)($row + 1), '');
			$row +=1;
			
			$assignments = timereportHelper::getAssignmentsUser($user->user_id);
			foreach($assignments as $assignment){ 
				$objPHPExcel->getActiveSheet()->setCellValue('A' . (string)($row + 1), '');
				$objPHPExcel->getActiveSheet()->setCellValue('B' . (string)($row + 1), (string)$assignment->name);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . (string)($row + 1), '');
				$objPHPExcel->getActiveSheet()->setCellValue('D' . (string)($row + 1), '');
				$row +=1;
				
				$dates = timereportHelper::getDateWorkUser($user->user_id, $assignment->id);
				foreach($dates as $date){
					$objPHPExcel->getActiveSheet()->setCellValue('A' . (string)($row + 1), '');
					$objPHPExcel->getActiveSheet()->setCellValue('B' . (string)($row + 1), '');
					$objPHPExcel->getActiveSheet()->setCellValue('C' . (string)($row + 1), (string)timereportHelper::convToMonth(date("m",strtotime($date->date))));
					$objPHPExcel->getActiveSheet()->setCellValue('D' . (string)($row + 1), (string)timereportHelper::getTimeFloat($date->hours));
					$row +=1;					
				}	
			}
		}

		$objPHPExcel->getActiveSheet()->setTitle('Export');
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$u = uniqid();
		$name = JPATH_ROOT.'/administrator/components/com_timereport/controllers/'.$u.'.xlsx';
		$objWriter->save($name);		
		$this->setRedirect(JURI::root().'administrator/components/com_timereport/controllers/'.$u.'.xlsx');		
		
	}	

}
