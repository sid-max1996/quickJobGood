<?php
	define('ROOT', dirname(__FILE__));
	include_once ROOT."/models/Start.php";
	//загрузка файла
	 try {
		$str = $_POST['ajaxStr'];
		//Ищем телефонные номера для того чтобы поставить запятые
		$search = 'Q';
		$pos = strpos($str, $search); 
		if($pos!==false)
		{
			$search = '~';
			$pos1 = strpos($str, $search, $pos+1);
			$pos2 = strpos($str, $search, $pos1+1);
			$len = $pos2 - $pos1 - 1;
			$strReplace = substr($str, $pos1+1, $len);
			//первая версия где пробелы между цифрами становились запятыми
			/*$strReplace = preg_replace('/(\d)([^0-9, ]+)(\d)/i', "$1$3", $strReplace);
			$strReplace = preg_replace('/^(\s+)/', '', $strReplace);
			$strReplace = preg_replace('/(\d)(\s+)(\d)/i', "$1, $3", $strReplace);
			$strReplace = preg_replace('/(\s+)$/', '', $strReplace);*/
			//вторая версия где номера строго по 11 цифр
			/*$strReplace = preg_replace('/([^0-9]+)/', "", $strReplace);
			$strReplace = preg_replace('/(\d)(\d{10})/i', "7$2, ", $strReplace);
			$strReplace = preg_replace('/(,\s)$/', "", $strReplace);
			$str = substr_replace($str, $strReplace, $pos1+1, $len);
			echo $strReplace."~";*/
		}
		$arr = explode("~", $str);
		$xls = Start::OpenXLS('/data/SidorenkoIrina.xlsx');
		$backAnswer = "";
		$count = count($arr);
		$cell;$val;
		for($i=0;$i<$count;$i+=2){
			$cell = $arr[$i];
			$val = $arr[$i+1];
			$backAnswer = $backAnswer.$cell."~".$val."~";
			if($val == "_backspace_")
				$val = "";
			Start::SetValueXLS($xls, $cell, $val);
		}
		Start::SaveXLS($xls, '/data/SidorenkoIrina.xlsx');
		echo $backAnswer;
	 }
	 catch (PDOException $e) {
        echo $e->getMessage();
     }
?>