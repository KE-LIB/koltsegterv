<?php
error_reporting(E_ALL);
/*include '/var/www/clients/client11/web36/web/lib/convert/Classes/PHPExcel.php';
include '/var/www/clients/client11/web36/web/lib/convert/Classes/PHPExcel/Writer/Excel2007.php';*/
include_once("../Scripts/db.php");
include_once("../Scripts/excelwriter/xlsxwriter.class.php");
@session_start();
$filename="analitikusAlEgysegenkent_".date('Y_m_d_his');
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
	$bevsum=0;
	$sqlbev="SELECT 
			 submissions_id AS latest,
			(SELECT kltsg_institute.name FROM kltsg_institute WHERE id=institute_id ) AS instname,
			(SELECT kltsg_unit.name FROM kltsg_unit WHERE id=unit_id ) AS unitname,
			(SELECT kltsg_category_bev.code FROM kltsg_category_bev WHERE id=sub_id ORDER bY kltsg_category_bev.code ASC)AS kkod,
			(SELECT kltsg_category_bev.name FROM kltsg_category_bev WHERE id=sub_id ORDER bY kltsg_category_bev.code ASC) AS kname,
			megnevezes,
			netto_egysegar,
			tax,
			afa_ossz_egyseg,
			brutto_egysegar,
			mennyiseg,
			(SELECT name FROM kltsg_quant WHERE id=quant) AS egyseg,
			netto_osszes,
			afa_osszes,
			brutto_osszes
		FROM kltsg_submissions_bevetel_sent 
			 where unit_id=".$_GET['id']." ORDER BY submissions_id DESC ";
	$bev=$GLOBALS['conn']->query($sqlbev);
$rows = array(
    array('Szervezet','Egység','Rovat','Rovat megnevezés','Tervezett beszerzés/igénylés','Nettó egységár','ÁFA kulcs'
	,'ÁFA egységár','Bruttó egységár','Mennyiség','Mennyiségi egység','Nettó összeg','ÁFA összeg','Bruttó összeg'));	
	$bev_a=array();	
	while($bevrec=$bev->fetch_array(MYSQLI_BOTH))
	{
		$bev_a=array();
		for($i=1;$i<15;$i++)
		{
		array_push($bev_a,$bevrec[$i]);
		}
		$bevsum+=$bevrec[14];
		array_push($rows,$bev_a);			
	}
	
	$kiadsum=0;
	$sqlkiad="SELECT 
			 submissions_id AS latest,
			(SELECT kltsg_institute.name FROM kltsg_institute WHERE id=institute_id ) AS instname,
			(SELECT kltsg_unit.name FROM kltsg_unit WHERE id=unit_id ) AS unitname,
			(SELECT kltsg_category.code FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC)AS kkod,
			(SELECT kltsg_category.name FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS kname,
			megnevezes,
			netto_egysegar,
			tax,
			afa_ossz_egyseg,
			brutto_egysegar,
			mennyiseg,
			(SELECT name FROM kltsg_quant WHERE id=quant) AS egyseg,
			netto_osszes,
			afa_osszes,
			brutto_osszes
		FROM kltsg_submissions_kiadas_sent 
			where unit_id=".$_GET['id']."  ORDER BY submissions_id DESC ";
	$kiad=$GLOBALS['conn']->query($sqlkiad);
			
	while($kiadrec=$kiad->fetch_array(MYSQLI_BOTH))
	{	
		$kiad_a=array();
		for($i=1;$i<15;$i++)
		{
		array_push($kiad_a,$kiadrec[$i]);
		}
		$kiadsum+=$kiadrec[14];
		array_push($rows,$kiad_a);	
	}
	$egyenleg=$bevsum-$kiadsum;
	array_push($rows,array("Bevétel összesen",$bevsum));
	array_push($rows,array("Kiadás összesen",$kiadsum));
	array_push($rows,array("Egyenleg összesen",$egyenleg));
$writer = new XLSXWriter();
$writer->setAuthor('ke');
foreach($rows as $row)
	$writer->writeSheetRow('Analitkus Alegységenként', $row);


$writer->writeToFile('../download/'.$filename.'.xlsx');
echo "<a href=download/".$filename.".xlsx><span class='glyphicon glyphicon-floppy-saved' onclick=deleteFile('".$filename."','".$_GET['id']."')>Letöltés</a>";
exit(0);
?>