<div class="row_own">
	  <div class="col-xs-4 col-md-4">
	  <div class="merleg_cimke alert alert-success merleg" id="merleg_cimer"><table class="merleg_table_green" id="merleg_table"><thead>
	  <tr ><th >&nbsp;Bevételek&nbsp;</th><th >&nbsp;Kiadások&nbsp;</th></tr></thead>
	  <tr  ><td ><span id="bevetelossz">0</span></td><td ><span id="kiadasossz">0</span></td></tr>
	  <tr ><th colspan="2">Egyenleg:</th></tr>
	  <tr ><td colspan="2"><span id="egyenleg">0</span></td></tr>
	  </tbody></tobdy></table>

		</div>

		</div>
		<div class="col-xs-8 col-md-8">
		<div class="alert alert-info place"><div class="place-text"><strong>Hely:</strong>
		<oreo id="egyseg"> <?php echo $egyseg;?></oreo><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"><oreo id="alegyseg"> 
		<?php echo $alEgyseg;?></oreo></span>
		<br><oreo id="errorMsgForm"></oreo>
		 </div>
		 </div>
 </div>
<div class="container">
<ul class="nav nav-tabs">



<li class="" ><a data-toggle="tab" href="#kiadful" onclick="showKiad()" id="0">Kiadások</a></li>
 <li><a data-toggle="tab" href="#bevful" onclick="showBev()" id="1">Bevételek</a></li>
 <li class=""><a data-toggle="tab" href="#info" onclick="ajaxLoadKoltsegfel('helpKFel')" >Útmutató</a></li>
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
	

	<button type="button" onclick="confirmSave()"  class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>&nbsp;Mentés későbbre</button>
	<button type="button" onclick="confirmSend()" class="btn btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;Feladás</button>
	<button type="button" onclick="confirmExit()" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>&nbsp;Elvetés</button>

	
	
	</div></div></div>
	</div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>

<script>
//kiadás megjelenítése+ amit eddig felvittünk
function showKiad(){
//	getAlEgysegName();
//getEgysegName();
ajaxLoadKoltsegfel("kiadas")
					
}
function showBev(){
//	getAlEgysegName();
//getEgysegName();
ajaxLoadKoltsegfel("bevetel")
					
}
function ajaxLoadKoltsegfel(mit)
{
$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/loadPage',
			data:"mit="+mit,
			success:function(result)
				{
					//console.log(result)
					$("#koltsegfel").html(result);
				}
	});
	}
	//elvetés
function confirmExit()
{
	var x = confirm("Biztosan ELVETI a költségtervezetet?\n\nHa az OK-t választja a munkája törlésre kerül és később sem folytathatja azt!");
		if (x){
			clearSubmission();
		ajaxLoad('main');}
}
//mentés és kilépés
function confirmSave()
{
	$.ajax(
	{
		type:"GET",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/confirmAndSave",
		success:function(result)
				{
					console.log(result);
				}
	});	
	ajaxLoad("main");
}
//felad és kilép
function confirmSend()
{
	$.ajax(
	{
		type:"GET",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/confirmSend",
		success:function(result)
				{
					console.log(result);
				}
	});	
	ajaxLoad("main");
}
//h mainbe valki vissza megy kitörli a submission táblákat
function clearSubmission()
{
	$.ajax(
	{
		type:"GET",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/clearSubmission",
		success:function(result)
				{
					console.log(result);
				}
	});	
}
</script>