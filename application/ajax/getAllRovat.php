<?php
	include_once("../Scripts/db.php");
		$sql="SELECT * FROM kltsg_category ORDER BY code desc";
		$res=$GLOBALS['conn']->query($sql) or die("Hiba az rovatok lekérdezésénél");
		while($record=$res->fetch_array(MYSQLI_BOTH))
		{
			echo "<option value=".$record['id']." selected>".$record['code']." - ".$record['name']."</option>";
		}
		echo'<option value="999" selected>Válasszon...</option>';
		//print_r($returnArray);
?>