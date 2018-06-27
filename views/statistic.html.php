  <!DOCTYPE html>  
 <html>  
      <head>            
           <title>Статистика</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   
           <!--<link rel="stylesheet" href="http://localhost/quickJob/template/css/style1.css" />  -->
		   <!--<script src="http://localhost/quickJob/template/js/js1.js"></script>-->
      </head>  
      <body> 
			<h1 align="center" style="color: blue">Статистика</h1>  
           <br /> 
           <div class="container">  
                
                <div class="table-responsive"> 
					<table id="stat" class="table table-striped table-bordered table-condensed table-hover">  
                        <thead>
                               <tr class="bg-warning" id="headers" >  
									<td><b>0</b></td>
                                    <td><b>1</b><?php echo ' ('.($arrCostStat['v1']).')';?></td>
									<td><b>2</b><?php echo ' ('.($arrCostStat['v2']).')';?></td>
									<td><b>3</b><?php echo ' ('.($arrCostStat['v3']).')';?></td>
									<td></td>
									<td>всего</td>
                               </tr>	     
                         </thead> 
						 <tbody>		
                          <?php  
							echo '  
                               <tr>  
                                    <td>'.$arrStat['v0'].'</td>  				
                                    <td>'.$arrStat['v1'].'</td> 
									<td>'.$arrStat['v2'].'</td> 
									<td>'.$arrStat['v3'].'</td> 
									<td>'.$arrStat['vNull'].'</td> 
									<td>'.$arrStat['vAll'].'</td> 
                               </tr>  
                               ';
							   echo '  
                               <tr>  
                                    <td>'.'-'.'</td>  				
                                    <td>'.$arrSumStat['v1'].' руб'.'</td> 
									<td>'.$arrSumStat['v2'].' руб'.'</td> 
									<td>'.$arrSumStat['v3'].' руб'.'</td> 
									<td>-</td> 
									<td>'.$totalSum.' руб'.'</td> 
                               </tr>  
                               ';
                          ?>  
						  </tbody>
                     </table> 					
                     <table id="all_data" class="table table-striped table-bordered table-condensed table-hover">  
                        <thead>
                               <tr class="bg-primary" id="headers" >  
									<td>num</td>
                                    <td>com2</td>
                               </tr>	     
                         </thead> 
						 <tbody>		
                          <?php  
                          foreach ($xlsStat as $id => $row){
                            echo '  
                               <tr>  
                                    <td class="bg-info">'.substr($id, 1).'</td>  				
                                    <td class="com2">'.$row["com2"]->val.'</td>
                               </tr>  
                               ';
                          } 
                          ?>  
						  </tbody>
                     </table> 		
                </div>  
           </div>  
      </body>  
 </html>
 
 <script>
	(function ($) {
			$.fn.СoloringCom = function () { 
				var table = $(this);
                var child = 'tbody tr td[class="com2"]';  
                var allCom =  $(this).find(child);
                
                allCom.each(function(){
					var classAdd = "bg-success";
					var val = $(this).text();
					if (val == "0")
						classAdd = "bg-danger";
					if(val.trim() != '')
						$(this).addClass(classAdd);
				});
            };
    })(jQuery);
		
	$(document).ready(function () {
		$('#all_data').СoloringCom();
	});
 </script>
 
