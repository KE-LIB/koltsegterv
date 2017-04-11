<?php
	include_once("../Scripts/db.php");
	@session_start();
	$sqlCat="SELECT kltsg_submissions_kiadas_sent.user_id, submissions_id, institute_id, kltsg_submissions_kiadas_sent.unit_id,
(SELECT name FROM kltsg_institute WHERE id=institute_id) AS institute_name,
(SELECT name FROM kltsg_unit WHERE id=kltsg_submissions_kiadas_sent.unit_id) AS unit_name 
FROM `kltsg_submissions_kiadas_sent`,kltsg_policy 
where kltsg_policy.user_id='".$_SESSION['id']."' and kltsg_policy.unit_id=kltsg_submissions_kiadas_sent.unit_id
 GROUP BY kltsg_submissions_kiadas_sent.unit_id, institute_id ORDER BY kltsg_submissions_kiadas_sent.unit_id DESC";
	$category=$GLOBALS['conn']->query($sqlCat);
	echo'<table class="table table-bordered">';
	while($record=$category->fetch_array(MYSQLI_BOTH))
	{
	echo '<tr class="main-table" group="istitute"><td colspan="3">'.$record['institute_name'].'</td>
	<td>
	<button type="button"  onclick="analytics(this.id)"  class="btn btn-info"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Analitkus</button>
	<button type="button"  onclick="aggregate(this.id)" class="btn btn-warning"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>&nbsp;Aggregált</button>
	</td>
	</tr>
	<tr class="warning" group="unit"><td colspan="3">'.$record['unit_name'].'</td>
	<td><button type="button"  onclick="analytics(this.id)"  class="btn btn-danger"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Analitkus</button>
	<button type="button"  onclick="aggregate(this.id)" class="btn btn-warrning"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>&nbsp;Aggregált</button>
	</td>
	</tr>
		<thead>
			<tr class="subtable">
			<th colspan="">Beadó</th><th colspan="">Azonosító</th><th colspan="">Dátum</th><th colspan="">Művelet</th></tr>
		</thead>';

		$submiss=$GLOBALS['conn']->query("SELECT CONCAT
		((SELECT last_name from kltsg_users WHERE id=user_id),' 
		',(SELECT first_name from kltsg_users WHERE id=user_id)) AS username, user_id, created_time, id 
		FROM `kltsg_submissions` WHERE 
		id IN(SELECT submissions_id FROM kltsg_submissions_kiadas_sent WHERE unit_id=".$record['unit_id']." ) ORDER BY id DESC");
		
		while($sub_record=$submiss->fetch_array(MYSQLI_BOTH))
		{
			echo '<tr group="records"><td>'.$sub_record['username'].'</td>';
			echo '<td>'.$sub_record['id']."</td><td>".$sub_record['created_time'];
			
			echo '</td>
				<td> 
	<button type="button" id="'.$record['unit_id'].'#'.$sub_record['user_id'].'" onclick="analytics(this.id)"  class="btn btn-primary"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Analitkus</button>
	<button type="button" id="'.$record['unit_id'].'#'.$sub_record['user_id'].'" onclick="aggregate(this.id)" class="btn btn-success"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>&nbsp;Aggregált</button>
	</td>
			</tr>';
		}
		echo "</tr>";

	}
	
	?>