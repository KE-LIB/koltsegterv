<?php
include_once("../Scripts/db.php");
@session_start();
echo '
<div class="col-xs-11 col-md-11"><h2 style="margin-top:10px;">Mentett tervezetek</h2></div>';
	$sql="SELECT * FROM kltsg_submissions_kiadas_saved, kltsg_submissions_bevetel_saved 
	WHERE kltsg_submissions_bevetel_saved.user_id='".$_SESSION['id']."'
	or kltsg_submissions_kiadas_saved.user_id='".$_SESSION['id']."'";
	
	$res=$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas_saved lekérdezésénél " . mysqli_error($GLOBALS['conn']));
	$savenum = $res->num_rows;
if($savenum==0){
echo '<br><br><br><div class="alert alert-info"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;Még nem mentett költségtervezetet!</div>';
}else{
echo'
<table class="table table-bordered"><thead>
      <tr class="main-table"><th colspan="">Sorszám</th><th colspan="1">Szervezet > Egység</th><th colspan="">Azonosító</th><th colspan="">Dátum</th><th colspan="">Műveletek</th></tr>
    </thead><tbody id="table_rows">';
	$sql="SELECT submissions_id, (SELECT created_time FROM kltsg_submissions WHERE id=submissions_id) AS submissions_time,
	institute_id, unit_id, (SELECT name FROM kltsg_institute WHERE id=institute_id) AS institute_name,
	(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit_name FROM `kltsg_submissions_kiadas_saved` WHERE user_id='".$_SESSION['id']."' 
	GROUP BY unit_id,
	institute_id, submissions_id ORDER BY id DESC;";
	$category=$GLOBALS['conn']->query($sql) or die("Hiba a kltsg  lekérdezésénél " . mysqli_error($GLOBALS['conn']));
	$i=1;
	while($record=$category->fetch_array(MYSQLI_BOTH))
	{
	//legördülő kell ide
	echo '<tr><td>'.$i++.'</td><td colspan=""><select name="inst_unit" class="form-control">';
		$place=$GLOBALS['conn']->query("
		SELECT (SELECT kltsg_institute.id FROM kltsg_institute WHERE id=parent)AS instid, (SELECT kltsg_institute.name FROM kltsg_institute WHERE id=parent)AS instname, kltsg_unit.id AS unitid, kltsg_unit.name AS unitname
		FROM kltsg_unit
		WHERE kltsg_unit.id IN (SELECT unit_id FROM kltsg_policy WHERE user_id='".$_SESSION['id']."' );");
			
			while($plcerec=$place->fetch_array(MYSQLI_BOTH))
			{
				if(($plcerec['instid']==$record['institute_id'])&&($plcerec['unitid']==$record['unit_id'])){
					echo "<option value='".$plcerec['instid']."#".$plcerec['unitid']."' selected>".$plcerec['instname']." > ".$plcerec['unitname']."</option>";
				}else{
					echo "<option value='".$plcerec['instid']."#".$plcerec['unitid']."'>".$plcerec['instname']." > ".$plcerec['unitname']."</option>";
				}
			}

			echo '</select></td><td class="main-table">'.$record['submissions_id'].'</td><td>'.$record['submissions_time'].'</td>
			<td><button type="submit" name="editSavedWork" onclick="return editWork()" class=" btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Szerkesztés</button>
			<button type="submit" name="changePlace" class=" btn btn-primary"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;Hely módosítása</button></td>';
			echo "<input type='hidden' name='institute' value='".$record['institute_id']."'/>";
			echo "<input type='hidden' name='unit' value='".$record['unit_id']."'/>";
			echo "<input type='hidden' name='submissions_id' value='".$record['submissions_id']."'/></tr></form>";


		}

	
}
?>