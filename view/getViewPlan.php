<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../img/favicon.ico">
		<title>Költségtervező új</title>
		<link rel="stylesheet" href="../Scripts\css\bootstrap.min.css">
		<link rel="stylesheet" href="../Scripts\css\koltsegterv.css">
		<script src="../Scripts/js/jquery.min.js"></script>
		<script src="../Scripts/js/bootstrap.min.js"></script>
	</head>
		<body>
			<div class="container" style="width:100%;">
				<div class="row" style="width:100%;">
					<div id="headPage">
						<div class="col-sm-4">
								<img class="felirat" src="../img/felirat.png"  alt="KE Költségtervező" border="0"/>
						</div>
						<div class="col-sm-4">
								<a class="pull-center" target="_blank" href="http://www.ke.hu">
								<img class="logo" onmouseover="this.src='../img/ke_kozep_ff.png'" onmouseout="this.src='../img/ke_kozep.png'" src="../img/ke_kozep.png"  alt="KE logo" border="0"/>
								</a>
						</div>
						<div class="col-sm-4">
								<div class="pull-right" id="topLeft"></div>
								
						</div>
					</div>
				</div>
				</div>
				<div class="row" id="mainPage">
<div class="row_own">
	  <div class="col-xs-4 col-md-4">
	  <div class="merleg_cimke alert alert-success merleg" id="merleg_cimer"><table class="merleg_table_green" id="merleg_table"><thead>
	  <tr ><th >&nbsp;Bevételek&nbsp;</th><th >&nbsp;Kiadások&nbsp;</th></tr></thead>
	  <tr  ><td >&nbsp;<span id="bevetelossz">0</span>&nbsp;</td><td >&nbsp;<span id="kiadasossz">0</span>&nbsp;</td></tr>
	  <tr ><th colspan="2">Egyenleg:</th></tr>
	  <tr ><td colspan="2"><span id="egyenleg">0</span></td></tr>
	  </tbody></tobdy></table>

		</div>

		</div>
		<div class="col-xs-8 col-md-8">
		<div class="alert alert-info place"><div class="place-text"><strong>Hely:</strong>
		<oreo id="egyseg">-</oreo><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"><oreo id="alegyseg">-</oreo></span>
		<br><oreo id="errorMsgForm"></oreo>
		 </div>
		 </div>
		 </div>
		 </div>
 </div>
<div class="container">
<ul class="nav nav-tabs">

<div class="row">
<div class="col-md-6">
<h2>Kiadások</h2>
  <div class="panel panel-danger">
    <div class="panel-body">
<?php
include_once("../Scripts/db.php");
@session_start();
$sql="select * from kltsg_submissions_kiadas_sent where submissions_id=".$_GET['id']." ";
//echo $sql;
$res=$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas lekérésénél");
//echo $res;
	$sub_id=0;
	$rovatCounter=1;
	$ossz=0;
while($sor=$res->fetch_array(MYSQLI_BOTH))
{
	if($sub_id!=$sor['sub_id'] or $sub_id==0)
	{
		$sqlRovat="select name from kltsg_category where id='".$sor['sub_id']."'";
		$resRovat=$GLOBALS['conn']->query($sqlRovat) or die("Hiba a kltsg_category lekérésénél");
		$sorRovat=$resRovat->fetch_array(MYSQLI_BOTH);
		$sqlSzamolas="select sum(netto_osszes) as netto,sum(brutto_osszes) as brutto,sum(afa_osszes) as afa from kltsg_submissions_kiadas_sent where sub_id='".$sor['sub_id']."' and submissions_id='".$_GET['id']."'";
		$resSzamolas=$GLOBALS['conn']->query($sqlSzamolas) or die("Hiba a kltsg_category lekérésénél");
		$sorSzamolas=$resSzamolas->fetch_array(MYSQLI_BOTH);
		$ossz=$ossz+$sorSzamolas['brutto'];
		
	echo '
<table class="table table-bordered"><thead>
<tr><th>#</th><th colspan="6">Rovat</th><th >Rovat összesen (nettó)</th><th>Áfa összeg</th><th colspan="1">Rovat összesen (bruttó)</th></tr>
</thead><tbody id="table_rows">
<tr class="main-table" id="" >
<td ><div class="line-num">'.$rovatCounter.'</div></td>
<td colspan="6">'.$sorRovat['name'].'</td>
<td colspan="">'.$sorSzamolas['netto'].'</td>
<td colspan="">'.$sorSzamolas['afa'].'</td>
<td colspan=""><span id=brutto'.$rovatCounter.'>'.$sorSzamolas['brutto'].'</span></td>
</tr>
</table><table class="table table-bordered">
<tr class="subtable">
<th colspan="">Tervezett beszerzés/igénylés</th><th>Nettó egységár</th><th>Bruttó egységár</th><th>Áfakulcs</th><th>Mennyiség</th>
<th>Nettó összesen</th><th>Bruttó összesen<tr id="Kiadas'.$sor['id'].'"class="edited-row">';
$rovatCounter++;
	}
echo "<td>".$sor['megnevezes']."</td>";
echo "<td>".$sor['netto_egysegar']."</td>";
echo "<td>".$sor['brutto_egysegar']."</td>";
echo "<td>".$sor['tax']."%</td>";
echo "<td>".$sor['mennyiseg']."</td>";
echo "<td>".$sor['netto_osszes']."</td>";
echo "<td>".$sor['brutto_osszes']."</td>";
$sub_id=$sor['sub_id'];
$inst=$GLOBALS['conn']->query("select name from kltsg_institute where id=".$sor['institute_id']."") or die("Hiba a institut lekérésénél");
$unit=$GLOBALS['conn']->query("select name from kltsg_unit where id=".$sor['unit_id']."") or die("Hiba a unit lekérésénél");
}
echo'<oreo id="buruttOsszesKiad" class="stealth">'.$ossz.'</oreo>';
?>
</table>
</div>
</div>
</div>
<div class="col-md-6">
<h2>Bevételek</h2>
  <div class="panel panel-success">
    <div class="panel-body">
<?php
include_once("../Scripts/db.php");
@session_start();
$sql="select * from kltsg_submissions_bevetel_sent where submissions_id=".$_GET['id']." ";
//echo $sql;
$res=$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas lekérésénél");
//echo $res;
	$sub_id=0;
	$rovatCounter=1;
	$ossz=0;

while($sor=$res->fetch_array(MYSQLI_BOTH))
{
	if($sub_id!=$sor['sub_id'] or $sub_id==0)
	{
		$sqlRovat="select name from kltsg_category where id='".$sor['sub_id']."'";
		$resRovat=$GLOBALS['conn']->query($sqlRovat) or die("Hiba a kltsg_category lekérésénél");
		$sorRovat=$resRovat->fetch_array(MYSQLI_BOTH);
		$sqlSzamolas="select sum(netto_osszes) as netto,sum(brutto_osszes) as brutto,sum(afa_osszes) as afa from kltsg_submissions_bevetel_sent where sub_id='".$sor['sub_id']."'and submissions_id='".$_GET['id']."'";
		$resSzamolas=$GLOBALS['conn']->query($sqlSzamolas) or die("Hiba a kltsg_category lekérésénél");
		$sorSzamolas=$resSzamolas->fetch_array(MYSQLI_BOTH);
		$ossz=$ossz+$sorSzamolas['brutto'];
		
	echo '
<table class="table table-bordered"><thead>
<tr><th>#</th><th colspan="6">Rovat</th><th >Rovat összesen (nettó)</th><th>Áfa összeg</th><th colspan="1">Rovat összesen (bruttó)</th></tr>
</thead><tbody id="table_rows">
<tr class="main-table" id="" >
<td ><div class="line-num">'.$rovatCounter.'</div></td>
<td colspan="6">'.$sorRovat['name'].'</td>
<td colspan="">'.$sorSzamolas['netto'].'</td>
<td colspan="">'.$sorSzamolas['afa'].'</td>
<td colspan=""><span id=brutto'.$rovatCounter.'>'.$sorSzamolas['brutto'].'</span></td>
</tr>
</table><table class="table table-bordered">
<tr class="subtable">
<th colspan="">Tervezett beszerzés/igénylés</th><th>Nettó egységár</th><th>Bruttó egységár</th><th>Áfakulcs</th><th>Mennyiség</th>
<th>Nettó összesen</th><th>Bruttó összesen<tr id="Kiadas'.$sor['id'].'"class="edited-row2">';
$rovatCounter++;
	}
echo "<td>".$sor['megnevezes']."</td>";
echo "<td>".$sor['netto_egysegar']."</td>";
echo "<td>".$sor['brutto_egysegar']."</td>";
echo "<td>".$sor['tax']."%</td>";
echo "<td>".$sor['mennyiseg']."</td>";
echo "<td>".$sor['netto_osszes']."</td>";
echo "<td>".$sor['brutto_osszes']."</td>";
$sub_id=$sor['sub_id'];
}
$ins_a=$inst->fetch_array(MYSQLI_BOTH);
$unit_a=$unit->fetch_array(MYSQLI_BOTH);
echo'<oreo id="inst" class="stealth">'.$ins_a['name'].'</oreo>';
echo'<oreo id="unit" class="stealth">'.$unit_a['name'].'</oreo>';
echo'<oreo id="buruttOsszesBev" class="stealth">'.$ossz.'</oreo>';
?>

</div>
 </div>
 </div>
 <script>
setTimeout(function() {
	var bevOssz=document.getElementById("buruttOsszesBev").innerHTML;
 var kiadOssz=document.getElementById("buruttOsszesKiad").innerHTML;
 var egyenleg=Number(bevOssz)-Number(kiadOssz);
 document.getElementById("bevetelossz").innerHTML=bevOssz;
 document.getElementById("kiadasossz").innerHTML=kiadOssz;
 document.getElementById("egyenleg").innerHTML=egyenleg;
 
 document.getElementById("egyseg").innerHTML=document.getElementById("inst").innerHTML;
 document.getElementById("alegyseg").innerHTML=document.getElementById("unit").innerHTML;
 
 if(egyenleg>=0)
		{
			document.getElementById("merleg_cimer").className="merleg_cimke alert alert-success merleg";
			document.getElementById("merleg_table").className="merleg_table_green";
		}
		else
		{
			document.getElementById("merleg_cimer").className="merleg_cimke alert alert-danger merleg";
			document.getElementById("merleg_table").className="merleg_table_red";
		}},500);
 </script>
 
 
