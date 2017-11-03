<div id="mainPage">
<div id="instituts">
<div class="container">
<div class="row">
<div class="col-sm-6">
<table id="insti" class="table">
<thead><h1>Főegységek</h1><br>
<button class="btn btn-primary" onclick=ChangeInst('9999')><span class="glyphicon glyphicon-plus"></span> Új egység</button><br><br></thead>
<tr><th>Azonosító</th><th>Egység neve</th><th>Műveletek</th>
</tr>
<?php
for($i=0;$i<count($egyseg);$i++)
{
	echo "<tr><td>".$egyseg[$i][0]."</td><td>".$egyseg[$i][1].'</td><td>
	<button type="button" onclick="ChangeInst('.$egyseg[$i][0].')" class="btn btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;Módosítás</button>
	</td></tr>';
}
?>
</table>

</div>
<div class="col-sm-6">
<table id="alinsti" class="table">
<thead><h1>Alegységek</h1><br><button class="btn btn-primary" onclick=ChangeUnit('9999')><span class="glyphicon glyphicon-plus"></span> Új alegység</button><br></thead>
<tr><th>Szülő</th><th>Egység neve</th><th>Műveletek</th>
</tr>
<?php
for($i=0;$i<count($alegyseg);$i++)
{
	echo "<tr><td>".$alegyseg[$i][2]."</td><td>".$alegyseg[$i][1].'</td><td>
	<button type="button" onclick="ChangeUnit('.$alegyseg[$i][0].')" class="btn btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;Módosítás</button>
	</td></tr>';
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
echo form_open('Koltsegterv/saveModInst');
echo '<div class="container">
<div class="row">
<div class="col-sm-6">';
echo form_label('Egység neve&nbsp;','First_Name');
   $data = array(
        'name'          => 'Inst_Name',
        'id'            => 'Inst_Name',
		'title'			=>'A felhasználó vezetéknve kerül ide',
		'type'			=>'text',
		'required'		=>'required',
		'class'		=>'form-control',
);
echo form_input($data);
$attributes = array(
					'class' => 'btn btn-primary',
					'id'=>'gomb',
					'class'=>'btn btn-primary btn-lg opt-btn',
					'onclick'=>'saveModInst()'
					);
echo "<br>".form_submit("lks", "mentés",$attributes).'';
$data = array(
        'name'          => 'id',
        'id'            => 'iid',	
		'type'			=>'text',
		'class'			=>'stealth',
		
);
echo form_input($data).'</div><div class="col-sm-6"><h1> Alegységek</h1>';
for($i=0;$i<count($egyseg);$i++)
{
	echo "<h4>".$egyseg[$i][1]."</h4><br>";
	for($j=0;$j<count($alegyseg);$j++)
	{
		if($alegyseg[$j][2]==$egyseg[$i][0])
		{
			$data = array(
        'name'          => 'checkbox[]',
        'id'            => 'alegyseg_'.$alegyseg[$j][0],
        'value'         => $alegyseg[$j][0],
        'style'         => 'margin:10px'
		);
echo form_checkbox($data).$alegyseg[$j][1]."<br>";
		}
		if($alegyseg[$j][2]=='999')
		{
			$data = array(
        'name'          => 'checkbox[]',
        'id'            => 'alegyseg_'.$alegyseg[$j][0],
        'value'         => $alegyseg[$j][0],
        'style'         => 'margin:10px'
		);
echo "használaton kívüli".form_checkbox($data).$alegyseg[$j][1]."<br>";
		}
	}
}
$string = '<br><br><br><br><br></div></div></div></div>';
echo form_close($string);
?>

<div id="cahngeUnit" class="stealth">
<?php
$this->load->helper('form');
echo form_open('Koltsegterv/saveModUnit');
echo form_label('Alegység neve&nbsp;','First_Name');
   $data = array(
        'name'          => 'Unit_Name',
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
function ChangeInst(id)
{
	$("#instituts").hide();
	$("#cahngeInstitut").show();
	$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/getInstUnits',
			data:{"id":id},
			success:function(result)
				{
					
					var exp=result.split(',')
					console.log(result)
					$("#iid").attr('value',exp[0])
					$("#Inst_Name").attr('value',exp[1])
					for(var i=1;i<exp.length;i++)
					{
						$("#alegyseg_"+exp[i]).attr('checked','checked')
					}
				}
	});
}
function ChangeUnit(id)
{
	$("#instituts").hide();
	$("#cahngeUnit").show();
	$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/getUnit',
			data:{"id":id},
			success:function(result)
				{
					
					var exp=result.split(',')
					$("#uid").attr('value',exp[0])
					$("#Unit_Name").attr('value',exp[1])
					
				}
	});
}
function saveModInst()
{
	$("#instituts").show();
	$("#cahngeInstitut").hide();

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
</script>
