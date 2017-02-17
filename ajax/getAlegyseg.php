<?php
include_once("../Scripts/db.php");
@session_start();
$inst=$_POST['egyseg'];
$sql="SELECT kltsg_unit.id AS unitid, kltsg_unit.name AS unitname
	FROM kltsg_unit
	WHERE kltsg_unit.id IN (SELECT unit_id FROM kltsg_policy WHERE user_id=".$_SESSION['id']." AND parent=".$inst.") ;";
	$uni=$GLOBALS['conn']->query($sql) or die("Hiba az Alegységek lekérdezésénél");
	while($record=$uni->fetch_array(MYSQLI_BOTH))
	{	
		echo "<option value=".$record['unitid']." selected>".$record['unitname']."</option>";
	}		
	echo'<option value="999" selected>Válasszon...</option>';
	?>		