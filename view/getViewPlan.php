<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="img/favicon.ico">
		<title>Költségtervező új</title>
		<link rel="stylesheet" href="../Scripts\css\bootstrap.min.css">
		<link rel="stylesheet" href="../Scripts\css\koltsegterv.css">
		<script src="../Scripts/js/jquery.min.js"></script>
		<script src="../Scripts/js/bootstrap.min.js"></script>
		<script src="./Scripts/js/functions.js"></script>
	</head>
		<body>
			<div class="container" style="width:100%;">
				<div class="row" style="width:100%;">
					<div id="headPage">
						<div class="col-sm-4">
								<img class="felirat" src="../img/felirat.png"  alt="KE Költségtervező" border="0"/>
						</div>
						<div class="col-sm-4">
								<a class="pull-center" target="_blank" href="http://www.ke.hu">
								<img class="logo" onmouseover="this.src='../img/ke_kozep_ff.png'" onmouseout="this.src='../img/ke_kozep.png'" src="img/ke_kozep.png"  alt="KE logo" border="0"/>
								</a>
						</div>
						<div class="col-sm-4">
								<div class="pull-right" id="topLeft"></div>
								
						</div>
					</div>
				</div>
				<div class="row" id="mainPage">
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
<div class="container">
<ul class="nav nav-tabs">



<li class="" ><a data-toggle="tab" href="#kiadful" onclick="showKiad()" id="0">Kiadások</a></li>
 <li><a data-toggle="tab" href="#bevful" onclick="showBev()" id="1">Bevételek</a></li>
 <li class=""><a data-toggle="tab" href="#info" onclick="showInfo()" >Útmutató</a></li>
</ul>
<div id="koltsegfel">
</div>
<div id="meglevoKoltseg">
</div>
 </div>
 <div id="send">


	
	</div></div></div>
	</div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
