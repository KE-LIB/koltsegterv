
<div class="col-xs-11 col-md-11"><h2 style="margin-top:10px;">Elküldött tervezetek</h2></div>
<?php
$sentnum=mysqli_fetch_array($connect_db->query("SELECT * FROM `kltsg_submissions_kiadas_sent` WHERE user_id=".$userid.""));

if($sentnum==0){
echo '<br><br><br><div class="alert alert-info"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;Még nem küldött költségtervezetet!</div>';
}else{
?>
<table class="table table-bordered"><thead>
      <tr><th colspan="4">Szervezet > Egység</th></tr>
    </thead><tbody id="table_rows">
<?php
$category=$connect_db->query("SELECT submissions_id, institute_id, unit_id,(SELECT name FROM kltsg_institute WHERE id=institute_id) AS institute_name,(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit_name FROM `kltsg_submissions_kiadas_sent` WHERE user_id=".$userid." GROUP BY unit_id, institute_id;");
$i=1;


	while($record=mysqli_fetch_array($category))
	{
	echo '<form action="list.php" method="GET"><tr class="main-table"><td colspan="4">'.$record['institute_name']." > ".$record['unit_name'].'</td></tr><thead>
		  <tr class="subtable"><th colspan="">Sorszám</th><th colspan="">Azonosító</th><th colspan="">Dátum</th><th colspan="">Műveletek</th></tr>
		</thead>';

		$submiss=$connect_db->query("SELECT * FROM `kltsg_submissions` WHERE id IN(SELECT submissions_id FROM kltsg_submissions_kiadas_sent WHERE user_id=".$userid." AND unit_id=".$record['unit_id']." ) ORDER BY id DESC");
		$i=1;
		while($sub_record=mysqli_fetch_array($submiss))
		{
			
			echo ($i==1)? "<tr class='current'>" : "<tr>";
			echo '<td>'.$i++."</td><td>".$sub_record['id']."</td><td>".$sub_record['created_time'];
			echo ($i==2) ? " (Aktuális) " : "";
			echo '</td><td>
			<button type="submit" name="resendSubmittedWork" onclick="return editWork()" class=" btn btn-default"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;Újra beadom</button></td>';
	
	
			echo "<input type='hidden' name='institute' value='".$record['institute_id']."'/>";
			echo "<input type='hidden' name='unit' value='".$record['unit_id']."'/>";
			echo "<input type='hidden' name='submissions_id' value='".$record['submissions_id']."'/></tr></form>";
		}

	}
}