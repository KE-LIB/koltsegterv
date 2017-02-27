<?php
include_once("../Scripts/db.php");
@session_start();
$megnevezes=$_POST['megnevezes'];
$egysegAr=$_POST['egysegAr'];
$mennyiseg=$_POST['mennyiseg'];
$brutto_osszes=$mennyiseg*$egysegAr;
$nettoEA=round(($egysegAr/($_COOKIE['afaKulcs']+100))*100);
$netto_osszes=$mennyiseg*$nettoEA;
$afa_osszes=$brutto_osszes-$netto_osszes;
$afa_ossz_egyseg=round($afa_osszes/$mennyiseg);
$brutto_egysegar=round($brutto_osszes/$mennyiseg);
$sql="insert into kltsg_submissions_kiadas 
(`sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`,
`megnevezes`, `netto_egysegar`, `tax`,  `afa_ossz_egyseg`, `quant`, `brutto_egysegar`)
values ('0','".$_SESSION['id']."','".$_COOKIE['egyseg']."','".$_COOKIE['rovatKiadas']."','".$brutto_osszes."','".$netto_osszes."',
'".$afa_osszes."','".$mennyiseg."','".$megnevezes."','".$nettoEA."','".$_COOKIE['afaKulcs']."','".$afa_ossz_egyseg."','".$_COOKIE['mertekegyseg']."','".$brutto_egysegar."')";
//echo $sql;
$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas felvitelénél " . mysqli_error($GLOBALS['conn']));


$sql="select * from kltsg_submissions_kiadas where user_id=".$_SESSION['id']." order by id desc";
//echo $sql;
$res=$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas lekérésénél");
echo '<table class="table table-bordered">
<tr class="subtable">
<th colspan="">Tervezett beszerzés/igénylés</th><th>Nettó egységár</th><th>Áfa egységár</th><th>Bruttó egységár</th><th>Áfakulcs</th><th>Mennyiség</th>
<th>Nettó összesen</th><th>Áfa összesen</th><th>Bruttó összesen</th><th>Művelet</th></tr><tr class="edited-row">';
while($sor=$res->fetch_array(MYSQLI_BOTH))
{
echo "<td>".$sor['megnevezes']."</td>";
echo "<td>".$sor['netto_egysegar']."</td>";
echo "<td>".$sor['afa_ossz_egyseg']."</td>";
echo "<td>".$sor['brutto_egysegar']."</td>";
echo "<td>".$sor['tax']."%</td>";
echo "<td>".$sor['mennyiseg']."</td>";
echo "<td>".$sor['netto_osszes']."</td>";
echo "<td>".($sor['brutto_osszes']-$sor['netto_osszes'])."</td>";
echo "<td>".$sor['brutto_osszes']."</td>";
echo "<td><button type='button'  onclick='delKiadRow(".$sor['id'].")' class='btn btn-danger'>
<span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>&nbsp;<button type='button' 
onclick='editKiadRow(".$sor['id'].")' class='btn btn-default'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></td></tr><tr class='edited-row'>";
}
print_r($sor);
?>