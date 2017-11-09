<div id="mainPage">
<div id="afas">
<button class="btn btn-primary" onclick=newAfa()><span class="glyphicon glyphicon-plus"></span> Új áfanem felvitele</button><br>
		<br>
<table class="table table-bordered">
<thead><tr><th>Áfanem</th></tr></thead>
<?php

for($i=0;$i<count($afa);$i++)
{
		echo '<tr><td>'.$afa[$i+1].' %</td></tr>';
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
echo form_label('Áfa értéke&nbsp;','First_Name');
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
					'onclick'=>'saveAfa()',
					);
echo "<br>".form_submit("lks", "mentés",$attributes);

form_close('');
?>
<br><br><br><br><br><br>
</div>
</div>

<script>
function newAfa()
{
$('#afas').hide();
$('#mod').show();	
}
function saveAfa()
{
	var value=$("#First_Name").val()
	
		$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/addAfa',
			data:"value="+value,
			success:function(result)
				{
					//console.log(result)
					ajaxALoad('afa')
				}
	});
}

</script>