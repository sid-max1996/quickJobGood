<?php
return array(
        //'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',
		'start' => 'start/getAll',
        //'start/page=([0-9]+)' => 'start/getAll/$1', 
		'work/([0-9]+)' => 'work/getPage/$1',
		//'work' => 'work/getPage/1',
		'save' => 'save/changeValue',
		'stats' => 'statistic/execute',
        //'news/([0-9]+)' => 'news/view/$1',
	//'news' => 'news/index', //actionIndex в NewsConroller
	//'products' => 'products/list' //actionList в ProductsController
);