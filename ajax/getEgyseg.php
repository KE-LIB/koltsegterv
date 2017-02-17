<?php
	include_once("../Scripts/db.php");
	@session_start();
	$returnArray=array();
		$sql="SELECT (SELECT kltsg_institute.id FROM kltsg_institute WHERE id=parent)AS instid, (SELECT kltsg_institute.name FROM kltsg_institute WHERE id=parent)AS instname
					FROM kltsg_unit
					WHERE kltsg_unit.id IN (SELECT unit_id FROM kltsg_policy WHERE user_id=".$_SESSION['id'].") GROUP BY instid;";
		$res=$GLOBALS['conn']->query($sql) or die("Hiba az egységek lekérdezésénél");
		
		while($record=$res->fetch_array(MYSQLI_BOTH))
		{
			echo "<option value=".$record['instid']." selected>".$record['instname']."</option>";
		}
		echo'<option value="999" selected>Válasszon...</option>';

		//print_r($returnArray);
		?>