<?php
include_once("../Scripts/db.php");
@session_start();
	$sql="insert into kltsg_submissions_kiadas_sent (`row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `quant`, `brutto_egysegar`, `created_time`)
	select `row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `quant`, `brutto_egysegar`, `created_time`
	from kltsg_submissions_kiadas_saved 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas_sent másolásánál " . mysqli_error($GLOBALS['conn']));
	
	$sql="insert into kltsg_submissions_bevetel_sent (`row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `quant`, `brutto_egysegar`, `created_time`)
	select `row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `quant`, `brutto_egysegar`, `created_time`
	from kltsg_submissions_bevetel_saved 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel_sent másolásánál " . mysqli_error($GLOBALS['conn']));
	
	$sql="delete 
	from kltsg_submissions_kiadas_saved 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel_saved törlésénél " . mysqli_error($GLOBALS['conn']));
	
	$sql="delete 
	from kltsg_submissions_bevetel_saved 
	where user_id='".$_SESSION['id']."' and submissions_id='".$_GET['sub']."'";
	$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel_saved törlésénél " . mysqli_error($GLOBALS['conn']));
	
	

?>