<?php
include_once("../Scripts/db.php");
@session_start();
		$sql="SELECT Year FROM `kltsg_submissions_kiadas_sent` GROUP BY Year";
	$uni=$GLOBALS['conn']->query($sql) or die("Hiba az Alegységek lekérdezésénél");
	while($record=$uni->fetch_array(MYSQLI_BOTH))
	{	
		if($record['Year']==$_COOKIE['Ev'])
		{
			$selected="selected=selected";
		}
		else
		{
		$selected="";	
		}
		echo "<option value=".$record['Year']." ".$selected.">".$record['Year']."</option>";
	}		
	echo'<option value="999" >Válasszon...</option>';
	?>		