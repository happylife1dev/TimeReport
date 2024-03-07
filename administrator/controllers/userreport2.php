<?php


defined('_JEXEC') or die;


class timereportControlleruserreport2 extends JControllerLegacy
{

	public function report()
	{
		
		ini_set('include_path', ini_get('include_path').';../Classes/');
		include JPATH_SITE.'/administrator/components/com_timereport/library/PHPExcel.php';
		include JPATH_SITE.'/administrator/components/com_timereport/library/PHPExcel/Writer/Excel2007.php';
		
		$users 			= timereportHelper::getTimeUsers();
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
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);	
		
		$i = 0 ;
        $objPHPExcel->getActiveSheet()->setCellValue('A' . (string)($i + 1), 'User'); 
        $objPHPExcel->getActiveSheet()->setCellValue('B' . (string)($i + 1), 'Jan'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('C' . (string)($i + 1), 'Feb'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('D' . (string)($i + 1), 'Mar'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('E' . (string)($i + 1), 'Apr'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('F' . (string)($i + 1), 'May'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('G' . (string)($i + 1), 'June'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('H' . (string)($i + 1), 'July'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('I' . (string)($i + 1), 'Aug'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('J' . (string)($i + 1), 'Sept'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('K' . (string)($i + 1), 'Oct'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('L' . (string)($i + 1), 'Nov'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('M' . (string)($i + 1), 'Dec'); 	
        $objPHPExcel->getActiveSheet()->setCellValue('N' . (string)($i + 1), 'YTD Totals'); 
		
		$count = count($users) + 1;
		$row = 1;
		for ($i = 1; $i < $count; $i++){
			$user = $users[$i - 1];
			if($user_id AND $user->user_id != $user_id){
				continue;
			}			

			$ytd1 	= timereportHelper::getItemsYtdBtUser($user->user_id, 1, $year);
			$ytd2 	= timereportHelper::getItemsYtdBtUser($user->user_id, 2, $year);
			$ytd3 	= timereportHelper::getItemsYtdBtUser($user->user_id, 3, $year);
			$ytd4 	= timereportHelper::getItemsYtdBtUser($user->user_id, 4, $year);
			$ytd5 	= timereportHelper::getItemsYtdBtUser($user->user_id, 5, $year);
			$ytd6 	= timereportHelper::getItemsYtdBtUser($user->user_id, 6, $year);
			$ytd7 	= timereportHelper::getItemsYtdBtUser($user->user_id, 7, $year);
			$ytd8 	= timereportHelper::getItemsYtdBtUser($user->user_id, 8, $year);
			$ytd9 	= timereportHelper::getItemsYtdBtUser($user->user_id, 9, $year);
			$ytd10 	= timereportHelper::getItemsYtdBtUser($user->user_id, 10, $year);
			$ytd11 	= timereportHelper::getItemsYtdBtUser($user->user_id, 11, $year);
			$ytd12 	= timereportHelper::getItemsYtdBtUser($user->user_id, 12, $year);

			
			$objPHPExcel->getActiveSheet()->setCellValue('A' . (string)($row + 1), (string)$user->name);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . (string)($row + 1), (string)$ytd1);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . (string)($row + 1), (string)$ytd2);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . (string)($row + 1), (string)$ytd3);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . (string)($row + 1), (string)$ytd4);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . (string)($row + 1), (string)$ytd5);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . (string)($row + 1), (string)$ytd6);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . (string)($row + 1), (string)$ytd7);
			$objPHPExcel->getActiveSheet()->setCellValue('I' . (string)($row + 1), (string)$ytd8);
			$objPHPExcel->getActiveSheet()->setCellValue('J' . (string)($row + 1), (string)$ytd9);
			$objPHPExcel->getActiveSheet()->setCellValue('K' . (string)($row + 1), (string)$ytd10);
			$objPHPExcel->getActiveSheet()->setCellValue('L' . (string)($row + 1), (string)$ytd11);
			$objPHPExcel->getActiveSheet()->setCellValue('M' . (string)($row + 1), (string)$ytd12);
			$objPHPExcel->getActiveSheet()->setCellValue('N' . (string)($row + 1), (string)($ytd1+$ytd2+$ytd3+$ytd4+$ytd5+$ytd6+$ytd7+$ytd8+$ytd9+$ytd10+$ytd11+$ytd12));

			$row +=1;
		}


		$objPHPExcel->getActiveSheet()->setTitle('Export');
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$u = uniqid();
		$name = JPATH_ROOT.'/administrator/components/com_timereport/controllers/'.$u.'.xlsx';
		$objWriter->save($name);		
		$this->setRedirect(JURI::root().'administrator/components/com_timereport/controllers/'.$u.'.xlsx');		
		
	}	

}
