<div id="mainPage">
<div id="merteks">
<button class="btn btn-primary" onclick=newMertek()><span class="glyphicon glyphicon-plus"></span> Új mértékegység felvitele</button><br>
		<br>
<table class="table table-bordered">
<thead><tr><th>Mértékegység</th></tr></thead>
<?php

for($i=0;$i<count($mertek);$i++)
{
		echo '<tr><td>'.$mertek[$i+1].'</td></tr>';
	$i++;
}
?>
		</table>
		<br><br><br><br><br>
</div>
<div id="mod" class="stealth container">
<?php
$this->load->helper('form');
echo '<div class="container">';
echo form_label('Mértékegység neve&nbsp;','First_Name');
   $data = array(
        'name'          => 'First_Name',
        'id'            => 'First_Name',
		'title'			=>'A felhasználó vezetéknve kerül ide',
		'type'			=>'text',
   
		'required'		=>'required',
);
echo form_input($data);
$attributes = array(
					'class' => 'btn btn-primary',
					'id'=>'gomb',
					'onclick'=>'saveMertek()',
					);
echo "<br>".form_submit("lks", "mentés",$attributes);

form_close('');
?>
<br><br><br><br><br><br>
</div>
</div>

<script>
function newMertek()
{
$('#merteks').hide();
$('#mod').show();	
}
function saveMertek()
{
	var value=$("#First_Name").val()
	
		$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/addMertek',
			data:"value="+value,
			success:function(result)
				{
					//console.log(result)
					ajaxALoad('mertekEgyseg')
				}
	});
}

</script>