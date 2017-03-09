//globális változók

///////////////////////////////////////////////////
$(document).ready(function(){
	//Bejelentkezés
	$("#login").click(function()
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
						document.cookie="KEname="+html;
						document.cookie="Page=main";
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
	});
	});
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
						getAlEgysegName();
						getEgysegName();
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
function showBev(){


	document.getElementById("kiadful").style.display = "none";
	document.getElementById("info").style.display = "none";
	document.getElementById("bevful").style.display = "inline";
			document.getElementById("send").style.display = "inline";
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
	$.ajax(
	{
		type:"POST",
		url:"ajax/getAllRovat.php",
		success:function(result)
				{
					//console.log(result);
					$("#rovat").html(result);
				
				}
	});				
					
//Áfa kulcsok betöltése					
					
		$.ajax(
	{
		type:"POST",
		url:"ajax/getAllAfa.php",
		success:function(result)
				{
					//console.log(result);
					$("#afaKulcs").html(result);
				
				}
	});							
//Mértékegységek betöltése					
					
		$.ajax(
	{
		type:"POST",
		url:"ajax/getAllMertek.php",
		success:function(result)
				{
					//console.log(result);
					$("#mertekegyseg").html(result);
				
				}
	});				
	$.ajax(
	{
		type:"POST",
		url:"ajax/getKiadas1.php",
		success:function(result)
				{
					//console.log(result);
					$("#meglevoKoltseg").html(result);
				
				}
	});								
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					

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
function setRovatKiadas()
{
	var rovat=$("#rovat").val();
	document.cookie="rovatKiadas="+rovat;	
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
function confirmExit()
{
	var x = confirm("Biztosan ELVETI a költségtervezetet?\n\nHa az OK-t választja a munkája törlésre kerül és később sem folytathatja azt!");
		if (x){
		ajaxLoad('main');}
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