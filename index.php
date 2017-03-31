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
		<link rel="stylesheet" href="Scripts\css\bootstrap.min.css">
		<link rel="stylesheet" href="Scripts\css\koltsegterv.css">
		<script src="Scripts/js/jquery.min.js"></script>
		<script src="Scripts/js/bootstrap.min.js"></script>
		<script src="Scripts/js/functions.js"></script>
	</head>
		<body>
			<div class="container" style="width:100%;" id="overPage">
				<div class="row" style="width:100%;">
					<div id="headPage">
						<div class="col-sm-4">
								<img class="felirat" src="img/felirat.png"  alt="KE Költségtervező" border="0"/>
						</div>
						<div class="col-sm-4">
								<a class="pull-center" target="_blank" href="http://www.ke.hu">
								<img class="logo" onmouseover="this.src='img/ke_kozep_ff.png'" onmouseout="this.src='img/ke_kozep.png'" src="img/ke_kozep.png"  alt="KE logo" border="0"/>
								</a>
						</div>
						<div class="col-sm-4">
								<div class="pull-right" id="topLeft"></div>
								
						</div>
					</div>
				</div>
				<div class="row" id="mainPage">
				<br>
				<div class="loginPanel">
					<div class="panel center panel-default">
						<div class="panel-heading clearfix"><b>
						<b>	<h1>Bejelentkezés<span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>
						</h1></b></div>
							
								<div class="input-group" >
									<span class="input-group-addon">
									<label>E-mail cím:</label><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
									<input type="text" name="email" id="inputEmail" class="form-control" placeholder="valaki@ke.hu" required autofocus>
								</div>
								<div class="input-group">
									<span class="input-group-addon">
									<label>Jelszó:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><i class="glyphicon glyphicon-lock" aria-hidden="true"></i>
									</span>
										<input type="password"  name="psw" id="inputPassword" class="form-control" placeholder="Jelszó" required>
								</div>
								<br>
									<button class="btn btn-lg btn-primary btn-block"  id="login" name="login" onclick="login()">Bejelentkezés</button>
								</div>
							
						</div>
					</div>
				<div class="row" id="errorMsg">
		</div>
		</div>
		<div id="footer">
      <div class="container">
        <p class="text-muted credit">Minden jog fenntartva! © Kaposvári Egyetem 2015</p>
      </div>
    </div>
		</body>
</html>