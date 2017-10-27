<?php
include_once("../Scripts/db.php");
@session_start();
$sql="select * from kltsg_submissions_kiadas_bevetel where id='".$_POST['id']."'";
//echo $sql;
$res=$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel lekérésénél");
$sor=$res->fetch_array(MYSQLI_BOTH);
$return=$sor['sub_id'].','.$sor['tax'].','.$sor['megnevezes'].','.$sor['brutto_osszes'].','.$sor['mennyiseg'].','.$sor['quant'].'';
echo $return;
$sql="delete from kltsg_submissions_bevetel where id='".$_POST['id']."'";
//echo $sql;
$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_bevetel lekérésénél");
?>