<?php
	include_once("../Scripts/db.php");
		$sql="SELECT kltsg_unit.name as egyseg 
		FROM `kltsg_unit` WHERE id=".$_COOKIE['alegyseg']."";
		$res=$GLOBALS['conn']->query($sql) or die("Hiba az alegységek lekérdezésénél");
		$record=$res->fetch_array(MYSQLI_BOTH);
		echo $record['egyseg'];
?>