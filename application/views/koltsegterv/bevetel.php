<div class="row labels">
<div class="col-xs-11 col-md-11"><h2 style="margin-top:0px;">Bevételek hozzáadása</h2></div>
<div class="eye col-xs-1 col-md-1"><!--button type="button" id="shbt" onclick="showHiddenKiad(this.value)" value="0" name="hide_show" class="btn btn-default"><span id="show_hide" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button--></div>
</div>
<div class="row labels">
<div class="col-xs-3 col-md-3"><span id="errorRovat">Rovat</span></div>
<div class=" collapsed col-xs-1 col-md-1">Nettó</div>
<div class="col-xs-1 col-md-1"><span id="errorAfa">Áfakulcs</span></div>
<div class="col-xs-1 col-md-1"><span id="errorEv">Év</span></div>
<div class="col-xs-1 col-md-1"><span id="errorHonap">Hónap</span></div>
<div class="collapsed col-xs-1 col-md-1">Áfa</div>
<div class=" collapsed col-xs-1 col-md-1">Bruttó</div>
<div class="col-xs-1 col-md-1"></div>
</div>
<div class="row">
<div class="col-xs-3 col-md-3">
<div class="dropdown">
<select name="rovat"  id="rovat" onchange="setRovat()" class="form-control add-panel-select" >
<option value="999" selected>Válasszon...</option>

</select>
</div>    
</div>

<div class=" collapsed col-xs-1 col-md-1">
<input name="nt_summa" type="number" min="0" step="any" id="" value="" class="form-control" placeholder="Összesen" readonly/>
</div>
<div class="col-xs-1 col-md-1">
<div class="dropdown">
<select name="afk"  id="afaKulcs" onchange="setAfa()" class="form-control add-panel-select" >

<option value="999" selected>Válasszon...</option>
</select>
</div>
</div>
<div class="col-xs-1 col-md-1">
<input  type="number" min="0" step="any"  class="form-control" value="<?php echo date("Y")+1; ?>" id="kltsgEve" pattern="\d{4}" onblur="ellenoriz('errorEv','kltsgEve')" required/></td>
</div>
<div class="col-xs-1 col-md-1">
<div class="dropdown">
<select name="honap"  id="honap"  onchange="setHonap()"class="form-control add-panel-select" >
<option value="999" selected>Válasszon...</option>
<option value="1" >Január</option>
<option value="2" >Február</option>
<option value="3" >Március</option>
<option value="4" >Április</option>
<option value="5" >Május</option>
<option value="6" >Június</option>
<option value="7" >Július</option>
<option value="8" >Augusztus</option>
<option value="9" >Szeptember</option>
<option value="10" >Október</option>
<option value="11" >Novemnber</option>
<option value="12" >december</option>
</select>
</div>
</div>
<div class="col-xs-2 col-md-2">

</div>
</div>
<div id="details">
<table class="table table-bordered"><thead>
<tr class="subtable"><th colspan="" ><span id="errorMegnev">Tervezett beszerzés/igénylés</span></th><th class="collapsed">
Nettó egységár</th><th class="collapsed">Áfakulcs</th><th class="collapsed">Áfa egységár</th><th><span id="errorBrutto">Bruttó egységár</span></th><th><span id="errorMennyiseg">Mennyiség</span></th>
<th><span id="errorMertek">Mértékegység</span></th><th class="collapsed">Nettó összesen</th><th class="collapsed">Áfa összesen</th><th class="collapsed">Brutto összesen</th></tr>
</thead>
<tr>
<td>

<textarea placeholder="Megnevezés" maxlength="150" style="height:34px"  id="megnevezes" name="" class="form-control"  onblur="ellenoriz('errorMegnev','megnevezes')" required></textarea>
</td>
<td>
<input  type="number" min="0" step="any"  class="form-control" placeholder="Egységár" id="egysegAr" name="bt_" value="" pattern="\d+(\.\d{2})?" onblur="ellenoriz('errorBrutto','egysegAr')" required/></td>
<td class="">
<input  type="number" min="0" step="any"  class="form-control" placeholder="Mennyiség" id="mennyiseg" name="menny" value="" onblur="ellenoriz('errorMennyiseg','mennyiseg')" required/></td>
<td>
<div class="dropdown">
<select id="mertekegyseg" onchange="setMertek()" class="form-control add-panel-select" required >
<option value="" selected>Válasszon...</option>
</select>
</div>
</td>
<td class="muv"><button type="submit" id="" onclick="showBev()" value="" name="rfd" class="btn btn-danger">
<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
</tr>
</table>
<button type="submit" onclick="ajaxAddBevetel()" value="1" name="upload_kiad" class="btn btn-success" id="upload_kiad"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>&nbsp;Rovat rögzítése</button>
<button type="submit" onclick="ajaxModBevetel()" value="1" name="mod_kiad" class="btn btn-primary stealth" id="mod_kiad"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>&nbsp;Rovat Módosítása</button>
<button type="submit" onclick="showBev()" value="1" name="cc_mod_kiad" class="btn btn-danger stealth" id="cc_mod"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>&nbsp;Mégsem</button>

</div>
<div id="content2">
<h2 class="h2-text" >Tervezett Bevételek</h2> 
<div id="kiadsSubmission"></div>

</div>
<oreo id="seged" class="stealth"></oreo>
<script>
//rovatok betöltése
	setTimeout(function() 
	{
	$.ajax(
	{
		type:"POST",
		url:"<?php echo base_url(); ?>" + 'index.php/Koltsegterv/fillBevetel',
		data:"mit=rovat",
		success:function(result)
				{
					//console.log(result);
					$("#rovat").html(result);
				
				}
	});		
	setRovatAfa();
	setAfaMertek();
	},100);		
	
function setRovat()
{
	var rovat=$("#rovat").val();
	document.cookie="rovat="+rovat;	
	$("#errorRovat").css("color","black");
	
}
function setRovatAfa()
{
	//Áfa kulcsok betöltése	
	$.ajax(
	{
			type:"POST",
		url:"<?php echo base_url(); ?>" + 'index.php/Koltsegterv/fillBevetel',
		data:"mit=afa",
		success:function(result)
				{
					//console.log(result);
					$("#afaKulcs").html(result);
				
				}
	});		
}
		
	
	setTimeout(function() {
		$.ajax(
	{
		type:"POST",
		url:"<?php echo base_url(); ?>" +"index.php/Koltsegterv/getBevetel",
		success:function(result)
				{
					//console.log(result);
					$("#meglevoKoltseg").html(result);
				
				}
	});	
	sumKiad()
	sumBev()
	},500);	
setTimeout(function() {getEgyenleg()},600);	


function getEgyenleg()
{		
			
			
			var osszBev=$("#bevetelossz").html();
			var osszKiad=$("#kiadasossz").html();
			//console.log(osszKiad)
			var egyenleg=Number(osszBev)-Number(osszKiad);
			//console.log(Number(osszBev)+","+Number(osszKiad));
			$("#egyenleg").html(egyenleg);
			//console.log(egyenleg);
		if(Number(egyenleg)>=0)
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
function ajaxAddBevetel()
{
	var megnevezes=$("#megnevezes").val();
	var egysegAr=$("#egysegAr").val();
	var mennyiseg=$("#mennyiseg").val();
	var rovat=$("#rovat").val();
	var afa=$("#afaKulcs").val();
	var ev=$("#kltsgEve").val();
	var honap=$("#honap").val();
	var mertekegyseg=$("#mertekegyseg").val();
	//console.log("megnevezes="+megnevezes+"?egysegAr="+egysegAr+"?mennyiseg="+mennyiseg);
	if(rovat=="999" || afa=="999" || mertekegyseg=="999" || megnevezes=="" || egysegAr=="" || mennyiseg==""|| honap=="999")
	{
		if(rovat=="999")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket ");
		$("#errorRovat").css("color","red");
		}
		if(afa=="999")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorAfa").css("color","red");
		}
	
		if(mertekegyseg=="999")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorMertek").css("color","red");
		}
		if(megnevezes=="")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorMegnev").css("color","red");
		}
		if(egysegAr=="")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorBrutto").css("color","red");
		}
		if(mertekegyseg=="999")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorMennyiseg").css("color","red");
		}
		if(honap=="999")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorHonap").css("color","red");
		}
		
	}
	else{
	$.ajax(
	{
			type:"POST",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/addBevetel",
		data:{'megnevezes':megnevezes,"egysegAr":egysegAr,"mennyiseg":mennyiseg,"rovat":rovat,"ev":ev,"honap":honap},
		success:function(result)
		{
		showBev();
		}

	});
	
	}
}

function setAfa()
{
	var afa=$("#afaKulcs").val();
	document.cookie="afaKulcs="+afa;	
	$("#errorAfa").css("color","black");;			
}
function setHonap()
{
		
	$("#errorHonap").css("color","black");;			
}
function setAfaMertek()
{

	//Mértékegységek betöltése					
	$.ajax(
	{
		type:"POST",
		url:"<?php echo base_url(); ?>" + 'index.php/Koltsegterv/fillKiadas',
		data:"mit=mertek",
		success:function(result)
				{
					//console.log(result);
					$("#mertekegyseg").html(result);
				
				}
	});				
}

function setMertek()
{
	var mertekegyseg=$("#mertekegyseg").val();
	document.cookie="mertekegyseg="+mertekegyseg;
	$("#errorMertek").css("color","black");;	
}

function ellenoriz(erromsg,mit)
{
	if($("#"+mit).value=="")
	{
		$("#"+erromsg).css("color","red");
	}
	else
	{
		$("#"+erromsg).css("color","black");;
	}
	
}
function sumKiad()
{
	$.ajax(
	{
		type:"POST",
		url:"<?php echo base_url(); ?>" +"index.php/Koltsegterv/getKiadasSum",
		success:function(result)
		{
		
		$("#kiadasossz").html(result);	
		}
		});

}
function sumBev()
{
	$.ajax(
	{
		type:"POST",
		url:"<?php echo base_url(); ?>" +"index.php/Koltsegterv/getBevetelSum",
		success:function(result)
		{
			
			$("#bevetelossz").html(result);	
		}
		});
	
}
function delBevRow(id)
{
	
	$.ajax(
	{
		type:"POST",
		url:"<?php echo base_url(); ?>" +"index.php/Koltsegterv/delBevRow",
		data:{'id':id},
		success:function(result)
		{
		console.log(result)
		showBev();
		}
		});
}
function editBevetelRow(id)
{
	$("#upload_kiad").css("display","none")
	$("#Kiadas"+id).css("display","none")
	$("#mod_kiad").css("display","inline")
	$("#cc_mod").css("display","inline")
	
	$.ajax(
	{
		type:"POST",
		url:"<?php echo base_url(); ?>" +"index.php/Koltsegterv/editBevetelRow",
		data:{'id':id},
		success:function(result)
		{
		exp=result.split(",");
		//console.log(result);
		$("#rovat").val(Number(exp[0]));
		$("#afaKulcs").val(exp[1]);
		$("#megnevezes").val(exp[2]);
		$("#egysegAr").val(exp[3]);
		$("#mennyiseg").val(exp[4]);
		$("#mertekegyseg").val(exp[5]);
		$("#kltsgEve").val(exp[6]);
		$("#honap").val(exp[7]);
		$("#seged").html(id);
		
		}
		});
}
function ajaxModBevetel()
{
	var megnevezes=$("#megnevezes").val();
	var egysegAr=$("#egysegAr").val();
	var mennyiseg=$("#mennyiseg").val();
	var rovat=$("#rovat").val();
	var afa=$("#afaKulcs").val();
	var ev=$("#kltsgEve").val();
	var mertekegyseg=$("#mertekegyseg").val();
	var id=$("#seged").html();
	var honap=$("#honap").val();
	console.log("megnevezes="+megnevezes+"?egysegAr="+egysegAr+"?mennyiseg="+mennyiseg);
	if(rovat=="999" || afa=="999" || mertekegyseg=="999" || megnevezes=="" || egysegAr=="" || mennyiseg=="" || honap=="999")
	{
		if(rovat=="999")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket ");
		$("#errorRovat").css("color","red");
		}
		if(afa=="999")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorAfa").css("color","red");
		}
	
		if(mertekegyseg=="999")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorMertek").css("color","red");
		}
		if(megnevezes=="")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorMegnev").css("color","red");
		}
		if(egysegAr=="")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorBrutto").css("color","red");
		}
		if(mertekegyseg=="999")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorMennyiseg").css("color","red");
		}
		if(honap=="999")
		{
		$("#errorMsgForm").html("Kérlek Töltsd ki a pirossal megjelőlt részeket");
		$("#errorHonap").css("color","red");
		}
	}
	else{
	$.ajax(
	{
			type:"POST",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/modBevetel",
		data:{'megnevezes':megnevezes,"egysegAr":egysegAr,"mennyiseg":mennyiseg,"rovat":rovat,"ev":ev,"id":id,"afa":afa,"honap":honap},
		success:function(result)
		{
			console.log(result+"jee")
		showBev();
		}

	});
	
	}
}
</script>