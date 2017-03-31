 <div class="panel panel-primary panel-transparent">
  <div class="panel-body-info">
  Üdvözöljük <?php echo $_COOKIE['KEname']; ?>!
  	<br>
	<button  type="button" class="btn btn-primary btn-panel" onclick="ajaxLoad('main')"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Főmenü</button>
	<button  type="button" class="btn btn-danger btn-panel" onclick="logOut()"><span class="glyphicon glyphicon-log-out" aria-hidden="true">Kijelentkezés</button>
</div>
  </div>
  