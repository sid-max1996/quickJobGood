<?php

include_once ROOT."/models/Start.php";


class WorkController {
	
	public static function actionGetPage($param1)
    {
		//header("Cache-Control: no-store, no-cache, must-revalidate");
		$curPageNum = $param1;

		//загрузка файла
		$xls = Start::OpenXLS('/data/SidorenkoIrina.xlsx');
		
		//параметры
		$linesOnPage = 100;
		$xlsRowCount= Start::GetLastRowNum($xls)-1;
		$maxPageNum = (int)($xlsRowCount/$linesOnPage);
		if($xlsRowCount%$linesOnPage!=0)
			$maxPageNum++;
		
		//получение данных
		$xlsArr = array();
		$xlsArr = Start::ArrFromXLS($xls, ($curPageNum-1)*$linesOnPage+1, ($curPageNum-1)*$linesOnPage+$linesOnPage);
		
		//select для com2
		$com2 = array('0', '1', '2', '3', '4', '5');
		include ROOT.'/index.html.php';       
    }
    
}