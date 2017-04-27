//globális változók
var  osszKiad=0;
var  osszBev=0;
var delay=50//0,05 sec
var delay2=500//0,5 sec
///////////////////////////////////////////////////
//bejelntkezés
function login()
{
	username=$("#inputEmail").val();
	psw=$("#inputPassword").val();	
	
				$.ajax(
			{
				type:"POST",
				url:"ajax/login.php",
				data:"email="+username+"&psw="+psw,
				success:function(html)
				{
					//ha nem false szöveget ad vissza
					if(html!="false")
					{
						document.getElementById("errorMsg").innerHTML = " ";
						var xmlhttp = new XMLHttpRequest();
						var exp=html.split(" ");
						document.cookie="KEname="+exp[0]+" "+exp[1];
						document.cookie="Page=main";
						document.cookie="lvl="+exp[2];
						xmlhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								document.getElementById("mainPage").innerHTML = this.responseText;
							}
						};
						
						xmlhttp.open("GET", "view/main.php", true);
						xmlhttp.send();
						var xmlhttp = new XMLHttpRequest();
						xmlhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								document.getElementById("topLeft").innerHTML = this.responseText;
							}
						};
						xmlhttp.open("GET", "view/topLeft.php", true);
						xmlhttp.send();
						
						
					}
					else
					{
						var xmlhttp = new XMLHttpRequest();
						xmlhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								
								document.getElementById("errorMsg").innerHTML = this.responseText;
							}
						};
						xmlhttp.open("GET", "error/loginError.php", true);
						xmlhttp.send();	
					}
				}
			});
}
//simaoldal betöltés
function ajaxLoad(mit)
		{
		if(mit=="newForm")
		{
			ajaxGetEgyseg();
		}
		if(mit=="main")
		{
			document.cookie = "alegyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "egyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "rovatKiadas=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "afaKulcs=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "mertekegyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			
			
		}
		if(mit=="form")
		{
			getAlEgysegName();
			getEgysegName();	
			setTimeout(function() {showKiad();},delay);
		}
		if(mit=="download")
		{	
			setTimeout(function() {egysegenkentiLista();},delay);
		}
		document.cookie="Page="+mit;
		var xmlhttp = new XMLHttpRequest();
						xmlhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								document.getElementById("mainPage").innerHTML = this.responseText;
							}
						};
						xmlhttp.open("GET", "view/"+mit+".php", true);
						xmlhttp.send();
						ajaxLoadTopLeft();
		setTimeout(function() {checkPriv();},500);
	}
//betöltö a bal felső menüt
function ajaxLoadTopLeft()
		{
		
		var xmlhttp = new XMLHttpRequest();
						xmlhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								document.getElementById("topLeft").innerHTML = this.responseText;
							}
						};
						xmlhttp.open("GET", "view/topLeft.php", true);
						xmlhttp.send();
	}
//cookiek értékének kinyerése
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}
if(getCookie("Page")!="")
{
	var mit=getCookie("Page");
	ajaxLoad(mit);
}
//új költségtervezetnél az egységek kiszedése
function ajaxGetEgyseg()
{
	document.cookie="Page=newForm";
$.ajax(
			{
				type:"POST",
				url:"ajax/getEgyseg.php",
				success:function(result)
				{
					//console.log(result);
					$("#egyseg").html(result)
				}
				});
}
//egységhez tartozó alegység kiszedése
function ajaxGetAlegyseg()
{
	var egyseg=$("#egyseg").val();
	$.ajax(
	{
		type:"POST",
		url:"ajax/getAlegyseg.php",
		data:"egyseg="+egyseg,
		success:function(result)
				{
					//console.log(result);
					$("#alEgyseg").html(result);
				
				}
	});
	
}
//új koltségtervező megnyitásához szükséges gomb megjelenítése
function ajaxJovahagy()
{
	var alEgyseg=$("#alEgyseg").val();
		//console.log(alEgyseg);
	if(alEgyseg!=999)
		{
			$("#jovahagyOK").css('display','');
		}
	else
	{
		$("#jovahagyOK").css('display','none');
	}
	
}
//új koltségtervező megnyitása
function newKoltseg()
{
	var egyseg=$("#egyseg").val();
	var alegyseg=$("#alEgyseg").val();
	document.cookie="egyseg="+egyseg;
	document.cookie="alegyseg="+alegyseg
	document.getElementById("errorMsg").innerHTML = " ";
						var xmlhttp = new XMLHttpRequest();
						document.cookie="Page=form";
						xmlhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								document.getElementById("mainPage").innerHTML = this.responseText;
							}
						};
						xmlhttp.open("GET", "view/form.php", true);
						xmlhttp.send();
						setTimeout(function() {getAlEgysegName();},500);		
						setTimeout(function() {getEgysegName();},500);		
}
//egység neve
function getEgysegName()
{
	$.ajax(
	{
		type:"POST",
		url:"ajax/getEgysegName.php",
		success:function(result)
				{
					//console.log(result);
					$("#egyseg").html(result);
				
				}
	});	
}
//alegység neve
function getAlEgysegName()
{
	$.ajax(
	{
		type:"POST",
		url:"ajax/getAlegysegName.php",
		success:function(result)
				{
					//console.log(result);
					$("#alegyseg").html(result);
				
				}
	});
}
//bevétele megjelenítése és feltöltése
function showBev(){
getAlEgysegName();
getEgysegName();
	var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("koltsegfel").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "view/bevetel.php", true);
					xmlhttp.send();
					
//Rovatok betöltése
	setTimeout(function() {
		$.ajax(
	{
		type:"POST",
		url:"ajax/getAllBevRovat.php",
		success:function(result)
				{
					//console.log(result);
					$("#rovat").html(result);
				
				}
	});	},500);		
					
//Áfa kulcsok betöltése					
					
	setTimeout(function() {	$.ajax(
	{
		type:"POST",
		url:"ajax/getAllAfa.php",
		success:function(result)
				{
					//console.log(result);
					$("#afaKulcs").html(result);
				
				}
	});		},500);					
//Mértékegységek betöltése					
					
	setTimeout(function() {	$.ajax(
	{
		type:"POST",
		url:"ajax/getAllMertek.php",
		success:function(result)
				{
					//console.log(result);
					$("#mertekegyseg").html(result);
				
				}
	});	},500);	
	
	setTimeout(function() { $.ajax(
	{
		type:"POST",
		url:"ajax/getBevetel1.php",
		success:function(result)
				{
					//console.log(result);
					$("#meglevoKoltseg").html(result);
				
				}
	});		},500);	
setTimeout(function() {getEgyenleg()},delay);
}

function delBevRow(id)
{
	
	$.ajax(
	{
		type:"POST",
		url:"ajax/delBevetelRow.php",
		data:{'id':id},
		success:function(result)
		{
		console.log(result)
		showBev();
		}
		});
}
//bevételek felvitele
function ajaxAddBevetel()
{
	var megnevezes=$("#megnevezes").val();
	var egysegAr=$("#egysegAr").val();
	var mennyiseg=$("#mennyiseg").val();
	var rovat=$("#rovat").val();
	var afa=$("#afaKulcs").val();
	var mertekegyseg=$("#mertekegyseg").val();
	//console.log("megnevezes="+megnevezes+"?egysegAr="+egysegAr+"?mennyiseg="+mennyiseg);
	if(rovat=="999" || afa=="999" || mertekegyseg=="999" || megnevezes=="" || egysegAr=="" || mennyiseg=="")
	{
		if(rovat=="999")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket ";
		document.getElementById("errorRovat").style.color="red";
		}
		if(afa=="999")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket";
		document.getElementById("errorAfa").style.color="red";
		}
	
		if(mertekegyseg=="999")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket";
		document.getElementById("errorMertek").style.color="red";
		}
		if(megnevezes=="")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket";
		document.getElementById("errorMegnev").style.color="red";
		}
		if(egysegAr=="")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket";
		document.getElementById("errorBrutto").style.color="red";
		}
		if(mertekegyseg=="999")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket";
		document.getElementById("errorMennyiseg").style.color="red";
		}
	}
	else{
	$.ajax(
	{
		type:"POST",
		url:"ajax/addBevetel.php",
		data:{'megnevezes':megnevezes,"egysegAr":egysegAr,"mennyiseg":mennyiseg,"rovat":rovat},
		success:function(result)
		{
		showBev();
		}

	});
	
	}
}
//bevitt bevételei sor szerkesztése
function editBevRow(id)
{
	$.ajax(
	{
		type:"POST",
		url:"ajax/getBevetelRow.php",
		data:{'id':id},
		success:function(result)
		{
		exp=result.split(",");
		$("#rovat").val(exp[0]);
		$("#afaKulcs").val(exp[1]);
		$("#megnevezes").val(exp[2]);
		$("#egysegAr").val(exp[3]);
		$("#mennyiseg").val(exp[4]);
		$("#mertekegyseg").val(exp[5]);
		document.getElementById("Bevetel"+id).style.display="none";
		}
		});
}
function sumBev()
{
	$.ajax(
	{
		type:"POST",
		url:"ajax/getBevetelSum.php",
		success:function(result)
		{
			osszBev=result;
			document.getElementById("bevetelossz").innerHTML=osszBev;	
		}
		});
	
}
//kiadás megjelenítése+ amit eddig felvittünk
function showKiad(){
	getAlEgysegName();
	getEgysegName();
	var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("koltsegfel").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "view/kiadas.php", true);
					xmlhttp.send();
					
//Rovatok betöltése
	setTimeout(function() {$.ajax(
	{
		type:"POST",
		url:"ajax/getAllRovat.php",
		success:function(result)
				{
					//console.log(result);
					$("#rovat").html(result);
				
				}
	});			},500);		
					
//Áfa kulcsok betöltése					
					
	setTimeout(function() {	$.ajax(
	{
		type:"POST",
		url:"ajax/getAllAfa.php",
		success:function(result)
				{
					//console.log(result);
					$("#afaKulcs").html(result);
				
				}
	});				},500);				
//Mértékegységek betöltése					
					
	setTimeout(function() {	$.ajax(
	{
		type:"POST",
		url:"ajax/getAllMertek.php",
		success:function(result)
				{
					//console.log(result);
					$("#mertekegyseg").html(result);
				
				}
	});	},500);				
	setTimeout(function() {$.ajax(
	{
		type:"POST",
		url:"ajax/getKiadas1.php",
		success:function(result)
				{
					//console.log(result);
					$("#meglevoKoltseg").html(result);
				
				}
	});	},500);	
setTimeout(function() {getEgyenleg()},delay);	
}
function getEgyenleg()
{		
			sumKiad()
			sumBev()
			setTimeout(function() {
				var egyenleg=Number(osszBev)-Number(osszKiad);
			//console.log(osszBev+","+osszKiad);
			document.getElementById("egyenleg").innerHTML=egyenleg;
			//console.log(egyenleg);
		if(egyenleg>=0)
		{
			document.getElementById("merleg_cimer").className="merleg_cimke alert alert-success merleg";
			document.getElementById("merleg_table").className="merleg_table_green";
		}
		else
		{
			document.getElementById("merleg_cimer").className="merleg_cimke alert alert-danger merleg";
			document.getElementById("merleg_table").className="merleg_table_red";
		}},delay);
}
function ajaxAddKiadas()
{
	var megnevezes=$("#megnevezes").val();
	var egysegAr=$("#egysegAr").val();
	var mennyiseg=$("#mennyiseg").val();
	var rovat=$("#rovat").val();
	var afa=$("#afaKulcs").val();
	var mertekegyseg=$("#mertekegyseg").val();
	//console.log("megnevezes="+megnevezes+"?egysegAr="+egysegAr+"?mennyiseg="+mennyiseg);
	if(rovat=="999" || afa=="999" || mertekegyseg=="999" || megnevezes=="" || egysegAr=="" || mennyiseg=="")
	{
		if(rovat=="999")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket ";
		document.getElementById("errorRovat").style.color="red";
		}
		if(afa=="999")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket";
		document.getElementById("errorAfa").style.color="red";
		}
	
		if(mertekegyseg=="999")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket";
		document.getElementById("errorMertek").style.color="red";
		}
		if(megnevezes=="")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket";
		document.getElementById("errorMegnev").style.color="red";
		}
		if(egysegAr=="")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket";
		document.getElementById("errorBrutto").style.color="red";
		}
		if(mertekegyseg=="999")
		{
		document.getElementById("errorMsgForm").innerHTML="Kérlek Töltsd ki a pirossal megjelőlt részeket";
		document.getElementById("errorMennyiseg").style.color="red";
		}
	}
	else{
	$.ajax(
	{
		type:"POST",
		url:"ajax/addKiadas.php",
		data:{'megnevezes':megnevezes,"egysegAr":egysegAr,"mennyiseg":mennyiseg,"rovat":rovat},
		success:function(result)
		{
		showKiad();
		}

	});
	
	}
}
function delKiadRow(id)
{
	
	$.ajax(
	{
		type:"POST",
		url:"ajax/delKiadasRow.php",
		data:{'id':id},
		success:function(result)
		{
		console.log(result)
		showKiad();
		}
		});
}
function editKiadRow(id)
{
	$.ajax(
	{
		type:"POST",
		url:"ajax/getKiadasRow.php",
		data:{'id':id},
		success:function(result)
		{
		exp=result.split(",");
		$("#rovat").val(exp[0]);
		$("#afaKulcs").val(exp[1]);
		$("#megnevezes").val(exp[2]);
		$("#egysegAr").val(exp[3]);
		$("#mennyiseg").val(exp[4]);
		$("#mertekegyseg").val(exp[5]);
		document.getElementById("Kiadas"+id).style.display="none";
		}
		});
}
function sumKiad()
{
	$.ajax(
	{
		type:"POST",
		url:"ajax/getKiadasSum.php",
		success:function(result)
		{
		osszKiad=result;
		document.getElementById("kiadasossz").innerHTML=osszKiad;	
		}
		});

}
function setRovat()
{
	var rovat=$("#rovat").val();
	document.cookie="rovat="+rovat;	
	document.getElementById("errorRovat").style.color="black"
}
function setAfa()
{
	var afa=$("#afaKulcs").val();
	document.cookie="afaKulcs="+afa;	
	document.getElementById("errorAfa").style.color="black"
}
function setMertek()
{
	var mertekegyseg=$("#mertekegyseg").val();
	document.cookie="mertekegyseg="+mertekegyseg;
	document.getElementById("errorMertek").style.color="black";	
}
function showInfo(){
	
	
		document.getElementById("bevful").style.display = "none";
		document.getElementById("kiadful").style.display = "none";
		document.getElementById("send").style.display = "none";
		document.getElementById("info").style.display = "inline";
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
		url:"ajax/confirmAndSave.php",
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
		url:"ajax/confirmAndSend.php",
		success:function(result)
				{
					console.log(result);
				}
	});	
	ajaxLoad("main");
}
function ellenoriz(erromsg,mit)
{
	if(document.getElementById(mit).value=="")
	{
		document.getElementById(erromsg).style.color="red";
	}
	else
	{
		document.getElementById(erromsg).style.color="black";
	}
	
}
//h mainbe valki vissza megy kitörli a submission táblákat
function clearSubmission()
{
	$.ajax(
	{
		type:"GET",
		url:"ajax/clearSubmission.php",
		success:function(result)
				{
					console.log(result);
				}
	});	
}
//kilistázza a mentett terveket
function savedPlans()
{
	
	$.ajax(
	{
		type:"GET",
		url:"ajax/getSavedPlansList.php",
		success:function(result)
				{
					
					$("#plansData").html(result);
					//console.log(result);
				}
	});	
}
//kilistázza az elküldött terveket
function sendPlans()
{
	
	$.ajax(
	{
		type:"GET",
		url:"ajax/getSendPlansList.php",
		success:function(result)
				{
					$("#plansData").html(result);
					//console.log(result);
				}
	});	
}
//terveknél a hely módosítás
function changePlace(sub,form,row_id)
{
	place=$("#inst_unit_"+row_id).val();
	//console.log(place)
	$.ajax(
	{
		type:"GET",
		data:{"sub":sub,"form":form,"place":place},
		url:"ajax/changedPlansPlace.php",
		success:function(result)
				{
					console.log(result);
				}
	});	
	if(form==="S")
	{
		setTimeout(function() {savedPlans();},delay);
	}
	else
	{
	setTimeout(function() {sendPlans();},delay);
	}
}
//terv törlése
function deletePlane(sub,form)
{
	$.ajax(
	{
		type:"GET",
		data:{"sub":sub,"form":form},
		url:"ajax/deletePlane.php",
		success:function(result)
				{
					console.log(result);
				}
	});	
	if(form==="S")
	{
		setTimeout(function() {savedPlans();},delay);
	}
	else
	{
	setTimeout(function() {sendPlans();},delay);
	}
}
//terv feladás
function sendPlane(sub)
{
	$.ajax(
	{
		type:"GET",
		data:{"sub":sub},
		url:"ajax/sendSavedPlane.php",
		success:function(result)
				{
					console.log(result);
				}
	});	
	
	setTimeout(function() {savedPlans();},delay);
	
}
//tervek szerkesztése
function editWork(sub,form,row_id)
{
var  place=$("#inst_unit_"+row_id).val();
var	 exp=place.split("#");
document.cookie="egyseg="+exp[0];
document.cookie="alegyseg="+exp[1];
$.ajax(
	{
		type:"GET",
		data:{"sub":sub,"form":form},
		url:"ajax/editWork.php",
		success:function(result)
				{
					console.log(result);
				}
	});	

	setTimeout(function() {ajaxLoad("form")},delay2);
	
}
//kijelentkezés
function logOut()
{
	$.ajax(
	{
		type:"GET",
		url:"ajax/logOut.php",
		success:function(result)
				{
					console.log(result);
				}
	});	
	document.cookie = "alegyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "egyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "rovatKiadas=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "afaKulcs=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "mertekegyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
	var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("overPage").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "index.php", true);
					xmlhttp.send();
}
//jogusultság ellenőrzése
function checkPriv()
{
if(getCookie("lvl")=="1")
{
	
	$("#privi").show();
}	
}
//egységenkénti listázás letöltéshez
function egysegenkentiLista()
{
		$.ajax(
	{
		type:"GET",
		url:"ajax/getEgysegenkentiLista.php",
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
	$("#downloads_Egyseg_"+id).html("<span class='glyphicon glyphicon-floppy-disk'>folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		data:{'id':id},
		url:"ajax/makeAnEgyseg.php",
		success:function(result)
				{
					$("#downloads_Egyseg_"+id).html(result);
				}
	});	
} 
//Alegységenkénti analitikus lista
function makeAnAlEgyseg(id,iid)
{
	$("#downloads_AlEgyseg_"+iid+"_"+id).html("<span class='glyphicon glyphicon-floppy-disk'>folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		data:{'id':id},
		url:"ajax/makeAnAlEgyseg.php",
		success:function(result)
				{
					$("#downloads_AlEgyseg_"+iid+"_"+id).html(result);
				}
	});	
} 
//recordonkénti analitikus lista
function makeAnRecord(id,iid)
{
	$("#downloads_record_"+id+"_"+iid).html("<span class='glyphicon glyphicon-floppy-disk'>folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		data:{'id':id,'uid':iid},
		url:"ajax/makeAnRecord.php",
		success:function(result)
				{
					$("#downloads_record_"+id+"_"+iid).html(result);
				}
	});	
} 
//teljes analitikus lista
function analyticsFull()
{
	$("#downloads_full").html("<span class='glyphicon glyphicon-floppy-disk'>folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		url:"ajax/makeAnFull.php",
		success:function(result)
				{
					$("#downloads_full").html(result);
				}
	});	
} 
//teljes agregált lista
function aggregateFull()
{
	$("#downloads_full").html("<span class='glyphicon glyphicon-floppy-disk'>folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		url:"ajax/makeAgFull.php",
		success:function(result)
				{
					$("#downloads_full").html(result);
				}
	});	
} 

//Egységenkénti agregált lista
function aggregateEgyseg(id)
{
	console.log(id)
	$("#downloads_Egyseg_"+id).html("<span class='glyphicon glyphicon-floppy-disk'>folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		data:{'id':id},
		url:"ajax/makeAgEgyseg.php",
		success:function(result)
				{
					$("#downloads_Egyseg_"+id).html(result);
				}
	});	
} 
//Alegységenkénti agregált lista
function makeAgAlEgyseg(id,iid)
{
	
	$("#downloads_AlEgyseg_"+iid+"_"+id).html("<span class='glyphicon glyphicon-floppy-disk'>folyamatban</span>")
	$.ajax(
	{
		type:"GET",
		data:{'id':id},
		url:"ajax/makeAgAlEgyseg.php",
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
		url:"ajax/deleteFile.php",
		success:function(result)
				{
					console.log(result)
				}
	});	},2000);	
}