<?php
include_once("../Scripts/db.php");
@session_start();
$sql="select * from kltsg_submissions_bevetel where user_id=".$_SESSION['id']."   order by sub_id desc";
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
		$sqlRovat="select name from kltsg_category_bev where id='".$sor['sub_id']."'";
		$resRovat=$GLOBALS['conn']->query($sqlRovat) or die("Hiba a kltsg_category lekérésénél");
		$sorRovat=$resRovat->fetch_array(MYSQLI_BOTH);
		$sqlSzamolas="select sum(netto_osszes) as netto,sum(brutto_osszes) as brutto,sum(afa_osszes) as afa from kltsg_submissions_bevetel where sub_id='".$sor['sub_id']."'";
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
<th colspan="">Tervezett beszerzés/igénylés</th><th>Nettó egységár</th><th>Áfa egységár</th><th>Bruttó egységár</th><th>Áfakulcs</th><th>Mennyiség</th>
<th>Nettó összesen</th><th>Áfa összesen</th><th>Bruttó összesen</th><th>Művelet</th></tr><tr id="Bevetel'.$sor['id'].'"class="edited-row2">';
$rovatCounter++;
	}

echo "<td>".$sor['megnevezes']."</td>";
echo "<td>".$sor['netto_egysegar']."</td>";
echo "<td>".$sor['afa_ossz_egyseg']."</td>";
echo "<td>".$sor['brutto_egysegar']."</td>";
echo "<td>".$sor['tax']."%</td>";
echo "<td>".$sor['mennyiseg']."</td>";
echo "<td>".$sor['netto_osszes']."</td>";
echo "<td>".($sor['brutto_osszes']-$sor['netto_osszes'])."</td>";
echo "<td>".$sor['brutto_osszes']."</td>";
echo "<td><button type='button'  onclick='delBevRow(".$sor['id'].")' class='btn btn-danger'>
<span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>&nbsp;<button type='button' 
onclick='editBevRow(".$sor['id'].")' class='btn btn-default'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></td></tr><tr class='edited-row'>";
$sub_id=$sor['sub_id'];
}
echo'<oreo id="buruttOsszesBev" class="stealth">'.$ossz.'</oreo>';
?>