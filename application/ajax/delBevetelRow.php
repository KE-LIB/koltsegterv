<?php
include_once("../Scripts/db.php");
@session_start();
$sql="delete from kltsg_submissions_bevetel where id='".$_POST['id']."'";
//echo $sql;
$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas lekérésénél");
?>