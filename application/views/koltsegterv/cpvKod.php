<div id="mainPage">
<div id="instituts">
<div class="container">
<div class="row">
<div class="col-sm-6">
<table id="insti" class="table">
<thead><h1>CPV1</h1><br>
<button class="btn btn-primary" onclick=addCPV1()><span class="glyphicon glyphicon-plus"></span> Új CPV1</button><br><br></thead>
<tr><th>Azonosító</th><th>Egység neve</th><th>Kódja</th>
</tr>
<?php
for($i=0;$i<count($cpv1);$i++)
{
	echo "<tr><td>".$cpv1[$i][0]."</td><td>".$cpv1[$i][2].'</td><td>'.$cpv1[$i][1].'</td></tr>';
}
?>
</table>

</div>
<div class="col-sm-6">
<table id="alinsti" class="table">
<thead><h1>CPV2</h1><br><button class="btn btn-primary" onclick=addCPV2()><span class="glyphicon glyphicon-plus"></span> Új cpv2</button><br><br></thead>
<tr><th>Szülő</th><th>Egység neve</th><th>Kódja</th>
</tr>
<?php
for($i=0;$i<count($cpv2);$i++)
{
	echo "<tr><td>".$cpv2[$i][3]."</td><td>".$cpv2[$i][2]."</td><td>".$cpv2[$i][1].'</td></tr>';
}
?>
</table>
<br><br><br><br><br>
</div>
</div>
</div>
</div>
<div id="cahngeInstitut" class="stealth">
<?php
$this->load->helper('form');
echo form_open('Koltsegterv/addCPV1',"id=cpv1");
echo '<div class="container">
<div class="row">
<div class="col-sm-6">Új CPV1 es kód esetén kérlek előbb a cpv 2-es kódot vidd fel, mert csak akkor tudsz párosítani hozzá valamit<br>'; 
echo form_label('CPV1 kód neve&nbsp;','Inst_Name');
   $data = array(
        'name'          => 'Inst_Name',
        'id'            => 'Inst_Name',
		'type'			=>'text',
		'required'		=>'required',
		'class'		=>'form-control',
);
echo form_input($data);
echo form_label('CPV1 kódja&nbsp;','Inst_Kod');
   $data = array(
        'name'          => 'Inst_Kod',
        'id'            => 'Inst_Kod',
		'type'			=>'text',
		'required'		=>'required',
		'class'		=>'form-control',
);
echo form_input($data);
$attributes = array(
					'class' => 'btn btn-primary',
					'id'=>'gomb',
					'class'=>'btn btn-primary btn-lg opt-btn',
					'onclick'=>'saveCPV1()'
					);
echo "<br>".form_submit("lks", "mentés",$attributes).'';
echo '</div><div class="col-sm-6"><h1> CPV2</h1>';

	for($j=0;$j<count($cpv2);$j++)
	{
		if($cpv2[$j][3]=='999')
		{
			$data = array(
        'name'          => 'checkbox[]',
        'id'            => 'cpv2_'.$cpv2[$j][0],
        'value'         => $cpv2[$j][0],
        'style'         => 'margin:10px'
		);
echo "használaton kívüli".form_checkbox($data).$cpv2[$j][1]."<br>";
		}
	}

$string = '<br><br><br><br><br></div></div></div></div>';
echo form_close($string);
?>

<div id="cahngeUnit" class="stealth">
<?php
$this->load->helper('form');
echo form_open('Koltsegterv/addCPV2');
echo form_label('CPV2 neve&nbsp;','Unit_Name');
   $data = array(
        'name'          => 'Unit_Name',
        'id'            => 'Unit_Name',
		'title'			=>'A felhasználó vezetéknve kerül ide',
		'type'			=>'text',
		'required'		=>'required',
		'class'		=>	'form-control',
);
echo form_input($data);
echo form_label('CPV2 kódja&nbsp;','Unit_Kod');
   $data = array(
        'name'          => 'Unit_Kod',
        'id'            => 'Unit_Name',
		'title'			=>'A felhasználó vezetéknve kerül ide',
		'type'			=>'text',
		'required'		=>'required',
		'class'		=>	'form-control',
);
echo form_input($data);
$attributes = array(
					'class' => 'btn btn-primary',
					'id'=>'gomb',
					'class'=>'btn btn-primary btn-lg opt-btn',
					);
echo "<br>".form_submit("lks", "mentés",$attributes).'';
$data = array(
        'name'          => 'id',
        'id'            => 'uid',	
		'type'			=>'text',
		'class'			=>'stealth',
		
);
echo form_input($data);
$string = '<br></div></div>';
echo form_close($string);
?>
<script>
function addCPV1()
{
	$("#instituts").hide();
	$("#cahngeInstitut").show();
}
function addCPV2()
{
	$("#instituts").hide();
	$("#cahngeUnit").show();
}
function ChangeInst(id)
{
	$("#instituts").hide();
	$("#cahngeInstitut").show();
}
function ChangeUnit(id)
{
	$("#instituts").hide();
	$("#cahngeUnit").show();
}
function saveCPV1()
{
	var str = $( "#cpv1" ).serialize();
	console.log(str)
	$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/addCPV1',
			data:{'str':str},
			success:function(result)
				{
					console.log(result)
				}
	});

}
function ajaxALoad(mit)
{
	$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/loadAPage/'+mit,
			data:"mit="+mit,
			success:function(result)
				{
					//console.log(result)
					$("#mainPage").html(result);
				}
	});
}
function logOut()
{
	$.ajax(
	{
		type:"GET",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/logOut",
		success:function(result)
				{
					$("#overPage").html(result);
				}
	});	
			document.cookie = "alegyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "egyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "rovatKiadas=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "afaKulcs=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "mertekegyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "ev=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "userid=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
	
}
function ajaxLoad(mit)
{
	
	$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/loadPage',
			data:"mit="+mit,
			success:function(result)
				{
					//console.log(result)
					$("#mainPage").html(result);
				}
	});
}
</script>
