<?php
	include_once("../Scripts/db.php");
		$sql="SELECT * FROM kltsg_quant ";
		$res=$GLOBALS['conn']->query($sql) or die("Hiba a mértékegység lekérdezésénél");
		while($record=$res->fetch_array(MYSQLI_BOTH))
		{
			echo "<option value=".$record['id']." selected>".$record['name']."</option>";
		}
		echo'<option value="999" selected>Válasszon...</option>';
		//print_r($returnArray);
?>