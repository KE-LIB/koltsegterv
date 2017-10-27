<?php
include_once("../Scripts/db.php");
@session_start();
$rovat=$_POST['rovat'];
$sql="SELECT id from kltsg_category where parent=".$inst.") ;";
	$uni=$GLOBALS['conn']->query($sql) or die("Hiba az Alegységek lekérdezésénél");
	while($record=$uni->fetch_array(MYSQLI_BOTH))
	{	
		echo "<option value=".$record['unitid']." selected>".$record['unitname']."</option>";
	}		
	echo'<option value="999" selected>Válasszon...</option>';
	?>		