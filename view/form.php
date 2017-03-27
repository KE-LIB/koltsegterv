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


	<div class="panel panel-default"><div class="panel-body"><p>
	A teljes költségtervezet (bevétel / kiadás) beküldéséhez, kattintson a MENTÉS ÉS FELADÁS gombra, a tervezet elvetéséhez válassza az ELVETÉS gombot, 
	ha később szeretné folytatni a megkezdett munkát, akkor válassza a MENTÉS ÉS KILÉPÉS opciót.<br>A mentett és elküldött munkáit a 
	FŐMENÜ > SAJÁT TERVEZETEK menüpont alat érheti el.</p>
	

	<button type="button" onclick="confirmSave()"  class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>&nbsp;Mentés és kilépés</button>
	<button type="button" onclick="return confirmSend()" class="btn btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;Mentés és feladás</button>
	<button type="button" onclick="return confirmExit()" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>&nbsp;Elvetés</button>

	
	
	</div></div></div>
	</div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
