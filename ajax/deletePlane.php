<?php
include_once("../Scripts/db.php");
@session_start();
if($_GET['form']=="S")
{
	$sql="delete from kltsg_submissions_kiadas_saved where submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas-bevetel_saved törlésénél " . mysqli_error($GLOBALS['conn']));
	$sql="delete from kltsg_submissions_bevetel_saved where submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas-bevetel_saved törlésénél " . mysqli_error($GLOBALS['conn']));
}
else
{
$sql="delete from kltsg_submissions_bevetel_sent where submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas-bevetel_sent törlésénél " . mysqli_error($GLOBALS['conn']));
	$sql="delete from kltsg_submissions_kiadas_sent where submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas-bevetel_sent törlésénél " . mysqli_error($GLOBALS['conn']));	
}
	