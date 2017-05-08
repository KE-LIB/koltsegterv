 <h2 style="margin-left:20px;"></h2>

<div class="container">
<div class="stealth" id="privi">
	<div class="panel panel-default"><div class="panel-body"><p><b><h2>Összegyetemi listák</h2></b></p><hr>
		<button type="button" onclick="analyticsFull()"  class="btn btn-primary"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Analitkus</button>
	<button type="button" onclick="aggregateFull()" class="btn btn-success"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>&nbsp;Aggregált</button>
	<div id="downloads_full" calss="pull-right" ></div>
	</div></div></div>
	


<h2><b>Egységenkénti listák</b></h2>
<h2>Szűrés</h2>
<div class="row">
<div class="col-xs-2 col-md-2" id="histitute"><button class="btn" onclick="hide('istitute')"  >Egységek elrejtése</button></div>
<div class="col-xs-2 col-md-2 stealth" id="sistitute"><button class="btn " onclick="show('istitute')" >Egységek mutatása</button></div>
<div class="col-xs-2 col-md-2" id="hunit"><button class="btn" onclick="hide('unit')" >Alegységek elrejtése</button></div>
<div class="col-xs-2 col-md-2 stealth" id="sunit"><button class="btn " onclick="show('unit')" >Alegységek mutatása</button></div>
<div class="col-xs-2 col-md-2" id="hrecords"><button class="btn" onclick="hide('records')" >Rekordok elrejtése</button></div>
<div class="col-xs-2 col-md-2 stealth" id="srecords"><button class="btn " onclick="show('records')" >Rekordok mutatása</button></div>
<div class="col-xs-2 col-md-2">Költségvetés Éve
<div class="dropdown">
<select name="evszam"  id="evszam" onChange="changeYear()" class="form-control add-panel-select" >
</select>
</div>
</div>
</div>
<div  id="egysegenkentiLista">
	

</div>
</div>

