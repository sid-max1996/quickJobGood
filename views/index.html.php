  <!DOCTYPE html>  
 <html>  
      <head>            
           <title>Таблица результатов анализов</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   
           <link rel="stylesheet" href="http://localhost/quickJob/template/css/style1.css" />  
		   <script src="http://localhost/quickJob/template/js/js1.js"></script>
      </head>  
      <body>  
           <br /> 
           <div class="container">  
                <h3 align="center">Работать Работать!!! Не Лениться!!!</h3>  
                </br> 
                <div class="table-responsive">  
                     <table id="main_data" class="table table-striped table-bordered table-condensed table-hover">  
                        <thead>
                               <tr id="headers">  
									<td>num</td>
									<td>own</td>
									<td>name</td>  
                                    <td>inn</td>                                     
                                    <td>address</td>  
                                    <td>boss_post</td>  
                                    <td>boss_name</td>   
                                    <td>boss_initials</td>   
                                    <td>phone</td>
                                    <td>email</td>
                                    <td>website</td>
                                    <td>com1</td>
                                    <td>com2</td>
                               </tr>	     
                         </thead> 
						 <tbody>		
                          <?php  
                          foreach ($xlsArr as $id => $row){
                            echo '  
                               <tr>  
                                    <td>'.substr($id, 1).'</td>  
									<td><textarea id="'.$row["own"]->cell.'"placeholder="own" cols="3">'.$row["own"]->val.'</textarea></td>
									<td><textarea id="'.$row["name"]->cell.'"placeholder="name" cols="9">'.$row["name"]->val.'</textarea></td>  
                                    <td><textarea id="'.$row["inn"]->cell.'"placeholder="inn" cols="5">'.$row["inn"]->val.'</textarea></td>                                     
                                    <td><textarea id="'.$row["addr"]->cell.'"placeholder="address" cols="10">'.$row["addr"]->val.'</textarea></td>  
                                    <td><textarea id="'.$row["boss_post"]->cell.'"placeholder="boss_post" cols="9">'.$row["boss_post"]->val.'</textarea></td>  
                                    <td><textarea id="'.$row["boss_name"]->cell.'"placeholder="boss_name" cols="12">'.$row["boss_name"]->val.'</textarea></td> 
                                    <td><textarea id="'.$row["boss_initials"]->cell.'"placeholder="boss_initials" cols="12">'.$row["boss_initials"]->val.'</textarea></td>   
                                    <td><textarea id="'.$row["phone"]->cell.'"placeholder="phone" cols="14">'.$row["phone"]->val.'</textarea></td>
                                    <td><textarea id="'.$row["email"]->cell.'"placeholder="email" cols="8">'.$row["email"]->val.'</textarea></td>
                                    <td><textarea id="'.$row["website"]->cell.'"placeholder="website" cols="6">'.$row["website"]->val.'</textarea></td>
                                    <td><textarea id="'.$row["com1"]->cell.'"placeholder="com1" cols="8">'.$row["com1"]->val.'</textarea></td>
                                    <td><select>
                                            <option selected="">'.$row["com2"]->val.'</option>';
									$num = count($com2);	
									for($i=0;$i<$num;$i++){
										echo '<option>'.$com2[$i].'</option>';
									}       
                                    echo'</select>
									</td>
                               </tr>  
                               ';
                          } 
                          ?>  
						  </tbody>
                     </table> 		
                </div>  
           </div>  
		   <div class="pagination">
				<?php
				if($curPageNum-1 > 0)
					echo '<a class="previous_page" rel="prev" href="http://localhost/quickjob/start/page='.($curPageNum-1).'">«</a>';
				?>
				<em><?php echo $curPageNum; ?></em> 
				<?php
				if($curPageNum < $maxPageNum-1){
					if($curPageNum+1 < $maxPageNum-2){
						echo'<a href="http://localhost/quickjob/start/page='.($curPageNum+1).'">'.($curPageNum+1).'</a>
						<a href="http://localhost/quickjob/start/page='.($curPageNum+2).'">'.($curPageNum+2).'</a>'; 
						if($curPageNum != $maxPageNum-4)
							echo '<span class="gap">…</span>';
					}
					if($curPageNum == $maxPageNum-3)
						echo'<a href="http://localhost/quickjob/start/page='.($curPageNum+1).'">'.($curPageNum+1).'</a>';
					echo'<a href="http://localhost/quickjob/start/page='.($maxPageNum-1).'">'.($maxPageNum-1).'</a> 
					<a href="http://localhost/quickjob/start/page='.($maxPageNum).'">'.$maxPageNum.'</a>';
				}
				if($curPageNum < $maxPageNum)
					echo '<a class="next_page" rel="next" href="http://localhost/quickjob/start/page='.($curPageNum+1).'">»</a>';
				?>
			</div>
			</br></br>
      </body>  
 </html>
 
 <script>
		/*$.ajax({
			url: "quickJob/save",
			success: function(data){
				alert( "Прибыли данные: " + data );
			}
		});*/
            $.post("quickJob/save", {}, function (data) {
                alert( "Прибыли данные: " + data );
            });

 </script>
