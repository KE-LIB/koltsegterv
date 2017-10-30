<div id="users">
<table id="user" class="table">
<thead><tr><th>Vezetéknév</th><th>Keresztnév</th><th>Admin</th><th>Email</th><th>Műveletek</th></tr></thead>
<?php

for($i=0;$i<count($users);$i++)
{
	echo '<tr id="sor_'.$users[$i][4].'">';
	for($j=0;$j<4;$j++)
	{
		echo '<td>'.$users[$i][$j].'</td>';
	}
	echo '<td>
	<button type="button" onclick="Change('.$users[$i][4].')" class="btn btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;Módosítás</button>
	<button type="button" onclick="Delete('.$users[$i][4].')" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>&nbsp;Törlés</button>
	</td></tr>';
}
?>
		</table>
		<br>
</div>
<div id="mod" class="stealth">
    <?php
$this->load->helper('form');
echo form_open('Koltsegterv/modUser');
echo '<div class="container"><div class="row"><div class="col-sm-2 well">';
echo form_label('Keresztnév&nbsp;','First_Name').'</div><div class="col-sm-3 well">';
   $data = array(
        'name'          => 'First_Name',
        'id'            => 'First_Name',
		'title'			=>'A felhasználó vezetéknve kerül ide',
		'type'			=>'text',
   
		'required'		=>'required',
);
echo form_input($data).'</div></div><div class="row"><div class="col-sm-2 well">';
echo form_label('Vezeték név','Last_Name').'</div><div class="col-sm-3 well">';
   $data = array(
        'name'          => 'Last_Name',
        'id'            => 'Last_Name',
		'title'			=>'A felhasználó vezetéknve kerül ide',
		'type'			=>'text',
   
		'required'		=>'required',
);
echo form_input($data).'</div></div><div class="row"><div class="col-sm-2 well">';
echo form_label('email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','email').'</div><div class="col-sm-3 well">';
   $data = array(
        'name'          => 'email',
        'id'            => 'email',
		'title'			=>'A felhasználó vezetéknve kerül ide',
		'type'			=>'email',
   
		'required'		=>'required',
);
echo form_input($data).'</div></div><div class="row"><div class="col-sm-2 well">';
echo form_label('Jelszó&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','psw').'</div><div class="col-sm-3 well">';
   $data = array(
        'name'          => 'psw',
        'id'            => 'psw',
		'title'			=>'A felhasználó vezetéknve kerül ide',
		'type'			=>'password',
   
		'required'		=>'required',
);
echo form_input($data).'</div></div><div class="row"><div class="col-sm-6">';
$data = array(
        'name'          => 'admin',
        'id'            => 'admin',
        'value'         => '1',
        'style'         => 'margin:10px'
);

echo form_checkbox($data).'A felhasználó admin jogosúltsággal rendelkezik</div></div><div class="row"><div class="col-sm-2">';

$attributes = array(
					'class' => 'btn btn-primary',
					);
echo "<br>".form_submit("lks", "mentés",$attributes);
  
$string = '</div></div>';
echo form_close($string);

?>

</div>
<script>
function Delete(id)
{
	console.log(id)
		$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/deleteUser',
			data:"id="+id,
			success:function(result)
				{
					//console.log(result)
					ajaxALoad('users')
				}
	});
}
function Change(id)
{
	$('#users').hide();
	$('#mod').show();
	$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/getModUser',
			data:"id="+id,
			success:function(result)
				{
					//console.log(result)
					ajaxALoad('users')
				}
	});*/
}
</script>