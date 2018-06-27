<?php
require_once (ROOT.'/libs/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
include_once ROOT."/models/CellXls.php";

class Start {
	public static function OpenXLS($path){
		try{
			$xls = PHPExcel_IOFactory::createReader('Excel2007');
			$xls = PHPExcel_IOFactory::load(ROOT.$path);
		}
		catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $xls;
	}

	public static function GetLastRowNum($xls){
		// Устанавливаем индекс активного листа
		$xls->setActiveSheetIndex(0);
		// Получаем активный лист
		$sheet = $xls->getActiveSheet();
		return $sheet->getHighestRow();
	}

	 public static function ArrFromXLS($xls, $start, $finish)
    {
        try {
			// Устанавливаем индекс активного листа
			$xls->setActiveSheetIndex(0);
			// Получаем активный лист
			$sheet = $xls->getActiveSheet();
			$startRow = 2;
			$lastRow = $sheet->getHighestRow();
			if(!is_null($start) && !is_null($finish)){
				$startRow = $start+1;
				$lastRow = $finish+1;
			}
			if($lastRow > $sheet->getHighestRow())
				$lastRow = $sheet->getHighestRow();
			$colsLetters = array('A', 'B', 'C', 'D', 'F', 'G', 'H', 'I', 'J', 'K', 'N', 'O', 'P', 'Q', 'V');
			$colsNames = array('id', 'inn', 'own', 'name', 'ind', 'addr', 'boss_post', 'boss_name',
				'boss_initials', 'boss_sex', 'phone', 'email', 'website', 'description', 'com2');
			for ($row = $startRow; $row <= $lastRow; $row++) {
				for($i=0;$i<count($colsLetters);$i++){
					$cellName = $colsLetters[$i].$row;
					$rowArr[$colsNames[$i]] = new CellXls($cellName, $sheet->getCell($cellName)->getValue());
				}
				$resArr['r'.($row)] = $rowArr;
			}
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resArr;
    }

	public static function SaveXLS($xls, $path){
		try{
			$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
			$objWriter->save(ROOT.$path);
		}
		catch (PDOException $e) {
            echo $e->getMessage();
        }
		return true;
	}

	//'C6', '20dsaas'
	public static function SetValueXLS($xls, $cell, $value){
		$xls->getActiveSheet()->setCellValue($cell, (string)$value);
	}

	public static function ComFromXLS($xls)
    {
        try {
			// Устанавливаем индекс активного листа
			$xls->setActiveSheetIndex(0);
			// Получаем активный лист
			$sheet = $xls->getActiveSheet();
			$startRow = 2;
			$lastRow = $sheet->getHighestRow();

			$colsLetters = array('A', 'V');
			$colsNames = array('id', 'com2');
			for ($row = $startRow; $row <= $lastRow; $row++) {
				for($i=0;$i<count($colsLetters);$i++){
					$cellName = $colsLetters[$i].$row;
					$rowArr[$colsNames[$i]] = new CellXls($cellName, $sheet->getCell($cellName)->getValue());
				}
				$resArr['r'.($row)] = $rowArr;
			}
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resArr;
    }
}
