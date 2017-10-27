<?php
	include_once("../Scripts/db.php");
		$sql="SELECT * FROM kltsg_tax ORDER BY value";
		$res=$GLOBALS['conn']->query($sql) or die("Hiba az áfakulcsok lekérdezésénél");
		while($record=$res->fetch_array(MYSQLI_BOTH))
		{
			echo "<option value=".$record['value']." selected>".$record['value']."%</option>";
		}
		echo'<option value="999" selected>Válasszon...</option>';
		//print_r($returnArray);
?>