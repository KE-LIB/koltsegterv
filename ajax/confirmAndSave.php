<?php
include_once("../Scripts/db.php");
@session_start();
	$sqlSubmit="insert into kltsg_submissions (user_id) values ('".$_SESSION['id']."')" ;
	$GLOBALS['conn']->query($sqlSubmit) or die("Hiba a kltsg_submissions beillesztésénél");
	$subId=$GLOBALS['conn']->insert_id;
	$sql="select row_id from kltsg_submissions_kiadas_saved order by row_id desc limit 1";
	$res=$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas_saved row_id lekérdezésénél");
	$sorSzam_a=$res->fetch_array(MYSQLI_BOTH);
	$row_id=$sorSzam_a['row_id'];
	$row_id++;
	$sql="select * from kltsg_submissions_kiadas where user_id='".$_SESSION['id']."' ";
	$res=$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas lekérdezésénél");
	while($kiadas=$res->fetch_array(MYSQLI_BOTH))
	{
	$sqlKiadas="insert into kltsg_submissions_kiadas_saved ( row_id, submissions_id, sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,category_tax_field, afa_ossz_egyseg, quant, brutto_egysegar)
	values('".$row_id."','".$subId."','".$kiadas['sub_id']."','".$_SESSION['id']."','".$kiadas['institute_id']."','".$kiadas['unit_id']."','".$kiadas['brutto_osszes']."','".$kiadas['netto_osszes']."','".$kiadas['afa_osszes']."','".$kiadas['mennyiseg']."','".$kiadas['megnevezes']."','".$kiadas['netto_egysegar']."','".$kiadas['tax']."','0','".$kiadas['afa_ossz_egyseg']."','".$kiadas['quant']."','".$kiadas['brutto_egysegar']."')";
	//echo $sqlKiadas;
	$GLOBALS['conn']->query($sqlKiadas) or die("Hiba a kltsg_submissions_kiadas_saved beillesztésénél");
	}
	//bevételek átrakása
	$sql="select row_id from kltsg_submissions_bevetel_saved order by row_id desc limit 1";
	$res=$GLOBALS['conn']->query($sql);
	$sorSzam_a=$res->fetch_array(MYSQLI_BOTH);
	$row_id=$sorSzam_a['row_id'];
	$row_id++;
	$sql="select * from kltsg_submissions_bevetel where user_id='".$_SESSION['id']."' ";
	$res=$GLOBALS['conn']->query($sql);
	while($bevetel=$res->fetch_array(MYSQLI_BOTH))
	{
	$sqlbevetel="insert into kltsg_submissions_bevetel_saved ( row_id, submissions_id, sub_id, user_id, institute_id,
	unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,
	category_tax_field, afa_ossz_egyseg, quant, brutto_egysegar)
	values('".$row_id."',
	'".$subId."',
	'".$bevetel['sub_id']."',
	'".$_SESSION['id']."',
	'".$bevetel['institute_id']."',
	'".$bevetel['unit_id']."',
	'".$bevetel['brutto_osszes']."',
	'".$bevetel['netto_osszes']."',
	'".$bevetel['afa_osszes']."',
	'".$bevetel['mennyiseg']."',
	'".$bevetel['megnevezes']."',
	'".$bevetel['netto_egysegar']."',
	'".$bevetel['tax']."',
	'0',
	'".$bevetel['afa_ossz_egyseg']."',
	'".$bevetel['quant']."',
	'".$bevetel['brutto_egysegar']."')";
	$GLOBALS['conn']->query($sqlbevetel) or die("Hiba a kltsg_submissions_bevetel_saved beillesztésénél");
	}
?>