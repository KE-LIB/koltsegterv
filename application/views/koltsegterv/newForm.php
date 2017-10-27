<div id="content1">
			<h2>1. Egység kiválasztása</h2>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="dropdown">
					<select  id="egyseg"  onchange="ajaxGetAlegyseg()" class="form-control" name="institute" autofocus >
					</select>
					</form>
					</div>
				</div>
		  </div>
		</div>
		<div id="content2">
			<h2>2. Alegység kiválasztása</h2><div class="panel panel-default"><div class="panel-body"><div class="dropdown">
			<select id="alEgyseg" onchange="ajaxJovahagy()"class="form-control" name="unit" autofocus >
			<option value="999">Válasszon...</option>
					
						</select></div></div></div>
						
						
		</div>
		
		
		<h2>3. Jóváhagyás</h2><div class="panel panel-default"><div class="panel-body"><p>Tovább a költségtervezet kitöltéséhez.</p>
		
		
		<input type="button" style="display:none;" id="jovahagyOK" class="btn btn-success" onclick="newKoltseg()" value="Ok" autofocus>&nbsp;&nbsp;<input type="button" class="btn btn-warning" value="Mégse" onclick="ajaxLoad('main')" ></div></div>
		
	
</div>
<script>
$(function() {
   getEgyseg()
});
function getEgyseg()
{
	$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/getEgyseg',
			success:function(result)
				{
					//console.log(result)
					$("#egyseg").html(result);
				}
	});
}
function ajaxGetAlegyseg()
{
	var egyseg=$("#egyseg").val();
	$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/ajaxGetAlegyseg',
			data:"egyseg="+egyseg,
			success:function(result)
				{
					//console.log(result)
					$("#alEgyseg").html(result);
				}
	});
}
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
function ajaxLoad(mit)
{
	if (mit=="form")
	{
	var egyseg=$("#egyseg").val();
	var alegyseg=$("#alEgyseg").val();
		$.ajax(
	{
		type:"POST",
			url: "<?php echo base_url(); ?>" + 'index.php/Koltsegterv/loadForm',
			data:{"egyseg":egyseg,"alEgyseg":alegyseg},
			success:function(result)
				{
					//console.log(result)
					$("#mainPage").html(result);
				}
	});
	}
	else{
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
}
function newKoltseg()
{
	
	var egyseg=$("#egyseg").val();
	var alegyseg=$("#alEgyseg").val();
	document.cookie="egyseg="+egyseg;
	document.cookie="alegyseg="+alegyseg;
	ajaxLoad("form");
}
</script>
