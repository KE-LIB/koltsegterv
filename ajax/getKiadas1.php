<?php
include_once("../Scripts/db.php");
@session_start();
$sql="select * from kltsg_submissions_kiadas where user_id=".$_SESSION['id']."  group by sub_id order by id desc";
echo $sql;
$res=$GLOBALS['conn']->query($sql) or die("Hiba a kltsg_submissions_kiadas lekérésénél");
echo '
<table class="table table-bordered"><thead>
<tr><th>#</th><th colspan="6">Rovat</th><th >Rovat összesen (nettó)</th><th>Áfa összeg</th><th colspan="1">Rovat összesen (bruttó)</th></tr>
</thead><tbody id="table_rows">
<tr class="main-table" id="" >
<td ><div class="line-num">-</div></td>
<td colspan="6"></td>
<td colspan=""></td>
<td colspan=""></td>
<td colspan=""></td>
</tr>

</table><table class="table table-bordered">
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