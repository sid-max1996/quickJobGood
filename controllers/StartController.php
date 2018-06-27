<?php

include_once ROOT."/models/Start.php";


class StartController {
    
    public static function actionGetAll()
    {
		//header("Cache-Control: no-store, no-cache, must-revalidate");
		/*if (strlen('0') != strlen(' '))
			echo "dsa";*/
		$curPageNum = 1;
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
        /*echo "<pre>";
        foreach ($xlsArr as $id => $table){
			echo $id. "</br>";
            foreach ($table as $key => $value){
                echo $key . ' = ' . $value->cell . " " . $value->val . "</br>";
            }
            echo "</br></br>";
        }
		 echo "</pre>";
        //print_r($xlsArr);       
        return true;        */
    }
    
}
