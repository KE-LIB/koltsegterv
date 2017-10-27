 <h2 style="margin-left:20px;"></h2>

<div class="container">
<div  id="privi">
	<div class="panel panel-default"><div class="panel-body"><p><b><h2>Összegyetemi listák</h2></b></p><hr>
	<div class="row">
	<div class="col-sm-6">
		<button type="button" onclick="analyticsFull()"  class="btn btn-primary"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Analitkus</button>
	<button type="button" onclick="aggregateFull()" class="btn btn-success"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>&nbsp;Aggregált</button>
	<div id="downloads_full" calss="pull-right" ></div>
	</div>
	<div class="col-sm-6">
	<table class="merleg_table_green" id="merleg_table"><thead>
	  <tr ><th >&nbsp;Bevételek&nbsp;</th><th >&nbsp;Kiadások&nbsp;</th></tr></thead>
	  <tr  ><td ><span id="bevetelossz">0</span></td><td ><span id="kiadasossz">0</span></td></tr>
	  <tr ><th colspan="2">Egyenleg:</th></tr>
	  <tr ><td colspan="2"><span id="egyenleg">0</span></td></tr>
	  </tbody></tobdy></table>

		</div>
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

<script>
setTimeout(function() {egysegenkentiLista();},300);
setTimeout(function() {setYear();},200);
setTimeout(function() {getFinanc();},400);
//lekérdezi az össz egyetemi költségvetést
function getFinanc()
{
	var year =$("#evszam").val()
	//console.log(year)
	$.ajax(
	{
		type:"POST",
		data:{"Year":year},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/getFinanc",
		success:function(result)
				{
					exp=result.split(",");
					var kiadas=numeral(Number(exp[0])).format('0,0')
					var bevetel=numeral(Number(exp[1])).format('0,0')
					$("#bevetelossz").html(bevetel)
					$("#kiadasossz").html(kiadas)
					setTimeout(function() {getEgyenleg()},200);
					//console.log(result);
				}
	});	
}
function getEgyenleg()
{		
			
			
			var osszBev=numeral($("#bevetelossz").html()).value();
			var osszKiad=numeral($("#kiadasossz").html()).value();
			//console.log(osszKiad)
			var egyenleg=numeral(Number(osszBev)-Number(osszKiad)).format('0,0');
			var egyenleg1=Number(osszBev)-Number(osszKiad);
			//console.log(Number(osszBev)+","+Number(osszKiad));
			$("#egyenleg").html(egyenleg);
			//console.log(egyenleg);
		if(Number(egyenleg1)>=0)
		{
			//console.log("+")
			$("#merleg_cimer").attr("class","merleg_cimke alert alert-success merleg");
			$("#merleg_table").attr("class","merleg_table_green");
		}
		else
		{
			//console.log("-")
			$("#merleg_cimer").attr("class","merleg_cimke alert alert-danger merleg");
			$("#merleg_table").attr("class","merleg_table_red");
		}
}
//egységenkénti listázás letöltéshez
function egysegenkentiLista()
{
		$.ajax(
	{
		type:"GET",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/getEgysegenkentiLista",
		success:function(result)
				{
					$("#egysegenkentiLista").html(result);
					//console.log(result);
				}
	});	
}
//letöltésnél elemek elrejtése/megjelenítése
function hide(mit)
{
	$("table tr[group="+mit+"]").hide()
	$("#s"+mit).removeClass("stealth")
	$("#h"+mit).addClass("stealth")
	
	
}
function show(mit)
{
	$("table tr[group="+mit+"]").show()
	$("#s"+mit).addClass("stealth")
	$("#h"+mit).removeClass("stealth")
	
}
//Egységenkénti analitikus lista
function analyticsEgyseg(id)
{
	$("#downloads_Egyseg_"+id).html("<span class='glyphicon glyphicon-floppy-disk'> folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		data:{'id':id},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/makeAnEgyseg",
		success:function(result)
				{
					$("#downloads_Egyseg_"+id).html(result);
				}
	});	
} 
//Alegységenkénti analitikus lista
function makeAnAlEgyseg(id,iid)
{
	$("#downloads_AlEgyseg_"+iid+"_"+id).html("<span class='glyphicon glyphicon-floppy-disk'> folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		data:{'id':id},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/makeAnAlEgyseg",
		success:function(result)
				{
					$("#downloads_AlEgyseg_"+iid+"_"+id).html(result);
				}
	});	
} 
//recordonkénti analitikus lista
function makeAnRecord(id,iid)
{
	$("#downloads_record_"+id+"_"+iid).html("<span class='glyphicon glyphicon-floppy-disk'> folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		data:{'id':id,'uid':iid},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/makeAnRecord",
		success:function(result)
				{
					$("#downloads_record_"+id+"_"+iid).html(result);
				}
	});	
} 
//teljes analitikus lista
function analyticsFull()
{
	$("#downloads_full").html("<span class='glyphicon glyphicon-floppy-disk'> folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/makeAnFull",
		success:function(result)
				{
					$("#downloads_full").html(result);
				}
	});	
} 
//teljes agregált lista
function aggregateFull()
{
	$("#downloads_full").html("<span class='glyphicon glyphicon-floppy-disk'> folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/makeAgFull",
		success:function(result)
				{
					$("#downloads_full").html(result);
				}
	});	
} 

//Egységenkénti agregált lista
function aggregateEgyseg(id)
{
	//console.log(id)
	$("#downloads_Egyseg_"+id).html("<span class='glyphicon glyphicon-floppy-disk'> folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		data:{'id':id},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/makeAgEgyseg",
		success:function(result)
				{
					$("#downloads_Egyseg_"+id).html(result);
				}
	});	
} 
//Alegységenkénti agregált lista
function makeAgAlEgyseg(id,iid)
{
	
	$("#downloads_AlEgyseg_"+iid+"_"+id).html("<span class='glyphicon glyphicon-floppy-disk'> folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		data:{'id':id},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/makeAgAlEgyseg",
		success:function(result)
				{
					$("#downloads_AlEgyseg_"+iid+"_"+id).html(result);
				}
	});	
} 


//letöltött file törlése
function deleteFile(name,id)
{
setTimeout(function() {
	$("div[id^='downloads_']").html("")
	$.ajax(
	{
		type:"GET",
		data:{'name':name},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/deleteFile",
		success:function(result)
				{
					$("#downloads_Egyseg_2").html(result);
				}
	});	},4000);	
}
//letöltésnél az évszámok feltöltése
function setYear()
{
	setTimeout(function() {
	$.ajax(
	{
		type:"GET",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/setYear",
		success:function(result)
				{
					$("#evszam").html(result);
				}
	});	},500);	
}
function changeYear()
{
	var evszam=$('#evszam').val();
	console.log(evszam)
	document.cookie="Ev="+evszam;
	egysegenkentiLista()
	setTimeout(function() {getFinanc();},400);
}
</script>