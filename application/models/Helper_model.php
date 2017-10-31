<?php
class Helper_model extends CI_Model {

      
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
		public function getEgyseg()
        {
			
			$this->load->database();
			$sql="SELECT (SELECT kltsg_institute.id FROM kltsg_institute WHERE id=parent)AS instid, (SELECT kltsg_institute.name FROM kltsg_institute WHERE id=parent)AS instname
			FROM kltsg_unit
			WHERE kltsg_unit.id IN (SELECT unit_id FROM kltsg_policy WHERE user_id=".$_COOKIE['userid'].") GROUP BY instid;";		
			$query = $this->db->query($sql);
			$returnArray=array();
            return $query;
		
		}
		public function getAlEgyseg()
        {
			
		$this->load->database();
		$sql="SELECT kltsg_unit.id AS unitid, kltsg_unit.name AS unitname
		FROM kltsg_unit
		WHERE kltsg_unit.id IN (SELECT unit_id FROM kltsg_policy WHERE user_id=".$_COOKIE['userid']." AND parent=".$_POST['egyseg'].") ;";		
		$query = $this->db->query($sql);
			
            return $query;
		
		}
		public function getEveryEgyseg()
        {
			
		$this->load->database();
		$sql="SELECT kltsg_institute.id AS itid, kltsg_institute.name AS itname	FROM kltsg_institute";		
		$query = $this->db->query($sql);
			
            return $query;
		
		}
		public function getEveryAlEgyseg()
        {
			
		$this->load->database();
		$sql="SELECT kltsg_unit.id AS unitid,parent as unitParent, kltsg_unit.name AS unitname
		FROM kltsg_unit";		
		$query = $this->db->query($sql);
			
            return $query;
		
		}
		public function getUserAlEgyseg()
        {
			
		$this->load->database();
		$sql="SELECT kltsg_unit.id AS unitid
		FROM kltsg_unit
		WHERE kltsg_unit.id IN (SELECT unit_id FROM kltsg_policy WHERE user_id=".$_POST['id'].") ;";		
		$query = $this->db->query($sql);
			
            return $query;
		
		}
		public function getAlegysegName($alegyseg)
        {
			
		$this->load->database();
		$sql="SELECT kltsg_unit.name as egyseg 
		FROM `kltsg_unit` WHERE id=".$alegyseg."";		
			$query = $this->db->query($sql);
			
            return $query;
		}
		public function getEgysegName($egyseg)
        {
			
		$this->load->database();
		$sql="SELECT kltsg_institute.name as egyseg 
		FROM `kltsg_institute` WHERE kltsg_institute.id=".$egyseg."";	
			$query = $this->db->query($sql);
			
            return $query;
		}
        
		public function getAllRovat()
        {
			
		$this->load->database();
		$sql="SELECT * FROM kltsg_category ORDER BY code desc";	
			$query = $this->db->query($sql);
			
            return $query;
		}	
		public function getAllBRovat()
        {
			
		$this->load->database();
		$sql="SELECT * FROM kltsg_category_bev ORDER BY code desc";	
			$query = $this->db->query($sql);
			
            return $query;
		}
		public function getAllAfa()
        {
			
		$this->load->database();
		$sql="SELECT * FROM kltsg_tax ORDER BY value";
			$query = $this->db->query($sql);
			
            return $query;
		}
		public function getAllMertek()
        {
			
		$this->load->database();
		$sql="SELECT * FROM kltsg_quant ";
		$query = $this->db->query($sql);
			
         return $query;
		}	
		public function getAllCPV1()
        {
			
		$this->load->database();
		$sql="SELECT * FROM kltsg_cpv1 ";
		$query = $this->db->query($sql);
			
         return $query;
		}
		public function getCPV2()
        {
		$parent=$_POST['id'];	
		$this->load->database();
		$sql="SELECT * FROM kltsg_cpv2 where parent='".$parent."' ";
		$query = $this->db->query($sql);
        return $query;
		}
		public function addKiadas()
        {
			
		$this->load->database();
		$megnevezes=$_POST['megnevezes'];
		$egysegAr=$_POST['egysegAr'];
		$mennyiseg=$_POST['mennyiseg'];
		$rovat=$_POST['rovat'];
		$ev=$_POST['ev'];
		$honap=$_POST['honap'];
		$cpv=$_POST['cpv'];
		$brutto_osszes=$mennyiseg*$egysegAr;
		$nettoEA=round(($egysegAr/($_COOKIE['afaKulcs']+100))*100);
		$netto_osszes=$mennyiseg*$nettoEA;
		$afa_osszes=$brutto_osszes-$netto_osszes;
		$afa_ossz_egyseg=round($afa_osszes/$mennyiseg);
		$brutto_egysegar=round($brutto_osszes/$mennyiseg);
		$sql="insert into kltsg_submissions_kiadas 
		(`sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`,
		`megnevezes`, `netto_egysegar`, `tax`,  `afa_ossz_egyseg`, `quant`, `brutto_egysegar`,`Year`,`cpv`,`honap`)
		values ('".$rovat."','".$_COOKIE['userid']."','".$_COOKIE['egyseg']."','".$_COOKIE['alegyseg']."','".$brutto_osszes."','".$netto_osszes."',
		'".$afa_osszes."','".$mennyiseg."','".$megnevezes."','".$nettoEA."','".$_COOKIE['afaKulcs']."','".$afa_ossz_egyseg."','".$_COOKIE['mertekegyseg']."','".$brutto_egysegar."','".$ev."','".$cpv."','".$honap."')";
		$query = $this->db->query($sql);
			
       
		}
		public function addBevetel()
        {
			
		$this->load->database();
		$megnevezes=$_POST['megnevezes'];
		$egysegAr=$_POST['egysegAr'];
		$mennyiseg=$_POST['mennyiseg'];
		$rovat=$_POST['rovat'];
		$ev=$_POST['ev'];
		$honap=$_POST['honap'];
		$brutto_osszes=$mennyiseg*$egysegAr;
		$nettoEA=round(($egysegAr/($_COOKIE['afaKulcs']+100))*100);
		$netto_osszes=$mennyiseg*$nettoEA;
		$afa_osszes=$brutto_osszes-$netto_osszes;
		$afa_ossz_egyseg=round($afa_osszes/$mennyiseg);
		$brutto_egysegar=round($brutto_osszes/$mennyiseg);
		$sql="insert into kltsg_submissions_bevetel 
		(`sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`,
		`megnevezes`, `netto_egysegar`, `tax`,  `afa_ossz_egyseg`, `quant`, `brutto_egysegar`,`Year`,`honap`)
		values ('".$rovat."','".$_COOKIE['userid']."','".$_COOKIE['egyseg']."','".$_COOKIE['alegyseg']."','".$brutto_osszes."','".$netto_osszes."',
		'".$afa_osszes."','".$mennyiseg."','".$megnevezes."','".$nettoEA."','".$_COOKIE['afaKulcs']."','".$afa_ossz_egyseg."','".$_COOKIE['mertekegyseg']."','".$brutto_egysegar."','".$ev."','".$honap."')";
		$query = $this->db->query($sql);      
		}
		public function modKiadas()
        {
			
		$this->load->database();
		$megnevezes=$_POST['megnevezes'];
		$egysegAr=$_POST['egysegAr'];
		$mennyiseg=$_POST['mennyiseg'];
		$rovat=$_POST['rovat'];
		$ev=$_POST['ev'];
		$id=$_POST['id'];
		$afa=$_POST['afa'];
		$cpv=$_POST['cpv'];
		$honap=$_POST['honap'];
		$brutto_osszes=$mennyiseg*$egysegAr;
		$nettoEA=round(($egysegAr/($afa+100))*100);
		$netto_osszes=$mennyiseg*$nettoEA;
		$afa_osszes=$brutto_osszes-$netto_osszes;
		$afa_ossz_egyseg=round($afa_osszes/$mennyiseg);
		$brutto_egysegar=round($brutto_osszes/$mennyiseg);
		$sql="update kltsg_submissions_kiadas set 
		sub_id='".$rovat."',
		user_id='".$_COOKIE['userid']."',
		institute_id='".$_COOKIE['egyseg']."',
		unit_id='".$_COOKIE['alegyseg']."', 
		brutto_osszes='".$brutto_osszes."',
		netto_osszes='".$netto_osszes."', 
		afa_osszes='".$afa_osszes."', 
		mennyiseg='".$mennyiseg."',
		megnevezes='".$megnevezes."', 
		netto_egysegar='".$nettoEA."',
		tax='".$afa."', 
		honap='".$honap."', 
		afa_ossz_egyseg='".$afa_ossz_egyseg."',
		quant='".$_COOKIE['mertekegyseg']."', 
		brutto_egysegar='".$brutto_egysegar."',
		Year='".$ev."',cpv='".$cpv."' where id='".$id."'";
		$query = $this->db->query($sql);       
		}
		public function modBevetel()
        {
		$this->load->database();
		$megnevezes=$_POST['megnevezes'];
		$egysegAr=$_POST['egysegAr'];
		$mennyiseg=$_POST['mennyiseg'];
		$rovat=$_POST['rovat'];
		$ev=$_POST['ev'];
		$id=$_POST['id'];
		$afa=$_POST['afa'];
		$honap=$_POST['honap'];
		$brutto_osszes=$mennyiseg*$egysegAr;
		$nettoEA=round(($egysegAr/($afa+100))*100);
		$netto_osszes=$mennyiseg*$nettoEA;
		$afa_osszes=$brutto_osszes-$netto_osszes;
		$afa_ossz_egyseg=round($afa_osszes/$mennyiseg);
		$brutto_egysegar=round($brutto_osszes/$mennyiseg);
		$sql="update kltsg_submissions_bevetel set 
		sub_id='".$rovat."',
		user_id='".$_COOKIE['userid']."',
		institute_id='".$_COOKIE['egyseg']."',
		unit_id='".$_COOKIE['alegyseg']."', 
		brutto_osszes='".$brutto_osszes."',
		netto_osszes='".$netto_osszes."', 
		afa_osszes='".$afa_osszes."', 
		mennyiseg='".$mennyiseg."',
		megnevezes='".$megnevezes."', 
		netto_egysegar='".$nettoEA."',
		tax='".$afa."', 
		honap='".$honap."', 
		afa_ossz_egyseg='".$afa_ossz_egyseg."',
		quant='".$_COOKIE['mertekegyseg']."', 
		brutto_egysegar='".$brutto_egysegar."',
		Year='".$ev."' where id='".$id."'";
		$query = $this->db->query($sql);       
		}
		
		public function getKiadas()
		{
			$this->load->database();
			$sql="select * from kltsg_submissions_kiadas where user_id=".$_COOKIE['userid']." and  institute_id='".$_COOKIE['egyseg']."' and unit_id='".$_COOKIE['alegyseg']."'  order by sub_id desc";	
		$query = $this->db->query($sql);
		$sub_id=0;
		$rovatCounter=1;
		$ossz=0;
		foreach ($query->result() as $row)
		{
		$sqlRovat="select name from kltsg_category where id='".$row->sub_id."'";
		$resRovat=$this->db->query($sqlRovat) or die("Hiba a kltsg_category lekérésénél");
		foreach($resRovat->result() as $sorRovat)
		{
		$sqlSzamolas="select sum(netto_osszes) as netto,sum(brutto_osszes) as brutto,sum(afa_osszes) as afa from kltsg_submissions_kiadas where sub_id='".$row->sub_id."'";
		
		$resSzamolas=$this->db->query($sqlSzamolas) or die("Hiba a kltsg_category lekérésénél");
		foreach($resSzamolas->result() as $sorSzamolas)
		{
		$ossz=$ossz+$sorSzamolas->brutto;
		if($sub_id!=$row->sub_id)
		{
		echo '
		<table class="table table-bordered"><thead>
		<tr><th>#</th><th colspan="6">Rovat</th><th >Rovat összesen (nettó)</th><th>Áfa összeg</th><th colspan="1">Rovat összesen (bruttó)</th></tr>
		</thead><tbody id="table_rows">
		<tr class="main-table" id="" >
		<td ><div class="line-num">'.$rovatCounter.'</div></td>
		<td colspan="6">'.$sorRovat->name.'</td>
		<td colspan="">'.$sorSzamolas->netto.'</td>
		<td colspan="">'.$sorSzamolas->afa.'</td>
		<td colspan=""><span id=brutto'.$rovatCounter.'>'.$sorSzamolas->brutto.'</span></td>
		</tr>
		</table>
		
		<table class="table table-bordered">
		<tr class="subtable">
		<th colspan="">Tervezett beszerzés/igénylés</th><th>Nettó egységár</th><th>Áfa egységár</th><th>Bruttó egységár</th><th>Áfakulcs</th><th>Mennyiség</th>
		<th>Nettó összesen</th><th>Áfa összesen</th><th>Bruttó összesen</th><th>Művelet</th></tr>';}
		echo '<tr id="Kiadas'.$row->id.'"class="edited-row">';
		
		$rovatCounter++;
		
		echo "<td>".$row->megnevezes."</td>";
		echo "<td>".$row->netto_egysegar."</td>";
		echo "<td>".$row->afa_ossz_egyseg."</td>";
		echo "<td>".$row->brutto_egysegar."</td>";
		echo "<td>".$row->tax."%</td>";
		echo "<td>".$row->mennyiseg."</td>";
		echo "<td>".$row->netto_osszes."</td>";
		echo "<td>".($row->brutto_osszes-$row->netto_osszes)."</td>";
		echo "<td>".$row->brutto_osszes."</td>";
		echo "<td><button type='button'  onclick='delKiadRow(".$row->id.")' class='btn btn-danger'>
		<span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>&nbsp;<button type='button' 
		onclick='editKiadRow(".$row->id.")' class='btn btn-default'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></td></tr>";
		$sub_id=$row->sub_id;
}}}
return $ossz;
}
public function getBevetel()
		{
			$this->load->database();
			$sql="select * from kltsg_submissions_bevetel where user_id=".$_COOKIE['userid']." and  institute_id='".$_COOKIE['egyseg']."' and unit_id='".$_COOKIE['alegyseg']."'  order by sub_id desc";	
		$query = $this->db->query($sql);
		$sub_id=0;
		$rovatCounter=1;
		$ossz=0;
		foreach ($query->result() as $row)
		{
		$sqlRovat="select name from kltsg_category_bev where id='".$row->sub_id."'";
		$resRovat=$this->db->query($sqlRovat) or die("Hiba a kltsg_category lekérésénél");
		foreach($resRovat->result() as $sorRovat)
		{
		$sqlSzamolas="select sum(netto_osszes) as netto,sum(brutto_osszes) as brutto,sum(afa_osszes) as afa from kltsg_submissions_bevetel where sub_id='".$row->sub_id."'";
		
		$resSzamolas=$this->db->query($sqlSzamolas) or die("Hiba a kltsg_category lekérésénél");
		foreach($resSzamolas->result() as $sorSzamolas)
		{
		$ossz=$ossz+$sorSzamolas->brutto;
		if($sub_id!=$row->sub_id)
		{
		echo '
		<table class="table table-bordered"><thead>
		<tr><th>#</th><th colspan="6">Rovat</th><th >Rovat összesen (nettó)</th><th>Áfa összeg</th><th colspan="1">Rovat összesen (bruttó)</th></tr>
		</thead><tbody id="table_rows">
		<tr class="main-table" id="" >
		<td ><div class="line-num">'.$rovatCounter.'</div></td>
		<td colspan="6">'.$sorRovat->name.'</td>
		<td colspan="">'.$sorSzamolas->netto.'</td>
		<td colspan="">'.$sorSzamolas->afa.'</td>
		<td colspan=""><span id=brutto'.$rovatCounter.'>'.$sorSzamolas->brutto.'</span></td>
		</tr>
		</table>
		
		<table class="table table-bordered">
		<tr class="subtable">
		<th colspan="">Tervezett beszerzés/igénylés</th><th>Nettó egységár</th><th>Áfa egységár</th><th>Bruttó egységár</th><th>Áfakulcs</th><th>Mennyiség</th>
		<th>Nettó összesen</th><th>Áfa összesen</th><th>Bruttó összesen</th><th>Művelet</th></tr>';}
		echo '<tr id="Kiadas'.$row->id.'"class="edited-row">';
		
		$rovatCounter++;
		
		echo "<td>".$row->megnevezes."</td>";
		echo "<td>".$row->netto_egysegar."</td>";
		echo "<td>".$row->afa_ossz_egyseg."</td>";
		echo "<td>".$row->brutto_egysegar."</td>";
		echo "<td>".$row->tax."%</td>";
		echo "<td>".$row->mennyiseg."</td>";
		echo "<td>".$row->netto_osszes."</td>";
		echo "<td>".($row->brutto_osszes-$row->netto_osszes)."</td>";
		echo "<td>".$row->brutto_osszes."</td>";
		echo "<td><button type='button'  onclick='delBevRow(".$row->id.")' class='btn btn-danger'>
		<span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>&nbsp;<button type='button' 
		onclick='editBevetelRow(".$row->id.")' class='btn btn-default'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></td></tr>";
		$sub_id=$row->sub_id;
}}}
return $ossz;
}

public function getKiadasSum()
{
$this->load->database();
$sql="select sum(brutto_osszes) as brutto from kltsg_submissions_kiadas where user_id=".$_COOKIE['userid']."";	
$query = $this->db->query($sql);
return $query;
}

public function getBevetelSum()
{
$this->load->database();
$sql="select sum(brutto_osszes) as brutto from kltsg_submissions_bevetel where user_id=".$_COOKIE['userid']."";	
$query = $this->db->query($sql);
return $query;
}

public function delKiadasRow($id)
{
	$this->load->database();
	$sql="delete from kltsg_submissions_kiadas where id='".$_POST['id']."'";
	$this->db->query($sql);
}
public function delBevRow($id)
{
	$this->load->database();
	$sql="delete from kltsg_submissions_bevetel where id='".$_POST['id']."'";
	$this->db->query($sql);
}
public function editKiadasRow($id)
{
	$this->load->database();
	$sql="select * from kltsg_submissions_kiadas where id='".$_POST['id']."'";
	$query=$this->db->query($sql);
	return $query;
}
public function editBevetelRow($id)
{
	$this->load->database();
	$sql="select * from kltsg_submissions_bevetel where id='".$_POST['id']."'";
	$query=$this->db->query($sql);
	return $query;
}
public function confirmAndSave()
{
	$this->load->database();
	$data=array('user_id'=>$_COOKIE['userid']);
	$this->db->insert('kltsg_submissions',$data) or die("Hiba a kltsg_submissions beillesztésénél");
	$subId=$this->db->insert_id();
	$sql="select row_id from kltsg_submissions_kiadas_saved order by row_id desc limit 1";
	$res=$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas_saved row_id lekérdezésénél");
	foreach($res->result() as $sorSzam_a);
	{
	$row_id=$sorSzam_a->row_id;
	}
	$row_id++;
	$sql="select * from kltsg_submissions_kiadas where user_id='".$_COOKIE['userid']."' ";
	$res=$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas lekérdezésénél");
	foreach($res->result() as $kiadas)
	{
	$sqlKiadas="insert into kltsg_submissions_kiadas_saved ( row_id, submissions_id, sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,category_tax_field, afa_ossz_egyseg, quant, brutto_egysegar,Year,cpv,honap)
	values('".$row_id."','".$subId."','".$kiadas->sub_id."','".$_COOKIE['userid']."','".$kiadas->institute_id."','".$kiadas->unit_id."','".$kiadas->brutto_osszes."','".$kiadas->netto_osszes."','".$kiadas->afa_osszes."','".$kiadas->mennyiseg."','".$kiadas->megnevezes."','".$kiadas->netto_egysegar."','".$kiadas->tax."','0','".$kiadas->afa_ossz_egyseg."','".$kiadas->quant."','".$kiadas->brutto_egysegar."','".$kiadas->Year."','".$kiadas->cpv."','".$kiadas->honap."')";
	//echo $sqlKiadas;
	$this->db->query($sqlKiadas) or die("Hiba a kltsg_submissions_kiadas_saved beillesztésénél");
	}
	//bevételek átrakása
	$sql="select row_id from kltsg_submissions_bevetel_saved order by row_id desc limit 1";
	$res=$this->db->query($sql);
	foreach($res->result() as $sorSzam_a);
	$row_id=$sorSzam_a->row_id;
	$row_id++;
	$sql="select * from kltsg_submissions_bevetel where user_id='".$_COOKIE['userid']."' ";
	//echo $sql;
	$res=$this->db->query($sql)or die("Hiba a kltsg_submissions_bevétel lekérdezésénél");
	foreach($res->result() as $bevetel)
	{
	$sqlbevetel="insert into kltsg_submissions_bevetel_saved ( row_id, submissions_id, sub_id, user_id, institute_id,
	unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,
	category_tax_field, afa_ossz_egyseg, quant, brutto_egysegar,Year,honap)
	values('".$row_id."',
	'".$subId."',
	'".$bevetel->sub_id."',
	'".$_COOKIE['userid']."',
	'".$bevetel->institute_id."',
	'".$bevetel->unit_id."',
	'".$bevetel->brutto_osszes."',
	'".$bevetel->netto_osszes."',
	'".$bevetel->afa_osszes."',
	'".$bevetel->mennyiseg."',
	'".$bevetel->megnevezes."',
	'".$bevetel->netto_egysegar."',
	'".$bevetel->tax."',
	'0',
	'".$bevetel->afa_ossz_egyseg."',
	'".$bevetel->quant."',
	'".$bevetel->brutto_egysegar."',
	'".$bevetel->Year."',
	'".$bevetel->honap."')";
	$this->db->query($sqlbevetel) or die("Hiba a kltsg_submissions_bevetel_saved beillesztésénél");
	}
	$sqlDelteBevetel="delete from kltsg_submissions_bevetel where user_id='".$_COOKIE['userid']."'" ;
	$this->db->query($sqlDelteBevetel) or die("Hiba a kltsg_submissions_bevetel törlésénél");
	$sqlDelteKiadas="delete from kltsg_submissions_kiadas where user_id='".$_COOKIE['userid']."'" ;
	$this->db->query($sqlDelteKiadas) or die("Hiba a kltsg_submissions_kiadas törlésénél");
}
public function confirmSend()
{
	$this->load->database();
	$data=array('user_id'=>$_COOKIE['userid']);
	$this->db->insert('kltsg_submissions',$data) or die("Hiba a kltsg_submissions beillesztésénél");
	$subId=$this->db->insert_id();
	$sql="select row_id from kltsg_submissions_kiadas_sent order by row_id desc limit 1";
	$res=$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas_sent row_id lekérdezésénél");
	foreach($res->result() as $sorSzam_a);
	{
	$row_id=$sorSzam_a->row_id;
	}
	$row_id++;
	$sql="select * from kltsg_submissions_kiadas where user_id='".$_COOKIE['userid']."' ";
	$res=$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas lekérdezésénél");
	foreach($res->result() as $kiadas)
	{
	$sqlKiadas="insert into kltsg_submissions_kiadas_sent ( row_id, submissions_id, sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,category_tax_field, afa_ossz_egyseg, quant, brutto_egysegar,Year,cpv,honap)
	values('".$row_id."','".$subId."','".$kiadas->sub_id."','".$_COOKIE['userid']."','".$kiadas->institute_id."','".$kiadas->unit_id."','".$kiadas->brutto_osszes."','".$kiadas->netto_osszes."','".$kiadas->afa_osszes."','".$kiadas->mennyiseg."','".$kiadas->megnevezes."','".$kiadas->netto_egysegar."','".$kiadas->tax."','0','".$kiadas->afa_ossz_egyseg."','".$kiadas->quant."','".$kiadas->brutto_egysegar."','".$kiadas->Year."','".$kiadas->cpv."','".$kiadas->honap."')";
	//echo $sqlKiadas;
	$this->db->query($sqlKiadas) or die("Hiba a kltsg_submissions_kiadas_sent beillesztésénél");
	}
	//bevételek átrakása
	$sql="select row_id from kltsg_submissions_bevetel_sent order by row_id desc limit 1";
	$res=$this->db->query($sql);
	foreach($res->result() as $sorSzam_a);
	$row_id=$sorSzam_a->row_id;
	$row_id++;
	$sql="select * from kltsg_submissions_bevetel where user_id='".$_COOKIE['userid']."' ";
	//echo $sql;
	$res=$this->db->query($sql)or die("Hiba a kltsg_submissions_bevétel lekérdezésénél");
	foreach($res->result() as $bevetel)
	{
	$sqlbevetel="insert into kltsg_submissions_bevetel_sent ( row_id, submissions_id, sub_id, user_id, institute_id,
	unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,
	category_tax_field, afa_ossz_egyseg, quant, brutto_egysegar,Year,honap)
	values('".$row_id."',
	'".$subId."',
	'".$bevetel->sub_id."',
	'".$_COOKIE['userid']."',
	'".$bevetel->institute_id."',
	'".$bevetel->unit_id."',
	'".$bevetel->brutto_osszes."',
	'".$bevetel->netto_osszes."',
	'".$bevetel->afa_osszes."',
	'".$bevetel->mennyiseg."',
	'".$bevetel->megnevezes."',
	'".$bevetel->netto_egysegar."',
	'".$bevetel->tax."',
	'0',
	'".$bevetel->afa_ossz_egyseg."',
	'".$bevetel->quant."',
	'".$bevetel->brutto_egysegar."',
	'".$bevetel->Year."','".$bevetel->honap."')";
	$this->db->query($sqlbevetel) or die("Hiba a kltsg_submissions_bevetel_sent beillesztésénél");
	}
	$sqlDelteBevetel="delete from kltsg_submissions_bevetel where user_id='".$_COOKIE['userid']."'" ;
	$this->db->query($sqlDelteBevetel) or die("Hiba a kltsg_submissions_bevetel törlésénél");
	$sqlDelteKiadas="delete from kltsg_submissions_kiadas where user_id='".$_COOKIE['userid']."'" ;
	$this->db->query($sqlDelteKiadas) or die("Hiba a kltsg_submissions_kiadas törlésénél");
}

public function clearSubmission()
{
	$this->load->database();
	$sqlDelteBevetel="delete from kltsg_submissions_bevetel where user_id='".$_COOKIE['userid']."'" ;
	$this->db->query($sqlDelteBevetel) or die("Hiba a kltsg_submissions_bevetel törlésénél");
	$sqlDelteKiadas="delete from kltsg_submissions_kiadas where user_id='".$_COOKIE['userid']."'" ;
	$this->db->query($sqlDelteKiadas) or die("Hiba a kltsg_submissions_kiadas törlésénél");
}

public function getSavedPlansList()
{
	$this->load->database();
	echo '
	<div class="col-xs-11 col-md-11"><h2 style="margin-top:10px;">Mentett tervezetek</h2></div>';
	$sql="SELECT * FROM kltsg_submissions_kiadas_saved
	WHERE  kltsg_submissions_kiadas_saved.user_id='".$_COOKIE['userid']."'";
	$res=$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas_saved lekérdezésénél ");
	$savenum = $res->num_rows();
	
	if($savenum==0)
	{
	echo '<br><br><br><div class="alert alert-info"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;Még nem mentett költségtervezetet!</div>';
	}
	else{
	echo'
	<table class="table table-bordered"><thead>
      <tr class="main-table"><th colspan="">Sorszám</th><th colspan="1">Szervezet > Egység</th><th colspan="">Azonosító</th><th colspan="">Dátum</th><th colspan="">Műveletek</th></tr>
    </thead><tbody id="table_rows">';
	$sql="SELECT submissions_id, (SELECT created_time FROM kltsg_submissions WHERE id=submissions_id) AS submissions_time,
	institute_id, unit_id, (SELECT name FROM kltsg_institute WHERE id=institute_id) AS institute_name,
	(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit_name FROM `kltsg_submissions_kiadas_saved` WHERE user_id='".$_COOKIE['userid']."' 
	GROUP BY unit_id,
	institute_id, submissions_id ORDER BY id DESC;";
	$category=$this->db->query($sql) or die("Hiba a kltsg  lekérdezésénél " . $this->db->error());
	$i=0;
	foreach($category->result() as $record)
	{
	//legördülő kell ide
	echo '<tr><td>'.$i++.'</td><td colspan=""><select id="inst_unit_'.$i.'" class="form-control">';
		$place=$this->db->query("
		SELECT (SELECT kltsg_institute.id FROM kltsg_institute WHERE id=parent)AS instid, (SELECT kltsg_institute.name FROM kltsg_institute WHERE id=parent)AS instname, kltsg_unit.id AS unitid, kltsg_unit.name AS unitname
		FROM kltsg_unit
		WHERE kltsg_unit.id IN (SELECT unit_id FROM kltsg_policy WHERE user_id='".$_COOKIE['userid']."' );");
			
			foreach($place->result() as $plcerec)
			{
				if(($plcerec->instid==$record->institute_id)&&($plcerec->unitid==$record->unit_id)){
					echo "<option value='".$plcerec->instid."#".$plcerec->unitid."' selected>".$plcerec->instname." > ".$plcerec->unitname."</option>";
				}else{
					echo "<option value='".$plcerec->instid."#".$plcerec->unitid."'>".$plcerec->instname." > ".$plcerec->unitname."</option>";
				}
			}

			echo '</select></td><td class="main-table">'.$record->submissions_id.'</td><td>'.$record->submissions_time.'</td>
			<td><button type="submit" name="editSavedWork" onclick=editWork('.$record->submissions_id.',"S",'.$i.') class=" btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Szerkesztés</button>
			<button type="submit" name="changePlace" class=" btn btn-primary" onclick=changePlace('.$record->submissions_id.',"S",'.$i.')><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;Hely módosítása</button>
			<button type="submit"  class=" btn btn-success" onclick=sendPlane('.$record->submissions_id.')><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;Feladás</button>
			<button type="submit"  class=" btn btn-danger" onclick=deletePlane('.$record->submissions_id.',"S")><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Törlés</button>
			</td>';
		}

	
}
}
public function changedPlansPlace()
{
	$this->load->database();
	$ins_unit=$_GET['place'];
	$exp=explode("#",$ins_unit);
	if($_GET['form']=="S")
	{
		$sql="update kltsg_submissions_kiadas_saved set institute_id='".$exp[0]."', unit_id='".$exp[1]."' where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
		$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas_saved módosításánál " );
		$sql="update kltsg_submissions_bevetel_saved set institute_id='".$exp[0]."', unit_id='".$exp[1]."' where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
		$this->db->query($sql) or die("Hiba a kltsg_submissions_bevétel_saved módosításánál " );
	}
	else
	{
		$sql="update kltsg_submissions_kiadas_sent  set institute_id='".$exp[0]."', unit_id='".$exp[1]."' where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
		$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas_sent módosításánál " );
		$sql="update kltsg_submissions_bevetel_sent  set institute_id='".$exp[0]."', unit_id='".$exp[1]."' where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
		$this->db->query($sql) or die("Hiba a kltsg_submissions_bevétel_sent módosításánál ");
	}
}
public function editWork()
{
	$this->load->database();
	if($_GET['form']=="S")
{
	$sql="insert into kltsg_submissions_kiadas(sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time,Year,cpv,honap) 
	select sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time,Year,cpv,honap 
	from kltsg_submissions_kiadas_saved 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas_saved másolásánál ");
	
	$sql="insert into kltsg_submissions_bevetel(sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time,Year,honap) 
	select sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time,Year,honap 
	from kltsg_submissions_bevetel_saved 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_bevetel_saved másolásánál ");
	
	$sql="delete 
	from kltsg_submissions_kiadas_saved 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_bevetel_saved törlésénél ");
	
	$sql="delete 
	from kltsg_submissions_bevetel_saved 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
    $this->db->query($sql) or die("Hiba a kltsg_submissions_bevetel_saved törlésénél ");
	
}
else
{
		$sql="insert into kltsg_submissions_kiadas(sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time,Year,cpv,honap) 
	select sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time,Year,cpv,honap 
	from kltsg_submissions_kiadas_sent 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
    $this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas_sent  másolásánál ");
	
	$sql="insert into kltsg_submissions_bevetel(sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time,Year,honap) 
	select sub_id, user_id, institute_id,unit_id, brutto_osszes, netto_osszes, afa_osszes, mennyiseg, megnevezes, netto_egysegar, tax,afa_ossz_egyseg, quant, brutto_egysegar,created_time,Year,honap 
	from kltsg_submissions_bevetel_sent 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
    $this->db->query($sql) or die("Hiba a kltsg_submissions_bevetel_sent  másolásánál ");
	
	$sql="delete 
	from kltsg_submissions_kiadas_sent 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
                $this->db->query($sql) or die("Hiba a kltsg_submissions_bevetel_sent  törlésénél ");
	
	$sql="delete 
	from kltsg_submissions_bevetel_sent 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
    $this->db->query($sql) or die("Hiba a kltsg_submissions_bevetel_sent  törlésénél ");
}
$sql="delete from kltsg_submissions	where id='".$_GET['sub']."'";
$this->db->query($sql) or die("Hiba a kltsg_submissions törlésénél ");
}
public function sendSavedPlane()
{
	$this->load->database();
	$sql="insert into kltsg_submissions_kiadas_sent (`row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `quant`, `brutto_egysegar`, `created_time`,Year,cpv,honap)
	 select `row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `quant`, `brutto_egysegar`, `created_time`,Year,cpv,honap 
	from kltsg_submissions_kiadas_saved 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas_sent másolásánál ");
	
	$sql="insert into kltsg_submissions_bevetel_sent (`row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `quant`, `brutto_egysegar`, `created_time`,Year,honap)
	select `row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `brutto_osszes`, `netto_osszes`, `afa_osszes`, `mennyiseg`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `quant`, `brutto_egysegar`, `created_time`,Year,honap
	from kltsg_submissions_bevetel_saved 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_bevetel_sent másolásánál ");
	
	$sql="delete 
	from kltsg_submissions_kiadas_saved 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_bevetel_saved törlésénél ");
	
	$sql="delete 
	from kltsg_submissions_bevetel_saved 
	where user_id='".$_COOKIE['userid']."' and submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_bevetel_saved törlésénél ");
}
public function deletePlane()
{
	$this->load->database();
	if($_GET['form']=="S")
	{
	$sql="delete from kltsg_submissions_kiadas_saved where submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas-bevetel_saved törlésénél ");
	$sql="delete from kltsg_submissions_bevetel_saved where submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas-bevetel_saved törlésénél ");
	}
	else
	{
	$sql="delete from kltsg_submissions_bevetel_sent where submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas-bevetel_sent törlésénél ");
	$sql="delete from kltsg_submissions_kiadas_sent where submissions_id='".$_GET['sub']."'";
	$this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas-bevetel_sent törlésénél ");	
	}
}
public function getSendPlansList()
{
	$this->load->database();
	echo '
	<div class="col-xs-11 col-md-11"><h2 style="margin-top:10px;">Elküldött tervezetek</h2></div>';
	$sql="SELECT * FROM kltsg_submissions_kiadas_sent 
	WHERE  kltsg_submissions_kiadas_sent.user_id='".$_COOKIE['userid']."'";
	$res= $this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas_sent lekérdezésénél ");
	$savenum = $res->num_rows();
	if($savenum==0){
	echo '<br><br><br><div class="alert alert-info"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;Még nem küldött költségtervezetet!</div>';
	}else{
	echo'
	<table class="table table-bordered"><thead>
      <tr class="main-table"><th colspan="">Sorszám</th><th colspan="1">Szervezet > Egység</th><th colspan="">Azonosító</th><th colspan="">Dátum</th><th colspan="">Műveletek</th></tr>
    </thead><tbody id="table_rows">';
	$sql="SELECT submissions_id, (SELECT created_time FROM kltsg_submissions WHERE id=submissions_id) AS submissions_time,
	institute_id, unit_id, (SELECT name FROM kltsg_institute WHERE id=institute_id) AS institute_name,
	(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit_name FROM `kltsg_submissions_kiadas_sent` WHERE user_id='".$_COOKIE['userid']."' 
	GROUP BY unit_id,
	institute_id, submissions_id ORDER BY id DESC;";
	$category= $this->db->query($sql) or die("Hiba a kltsg  lekérdezésénél ");
	$i=0;
	foreach($category->result() as $record)
	{
	//legördülő kell ide
	echo '<tr><td>'.$i++.'</td><td colspan=""><select id="inst_unit_'.$i.'" class="form-control">';
		$place= $this->db->query("
		SELECT (SELECT kltsg_institute.id FROM kltsg_institute WHERE id=parent)AS instid, (SELECT kltsg_institute.name FROM kltsg_institute WHERE id=parent)AS instname, kltsg_unit.id AS unitid, kltsg_unit.name AS unitname
		FROM kltsg_unit
		WHERE kltsg_unit.id IN (SELECT unit_id FROM kltsg_policy WHERE user_id='".$_COOKIE['userid']."' );");
			
			foreach($place->result() as $plcerec)
			{
				if(($plcerec->instid==$record->institute_id)&&($plcerec->unitid==$record->unit_id)){
					echo "<option value='".$plcerec->instid."#".$plcerec->unitid."' selected>".$plcerec->instname." > ".$plcerec->unitname."</option>";
				}else{
					echo "<option value='".$plcerec->instid."#".$plcerec->unitid."'>".$plcerec->instname." > ".$plcerec->unitname."</option>";
				}
			}

			echo '</select></td><td class="main-table">'.$record->submissions_id.'</td><td>'.$record->submissions_time.'</td>
			<td><button type="submit" name="changePlace" class=" btn btn-primary" onclick=changePlace('.$record->submissions_id.',"R",'.$i.')><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;Hely módosítása</button>
			<button class="btn btn-warning" role="button" onclick=getViewPlan('.$record->submissions_id.')><span class="glyphicon glyphicon-eye-open" aria-hidden="true" ></span>&nbsp;Előnézet</button>
			<button type="submit"  class=" btn btn-danger" onclick=deletePlane('.$record->submissions_id.',"R")><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Törlés</button>
			</td>';
		}

	
}
}
public function getViewPlan()
{
	echo '
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
    <div class="panel-body">';
	$this->load->database();
	$sql="select * from kltsg_submissions_kiadas_sent where submissions_id=".$_POST['id']." ";
//echo $sql;
	$res= $this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas lekérésénél");
//echo $res;
	$sub_id=0;
	$rovatCounter=1;
	$ossz=0;
	foreach($res->result() as $sor)
	{
	if($sub_id!=$sor->sub_id or $sub_id==0)
	{
		$sqlRovat="select name from kltsg_category where id='".$sor->sub_id."'";
		$resRovat= $this->db->query($sqlRovat) or die("Hiba a kltsg_category lekérésénél");
		foreach($resRovat->result() as $sorRovat)
		{
		$sqlSzamolas="select sum(netto_osszes) as netto,sum(brutto_osszes) as brutto,sum(afa_osszes) as afa,Year from kltsg_submissions_kiadas_sent where sub_id='".$sor->sub_id."' and submissions_id='".$_POST['id']."'";
		$resSzamolas= $this->db->query($sqlSzamolas) or die("Hiba a kltsg_category lekérésénél");
		foreach($resSzamolas->result() as $sorSzamolas)
		{
		$ossz=$ossz+$sorSzamolas->brutto;
		
		echo '
	<table class="table table-bordered"><thead>
	<tr><th>#</th><th colspan="6">Rovat</th><th >Rovat összesen (nettó)</th><th>Áfa összeg</th><th >Rovat összesen (bruttó)</th><th >Év</th></tr>
	</thead><tbody id="table_rows">
	<tr class="main-table" id="" >
	<td ><div class="line-num">'.$rovatCounter.'</div></td>
	<td colspan="6">'.$sorRovat->name.'</td>
	<td colspan="">'.$sorSzamolas->netto.'</td>
	<td colspan="">'.$sorSzamolas->afa.'</td>
	<td colspan=""><span id=brutto'.$rovatCounter.'>'.$sorSzamolas->brutto.'</span></td>
	<td colspan="">'.$sorSzamolas->Year.'</td>
	</tr>
	</table><table class="table table-bordered">
	<tr class="subtable">
	<th colspan="">Tervezett beszerzés/igénylés</th><th>Nettó egységár</th><th>Bruttó egységár</th><th>Áfakulcs</th><th>Mennyiség</th>
	<th>Nettó összesen</th><th>Bruttó összesen<tr id="Kiadas'.$sor->id.'"class="edited-row">';
	$rovatCounter++;
		}
	}}
	echo "<td>".$sor->megnevezes."</td>";
	echo "<td>".$sor->netto_egysegar."</td>";
	echo "<td>".$sor->brutto_egysegar."</td>";
	echo "<td>".$sor->tax."%</td>";
	echo "<td>".$sor->mennyiseg."</td>";
	echo "<td>".$sor->netto_osszes."</td>";
	echo "<td>".$sor->brutto_osszes."</td>";
	$sub_id=$sor->sub_id;
	$inst= $this->db->query("select name from kltsg_institute where id=".$sor->institute_id."") or die("Hiba a institut lekérésénél");
	$unit= $this->db->query("select name from kltsg_unit where id=".$sor->unit_id."") or die("Hiba a unit lekérésénél");
	}
	echo'<oreo id="buruttOsszesKiad" class="stealth">'.$ossz.'</oreo>
</table>
</div>
</div>
</div>
<div class="col-md-6">
<h2>Bevételek</h2>
  <div class="panel panel-success">
    <div class="panel-body">';
	$sql="select * from kltsg_submissions_bevetel_sent where submissions_id=".$_POST['id']." ";
//echo $sql;
$res= $this->db->query($sql) or die("Hiba a kltsg_submissions_kiadas lekérésénél");
//echo $res;
	$sub_id=0;
	$rovatCounter=1;
	$ossz=0;

foreach($res->result() as $sor)
{
	if($sub_id!=$sor->sub_id or $sub_id==0)
	{
		$sqlRovat="select name from kltsg_category where id='".$sor->sub_id."'";
		$resRovat= $this->db->query($sqlRovat) or die("Hiba a kltsg_category lekérésénél");
		foreach($resRovat->result() as $sorRovat)
		{
		$sqlSzamolas="select sum(netto_osszes) as netto,sum(brutto_osszes) as brutto,sum(afa_osszes) as afa,Year from kltsg_submissions_bevetel_sent where sub_id='".$sor->sub_id."'and submissions_id='".$_POST['id']."'";
		$resSzamolas= $this->db->query($sqlSzamolas) or die("Hiba a kltsg_category lekérésénél");
		foreach($resSzamolas->result() as $sorSzamolas)
		{
		$ossz=$ossz+$sorSzamolas->brutto;
		
	echo '
<table class="table table-bordered"><thead>
<tr><th>#</th><th colspan="6">Rovat</th><th >Rovat összesen (nettó)</th><th>Áfa összeg</th><th >Rovat összesen (bruttó)</th><th >Év</th></tr>
</thead><tbody id="table_rows">
<tr class="main-table" id="" >
<td ><div class="line-num">'.$rovatCounter.'</div></td>
<td colspan="6">'.$sorRovat->name.'</td>
<td colspan="">'.$sorSzamolas->netto.'</td>
<td colspan="">'.$sorSzamolas->afa.'</td>
<td colspan=""><span id=brutto'.$rovatCounter.'>'.$sorSzamolas->brutto.'</span></td>
<td colspan="">'.$sorSzamolas->Year.'</td>
</tr>
</table><table class="table table-bordered">
<tr class="subtable">
<th colspan="">Tervezett beszerzés/igénylés</th><th>Nettó egységár</th><th>Bruttó egységár</th><th>Áfakulcs</th><th>Mennyiség</th>
<th>Nettó összesen</th><th>Bruttó összesen<tr id="Kiadas'.$sor->id.'"class="edited-row2">';
$rovatCounter++;
	}
	}}
echo "<td>".$sor->megnevezes."</td>";
echo "<td>".$sor->netto_egysegar."</td>";
echo "<td>".$sor->brutto_egysegar."</td>";
echo "<td>".$sor->tax."%</td>";
echo "<td>".$sor->mennyiseg."</td>";
echo "<td>".$sor->netto_osszes."</td>";
echo "<td>".$sor->brutto_osszes."</td>";
$sub_id=$sor->sub_id;
}
foreach($inst->result() as $ins_a)
{
foreach($unit->result() as $unit_a)
{
echo'<oreo id="inst" class="stealth">'.$ins_a->name.'</oreo>';
echo'<oreo id="unit" class="stealth">'.$unit_a->name.'</oreo>';
}
}
echo'<oreo id="buruttOsszesBev" class="stealth">'.$ossz.'</oreo>';
}
public function getEgysegenkentiLista()
{
	$this->load->database();
		$sqlCat="SELECT kltsg_submissions_kiadas_sent.user_id, submissions_id, institute_id, kltsg_submissions_kiadas_sent.unit_id,
(SELECT name FROM kltsg_institute WHERE id=institute_id) AS institute_name,
(SELECT name FROM kltsg_unit WHERE id=kltsg_submissions_kiadas_sent.unit_id) AS unit_name 
FROM `kltsg_submissions_kiadas_sent`,kltsg_policy 
where kltsg_policy.user_id='".$_COOKIE['userid']."' and kltsg_policy.unit_id=kltsg_submissions_kiadas_sent.unit_id and Year='".$_COOKIE['Ev']."'
 GROUP BY kltsg_submissions_kiadas_sent.unit_id, institute_id ORDER BY kltsg_submissions_kiadas_sent.unit_id DESC";

	$category= $this->db->query($sqlCat);
	echo'<table class="table table-bordered">';
	foreach($category->result() as $record)
	{
		
	echo '<tr class="main-table" group="istitute"><td colspan="3">'.$record->institute_name.'</td>
	<td>
	<button type="button"  onclick="analyticsEgyseg('.$record->institute_id.')"  class="btn btn-info"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Analitkus</button>
	<button type="button" id="agregalt" onclick="aggregateEgyseg('.$record->institute_id.')" class="btn btn-warning"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>&nbsp;Aggregált</button>
	</td><td><div id="downloads_Egyseg_'.$record->institute_id.'" calss="pull-right" ></div>
	</td>
	</tr>
	<tr class="warning" group="unit"><td colspan="3">'.$record->unit_name.'</td>
	<td><button type="button"  onclick="makeAnAlEgyseg('.$record->unit_id.','.$record->institute_id.')"  class="btn btn-danger"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Analitkus</button>
	<button type="button"  id="agregalt1" onclick="makeAgAlEgyseg('.$record->unit_id.','.$record->institute_id.')" class="btn btn-warrning"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>&nbsp;Aggregált</button>
	</td><td><div id="downloads_AlEgyseg_'.$record->institute_id.'_'.$record->unit_id.'" calss="pull-right" ></div>
	</td>
	</tr>
		<thead>
			<tr class="subtable" group="records">
			<th colspan="" >Beadó</th><th colspan="">Azonosító</th><th colspan="">Dátum</th><th colspan="">Művelet</th><th colspan="">Letöltés</th></tr>
		</thead>';

		$submiss=$this->db->query("SELECT CONCAT
		((SELECT last_name from kltsg_users WHERE id=user_id),' 
		',(SELECT first_name from kltsg_users WHERE id=user_id)) AS username, user_id, created_time, id 
		FROM `kltsg_submissions` WHERE 
		id IN(SELECT submissions_id FROM kltsg_submissions_kiadas_sent WHERE unit_id=".$record->unit_id." and Year='".$_COOKIE['Ev']."' ) ORDER BY id DESC");
		
		foreach($submiss->result() as $sub_record)
		{
			echo '<tr group="records"><td>'.$sub_record->username.'</td>';
			echo '<td>'.$sub_record->id."</td><td>".$sub_record->created_time;
			
			echo '</td>
				<td> 
	<button type="button" id="'.$record->unit_id.'#'.$sub_record->user_id.'" onclick="makeAnRecord('.$record->unit_id.','.$sub_record->user_id.')"  class="btn btn-primary"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Analitkus</button>
	</td><td><div id="downloads_record_'.$record->unit_id.'_'.$sub_record->user_id.'" calss="pull-right" ></div>
	</td>
			</tr>';
		}
		echo "</tr>";

	}
}
public function setYear()
{
	$this->load->database();
	$sql="SELECT Year FROM `kltsg_submissions_kiadas_sent` GROUP BY Year";
	$query=$this->db->query($sql);
	return $query;
}
public function deleteUser()
{
	$this->load->database();
	$this->db->where('id', $_POST['id']);
	$this->db->delete('kltsg_users');
	
}
public function getModUser()
{
	$this->load->database();
	$this->db->where('id', $_POST['id']);
	$query=$this->db->get('kltsg_users');
	return $query;
}
public function saveUser()
{
	$this->load->database();
	if($_POST['psw']=="")
	{	
	$this->db->set('password', md5($_POST['psw']));
	}
	if(isset($_POST['admin']))
	{	
	$this->db->set('level',$_POST['admin']);
	}
	else
	{
	$this->db->set('level','0');	
	}
	$this->db->set('first_name', $_POST['Last_Name']);
	$this->db->set('last_name', $_POST['First_Name']);
	$this->db->set('email', $_POST['email']);
	$this->db->where('id', $_POST['id']);
	$this->output->enable_profiler(TRUE);
	$query=$this->db->update('kltsg_users');
	print_r($query);
}
public function getUsers()
{
	$this->load->database();
	$sql="SELECT first_name,last_name,level,email,id FROM `kltsg_users";
	$query=$this->db->query($sql);
	return $query;
}
public function getFinanc()
{

$this->load->database();
$sql="select sum(brutto_osszes) as brutto from kltsg_submissions_bevetel_sent where Year='".$_COOKIE['Ev']."'";	

$query = $this->db->query($sql);
foreach($query->result() as $row)
{
	$bev=$row->brutto;
}
$sql="select sum(brutto_osszes) as brutto from kltsg_submissions_kiadas_sent where Year='".$_COOKIE['Ev']."'";	

$query = $this->db->query($sql);
foreach($query->result() as $row)
{
	$kiad=$row->brutto;
}
$osszefuz=$kiad.",".$bev;
return $osszefuz;
}
public function getFinancUser()
{
$this->load->database();
$this->db->select('unit_id');
$this->db->where('user_id',$_COOKIE['userid']);
$policy = $this->db->get('kltsg_policy');
$bev=0;
$kiad=0;
foreach($policy->result() as $rows)
{		
$sql="select sum(brutto_osszes) as brutto from kltsg_submissions_bevetel_sent where Year='".$_COOKIE['Ev']."' and unit_id='".$rows->unit_id."'";	
$query = $this->db->query($sql);
foreach($query->result() as $row)
{
	$bev+=$row->brutto;
}
$sql="select sum(brutto_osszes) as brutto from kltsg_submissions_kiadas_sent where Year='".$_COOKIE['Ev']."' and  user_id='".$rows->unit_id."'";	

$query = $this->db->query($sql);
foreach($query->result() as $row)
{
	$kiad+=$row->brutto;
}
}
$osszefuz=$kiad.",".$bev;
return $osszefuz;
}
public function makeAnEgyseg()
{
$this->load->database();
$this->load->library('excel');
//include_once("../../excelwriter/xlsxwriter.class.php");
$filename="analitikusEgysegenkent_".date('Y_m_d_his');
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
			afa_osszes,honap,
			brutto_osszes
		FROM kltsg_submissions_bevetel_sent 
			 where institute_id=".$_GET['id']." and Year=".$_COOKIE['Ev']." ORDER BY submissions_id DESC ";
	$bev=$this->db->query($sqlbev);
$rows = array(array());
array_push($rows,array('Analitkus Egységenként',$_COOKIE['Ev'],'','','','','','','','','','','','','',''));
array_push($rows,array('Szervezet','Egység','Rovat','Rovat megnevezés','Tervezett beszerzés/igénylés','Nettó egységár','ÁFA kulcs'
	,'ÁFA egységár','Bruttó egységár','Mennyiség','Mennyiségi egység','Nettó összeg','ÁFA összeg','Bruttó összeg','CPV kód','Hónap'));	
	$bev_a=array();	
	foreach($bev->result() as $bevrec)
	{	
		$bev_a=array();
		array_push($bev_a,$bevrec->latest);
		array_push($bev_a,$bevrec->unitname);
		array_push($bev_a,$bevrec->kkod);
		array_push($bev_a,$bevrec->kname);
		array_push($bev_a,$bevrec->megnevezes);
		array_push($bev_a,$bevrec->netto_egysegar);
		array_push($bev_a,$bevrec->tax);
		array_push($bev_a,$bevrec->afa_ossz_egyseg);
		array_push($bev_a,$bevrec->brutto_egysegar);
		array_push($bev_a,$bevrec->mennyiseg);
		array_push($bev_a,$bevrec->egyseg);
		array_push($bev_a,$bevrec->netto_osszes);
		array_push($bev_a,$bevrec->afa_osszes);
		array_push($bev_a,$bevrec->brutto_osszes);
		array_push($bev_a,'nincs');
		array_push($bev_a,$bevrec->honap);
		
		$bevsum+=$bevrec->brutto_osszes;
		array_push($rows,$bev_a);	
				
	}
	
	$kiadsum=0;
	$sqlkiad="SELECT 
			 submissions_id AS latest,
			(SELECT kltsg_institute.name FROM kltsg_institute WHERE id=institute_id ) AS instname,
			(SELECT kltsg_unit.name FROM kltsg_unit WHERE id=unit_id ) AS unitname,
			(SELECT kltsg_category.code FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC)AS kkod,
			(SELECT kltsg_category.name FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS kname,
			(SELECT name FROM kltsg_cpv1 WHERE id=cpv) as cpv2,
			megnevezes,
			netto_egysegar,
			tax,
			afa_ossz_egyseg,
			brutto_egysegar,
			mennyiseg,
			(SELECT name FROM kltsg_quant WHERE id=quant) AS egyseg,
			netto_osszes,
			afa_osszes,honap,
			brutto_osszes
		FROM kltsg_submissions_kiadas_sent 
			where institute_id=".$_GET['id']." and Year=".$_COOKIE['Ev']."  ORDER BY submissions_id DESC ";
			
	$kiad=$this->db->query($sqlkiad);
	foreach($kiad->result() as $kiadrec)
	{	
	$kiad_a=array();
		array_push($kiad_a,$kiadrec->latest);
		array_push($kiad_a,$kiadrec->unitname);
		array_push($kiad_a,$kiadrec->kkod);
		array_push($kiad_a,$kiadrec->kname);
		array_push($kiad_a,$kiadrec->megnevezes);
		array_push($kiad_a,$kiadrec->netto_egysegar);
		array_push($kiad_a,$kiadrec->tax);
		array_push($kiad_a,$kiadrec->afa_ossz_egyseg);
		array_push($kiad_a,$kiadrec->brutto_egysegar);
		array_push($kiad_a,$kiadrec->mennyiseg);
		array_push($kiad_a,$kiadrec->egyseg);
		array_push($kiad_a,$kiadrec->netto_osszes);
		array_push($kiad_a,$kiadrec->afa_osszes);
		array_push($kiad_a,$kiadrec->brutto_osszes);
		array_push($kiad_a,$kiadrec->cpv2);
		array_push($kiad_a,$kiadrec->honap);
		$kiadsum+=$kiadrec->brutto_osszes;
		array_push($rows,$kiad_a);	
	}
	$egyenleg=$bevsum-$kiadsum;
	array_push($rows,array("Bevétel összesen",$bevsum));
	array_push($rows,array("Kiadás összesen",$kiadsum));
	array_push($rows,array("Egyenleg összesen",$egyenleg));
$writer = new XLSXWriter();
$writer->setAuthor('ke');
foreach($rows as $row)
	$writer->writeSheetRow('Analitkus Egységenként', $row);


$writer->writeToFile('download/'.$filename.'.xlsx');
echo "<a href=".base_url()."download/".$filename.".xlsx><span class='glyphicon glyphicon-floppy-saved' onclick=deleteFile('".$filename."','".$_GET['id']."')>Letöltés</a>";
exit(0);
}
public function makeAnAlEgyseg()
{
$this->load->database();
$this->load->library('excel');
//include_once("../../excelwriter/xlsxwriter.class.php");
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
			afa_osszes,honap,
			brutto_osszes
		FROM kltsg_submissions_bevetel_sent 
			 where unit_id=".$_GET['id']." and Year=".$_COOKIE['Ev']." ORDER BY submissions_id DESC ";
	$bev=$this->db->query($sqlbev);
$rows = array(array());
array_push($rows,array('Analitkus Alegységenként',$_COOKIE['Ev'],'','','','','','','','','','','','','',''));
array_push($rows,array('Szervezet','Egység','Rovat','Rovat megnevezés','Tervezett beszerzés/igénylés','Nettó egységár','ÁFA kulcs'
	,'ÁFA egységár','Bruttó egységár','Mennyiség','Mennyiségi egység','Nettó összeg','ÁFA összeg','Bruttó összeg','CPV kód','Hónap'));	
	$bev_a=array();	
	foreach($bev->result() as $bevrec)
	{	
		$bev_a=array();
		array_push($bev_a,$bevrec->latest);
		array_push($bev_a,$bevrec->unitname);
		array_push($bev_a,$bevrec->kkod);
		array_push($bev_a,$bevrec->kname);
		array_push($bev_a,$bevrec->megnevezes);
		array_push($bev_a,$bevrec->netto_egysegar);
		array_push($bev_a,$bevrec->tax);
		array_push($bev_a,$bevrec->afa_ossz_egyseg);
		array_push($bev_a,$bevrec->brutto_egysegar);
		array_push($bev_a,$bevrec->mennyiseg);
		array_push($bev_a,$bevrec->egyseg);
		array_push($bev_a,$bevrec->netto_osszes);
		array_push($bev_a,$bevrec->afa_osszes);
		array_push($bev_a,$bevrec->brutto_osszes);
		array_push($bev_a,'nincs');
		array_push($bev_a,$bevrec->honap);
		$bevsum+=$bevrec->brutto_osszes;
		array_push($rows,$bev_a);	
				
	}
	
	$kiadsum=0;
	$sqlkiad="SELECT 
			 submissions_id AS latest,
			(SELECT kltsg_institute.name FROM kltsg_institute WHERE id=institute_id ) AS instname,
			(SELECT kltsg_unit.name FROM kltsg_unit WHERE id=unit_id ) AS unitname,
			(SELECT kltsg_category.code FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC)AS kkod,
			(SELECT kltsg_category.name FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS kname,
			(SELECT name FROM kltsg_cpv1 WHERE id=cpv) as cpv2,
			megnevezes,
			netto_egysegar,
			tax,
			afa_ossz_egyseg,
			brutto_egysegar,
			mennyiseg,
			(SELECT name FROM kltsg_quant WHERE id=quant) AS egyseg,
			netto_osszes,
			afa_osszes,honap,
			brutto_osszes
		FROM kltsg_submissions_kiadas_sent 
			where unit_id=".$_GET['id']." and Year=".$_COOKIE['Ev']."  ORDER BY submissions_id DESC ";
			
	$kiad=$this->db->query($sqlkiad);
	foreach($kiad->result() as $kiadrec)
	{	
	$kiad_a=array();
		array_push($kiad_a,$kiadrec->latest);
		array_push($kiad_a,$kiadrec->unitname);
		array_push($kiad_a,$kiadrec->kkod);
		array_push($kiad_a,$kiadrec->kname);
		array_push($kiad_a,$kiadrec->megnevezes);
		array_push($kiad_a,$kiadrec->netto_egysegar);
		array_push($kiad_a,$kiadrec->tax);
		array_push($kiad_a,$kiadrec->afa_ossz_egyseg);
		array_push($kiad_a,$kiadrec->brutto_egysegar);
		array_push($kiad_a,$kiadrec->mennyiseg);
		array_push($kiad_a,$kiadrec->egyseg);
		array_push($kiad_a,$kiadrec->netto_osszes);
		array_push($kiad_a,$kiadrec->afa_osszes);
		array_push($kiad_a,$kiadrec->brutto_osszes);
		array_push($kiad_a,$kiadrec->cpv2);
		array_push($kiad_a,$kiadrec->honap);
		$kiadsum+=$kiadrec->brutto_osszes;
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


$writer->writeToFile('download/'.$filename.'.xlsx');
echo "<a href=".base_url()."download/".$filename.".xlsx><span class='glyphicon glyphicon-floppy-saved' onclick=deleteFile('".$filename."','".$_GET['id']."')>Letöltés</a>";
exit(0);
}
public function makeAnRecord()
{
$this->load->database();
$this->load->library('excel');
//include_once("../../excelwriter/xlsxwriter.class.php");
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
			afa_osszes,honap,
			brutto_osszes
		FROM kltsg_submissions_bevetel_sent 
			 where institute_id=".$_GET['id']." and Year=".$_COOKIE['Ev']." and user_id=".$_GET['uid']." ORDER BY submissions_id DESC ";
	$bev=$this->db->query($sqlbev);
$rows = array(array());
array_push($rows,array('Analitkus Alegységenként',$_COOKIE['Ev'],'','','','','','','','','','','','','',''));
array_push($rows,array('Szervezet','Egység','Rovat','Rovat megnevezés','Tervezett beszerzés/igénylés','Nettó egységár','ÁFA kulcs'
	,'ÁFA egységár','Bruttó egységár','Mennyiség','Mennyiségi egység','Nettó összeg','ÁFA összeg','Bruttó összeg','CPV kód','Hónap'));	
	$bev_a=array();	
	foreach($bev->result() as $bevrec)
	{	
		$bev_a=array();
		array_push($bev_a,$bevrec->latest);
		array_push($bev_a,$bevrec->unitname);
		array_push($bev_a,$bevrec->kkod);
		array_push($bev_a,$bevrec->kname);
		array_push($bev_a,$bevrec->megnevezes);
		array_push($bev_a,$bevrec->netto_egysegar);
		array_push($bev_a,$bevrec->tax);
		array_push($bev_a,$bevrec->afa_ossz_egyseg);
		array_push($bev_a,$bevrec->brutto_egysegar);
		array_push($bev_a,$bevrec->mennyiseg);
		array_push($bev_a,$bevrec->egyseg);
		array_push($bev_a,$bevrec->netto_osszes);
		array_push($bev_a,$bevrec->afa_osszes);
		array_push($bev_a,$bevrec->brutto_osszes);
		array_push($bev_a,'nincs');
		array_push($bev_a,$bevrec->honap);
		$bevsum+=$bevrec->brutto_osszes;
		array_push($rows,$bev_a);	
				
	}
	
	$kiadsum=0;
	$sqlkiad="SELECT 
			 submissions_id AS latest,
			(SELECT kltsg_institute.name FROM kltsg_institute WHERE id=institute_id ) AS instname,
			(SELECT kltsg_unit.name FROM kltsg_unit WHERE id=unit_id ) AS unitname,
			(SELECT kltsg_category.code FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC)AS kkod,
			(SELECT kltsg_category.name FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS kname,
			(SELECT name FROM kltsg_cpv1 WHERE id=cpv) as cpv2,
			megnevezes,
			netto_egysegar,
			tax,
			afa_ossz_egyseg,
			brutto_egysegar,
			mennyiseg,
			(SELECT name FROM kltsg_quant WHERE id=quant) AS egyseg,
			netto_osszes,
			afa_osszes,honap,
			brutto_osszes
		FROM kltsg_submissions_kiadas_sent 
			where institute_id=".$_GET['id']." and Year=".$_COOKIE['Ev']." and user_id=".$_GET['uid']." ORDER BY submissions_id DESC ";
			
	$kiad=$this->db->query($sqlkiad);
	foreach($kiad->result() as $kiadrec)
	{	
	$kiad_a=array();
		array_push($kiad_a,$kiadrec->latest);
		array_push($kiad_a,$kiadrec->unitname);
		array_push($kiad_a,$kiadrec->kkod);
		array_push($kiad_a,$kiadrec->kname);
		array_push($kiad_a,$kiadrec->megnevezes);
		array_push($kiad_a,$kiadrec->netto_egysegar);
		array_push($kiad_a,$kiadrec->tax);
		array_push($kiad_a,$kiadrec->afa_ossz_egyseg);
		array_push($kiad_a,$kiadrec->brutto_egysegar);
		array_push($kiad_a,$kiadrec->mennyiseg);
		array_push($kiad_a,$kiadrec->egyseg);
		array_push($kiad_a,$kiadrec->netto_osszes);
		array_push($kiad_a,$kiadrec->afa_osszes);
		array_push($kiad_a,$kiadrec->brutto_osszes);
		array_push($kiad_a,$kiadrec->cpv2);
		array_push($kiad_a,$kiadrec->honap);
		$kiadsum+=$kiadrec->brutto_osszes;
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


$writer->writeToFile('download/'.$filename.'.xlsx');
echo "<a href=".base_url()."download/".$filename.".xlsx><span class='glyphicon glyphicon-floppy-saved' onclick=deleteFile('".$filename."','".$_GET['id']."')>Letöltés</a>";
exit(0);
}
public function makeAnFull()
{
$this->load->database();
$this->load->library('excel');
//include_once("../../excelwriter/xlsxwriter.class.php");
$filename="analitikusTeljes_".date('Y_m_d_his');
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
			afa_osszes,honap,
			brutto_osszes
		FROM kltsg_submissions_bevetel_sent 
			 where Year=".$_COOKIE['Ev']." ORDER BY submissions_id DESC ";
	$bev=$this->db->query($sqlbev);
$rows = array(array());
array_push($rows,array('Analitkus Teljes',$_COOKIE['Ev'],'','','','','','','','','','','','','',''));
array_push($rows,array('Szervezet','Egység','Rovat','Rovat megnevezés','Tervezett beszerzés/igénylés','Nettó egységár','ÁFA kulcs'
	,'ÁFA egységár','Bruttó egységár','Mennyiség','Mennyiségi egység','Nettó összeg','ÁFA összeg','Bruttó összeg','CPV kód','Hónap'));	
	$bev_a=array();	
	foreach($bev->result() as $bevrec)
	{	
		$bev_a=array();
		array_push($bev_a,$bevrec->latest);
		array_push($bev_a,$bevrec->unitname);
		array_push($bev_a,$bevrec->kkod);
		array_push($bev_a,$bevrec->kname);
		array_push($bev_a,$bevrec->megnevezes);
		array_push($bev_a,$bevrec->netto_egysegar);
		array_push($bev_a,$bevrec->tax);
		array_push($bev_a,$bevrec->afa_ossz_egyseg);
		array_push($bev_a,$bevrec->brutto_egysegar);
		array_push($bev_a,$bevrec->mennyiseg);
		array_push($bev_a,$bevrec->egyseg);
		array_push($bev_a,$bevrec->netto_osszes);
		array_push($bev_a,$bevrec->afa_osszes);
		array_push($bev_a,$bevrec->brutto_osszes);
		array_push($bev_a,'nincs');
		array_push($bev_a,$bevrec->honap);
		$bevsum+=$bevrec->brutto_osszes;
		array_push($rows,$bev_a);	
				
	}
	
	$kiadsum=0;
	$sqlkiad="SELECT 
			 submissions_id AS latest,
			(SELECT kltsg_institute.name FROM kltsg_institute WHERE id=institute_id ) AS instname,
			(SELECT kltsg_unit.name FROM kltsg_unit WHERE id=unit_id ) AS unitname,
			(SELECT kltsg_category.code FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC)AS kkod,
			(SELECT kltsg_category.name FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS kname,
			(SELECT name FROM kltsg_cpv1 WHERE id=cpv) as cpv2,
			megnevezes,
			netto_egysegar,
			tax,
			afa_ossz_egyseg,
			brutto_egysegar,
			mennyiseg,
			(SELECT name FROM kltsg_quant WHERE id=quant) AS egyseg,
			netto_osszes,
			afa_osszes,honap,
			brutto_osszes
		FROM kltsg_submissions_kiadas_sent 
			where Year=".$_COOKIE['Ev']."  ORDER BY submissions_id DESC ";
			
	$kiad=$this->db->query($sqlkiad);
	foreach($kiad->result() as $kiadrec)
	{	
	$kiad_a=array();
		array_push($kiad_a,$kiadrec->latest);
		array_push($kiad_a,$kiadrec->unitname);
		array_push($kiad_a,$kiadrec->kkod);
		array_push($kiad_a,$kiadrec->kname);
		array_push($kiad_a,$kiadrec->megnevezes);
		array_push($kiad_a,$kiadrec->netto_egysegar);
		array_push($kiad_a,$kiadrec->tax);
		array_push($kiad_a,$kiadrec->afa_ossz_egyseg);
		array_push($kiad_a,$kiadrec->brutto_egysegar);
		array_push($kiad_a,$kiadrec->mennyiseg);
		array_push($kiad_a,$kiadrec->egyseg);
		array_push($kiad_a,$kiadrec->netto_osszes);
		array_push($kiad_a,$kiadrec->afa_osszes);
		array_push($kiad_a,$kiadrec->brutto_osszes);
		array_push($kiad_a,$kiadrec->cpv2);
		array_push($kiad_a,$kiadrec->honap);
		$kiadsum+=$kiadrec->brutto_osszes;
		array_push($rows,$kiad_a);	
	}
	$egyenleg=$bevsum-$kiadsum;
	array_push($rows,array("Bevétel összesen",$bevsum));
	array_push($rows,array("Kiadás összesen",$kiadsum));
	array_push($rows,array("Egyenleg összesen",$egyenleg));
$writer = new XLSXWriter();
$writer->setAuthor('ke');
foreach($rows as $row)
	$writer->writeSheetRow('Analitkus Teljes', $row);


$writer->writeToFile('download/'.$filename.'.xlsx');
echo "<a href=".base_url()."download/".$filename.".xlsx><span class='glyphicon glyphicon-floppy-saved' onclick=deleteFile('".$filename."','1')>Letöltés</a>";
exit(0);
}
public function makeAgEgyseg()
{
	$this->load->database();
	$this->load->library('excel');
	//include_once("../../excelwriter/xlsxwriter.class.php");
	$filename="agregaltEgysegenkent_".date('Y_m_d_his');
	header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	$filename="agregaltEgyseg_".date('Y_m_d_his');
	$ertek = array();
	$inst = array();
	$sql_all="SELECT unit_id, (SELECT kltsg_institute.name FROM kltsg_institute WHERE kltsg_institute.id=(SELECT parent FROM kltsg_unit WHERE id=unit_id)) AS inst,(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit, (SELECT code FROM kltsg_category_bev WHERE id=sub_id ORDER bY kltsg_category_bev.code ASC) AS rovat, 
	netto_osszes, 
	(SELECT tax FROM kltsg_category_bev WHERE id=sub_id ORDER bY kltsg_category_bev.code ASC) AS afarovat, 
	afa_osszes 
	FROM kltsg_submissions_bevetel_sent where institute_id=".$_GET['id']." and Year=".$_COOKIE['Ev']."
	UNION ALL
	SELECT unit_id,(SELECT kltsg_institute.name FROM kltsg_institute WHERE kltsg_institute.id=(SELECT parent FROM kltsg_unit WHERE id=unit_id)) AS inst,(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit, (SELECT code FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS rovat,
	netto_osszes, 
	(SELECT tax FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS afarovat, 
	afa_osszes 
	FROM kltsg_submissions_kiadas_sent where institute_id=".$_GET['id']." and Year=".$_COOKIE['Ev']."";
	$all=$this->db->query($sql_all);
	$i=0;
	foreach($all->result() as $kiadrov)
	{	
		$inst[$i] = $kiadrov->inst."_".$kiadrov->unit;
		$ertek[$i]['inst_unit'] = $kiadrov->inst."_".$kiadrov->unit;
		$ertek[$i]['rovat'] = ($kiadrov->rovat!="") ? $kiadrov->rovat : "üres rovat";
		$ertek[$i]['netto'] = $kiadrov->netto_osszes;
		$ertek[$i]['afarovat'] = ($kiadrov->afarovat!="") ? $kiadrov->afarovat : "üres rovat";
		$ertek[$i]['afa'] = $kiadrov->afa_osszes;
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
		$this->db->query($sql_aggr_grp);
		$sql_grp_id="SELECT * FROM `kltsg_aggregate_group` WHERE name='".$hely."'";
		$grp_id_a=$this->db->query($sql_grp_id);
		foreach($grp_id_a->result() as $grp_id)
		{
	
		for($j=0;$j<count($sepertek[$uniqinst[$i]]);$j++)
		{
			
			//echo $sepertek[$uniqinst[$i]][$j]['rovat']."  ".$sepertek[$uniqinst[$i]][$j]['netto']."  ".$sepertek[$uniqinst[$i]][$j]['afarovat']."  ".$sepertek[$uniqinst[$i]][$j]['afa']."<br>";
			$sql_aggr_grp_a="INSERT INTO `kltsg_aggregate_data`(`group_id`, `rovat`, `netto`, `afarovat`, `afa`) VALUES ('".$grp_id->id."',
			'".$sepertek[$uniqinst[$i]][$j]['rovat']."',
			'".$sepertek[$uniqinst[$i]][$j]['netto']."',
			'".$sepertek[$uniqinst[$i]][$j]['afarovat']."',
			'".$sepertek[$uniqinst[$i]][$j]['afa']."'
			)";
			$this->db->query($sql_aggr_grp_a);
			
		}
		}
	}
	$name=$this->db->query("SELECT name FROM kltsg_institute where id='".$_GET['id']."'");
	foreach($name->result() as $name_a)
	{
	$rows = array(array());
	array_push($rows,array('Agregált egységenként',$_COOKIE['Ev'],'','','','',''));
    array_push($rows,array('Szervezet' , 'Egység', 'Rovat','Áfarovat','Netto','Áfa','Brutto'));	
	$sql_grp="SELECT * FROM `kltsg_aggregate_group` where name like '".$name_a->name." >%'";
	
	}
	$grp=$this->db->query($sql_grp);
	
	foreach($grp->result() as $group)
	{
		
		$sql_all_a="SELECT rovat, SUM(netto) AS netto, afarovat, SUM(afa) AS afa FROM `kltsg_aggregate_data` WHERE group_id=".$group->id." GROUP BY rovat";
		
		$all=$this->db->query($sql_all_a);
		foreach($all->result() as $kiadrov)
		{
			$betolt=array();
			$split=explode('>',$group->name);
			array_push($betolt,$split[0]);
			array_push($betolt,$split[1]);
			array_push($betolt,$kiadrov->rovat);
			array_push($betolt,$kiadrov->afarovat);
			array_push($betolt,$kiadrov->netto);
			array_push($betolt,$kiadrov->afa);
			$ossz=$kiadrov->afa+$kiadrov->netto;
			array_push($betolt,$ossz);
			array_push($rows,$betolt);
		}
		
	}
	$this->db->query("TRUNCATE kltsg_aggregate_group");
	$this->db->query("TRUNCATE kltsg_aggregate_data");
	
	$writer = new XLSXWriter();
	$writer->setAuthor('ke');
	foreach($rows as $row)
		$writer->writeSheetRow('Agregált Egységenként', $row);


	$writer->writeToFile('download/'.$filename.'.xlsx');
	echo "<a href=".base_url()."download/".$filename.".xlsx><span class='glyphicon glyphicon-floppy-saved' onclick=deleteFile('".$filename."','1')>Letöltés</a>";
}
public function makeAgAlEgyseg()
{
	$this->load->database();
	$this->load->library('excel');
	//include_once("../../excelwriter/xlsxwriter.class.php");
	$filename="agregaltAlEgysegenkent_".date('Y_m_d_his');
	header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	$filename="agregaltEgyseg_".date('Y_m_d_his');
	$ertek = array();
	$inst = array();
	$sql_all="SELECT unit_id, (SELECT kltsg_institute.name FROM kltsg_institute WHERE kltsg_institute.id=(SELECT parent FROM kltsg_unit WHERE id=unit_id)) AS inst,(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit, (SELECT code FROM kltsg_category_bev WHERE id=sub_id ORDER bY kltsg_category_bev.code ASC) AS rovat, 
	netto_osszes, 
	(SELECT tax FROM kltsg_category_bev WHERE id=sub_id ORDER bY kltsg_category_bev.code ASC) AS afarovat, 
	afa_osszes 
	FROM kltsg_submissions_bevetel_sent where unit_id='".$_GET['id']."' and Year='".$_COOKIE['Ev']."'
	UNION ALL
	SELECT unit_id,(SELECT kltsg_institute.name FROM kltsg_institute WHERE kltsg_institute.id=(SELECT parent FROM kltsg_unit WHERE id=unit_id)) AS inst,(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit, (SELECT code FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS rovat,
	netto_osszes, 
	(SELECT tax FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS afarovat, 
	afa_osszes 
	FROM kltsg_submissions_kiadas_sent where unit_id='".$_GET['id']."' and Year='".$_COOKIE['Ev']."' ";
	
	$all=$this->db->query($sql_all);
	$i=0;
	foreach($all->result() as $kiadrov)
	{	
		$inst[$i] = $kiadrov->inst."_".$kiadrov->unit;
		$ertek[$i]['inst_unit'] = $kiadrov->inst."_".$kiadrov->unit;
		$ertek[$i]['rovat'] = ($kiadrov->rovat!="") ? $kiadrov->rovat : "üres rovat";
		$ertek[$i]['netto'] = $kiadrov->netto_osszes;
		$ertek[$i]['afarovat'] = ($kiadrov->afarovat!="") ? $kiadrov->afarovat : "üres rovat";
		$ertek[$i]['afa'] = $kiadrov->afa_osszes;
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
		$this->db->query($sql_aggr_grp);
		$sql_grp_id="SELECT * FROM `kltsg_aggregate_group` WHERE name='".$hely."'";
		$grp_id_a=$this->db->query($sql_grp_id);
		foreach($grp_id_a->result() as $grp_id)
		{
	
		for($j=0;$j<count($sepertek[$uniqinst[$i]]);$j++)
		{
			
			//echo $sepertek[$uniqinst[$i]][$j]['rovat']."  ".$sepertek[$uniqinst[$i]][$j]['netto']."  ".$sepertek[$uniqinst[$i]][$j]['afarovat']."  ".$sepertek[$uniqinst[$i]][$j]['afa']."<br>";
			$sql_aggr_grp_a="INSERT INTO `kltsg_aggregate_data`(`group_id`, `rovat`, `netto`, `afarovat`, `afa`) VALUES ('".$grp_id->id."',
			'".$sepertek[$uniqinst[$i]][$j]['rovat']."',
			'".$sepertek[$uniqinst[$i]][$j]['netto']."',
			'".$sepertek[$uniqinst[$i]][$j]['afarovat']."',
			'".$sepertek[$uniqinst[$i]][$j]['afa']."'
			)";
			$this->db->query($sql_aggr_grp_a);
			
		}
		}
	}
	$name=$this->db->query("SELECT name FROM kltsg_institute where id='".$_GET['id']."'");
	foreach($name->result() as $name_a)
	{
	$rows = array(array());
	array_push($rows,array('Agregált alEgységenként',$_COOKIE['Ev'],'','','','',''));
    array_push($rows,array('Szervezet' , 'Egység', 'Rovat','Áfarovat','Netto','Áfa','Brutto'));	
	$sql_grp="SELECT * FROM `kltsg_aggregate_group` where name like '".$name_a->name." >%'";
	
	}
	$grp=$this->db->query($sql_grp);
	
	foreach($grp->result() as $group)
	{
		
		$sql_all_a="SELECT rovat, SUM(netto) AS netto, afarovat, SUM(afa) AS afa FROM `kltsg_aggregate_data` WHERE group_id=".$group->id." GROUP BY rovat";
		
		$all=$this->db->query($sql_all_a);
		foreach($all->result() as $kiadrov)
		{
			$betolt=array();
			$split=explode('>',$group->name);
			array_push($betolt,$split[0]);
			array_push($betolt,$split[1]);
			array_push($betolt,$kiadrov->rovat);
			array_push($betolt,$kiadrov->afarovat);
			array_push($betolt,$kiadrov->netto);
			array_push($betolt,$kiadrov->afa);
			$ossz=$kiadrov->afa+$kiadrov->netto;
			array_push($betolt,$ossz);
			array_push($rows,$betolt);
		}
		
	}
	$this->db->query("TRUNCATE kltsg_aggregate_group");
	$this->db->query("TRUNCATE kltsg_aggregate_data");
	
	$writer = new XLSXWriter();
	$writer->setAuthor('ke');
	foreach($rows as $row)
		$writer->writeSheetRow('Agregált Alegységenként', $row);


	$writer->writeToFile('download/'.$filename.'.xlsx');
	echo "<a href=".base_url()."download/".$filename.".xlsx><span class='glyphicon glyphicon-floppy-saved' onclick=deleteFile('".$filename."','1')>Letöltés</a>";
}
public function makeAgFull()
{
	$this->load->database();
	$this->load->library('excel');
	//include_once("../../excelwriter/xlsxwriter.class.php");
	$filename="agregaltTeljes_".date('Y_m_d_his');
	header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	$filename="agregaltTeljes_".date('Y_m_d_his');
	$ertek = array();
	$inst = array();
	$sql_all="SELECT unit_id, (SELECT kltsg_institute.name FROM kltsg_institute WHERE kltsg_institute.id=(SELECT parent FROM kltsg_unit WHERE id=unit_id)) AS inst,(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit, (SELECT code FROM kltsg_category_bev WHERE id=sub_id ORDER bY kltsg_category_bev.code ASC) AS rovat, 
	netto_osszes, 
	(SELECT tax FROM kltsg_category_bev WHERE id=sub_id ORDER bY kltsg_category_bev.code ASC) AS afarovat, 
	afa_osszes 
	FROM kltsg_submissions_bevetel_sent where Year=".$_COOKIE['Ev']."
	UNION ALL
	SELECT unit_id,(SELECT kltsg_institute.name FROM kltsg_institute WHERE kltsg_institute.id=(SELECT parent FROM kltsg_unit WHERE id=unit_id)) AS inst,(SELECT name FROM kltsg_unit WHERE id=unit_id) AS unit, (SELECT code FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS rovat,
	netto_osszes, 
	(SELECT tax FROM kltsg_category WHERE id=sub_id ORDER bY kltsg_category.code ASC) AS afarovat, 
	afa_osszes 
	FROM kltsg_submissions_kiadas_sent where Year=".$_COOKIE['Ev']."";
	$all=$this->db->query($sql_all);
	$i=0;
	foreach($all->result() as $kiadrov)
	{	
		$inst[$i] = $kiadrov->inst."_".$kiadrov->unit;
		$ertek[$i]['inst_unit'] = $kiadrov->inst."_".$kiadrov->unit;
		$ertek[$i]['rovat'] = ($kiadrov->rovat!="") ? $kiadrov->rovat : "üres rovat";
		$ertek[$i]['netto'] = $kiadrov->netto_osszes;
		$ertek[$i]['afarovat'] = ($kiadrov->afarovat!="") ? $kiadrov->afarovat : "üres rovat";
		$ertek[$i]['afa'] = $kiadrov->afa_osszes;
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
		$this->db->query($sql_aggr_grp);
		$sql_grp_id="SELECT * FROM `kltsg_aggregate_group` WHERE name='".$hely."'";
		$grp_id_a=$this->db->query($sql_grp_id);
		foreach($grp_id_a->result() as $grp_id)
		{
	
		for($j=0;$j<count($sepertek[$uniqinst[$i]]);$j++)
		{
			
			//echo $sepertek[$uniqinst[$i]][$j]['rovat']."  ".$sepertek[$uniqinst[$i]][$j]['netto']."  ".$sepertek[$uniqinst[$i]][$j]['afarovat']."  ".$sepertek[$uniqinst[$i]][$j]['afa']."<br>";
			$sql_aggr_grp_a="INSERT INTO `kltsg_aggregate_data`(`group_id`, `rovat`, `netto`, `afarovat`, `afa`) VALUES ('".$grp_id->id."',
			'".$sepertek[$uniqinst[$i]][$j]['rovat']."',
			'".$sepertek[$uniqinst[$i]][$j]['netto']."',
			'".$sepertek[$uniqinst[$i]][$j]['afarovat']."',
			'".$sepertek[$uniqinst[$i]][$j]['afa']."'
			)";
			$this->db->query($sql_aggr_grp_a);
			
		}
		}
	}
	
	$rows = array(array());
	array_push($rows,array('Agregált Teljes',$_COOKIE['Ev'],'','','','',''));
    array_push($rows,array('Szervezet' , 'Egység', 'Rovat','Áfarovat','Netto','Áfa','Brutto'));	
	$sql_grp="SELECT * FROM `kltsg_aggregate_group`";
	
	
	$grp=$this->db->query($sql_grp);
	
	foreach($grp->result() as $group)
	{
		
		$sql_all_a="SELECT rovat, SUM(netto) AS netto, afarovat, SUM(afa) AS afa FROM `kltsg_aggregate_data` WHERE group_id=".$group->id." GROUP BY rovat";
		
		$all=$this->db->query($sql_all_a);
		foreach($all->result() as $kiadrov)
		{
			$betolt=array();
			$split=explode('>',$group->name);
			array_push($betolt,$split[0]);
			array_push($betolt,$split[1]);
			array_push($betolt,$kiadrov->rovat);
			array_push($betolt,$kiadrov->afarovat);
			array_push($betolt,$kiadrov->netto);
			array_push($betolt,$kiadrov->afa);
			$ossz=$kiadrov->afa+$kiadrov->netto;
			array_push($betolt,$ossz);
			array_push($rows,$betolt);
		}
		
	}
	$this->db->query("TRUNCATE kltsg_aggregate_group");
	$this->db->query("TRUNCATE kltsg_aggregate_data");

	
	$writer = new XLSXWriter();
	$writer->setAuthor('ke');
	foreach($rows as $row)
		$writer->writeSheetRow('Agregált Teljes', $row);


	$writer->writeToFile('download/'.$filename.'.xlsx');
	echo "<a href=".base_url()."download/".$filename.".xlsx><span class='glyphicon glyphicon-floppy-saved' onclick=deleteFile('".$filename."','1')>Letöltés</a>";
}
}
?>		