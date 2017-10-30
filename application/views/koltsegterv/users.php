<div id="users">
<table id="user"></table>
</div>
<div id="mod">
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
echo form_input($data).'</div></div><div class="row"><div class="col-sm-2">';
$attributes = array(
					'class' => 'btn btn-primary',
					);
echo "<br>".form_submit("lks", "mentés",$attributes);
  
$string = '</div></div>';
echo form_close($string);

?>

</div>