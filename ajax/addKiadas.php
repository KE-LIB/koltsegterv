<?php
include_once("../Scripts/db.php");
@session_start();
$megnevezes=$_POST['megnevezes'];
$egysegAr=$_POST['egysegAr'];
$mennyiseg=$_POST['mennyiseg'];
$rovat=$_POST['rovat'];
$brutto_osszes=$mennyiseg*$egysegAr;
$nettoEA=round(($egysegAr/($_COOKIE['afaKulcs']+100))*100);
$netto_osszes=$mennyiseg*$nettoEA;
$afa_osszes=$brutto_osszes-$netto_osszes;
$afa_ossz_egyseg=round($afa_osszes/$mennyiseg);
$brutto_egysegar=round($brutto_osszes/$mennyiseg);
$sql="insert into kltsg_submissions_kiadas 
(`sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`,
`megnevezes`, `netto_egysegar`, `tax`,  `afa_ossz_egyseg`, `quant`, `brutto_egysegar`)
values ('".$rovat."','".$_SESSION['id']."','".$_COOKIE['egyseg']."','".$_COOKIE['alegyseg']."','".$brutto_osszes."','".$netto_osszes."',
'".$afa_osszes."','".$mennyiseg."','".$megnevezes."','".$nettoEA."','".$_COOKIE['afaKulcs']."','".$afa_ossz_egyseg."','".$_COOKIE['mertekegyseg']."','".$brutto_egysegar."')";
//echo $sql;
$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas felvitelénél " . mysqli_error($GLOBALS['conn']));
?>