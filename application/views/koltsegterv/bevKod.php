<div id="mainPage">
<div id="bks">
<button class="btn btn-primary" onclick=newbk()><span class="glyphicon glyphicon-plus"></span> Új Bevétel kód felvitele</button><br>
		<br>
<table class="table table-bordered">
<thead><tr><th>Kód</th><th>Név</th><th>Áfa</th></tr></thead>
<?php

for($i=0;$i<count($bk);$i++)
{
		echo '<tr><td>'.$bk[$i+1].'</td><td>'.$bk[$i+2].'</td><td>'.$bk[$i+3].'</td></tr>';
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
echo form_label('Bevétel Kódja&nbsp;','bk');
   $data = array(
        'name'          => 'bk',
        'id'            => 'bk',	
		'type'			=>'text',
		'required'		=>'required',
);
echo form_input($data);
echo form_label('Bevétel neve&nbsp;','bn');
   $data = array(
        'name'          => 'bn',
        'id'            => 'bn',
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
					'onclick'=>'savebk()',
					);
echo "<br>".form_submit("lks", "mentés",$attributes);
form_close('');
?>
<br><br><br><br><br><br>
</div>
</div>

<script>
function newbk()
{
$('#bks').hide();
$('#mod').show();	
}
function savebk()
{
	var bk=$("#bk").val()
	var kn=$("#bn").val()
	var afa=$("#afa").val()
	
		$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/addBK',
			data:{"bk":bk,"bn":kn,"afa":afa},
			success:function(result)
				{
					//console.log(result)
					ajaxALoad('bevKod')
				}
	});
}

</script>