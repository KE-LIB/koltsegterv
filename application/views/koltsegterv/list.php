	<h2 style="margin-left:20px;">Saját tervezetek</h2>
		<div class="container">
			<ul class="nav nav-tabs">
			
			<li ><a data-toggle="tab" href="#kuldott"  onclick="sendPlans()" >Elküldött tervezetek</a></li>
			<li ><a data-toggle="tab" href="#mentett" onclick="savedPlans()" >Mentett tervezetek</a></li>
			</ul>
			</div>
			</div>
			</div>
			</div>
			</div>
		<div id="plansData">
		
		</div>
		</div>
		<script>
	function savedPlans()
{
	
	$.ajax(
	{
		type:"GET",
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/getSavedPlansList",
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
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/getSendPlansList",
		success:function(result)
				{
					$("#plansData").html(result);
					//console.log(result);
				}
	});	
}
function getViewPlan(record)
{
	//console.log(record);
	$.ajax(
	{
		type:"POST",
		data:'id='+record,
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/getViewPlan",
		success:function(result)
				{
					$("#mainPage").html(result);
					//console.log(result);
				}
	});	
	szamol()
}
function changePlace(sub,form,row_id)
{
	place=$("#inst_unit_"+row_id).val();
	//console.log(place)
	$.ajax(
	{
		type:"GET",
		data:{"sub":sub,"form":form,"place":place},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/changedPlansPlace",
		success:function(result)
				{
					console.log(result);
				}
	});	
	if(form==="S")
	{
		setTimeout(function() {savedPlans();},200);
	}
	else
	{
	setTimeout(function() {sendPlans();},200);
	}
}
//terv törlése
function deletePlane(sub,form)
{
	$.ajax(
	{
		type:"GET",
		data:{"sub":sub,"form":form},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/deletePlane",
		success:function(result)
				{
					console.log(result);
				}
	});	
	if(form==="S")
	{
		setTimeout(function() {savedPlans();},300);
	}
	else
	{
	setTimeout(function() {sendPlans();},300);
	}
}
//terv feladás
function sendPlane(sub)
{
	$.ajax(
	{
		type:"GET",
		data:{"sub":sub},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/sendSavedPlane",
		success:function(result)
				{
					console.log(result);
				}
	});	
	
	setTimeout(function() {savedPlans();},300);
	
}
//tervek szerkesztése
function editWork(sub,form,row_id)
{
var  place=$("#inst_unit_"+row_id).val();
var	 exp=place.split("#");
$.ajax(
	{
		type:"GET",
		data:{"sub":sub,"form":form},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/editWork",
		success:function(result)
				{
					console.log(result);
				}
	});	

	setTimeout(function() {
		var egyseg=exp[0];
		var alegyseg=exp[1];
		$.ajax(
	{
		type:"POST",
		data:{"egyseg":egyseg,"alEgyseg":alegyseg},
		url:"<?php echo base_url(); ?>" + "index.php/Koltsegterv/loadForm",
		success:function(result)
				{
					$("#mainPage").html(result);
				}
	});
	},500);
	
}
		</script>