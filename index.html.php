  <!DOCTYPE html>
 <html>
      <head>
           <title>Таблица Эксель</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <link rel="stylesheet" href="http://localhost/quickJobGood/template/css/style1.css" />
		   <script src="http://localhost/quickJobGood/template/js/js1.js"></script>
      </head>
      <body>
           <br />
           <div class="container">
				<a href="http://localhost/quickJobGood/start"><i class="glyphicon glyphicon-home" style="color:green; font-size:25px;"></i></a>
                <a href="http://localhost/quickJobGood/data/SidorenkoIrina.xlsx" target="_blank"
					style="padding-left: 15px"><i class="glyphicon glyphicon-download-alt" style="color:green; font-size:25px;"></i></a>
				 <a href="http://localhost/quickJobGood/stats" target="_blank"
					style="padding-left: 15px"><i class="glyphicon glyphicon-stats" style="color:green; font-size:25px;"></i></a>
				<?php echo "<space class='pageNumber' style='padding-left: 10px'>страница #".$curPageNum."</space>"; ?>
                </br></br>
				<div class="pagination">
				<!--<a href="http://localhost/quickJobGood/work/1" style="padding-right: 150px"><i class="glyphicon glyphicon-arrow-left" style="color:green; font-size:25px;"></i></a>-->
				<?php
				if($curPageNum-1 > 0)
					echo '<a class="previous_page" rel="prev" href="http://localhost/quickJobGood/work/'.($curPageNum-1).'"><i class="glyphicon glyphicon-chevron-left"
				style="color:green; font-size:17px;"></i></a>';
				?>
				<?php
				for($i=1; $i <= $maxPageNum; $i++)
					echo'<a href="http://localhost/quickJobGood/work/'.$i.'">'.$i.'</a>';
				if($curPageNum < $maxPageNum)
					echo '<a class="next_page" rel="next" href="http://localhost/quickJobGood/work/'.($curPageNum+1).'"><i class="glyphicon glyphicon-chevron-right"
				style="color:green; font-size:17px;"></i></a>';
				/*echo '<a href="http://localhost/quickJobGood/work/'.$maxPageNum.'" style="padding-left: 150px"><i class="glyphicon glyphicon-arrow-right"
				style="color:green; font-size:25px;"></i></a>';*/
				?>
				</div>
				</br></br>
                <div class="table-responsive">
                     <table id="main_data" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                           <tr id="headers">
              									<td>num</td>
              									<td>own</td>
              									<td>name</td>
                                <td>inn</td>
                                <td>addr</td>
                                <td>ind</td>
                                <td>bs_post</td>
                                <td>bs_name</td>
                                <td>bs_ini</td>
                                <td>bs_sex</td>
                                <td>phone</td>
                                <td>email</td>
                                <td>site</td>
                                <td>descr</td>
                                <td>comm</td>
                           </tr>
                     </thead>
				             <tbody>
                      <?php
                      foreach ($xlsArr as $id => $row){
                        echo '
                           <tr>
                                <td>'.substr($id, 1).'
                          </td>

                        <td>
        									<input type="checkbox"><br>
        									<select id="'.$row["own"]->cell.'" class="fromSel" style="width: 40px">
        										<option selected=""></option>
        										<option>ООО</option>
                            <option>ИП</option>
        										<option>АО</option>
        										<option>ЗАО</option>
        										<option>ПАО</option>
        									</select>
        									<textarea id="'.$row["own"]->cell.'"placeholder="own" cols="3">'.$row["own"]->val.'</textarea>
                        </td>


                        <td>
      										<input type="checkbox">
      										<a class="rusProfHref"
      										href="http://www.rusprofile.ru/search?query='.str_replace('"', '', $row["name"]->val).'"target="_blank"><i class="glyphicon glyphicon-rub" style="color:green; font-size:17px;"></i></a>
      										<a class="removeText" style="cursor: pointer">
      										<i class="glyphicon glyphicon-remove-circle" style="color:#CD5C5C; font-size:20px;"></i></a>
      										<textarea id="'.$row["name"]->cell.'"placeholder="name"
      										class="rusProf"
      										cols="9">'.$row["name"]->val.'</textarea>
      									</td>

                        <td>
      										<input type="checkbox">
      										<a class="rusProfHref"
      										href="http://www.rusprofile.ru/search
      										?query='.$row["inn"]->val.'"target="_blank"><i class="glyphicon glyphicon-rub" style="color:green; font-size:17px;"></i></a>
      										<textarea class="rusProf"
      										id="'.$row["inn"]->cell.'"placeholder="inn" cols="5">'.$row["inn"]->val.'</textarea>
      									</td>

                        <td>
      										<input type="checkbox">';
        									$addrArr = explode(" ", $row["addr"]->val);
        									echo ' <a class="rusProfHref"
        									href="http://www.rusprofile.ru/search?query';
        									echo'='.$addrArr[0].' '.$addrArr[1].'"target="_blank"><i class="glyphicon glyphicon-rub" style="color:green; font-size:17px;"></i></a>
        									<a class="removeText" style="cursor: pointer">
        									<i class="glyphicon glyphicon-remove-circle" style="color:#CD5C5C; font-size:20px;"></i></a>
      										<textarea id="'.$row["addr"]->cell.'"placeholder="address"
      										class="rusProf"
      										cols="8">'.$row["addr"]->val.'</textarea>
      									</td>

                        <td>
        									<input type="checkbox">
        									<textarea id="'.$row["ind"]->cell.'"placeholder="bs_name" cols="6">'.$row["ind"]->val.'</textarea>
                        </td>

                        <td>
        									<select id="'.$row["boss_post"]->cell.'" class="fromSel" style="width: 70px">
        										<option selected=""></option>
        										<option>Генеральный директор</option>
        										<option>Директор</option>
        										<option>Индивидуальный предприниматель</option>
        										<option>Президент</option>
          								</select>
          								<textarea id="'.$row["boss_post"]->cell.'"placeholder="bs_post" cols="7">'.$row["boss_post"]->val.'</textarea>
                        </td>

                        <td>
        									<input type="checkbox">
        									<textarea id="'.$row["boss_name"]->cell.'"placeholder="bs_name" cols="8">'.$row["boss_name"]->val.'</textarea>
                        </td>

                        <td>
      										</br><textarea id="'.$row["boss_initials"]->cell.'"placeholder="bs_ini" cols="6">'.$row["boss_initials"]->val.'</textarea>
      									</td>

                        <td>
                          <select id="'.$row["boss_sex"]->cell.'" class="fromSel" style="width: 40px">
                            <option selected=""></option>
                            <option>м</option>
                            <option>ж</option>
                          </select></br>
                          <textarea id="'.$row["boss_sex"]->cell.'"placeholder="sex" cols="3">'.$row["boss_sex"]->val.'</textarea>
                        </td>

                        <td>
      										<a class="removeText" style="cursor: pointer">
      										<i class="glyphicon glyphicon-remove-circle" style="color:#CD5C5C; font-size:20px;"></i></a>
      										<textarea id="'.$row["phone"]->cell.'"placeholder="phone" cols="13">'.$row["phone"]->val.'</textarea>
      									</td>

                        <td>
      										<a class="removeText" style="cursor: pointer">
      										<i class="glyphicon glyphicon-remove-circle" style="color:#CD5C5C; font-size:20px;"></i></a>
      										<textarea id="'.$row["email"]->cell.'"placeholder="email" cols="8">'.$row["email"]->val.'</textarea>
      									</td>

                        <td>';
      										$webArr = explode(",", $row["website"]->val, 3);
      										if($webArr != false){
      											/*for($i=0;$i<count($webArr);$i++){
      												echo'<a href="'.$webArr[$i].'"target="_blank"><i class="glyphicon glyphicon-eye-open" style="color:green; font-size:17px;"></i></a>';
      											}*/
      											echo'<a href="'.$webArr[0].'"target="_blank"><i class="glyphicon glyphicon-eye-open" style="color:green; font-size:17px;"></i></a>';
      										}else
      											echo'<a href="'.$row["website"]->val.'"target="_blank"><i class="glyphicon glyphicon-eye-open" style="color:green; font-size:17px;"></i></a>';

        									echo '<textarea id="'.$row["website"]->cell.'"placeholder="website" cols="6">'.$row["website"]->val.'</textarea>
      									</td>

                        <td>
                          </br><textarea id="'.$row["description"]->cell.'"placeholder="descr" cols="8">'.$row["description"]->val.'</textarea>
                        </td>

                        <td>
        									<a class="rusProfSearch" href="#" target="_blank"><i class="glyphicon glyphicon-search" style="color:green; font-size:17px;"></i></a>';
        									echo '<br><a class="yandexSearch" href="#" target="_blank"><i class="glyphicon glyphicon-globe" style="color:green; font-size:17px;"></i></a>';
        									$cur = $row["com2"]->val;
        									/*if($cur != "1" && $cur != "2")
        										$cur = "0";*/
        									echo '<select id="'.$row["com2"]->cell.'" class="com2Sel">
                                                    <option selected="">'.$cur.'</option>';
        									$num = count($com2);
        									for($i=0;$i<$num;$i++){
        										if($cur != $com2[$i]){
        											if($cur == 0 && $com2[$i] == 0 && strlen($cur) == strlen($com2[$i]))
        												break;
        											else
        												echo '<option>'.$com2[$i].'</option>';
        										}
        									}
                                            echo'</select>
        									</br></br>
        									<a class="save" style="cursor: pointer">
        									<i class="glyphicon glyphicon-floppy-disk" style="color:#4682B4; font-size:25px;"></i></a>
        									</br>
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
    				<a href="http://localhost/quickJobGood/work/1" style="padding-right: 150px"><i class="glyphicon glyphicon-arrow-left" style="color:green; font-size:25px;"></i></a>
    				<?php
    				if($curPageNum-1 > 0)
    					echo '<a class="previous_page" rel="prev" href="http://localhost/quickJobGood/work/'.($curPageNum-1).'"><i class="glyphicon glyphicon-chevron-left"
    				style="color:green; font-size:17px;"></i></a>';
    				?>
    				<?php
    				for($i=1; $i <= $maxPageNum; $i++)
    					echo'<a href="http://localhost/quickJobGood/work/'.$i.'">'.$i.'</a>';
    				if($curPageNum < $maxPageNum)
    					echo '<a class="next_page" rel="next" href="http://localhost/quickJobGood/work/'.($curPageNum+1).'"><i class="glyphicon glyphicon-chevron-right"
    				style="color:green; font-size:17px;"></i></a>';
    				echo '<a href="http://localhost/quickJobGood/work/'.$maxPageNum.'" style="padding-left: 150px"><i class="glyphicon glyphicon-arrow-right"
    				style="color:green; font-size:25px;"></i></a>';
    				?>
    			</div>
  			</br></br>
      </body>
 </html>

 <script>


 </script>
