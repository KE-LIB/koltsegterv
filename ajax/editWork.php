<?php
include_once("../Scripts/db.php");
@session_start();
if($_GET['form']=="S")
{
	$sql="insert into kltsg_submissions_kiadas(sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time) 
	select sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time 
	from kltsg_submissions_kiadas_saved 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas_saved másolásánál " . mysqli_error($GLOBALS['conn']));
	
	$sql="insert into kltsg_submissions_bevetel(sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time) 
	select sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time 
	from kltsg_submissions_bevetel_saved 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel_saved másolásánál " . mysqli_error($GLOBALS['conn']));
	
	$sql="delete 
	from kltsg_submissions_kiadas_saved 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel_saved törlésénél " . mysqli_error($GLOBALS['conn']));
	
	$sql="delete 
	from kltsg_submissions_bevetel_saved 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel_saved törlésénél " . mysqli_error($GLOBALS['conn']));
	
}
else
{
		$sql="insert into kltsg_submissions_kiadas(sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time) 
	select sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time 
	from kltsg_submissions_kiadas_sent 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas_sent  másolásánál " . mysqli_error($GLOBALS['conn']));
	
	$sql="insert into kltsg_submissions_bevetel(sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time) 
	select sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time 
	from kltsg_submissions_bevetel_sent 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel_sent  másolásánál " . mysqli_error($GLOBALS['conn']));
	
	$sql="delete 
	from kltsg_submissions_kiadas_sent 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel_sent  törlésénél " . mysqli_error($GLOBALS['conn']));
	
	$sql="delete 
	from kltsg_submissions_bevetel_sent 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel_sent  törlésénél " . mysqli_error($GLOBALS['conn']));
}
$sql="delete from kltsg_submissions	where id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions törlésénél " . mysqli_error($GLOBALS['conn']));
?>