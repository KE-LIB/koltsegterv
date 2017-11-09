<div id="mainPage">
<div id="kks">
<button class="btn btn-primary" onclick=newKK()><span class="glyphicon glyphicon-plus"></span> Új Kiadás kód felvitele</button><br>
		<br>
<table class="table table-bordered">
<thead><tr><th>Kód</th><th>Név</th><th>Áfa</th></tr></thead>
<?php

for($i=0;$i<count($kk);$i++)
{
		echo '<tr><td>'.$kk[$i+1].'</td><td>'.$kk[$i+2].'</td><td>'.$kk[$i+3].'</td></tr>';
	$i=$i+3;
}
?>
		</table>
		<br><br><br><br><br>
</div>
<div id="mod" class="stealth container">
<?php
$this->load->helper('form');
echo '<div class="container">';
echo form_label('Kiadás Kódja&nbsp;','kk');
   $data = array(
        'name'          => 'kk',
        'id'            => 'kk',	
		'type'			=>'text',
		'required'		=>'required',
);
echo form_input($data);
echo form_label('Kiadás neve&nbsp;','kn');
   $data = array(
        'name'          => 'kn',
        'id'            => 'kn',
		'type'			=>'text',
		'required'		=>'required',
);
echo form_input($data);echo form_label('Áfa&nbsp;','afa');
   $data = array(
        'name'          => 'afa',
        'id'            => 'afa',	
		'value'			=>'-',
		'type'			=>'text',
		'required'		=>'required',
);
echo form_input($data);
$attributes = array(
					'class' => 'btn btn-primary',
					'id'=>'gomb',
					'onclick'=>'saveKK()',
					);
echo "<br>".form_submit("lks", "mentés",$attributes);
form_close('');
?>
<br><br><br><br><br><br>
</div>
</div>

<script>
function newKK()
{
$('#kks').hide();
$('#mod').show();	
}
function saveKK()
{
	var kk=$("#kk").val()
	var kn=$("#kn").val()
	var afa=$("#afa").val()
	
		$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/addKK',
			data:{"kk":kk,"kn":kn,"afa":afa},
			success:function(result)
				{
					//console.log(result)
					ajaxALoad('kiadKod')
				}
	});
}

</script>