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

function showKiad(){
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