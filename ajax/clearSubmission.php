<?php
include_once("../Scripts/db.php");
@session_start();
	$sqlDelteBevetel="delete from kltsg_submissions_bevetel where user_id='".$_SESSION['id']."'" ;
	$GLOBALS['conn']->query($sqlDelteBevetel) or die("Hiba a kltsg_submissions_bevetel törlésénél");
	$sqlDelteKiadas="delete from kltsg_submissions_kiadas where user_id='".$_SESSION['id']."'" ;
	$GLOBALS['conn']->query($sqlDelteKiadas) or die("Hiba a kltsg_submissions_kiadas törlésénél");
?>