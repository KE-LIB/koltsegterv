 <div class="panel panel-primary panel-transparent">
  <div class="panel-body-info">
  Üdvözöljük <?php 
  if(isset($user))
  {
	  echo $user;
	  } 
	  ?>
  	<br>
	<button  type="button" class="btn btn-primary btn-panel" onclick="ajaxLoad('main')"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Főmenü</button>
	<button  type="button" class="btn btn-danger btn-panel" onclick="logOut()"><span class="glyphicon glyphicon-log-out" aria-hidden="true">Kijelentkezés</button>
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
</script>