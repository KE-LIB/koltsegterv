<?php
error_reporting(E_ALL);
/*include '/var/www/clients/client11/web36/web/lib/convert/Classes/PHPExcel.php';
include '/var/www/clients/client11/web36/web/lib/convert/Classes/PHPExcel/Writer/Excel2007.php';*/
include_once("../Scripts/db.php");
include_once("../Scripts/excelwriter/xlsxwriter.class.php");
@session_start();
$filename="agregaltFull_".date('Y_m_d_his');
	$ertek = array();
	$inst = array();
	$sql_all="SELECT unit_id, (SELECT kltsg_institute.name FROM kltsg_institute WHERE kltsg_institute.id=(SELECT parent FROM kltsg_unit WHERE id=unit_id)) AS inst,(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit, (SELECT code FROM kltsg_category_bev WHERE id=sub_id ORDER bY kltsg_category_bev.code ASC) AS rovat, 
	netto_osszes, 
	(SELECT tax FROM kltsg_category_bev WHERE id=sub_id ORDER bY kltsg_category_bev.code ASC) AS afarovat, 
	afa_osszes 
	FROM kltsg_submissions_bevetel_sent
	UNION ALL
	SELECT unit_id,(SELECT kltsg_institute.name FROM kltsg_institute WHERE kltsg_institute.id=(SELECT parent FROM kltsg_unit WHERE id=unit_id)) AS inst,(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit, (SELECT code FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS rovat,
	netto_osszes, 
	(SELECT tax FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS afarovat, 
	afa_osszes 
	FROM kltsg_submissions_kiadas_sent";
	$all=$GLOBALS['conn']->query($sql_all);
	$i=0;
	while($kiadrov=$all->fetch_array(MYSQLI_BOTH))
	{	
		$inst[$i] = $kiadrov['inst']."_".$kiadrov['unit'];
		$ertek[$i]['inst_unit'] = $kiadrov['inst']."_".$kiadrov['unit'];
		$ertek[$i]['rovat'] = ($kiadrov['rovat']!="") ? $kiadrov['rovat'] : "üres rovat";
		$ertek[$i]['netto'] = $kiadrov['netto_osszes'];
		$ertek[$i]['afarovat'] = ($kiadrov['afarovat']!="") ? $kiadrov['afarovat'] : "üres rovat";
		$ertek[$i]['afa'] = $kiadrov['afa_osszes'];
		$i++;
	}
	$uniqinst = array_unique($inst);
	$ujind=0;
	$uniqinst = array_values($uniqinst);
	$sepertek = array();
	for($i=0;$i<count($uniqinst);$i++)
	{
		for($j=0;$j<count($ertek);$j++)
		{
			if($uniqinst[$i] == $ertek[$j]['inst_unit'])
			{
				$sepertek[$uniqinst[$i]][$ujind]['rovat'] = $ertek[$j]['rovat'];
				$sepertek[$uniqinst[$i]][$ujind]['netto'] = $ertek[$j]['netto'];
				$sepertek[$uniqinst[$i]][$ujind]['afarovat'] = $ertek[$j]['afarovat'];
				$sepertek[$uniqinst[$i]][$ujind]['afa'] = $ertek[$j]['afa'];
				$ujind++;
			}
		}
	}
	for($i=0;$i<count($uniqinst);$i++)
	{
		$sepertek[$uniqinst[$i]] = array_values($sepertek[$uniqinst[$i]]);
	}
	for($i=0;$i<count($uniqinst);$i++)
	{
		$hely = preg_replace("#_#"," > ",$uniqinst[$i]);
		$sql_aggr_grp="INSERT INTO `kltsg_aggregate_group` (`name`) VALUES ('".$hely."')";
		$aggr_grp=$GLOBALS['conn']->query($sql_aggr_grp);
		$sql_grp_id="SELECT * FROM `kltsg_aggregate_group` WHERE name='".$hely."'";
		$grp_id_a=$GLOBALS['conn']->query($sql_grp_id);
		$grp_id=$grp_id_a->fetch_array(MYSQLI_BOTH);
	
		for($j=0;$j<count($sepertek[$uniqinst[$i]]);$j++)
		{
			
			//echo $sepertek[$uniqinst[$i]][$j]['rovat']."  ".$sepertek[$uniqinst[$i]][$j]['netto']."  ".$sepertek[$uniqinst[$i]][$j]['afarovat']."  ".$sepertek[$uniqinst[$i]][$j]['afa']."<br>";
			$sql_aggr_grp_a="INSERT INTO `kltsg_aggregate_data`(`group_id`, `rovat`, `netto`, `afarovat`, `afa`) VALUES ('".$grp_id['id']."',
			'".$sepertek[$uniqinst[$i]][$j]['rovat']."',
			'".$sepertek[$uniqinst[$i]][$j]['netto']."',
			'".$sepertek[$uniqinst[$i]][$j]['afarovat']."',
			'".$sepertek[$uniqinst[$i]][$j]['afa']."'
			)";
			$GLOBALS['conn']->query($sql_aggr_grp_a);
			
		}
	}
	$rows = array(
    array('Szervezet' , 'Egység', 'Rovat','Áfarovat','Netto','Áfa','Brutto'));	
	
	
	
	$sql_grp="SELECT * FROM `kltsg_aggregate_group`";
	
	$grp=$GLOBALS['conn']->query($sql_grp);
	
	while($group=$grp->fetch_array(MYSQLI_BOTH))
	{
		
		$sql_all_a="SELECT rovat, SUM(netto) AS netto, afarovat, SUM(afa) AS afa FROM `kltsg_aggregate_data` WHERE group_id=".$group['id']." GROUP BY rovat";
		
		$all=$GLOBALS['conn']->query($sql_all_a);
		while($kiadrov=$all->fetch_array(MYSQLI_BOTH))
		{
			$betolt=array();
			$split=explode('>',$group['name']);
			array_push($betolt,$split[0]);
			array_push($betolt,$split[1]);
			array_push($betolt,$kiadrov['rovat']);
			array_push($betolt,$kiadrov['afarovat']);
			array_push($betolt,$kiadrov['netto']);
			array_push($betolt,$kiadrov['afa']);
			$ossz=$kiadrov['afa']+$kiadrov['netto'];
			array_push($betolt,$ossz);
			array_push($rows,$betolt);
		}
		
	}
	$GLOBALS['conn']->query("TRUNCATE kltsg_aggregate_group");
	$GLOBALS['conn']->query("TRUNCATE kltsg_aggregate_data");
	$writer = new XLSXWriter();
	$writer->setAuthor('ke');
	foreach($rows as $row)
		$writer->writeSheetRow('Agregált Összegyetemi', $row);


	$writer->writeToFile('../download/'.$filename.'.xlsx');
	echo "<a href=download/".$filename.".xlsx><span class='glyphicon glyphicon-floppy-saved' onclick=deleteFile('".$filename."','1')>Letöltés</a>";
?>
