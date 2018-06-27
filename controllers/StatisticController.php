<?php

include_once ROOT."/models/Start.php";

class StatisticController {
	
	public static function actionExecute()
    {

		//загрузка файла
		$xls = Start::OpenXLS('/data/SidorenkoIrina.xlsx');
		
		//получение данных
		$xlsStat = array();
		$xlsStat = Start::ComFromXLS($xls);
		$arrStat  = array('v0'=>0,'v1'=>0,'v2'=>0, 'v3'=>0, 'vNull'=>0, 'vAll'=>0);
		$arrCostStat  = array('v0'=>0,'v1'=>5,'v2'=>17, 'v3'=>7);
		foreach ($xlsStat as $id => $row){
			$arrStat['vAll'] += 1;
			$val = $row["com2"]->val;
			if ($val == '0' && strlen($val)==1)
				$arrStat['v0'] += 1;  
			else if ($val == '1')
				$arrStat['v1'] += 1; 
			else if ($val == '2')
				$arrStat['v2'] += +1; 
			else if ($val == '3')
				$arrStat['v3'] += +1; 
			else 
				$arrStat['vNull'] += +1;
        } 
		$arrSumStat  = array('v0'=>0,'v1'=>0,'v2'=>0, 'v3'=>0);
		$totalSum = 0;
		for ($i=0;$i<count($arrSumStat);$i++){
			$arrSumStat['v'.$i] += $arrStat['v'.$i]*$arrCostStat['v'.$i];
			$totalSum += $arrSumStat['v'.$i];
		}
		include ROOT.'/views/statistic.html.php';       
    }
    
}