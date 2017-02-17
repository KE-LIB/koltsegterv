<?php
	include_once("../Scripts/db.php");
		$sql="SELECT kltsg_institute.name as egyseg 
		FROM `kltsg_institute` WHERE kltsg_institute.id=".$_COOKIE['egyseg']."";
		$res=$GLOBALS['conn']->query($sql) or die("Hiba az egységek lekérdezésénél");
		$record=$res->fetch_array(MYSQLI_BOTH);
		echo $record['egyseg'];
?>
		