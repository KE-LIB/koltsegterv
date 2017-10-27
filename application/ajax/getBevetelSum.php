<?php
include_once("../Scripts/db.php");
@session_start();
	$sqlSzamolas="select sum(brutto_osszes) as brutto from kltsg_submissions_bevetel where user_id=".$_SESSION['id']."";
	$resSzamolas=$GLOBALS['conn']->query($sqlSzamolas) or die("Hiba a kltsg_category lekérésénél");
	$sorSzamolas=$resSzamolas->fetch_array(MYSQLI_BOTH);
	echo $sorSzamolas['brutto'];
?>