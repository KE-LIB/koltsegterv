<div id="mainPage">
<div class="options">
		<button type="button" onclick="ajaxLoad('list')" class="btn btn-primary btn-lg opt-btn">
			<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span><br>Saját tervezetek
		</button>
		<button type="button" onclick='ajaxLoad("newForm")' id="newForm" name="newForm" class="btn btn-success btn-lg opt-btn">
			<span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span><br>Új költségtervezet
		</button>
	<button type="button" onclick='ajaxLoad("download")' class="btn btn-warning btn-lg opt-btn">
			<span class="glyphicon glyphicon-save" aria-hidden="true"></span><br>Letöltések
			</button>		
				<button  type="button" onclick="ajaxLoad('admin')" class="btn btn-danger btn-lg opt-btn">
			<span class="glyphicon glyphicon-king" aria-hidden="true"></span><br>Admin
			</button>
	</div>
	</div>
	<script>
 function ajaxLoad(mit)
{
	
	$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/loadPage',
			data:"mit="+mit,
			success:function(result)
				{
					//console.log(result)
					$("#mainPage").html(result);
				}
	});
}
	

function ajaxALoad(mit)
{
	$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/loadAPage/'+mit,
			data:"mit="+mit,
			success:function(result)
				{
					//console.log(result)
					$("#mainPage").html(result);
				}
	});
}
function szamol(){
setTimeout(function() {
	var bevOssz=document.getElementById("buruttOsszesBev").innerHTML;
 var kiadOssz=document.getElementById("buruttOsszesKiad").innerHTML;
 var egyenleg=Number(bevOssz)-Number(kiadOssz);
 document.getElementById("bevetelossz").innerHTML=bevOssz;
 document.getElementById("kiadasossz").innerHTML=kiadOssz;
 document.getElementById("egyenleg").innerHTML=egyenleg;
 
 document.getElementById("egyseg").innerHTML=document.getElementById("inst").innerHTML;
 document.getElementById("alegyseg").innerHTML=document.getElementById("unit").innerHTML;
 
 if(egyenleg>=0)
		{
			document.getElementById("merleg_cimer").className="merleg_cimke alert alert-success merleg";
			document.getElementById("merleg_table").className="merleg_table_green";
		}
		else
		{
			document.getElementById("merleg_cimer").className="merleg_cimke alert alert-danger merleg";
			document.getElementById("merleg_table").className="merleg_table_red";
		}},500);
}
function logOut()
{
	$.ajax(
	{
		type:"GET",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/logOut",
		success:function(result)
				{
					$("#overPage").html(result);
				}
	});	
			document.cookie = "alegyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "egyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "rovatKiadas=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "afaKulcs=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "mertekegyseg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "ev=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
			document.cookie = "userid=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/newkoltsegterv/koltsegterv;";
	
}
</script>