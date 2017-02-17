	
<div class="row labels">
		<div class="col-xs-11 col-md-11"><h2 style="margin-top:0px;">Bevételek hozzáadása</h2></div>
		<div class="eye col-xs-1 col-md-1"><button type="button" id="bev_shbt" onclick="showHiddenBev(this.value)" value="0" name="hide_show" class="btn btn-default"><span id="bev_show_hide" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></div>
			</div>							
		<?php
		if($editedBevRow!=-1){
			$data=mysqli_query(getDatabaseConnect(),"SELECT * FROM kltsg_submissions_bevetel WHERE id=".$editedBevRow."");
							
			while($record=mysqli_fetch_array($data))
			{
				$rovat = $record['sub_id'];
				$afk = $record['tax'];
				$nt_summa = $record['netto_osszes'];
				$af_summa = $record['afa_osszes'];
				$bt_summa = $record['brutto_osszes'];

			}
				
		}else{
				$rovat = (empty($_GET["bev_rovat"]))? "" : $_GET["bev_rovat"];
				$nt_summa = (empty($_GET["bev_nt_summa"]))? "" : $_GET["bev_nt_summa"];
				$afk = (empty($_GET["bev_afk"]))? "" : $_GET["bev_afk"];
				$af_summa = (empty($_GET["bev_af_summa"]))? "" : $_GET["bev_af_summa"];
				$bt_summa = (empty($_GET["bev_bt_summa"]))? "" : $_GET["bev_bt_summa"];
				$menny_summa = (empty($_GET["bev_menny_summa"]))? "" : $_GET["bev_menny_summa"];					
		}
		?>
		
		
			<form id="form" action="form.php" method="GET">
			<div class="row labels">
				<div class="col-xs-3 col-md-3">Rovat</div>
				<div class=" collapsed col-xs-1 col-md-1">Nettó</div>
				<div class="col-xs-1 col-md-1">Áfakulcs</div>
				<div class="collapsed col-xs-1 col-md-1">Áfa</div>
				<div class="collapsed col-xs-1 col-md-1">Bruttó</div>
				<div class="col-xs-1 col-md-1"></div>
			</div>
			<div class="row">
				<div class="col-xs-3 col-md-3">
						<div class="dropdown">
							<select name="bev_rovat" onChange="bev_stepAF(this.id)" id="data_bev1" class="form-control add-panel-select" >
								
								<?php
								
								
								
								
								if($rovat==""){
									echo '<option value="999" selected>Válasszon...</option>';
								}
								
								
								$category=mysqli_query(getDatabaseConnect(),"SELECT * FROM kltsg_category_bev ORDER BY code ASC");
								while($record=mysqli_fetch_array($category))
								{								
									if($rovat==$record['id']){
										echo "<option value=".$record['id']." selected>".$record['code']." - ".$record['name']."</option>";
									}else{
										echo "<option value=".$record['id'].">".$record['code']." - ".$record['name']."</option>";
									}
								}
								?>	
							</select>
						</div>	    
				</div>

				<?php
				echo '<div class="collapsed col-xs-1 col-md-1">
							<input name="bev_nt_summa" type="number" min="0" step="any" id="data_bev3" value="'.$nt_summa.'" class="form-control" placeholder="Összesen" readonly/>
				</div>
				<div class="col-xs-1 col-md-1">
							<div class="dropdown">
							<select name="bev_afk" onChange="bev_fillTaxValue(this.id)" onchange="" id="data_bev4" class="form-control add-panel-select"  >';
							
							
							if($editedBevRow!=-1){
								$tax=mysqli_query(getDatabaseConnect(),"SELECT * FROM kltsg_tax ORDER BY value");
								while($record=mysqli_fetch_array($tax))
								{
									if($afk==$record['value']){
										echo "<option value=".$record['value']." selected>".$record['value']."%</option>";
									}else{
										echo "<option value=".$record['value']." >".$record['value']."%</option>";
									}
								}
							}else{
								if($afk==""){
									echo '<option value="999" selected>Válasszon...</option>';
								}
								$tax=mysqli_query(getDatabaseConnect(),"SELECT * FROM kltsg_tax ORDER BY value");
								while($record=mysqli_fetch_array($tax))
								{
									if($afk==$record['value']){
										echo "<option value=".$record['value']." selected>".$record['value']."%</option>";
									}else{
										echo "<option value=".$record['value']." >".$record['value']."%</option>";
									}
								}
							}
							echo '</select>
							</div>
				</div>
				<div class="collapsed col-xs-1 col-md-1">
							<input type="number" name="bev_af_summa" min="0" step="any" id="data_bev5"  value="'.$af_summa.'" class="form-control" placeholder="Összesen" readonly/>
				</div>
								<div class="collapsed col-xs-1 col-md-1">
							<input type="number" name="bev_bt_summa" min="0" step="any" id="data_bev6"  value="'.$bt_summa.'" class="form-control" placeholder="Összesen" readonly/>
				</div>
								';
				
				?>
				
				<div class="col-xs-1 col-md-1"></div>
				<div class="col-xs-2 col-md-2">
					
				</div>
				</div>
			<div id="details"><table class="table table-bordered"><thead>
			<tr class="subtable"><th colspan="">Tervezett beszerzés/igénylés</th><th class="collapsed">Nettó egységár</th><th class="collapsed">Áfakulcs</th><th class="collapsed">Áfa egységár</th><th>Bruttó egységár</th><th>Mennyiség</th><th>Mértékegység</th><th class="collapsed">Nettó összesen</th><th class="collapsed">Áfa összesen</th><th class="collapsed">Brutto összesen</th></tr>
			</thead>
			<?php 	
				//$bev_adatok = array();
				
				$uji=0;
				
				for($i=0;$i<$bev_rownumber;$i++){
				
				if($editedBevRow!=-1){
					$edit=mysqli_query(getDatabaseConnect(),"SELECT * FROM kltsg_submissions_bevetel WHERE id=".$editedBevRow."");
							$wi=0;
							while($row=mysqli_fetch_array($edit))
							{
								$megnev = $row['megnevezes'];
								$ntegys = $row['netto_egysegar'];
								$afk_egys = $row['tax'];
								$af_egys = $row['afa_ossz_egyseg'];
								$bt_egys = $row['brutto_egysegar'];
								$menny = $row['mennyiseg'];
								$egyseg = $row['quant'];
								$nt_ossz = $row['netto_osszes'];
								$af_ossz = $row['afa_osszes'];
								$bt_ossz = $row['brutto_osszes'];
							}
				}else{
					$megnev = (empty($_GET["bev_megnev#".$i]))? "": $_GET["bev_megnev#".$i];
					$ntegys = (empty($_GET["bev_nt_egys#".$i]))? "":$_GET["bev_nt_egys#".$i];
					$afk_egys = (empty($_GET["bev_afk"]))? "":$_GET["bev_afk"];
					$af_egys = (empty($_GET["bev_af_egys#".$i]))? "":$_GET["bev_af_egys#".$i];
					$bt_egys = (empty($_GET["bev_bt_egys#".$i]))? "":$_GET["bev_bt_egys#".$i];
					$menny = (empty($_GET["bev_menny#".$i]))? "":$_GET["bev_menny#".$i];
					$egyseg = (empty($_GET["bev_egyseg#".$i]))? "" : $_GET["bev_egyseg#".$i];
					$nt_ossz = (empty($_GET["bev_nt_ossz#".$i]))? "":$_GET["bev_nt_ossz#".$i];
					$af_ossz = (empty($_GET["bev_af_ossz#".$i]))? "":$_GET["bev_af_ossz#".$i];
					$bt_ossz = (empty($_GET["bev_bt_ossz#".$i]))? "":$_GET["bev_bt_ossz#".$i];
				}			
				if($i!=$bev_rfd){
				$bev_adatok[$uji]['rovat_id']=$rovat;
				$bev_adatok[$uji]['megnev']=$megnev;
				$bev_adatok[$uji]['nt_egys']=$ntegys;
				$bev_adatok[$uji]['afk_egys']=$afk_egys;
				$bev_adatok[$uji]['af_egys']=$af_egys;
				$bev_adatok[$uji]['bt_egys']=$bt_egys;
				$bev_adatok[$uji]['menny']=$menny;
				$bev_adatok[$uji]['egyseg']=$egyseg;
				$bev_adatok[$uji]['nt_ossz']=$nt_ossz;
				$bev_adatok[$uji]['af_ossz']=$af_ossz;
				$bev_adatok[$uji]['bt_ossz']=$bt_ossz;
				
				$bev_sorok[$uji][0]= '
				<tr><td><textarea placeholder="Megnevezés" style="height:34px" ondblclick="commentBevRow(this.id)" name="bev_megnev#'.$uji.'" id="subData_bev#'.$uji.'#2" class="form-control" required>'.$megnev.'</textarea></td>
					<td class="collapsed">
					<input type="text" min="0" step="any"  id="subData_bev#'.$uji.'#3" class="form-control" placeholder="Egységár" name="bev_nt_egys#'.$uji.'" value="'.$ntegys.'" readonly/></td>
					<td class="collapsed">
					<input type="number" min="0" step="any" id="subData_bev#'.$uji.'#4" class="form-control" placeholder="Áfakulcs" name="bev_afk_egys" value="'.$afk_egys.'" readonly/></td>
					<td class="collapsed">
					<input type="number" min="0" step="any" id="subData_bev#'.$uji.'#5" class="form-control" placeholder="Egységár" name="bev_af_egys#'.$uji.'"  value="'.$af_egys.'" readonly/></td>
					<td>
					<input onKeyUp="bev_unitValue(this.id)" type="number" min="0" step="any" id="subData_bev#'.$uji.'#6" class="form-control" placeholder="Egységár"  name="bev_bt_egys#'.$uji.'" value="'.$bt_egys.'" required/></td>
					<td>
					<input onKeyUp="bev_unitSum(this.id)" type="number" min="0" step="any" id="subData_bev#'.$uji.'#7" class="form-control" placeholder="Mennyiség"  name="bev_menny#'.$uji.'" value="'.$menny.'" required/></td>
					<td>
						<div class="dropdown">
						<select name="bev_egyseg#'.$uji.'" onKeyUp="bev_stepAF(this.id)" id="subData_bev#'.$uji.'#8" class="form-control add-panel-select" required >';
							$bev_sorok[$uji][1]= '<option value="" selected>Válasszon...</option>';
							
							$quant=mysqli_query(getDatabaseConnect(),"SELECT * FROM kltsg_quant ORDER BY id");
							$wi=0;
							while($record=mysqli_fetch_array($quant))
							{
								if($record['id']==$egyseg){
								$bev_sorok[$uji][2][$wi] =  "<option value=".$record['id']." selected>".$record['name']."</option>";
								}else{
								$bev_sorok[$uji][2][$wi] =  "<option value=".$record['id'].">".$record['name']."</option>";
								}
								$wi++;
							}
						$bev_sorok[$uji][3]= '</select>
						</div>
					</td>
					<td class="collapsed">
					<input type="number" min="0" step="any" id="subData_bev#'.$uji.'#9" class="form-control" placeholder="Nettó össz." name="bev_nt_ossz#'.$uji.'" value="'.$nt_ossz.'" readonly/></td>
					<td class="collapsed">
					<input type="number" min="0" step="any" id="subData_bev#'.$uji.'#10" class="form-control" placeholder="Áfa össz." name="bev_af_ossz#'.$uji.'" value="'.$af_ossz.'" readonly/></td>
					<td class="collapsed">
					<input type="number" min="0" step="any" id="subData_bev#'.$uji.'#11" class="form-control" placeholder="Bruttó össz." name="bev_bt_ossz#'.$uji.'" value="'.$bt_ossz.'" readonly/></td>';
					
				//echo'<td>
				//<button type="submit" id="'.$uji.'" onclick="return bev_deleteSelectedRow(this.id)" value="'.$uji.'" name="bev_rfd" class="btn //btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
				//</td></tr>';

				$bev_sorok[$uji][4]='';
				if($uji!=0){	
					$bev_sorok[$uji][4]='<td class="muv"><button type="submit" id="'.$uji.'" onclick="return bev_deleteSelectedRow(this.id)" value="'.$uji.'" name="bev_rfd" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>';
				}
				$bev_sorok[$uji][5]='';
				if($editedBevRow==-1){
					
					$meg=0;
					if($bev_rfd!=99999){
						$meg=1;
					}
					
					if($uji+$meg==$bev_rownumber-1){
						$bev_sorok[$uji][5]='<td class="muv"><button type="submit" name="bev_ujsor" value="1" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>';
					}
				
				}
				
				$bev_sorok[$uji][6]='</tr>';
				
				
				
				
				
				$uji++;
				
				}
				}
		
				
				for($i=0;$i<count($bev_sorok);$i++){
				
			    echo $bev_sorok[$i][0].$bev_sorok[$i][1];
				
					for($j=0;$j<count($bev_sorok[$i][2]);$j++){
						echo $bev_sorok[$i][2][$j];
					}
				 echo $bev_sorok[$i][3].$bev_sorok[$i][4].$bev_sorok[$i][5].$bev_sorok[$i][6];
				}
				?>
			</table>
			
			 <?php
					echo "<input type='hidden' name='institute' value='".$inst."'/>";
					echo "<input type='hidden' name='unit' value='".$unit."'/>";
					echo "<input type='hidden' name='bev_rows' value='".count($bev_sorok)."'/>";
					echo "<input type='hidden' name='rows' value='1'/>";
					echo "<input type='hidden' name='active_tab' value='bev'/>";
	
		if($editedBevRow!=-1){
	echo "<input type='hidden' name='rowid' value='".$editedBevRow."'/>";
		echo '<button type="submit" value="1" name="save_edit_bev" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;Sor mentése</button>&nbsp;<button type="button" value="1" id="'.$editedBevRow.'" onclick="delBevRow(this.id)" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Sor törlése</button>&nbsp;<button type="button" value="1" onclick="cancel()" class="btn btn-warning"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>&nbsp;Mégse</button>
		';
	}else{
		echo '<button type="submit" onclick="return validateBevForm()" value="1" name="upload_bev" class="btn btn-success"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>&nbsp;Rovat rögzítése</button>';
	}
	?>
	
	
	
	
	
	</form>
	</div>
	
	
	<div id="content2">
	<h2 class="h2-text" >Tervezett bevételek</h2>  
	<table class="table table-bordered"><thead>
      <tr><th>#</th><th colspan="6">Rovat</th><th >Rovat összesen (nettó)</th><th>Áfa összeg</th><th colspan="1">Rovat összesen (bruttó)</th></tr>
    </thead><tbody id="table_rows">
	<?php
	
		//<tr><td colspan="7">
	
		$table=mysqli_query(getDatabaseConnect(),"SELECT sub_id, SUM(netto_osszes) AS nettoSum, SUM(brutto_osszes) AS bruttoSum, SUM(afa_osszes) AS afaSum, SUM(mennyiseg) AS mennyiseg FROM kltsg_submissions_bevetel WHERE user_id=".$userid." AND institute_id='".$inst."' AND unit_id='".$unit."' GROUP BY sub_id");
		$wi=1;
		while($record=mysqli_fetch_array($table))
		{
		$rovatid=mysqli_query(getDatabaseConnect(),"SELECT * FROM kltsg_category_bev WHERE id='".$record['sub_id']."'");
		$rovatnev=mysqli_fetch_array($rovatid);
		
		$rowid='rowid#'.$i;

	
		$rowspan=mysqli_fetch_array(mysqli_query(getDatabaseConnect(),"SELECT count(*) AS rownum FROM kltsg_submissions_bevetel WHERE user_id=".$userid." AND sub_id='".$record['sub_id']."' AND institute_id='".$inst."' AND unit_id='".$unit."'"));
	
	echo '<tr class="main-table" id="'.$rowid.'" >
			<td><div class="line-num">'.$wi.'</div></td>
			<td colspan="6">'.$rovatnev['name'].'</td>
			

			

			';
	echo '
	<td colspan="">'.number_format($record['nettoSum'], 0, ',', ' ').'</td>
	<td colspan="">'.number_format($record['afaSum'], 0, ',', ' ').'</td>
	<td colspan="">'.number_format($record['bruttoSum'], 0, ',', ' ').'</td>

	</tr>
	<tr class="subtable"><th rowspan="'.($rowspan['rownum']+1).'"></th>
	<th colspan="">Tervezett beszerzés/igénylés</th><th>Nettó egységár</th><th>Áfa egységár</th><th>Bruttó egységár</th><th>Áfakulcs</th><th>Mennyiség</th><th>Nettó összesen</th><th>Áfa összesen</th><th>Brutto összesen</th><th rowspan="">Művelet</tr>';
	
	$sub_table=mysqli_query(getDatabaseConnect(),"SELECT * FROM kltsg_submissions_bevetel WHERE user_id=".$userid." AND sub_id='".$record['sub_id']."' AND institute_id='".$inst."' AND unit_id='".$unit."'");
		//$wi=1;
		while($record=mysqli_fetch_array($sub_table))
		{
			$egyseg=mysqli_fetch_array(mysqli_query(getDatabaseConnect(),"SELECT * FROM kltsg_quant WHERE id='".$record['quant']."'"));
			
			if($editedBevRow==$record['id']){
				echo '<tr class="edited-row">';
			}else{
				echo '<tr id="'.$rowid.'" >';
			}
				echo'
				<td colspan="" title="'.$record['megnevezes'].'">'.substr(wordwrap($record['megnevezes'], 20, "\n", true),0,20);
				echo (strlen($record['megnevezes'])<20)? '  ' : '...';
				echo'</td>
				<td colspan="">'.number_format($record['netto_egysegar'], 2, ',', ' ').'</td>
				<td colspan="">'.number_format($record['afa_ossz_egyseg'], 2, ',', ' ').'</td>
				<td colspan="">'.number_format($record['brutto_egysegar'], 2, ',', ' ').'</td>
				<td colspan="">'.$record['tax'].'%</td>
				<td colspan="">'.$record['mennyiseg'].' '.$egyseg['name'].'</td>
				<td colspan="">'.number_format($record['netto_osszes'], 0, ',', ' ').'</td>
				<td colspan="">'.number_format($record['afa_osszes'], 0, ',', ' ').'</td>
				<td colspan="">'.number_format($record['brutto_osszes'], 0, ',', ' ').'</td>';
				
			if($editedBevRow==$record['id']){
				echo '<td>Szerkesztés alatt!</td>';
			}else{
	
				echo'<td><button type="button" id="'.$record['id'].'" onclick="return delBevRow(this.id)" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>&nbsp;<button type="button" id="'.$record['id'].'" onclick="return editBevRow(this.id)" class=" btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><input type="hidden" name="rows" value="'.$rowspan['rownum'].'"/><input type="hidden" name="rowid" value="'.$record['id'].'"/>';
				echo "<input type='hidden' name='institute' value='".$inst."'/>";
				echo "<input type='hidden' name='unit' value='".$unit."'/>";
				echo "<input type='hidden' name='bev_rows' value='1'/>";
				echo "<input type='hidden' name='active_tab' value='kiad'/>";
				echo '</td></form>';
			}
				echo'</tr>';
	}
	$wi++;
	}
	
	$sum=mysqli_fetch_array(mysqli_query(getDatabaseConnect(),"SELECT SUM(brutto_osszes) AS bruttoSum, SUM(netto_osszes) AS nettoSum, SUM(afa_osszes) AS afaSum FROM kltsg_submissions_bevetel WHERE user_id=".$userid." AND institute_id='".$inst."' AND unit_id='".$unit."';"));



$bruttoSum=(empty($sum['bruttoSum']))? 0 : $sum['bruttoSum'];	
$nettoSum=(empty($sum['nettoSum']))? 0 : $sum['nettoSum'];	
$afaSum=(empty($sum['afaSum']))? 0 : $sum['afaSum'];	

?>
		<tr id="summa">
		<td colspan="7">Összesen:</td>
		<td ><?php echo number_format($nettoSum, 0, ',', ' '); ?></td>
		<td ><?php echo number_format($afaSum, 0, ',', ' '); ?></td>
		<td ><?php echo number_format($bruttoSum, 0, ',', ' '); ?></td>
		</tr>
		</tbody>
		</table>
	</div>
	</div>
	
<script>

	var bev_inputList = ["data_bev1","data_bev4","subData_bev#0#2","subData_bev#0#6","subData_bev#0#7","subData_bev#0#8"]; 
	var bev_first = 0;
	var bev_currentRowNumber = '<?php echo count($bev_sorok);?>';
	var bev_afaertek = 0;
	var bev_bruttoertek = 0;
	var bev_mennyisegertek = 0;

	//kiemelés
	(function(){
	if(bev_first==0){
		
		document.getElementById(bev_inputList[0]).style.border = "2px solid #eea236";
	}
	})();
	//egyszerűsítés
	function bev_floor(num){
		return Math.round((num)*100)/100;
	}
		//validate rovatrogzités
	function validateBevForm(){
	
	var rovatind = document.getElementById("data_bev1").selectedIndex;
	var rovatopt = document.getElementById("data_bev1").options;
	var rovat = rovatopt[rovatind].value;
	
	var afaind = document.getElementById("data_bev4").selectedIndex;
	var afaopt = document.getElementById("data_bev4").options;
	var afakulcs = afaopt[afaind].value;
	
	if((rovat==999)||(afakulcs==999)){
		alert("Kérem válasszon Rovatot / Áfakulcsot!");
		return false;
	}else{
	
		return true;
	}

	}
	function commentBevRow(id){
	
		var slen = document.getElementById(id).value;
		var sstyle = document.getElementById(id).style.height.replace("px","");
		if(sstyle==34){
			document.getElementById(id).style.height = (3*sstyle)+"px";
		}else{
			document.getElementById(id).style.height = "34px";
		}
	}
	//szerkesztés mégse
	function cancel(){
		location.href="form.php?bev_rows=1&rows=1&&active_tab=bev&institute="+inst+"&unit="+unit;
	}
	//sor szerkesztés
	function editBevRow(rowid){
		//alert(rowid);
		var x = confirm("Biztosan SZERKESZTI a kiválasztott sort?");
		if (x){
			location.href="form.php?edit_bev=1&rowid="+rowid+"&bev_rows=1&rows=1&active_tab=bev&institute="+inst+"&unit="+unit;
		}else{
			return false;
		}
		
	}
	//sor törlése
	function delBevRow(rowid){
		var x = confirm("Biztosan TÖRLI a kiválasztott sort?");
		if (x){
			location.href="form.php?delete_bev_row=&rowid="+rowid+"&active_tab=bev&institute="+inst+"&unit="+unit;
		}else{
			return false;
		}
	}
		//rejtett cellák mutatása
	function showHiddenBev(ertek){
		
			var collapsed = document.getElementsByClassName("collapsed");
			
			if(ertek == 0){
			
			document.getElementById("bev_show_hide").className ="glyphicon glyphicon-eye-close";
			document.getElementById("bev_shbt").value=1;
			for(var i=0;i<collapsed.length;i++){
				collapsed[i].style.display = "table-cell";
			}
			}else if(ertek == 1){
			document.getElementById("bev_show_hide").className ="glyphicon glyphicon-eye-open";
			document.getElementById("bev_shbt").value=0;
			for(var i=0;i<collapsed.length;i++){
				collapsed[i].style.display = "none";
			}
			}
			
	}
	//get áfa
	function getAfa(){
		var afa = document.getElementById('data_bev4').value;
		if(afa.length==2){
			afa = parseFloat('1.'+afa);
		}else if(afa.length==1){
			afa = parseFloat('1.0'+afa);
		}
		bev_afaertek=afa;
	}
	//dtörléshez cellák töltése
	function bev_deleteSelectedRow(id){
	
		for(var i=2;i<12;i++){
			if(i==8){ 
				document.getElementById("subData_bev#"+id+"#"+i).selectedIndex=1;
			}else{
				document.getElementById("subData_bev#"+id+"#"+i).value=0;
				//document.forms["form"].submit();
			}
		}
		return true;
	}
	//kiemelés léptetése
	function bev_stepAF(id){
		document.getElementById(id).style.border = "";
		var num=999;
		
		for(var i=0;i<bev_inputList.length;i++){
			if(bev_inputList[i]==id){
				num=i+1;
			}
		}
		if(num!=bev_inputList.length){
		document.getElementById(bev_inputList[parseInt(num)]).style.border = "2px solid #eea236";
		}
	}
	
	//áfaérték töltése
	function bev_fillTaxValue(id){
		
		var sorId = id.split("#");
	
		var afa = document.getElementById(id).value;
		for(var i=0;i<bev_currentRowNumber;i++){	
			document.getElementById("subData_bev#"+i+"#4").value=bev_floor(afa);
		}

	
		if(afa.length==2){
			afa = parseFloat('1.'+afa);
		}else if(afa.length==1){
			afa = parseFloat('1.0'+afa);
		}
		bev_afaertek = afa;
		for(var i=0;i<bev_currentRowNumber;i++){	
			
			bev_unitValue("subData_bev#"+i+"#6");
		}
		//bev_stepAF(id);
	}
	//afa egység ertek
	function bev_unitValue(id){
		
		var sorId = id.split("#");
		var brutto = document.getElementById(id).value;
		getAfa();
		var netto = brutto/bev_afaertek;
		var afa = brutto-netto;
		document.getElementById("subData_bev#"+sorId[1]+"#3").value=bev_floor(netto);
		document.getElementById("subData_bev#"+sorId[1]+"#5").value=bev_floor(afa);
		
		bev_bruttoertek = brutto;
		bev_unitSum("subData_bev#"+sorId[1]+"#7")

		//bev_stepAF(id);
	}
	//sor összesen
	function bev_unitSum(id){
	//alert(bev_afaertek);
		//bev_unitValue(id);
		var sorId = id.split("#");
		var mennyiseg = document.getElementById(id).value;
		var brutto = document.getElementById("subData_bev#"+sorId[1]+"#6").value;
		bev_bruttoertek = brutto;
		var bruttoSum = mennyiseg*bev_bruttoertek;
		var afa = document.getElementById('data_bev4').value;
		if(afa.length==2){
			afa = parseFloat('1.'+afa);
		}else if(afa.length==1){
			afa = parseFloat('1.0'+afa);
		}
		bev_afaertek=afa;
		
		var bruttoSum = mennyiseg*bev_bruttoertek;
		var nettoSum = bruttoSum/bev_afaertek;
		//console.log(nettoSum+"-"+afaertek);
		var afaSum = bruttoSum-nettoSum;
				
		document.getElementById("subData_bev#"+sorId[1]+"#9").value=bev_floor(nettoSum);
		document.getElementById("subData_bev#"+sorId[1]+"#10").value=bev_floor(afaSum);
		document.getElementById("subData_bev#"+sorId[1]+"#11").value=bev_floor(bruttoSum);

		bev_mennyisegertek = mennyiseg;
		bev_allSum();
	}
	function bev_allSum(){
		var nettoSum=0;
		var afaSum=0;
		var bruttoSum=0;
		var mennySum=0;
		
		for(var i=0;i<bev_currentRowNumber;i++){
			nettoSum+=parseFloat(document.getElementById("subData_bev#"+i+"#9").value);
			afaSum+=parseFloat(document.getElementById("subData_bev#"+i+"#10").value);
			bruttoSum+=parseFloat(document.getElementById("subData_bev#"+i+"#11").value);
			mennySum+=parseFloat(document.getElementById("subData_bev#"+i+"#7").value);
		}
		
		document.getElementById("data_bev3").value=bev_floor(nettoSum);
		document.getElementById("data_bev5").value=bev_floor(afaSum);
		document.getElementById("data_bev6").value=bev_floor(bruttoSum);
		document.getElementById("data_bev7").value=bev_floor(mennySum);
	}
	
  </script>