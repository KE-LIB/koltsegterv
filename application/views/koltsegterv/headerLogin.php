<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="<?php echo base_url(); ?>img/favicon.ico">
		<title>Költségtervező új</title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>css\bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css\koltsegterv.css">
		<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>js/numeral.js"></script>
		
	</head>
		<body>
			<div class="container" style="width:100%;" id="overPage">
				<div class="row" style="width:100%;">
					<div id="headPage">
						<div class="col-sm-4">
								<img class="felirat" src="<?php echo base_url(); ?>img/felirat.png"  alt="KE Költségtervező" border="0"/>
						</div>
						<div class="col-sm-4">
								<a class="pull-center" target="_blank" href="http://www.ke.hu">
								<img class="logo" onmouseover="this.src='<?php echo base_url(); ?>img/ke_kozep_ff.png'" onmouseout="this.src='<?php echo base_url(); ?>img/ke_kozep.png'" src="<?php echo base_url(); ?>img/ke_kozep.png"  alt="KE logo" border="0"/>
								</a>
						</div>
						<div class="col-sm-4">
								<div class="panel panel-primary panel-transparent">
  <div class="panel-body-info" id="felsopanel">
  Üdvözöljük <?php 
  if(isset($user))
  {
	  echo $user;
	  } 
	   $this->load->helper('form');
	echo form_open('Koltsegterv/LogOut');?>
	<button  type="button" id="fomenu"  class="btn btn-primary btn-panel" onclick="ajaxLoad('main')"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Főmenü</button>

	<button  type="button" class="btn btn-danger btn-panel" onclick="logOut()"><span class="glyphicon glyphicon-log-out" aria-hidden="true">Kijelentkezés</button>
<?php	 $string = '</div></div>';
echo form_close($string);
							 ?>
								
						</div>
					</div>
				</div>