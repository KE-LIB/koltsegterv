<?php
include_once("../Scripts/db.php");
@session_start();
$ins_unit=$_GET['place'];
$exp=explode("#",$ins_unit);
if($_GET['form']=="S")
{
	$sql="update kltsg_submissions_kiadas_saved set institute_id='".$exp[0]."', unit_id='".$exp[1]."' where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas_saved módosításánál " . mysqli_error($GLOBALS['conn']));
	$sql="update kltsg_submissions_bevetel_saved set institute_id='".$exp[0]."', unit_id='".$exp[1]."' where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevétel_saved módosításánál " . mysqli_error($GLOBALS['conn']));
}
else
{
	$sql="update kltsg_submissions_kiadas_sent  set institute_id='".$exp[0]."', unit_id='".$exp[1]."' where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas_sent módosításánál " . mysqli_error($GLOBALS['conn']));
	$sql="update kltsg_submissions_bevetel_sent  set institute_id='".$exp[0]."', unit_id='".$exp[1]."' where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevétel_sent módosításánál " . mysqli_error($GLOBALS['conn']));
}
?>