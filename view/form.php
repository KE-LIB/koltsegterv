<?php
//echo'egyseg'.$_GET['egyseg'].' alegyseg:'.$_GET['alegyseg'];
?>
  

<div class="row_own">
	  <div class="col-xs-4 col-md-4">
	  <div class="merleg_cimke alert alert-success merleg"><table class="merleg_table_green" ><thead>
	  <tr ><th >&nbsp;Bevételek&nbsp;</th><th >&nbsp;Kiadások&nbsp;</th></tr></thead>
	  <tr  ><td >&nbsp;<span id="bevetel">-</span>&nbsp;</td><td >&nbsp;<span id="kiadas">-</span>&nbsp;</td></tr>
	  <tr ><th colspan="2">Egyenleg:</th></tr>
	  <tr ><td colspan="2"><span id="egyenleg">-</span></td></tr>
	  </tbody></tobdy></table>

		</div>

		</div>
		<div class="col-xs-8 col-md-8">
		<div class="alert alert-info place"><div class="place-text"><strong>Hely:</strong>
		<oreo id="egyseg">-</oreo><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"><oreo id="alegyseg">-</oreo></span>
		 </div>
		 </div>
 </div>
<div class="container">
<ul class="nav nav-tabs">



<li class="active" ><a data-toggle="tab" href="#kiadful" onclick="showKiad()" id="0">Kiadások</a></li>
 <li><a data-toggle="tab" href="#bevful" onclick="showBev()" id="1">Bevételek</a></li>
 <li class=""><a data-toggle="tab" href="#info" onclick="showInfo()" >Útmutató</a></li>'
</ul>
<div id="koltsegfel">
</div>
 </div>
 <div id="send">


	<div class="panel panel-default"><div class="panel-body"><p>
	A teljes költségtervezet (bevétel / kiadás) beküldéséhez, kattintson a MENTÉS ÉS FELADÁS gombra, a tervezet elvetéséhez válassza az ELVETÉS gombot, 
	ha később szeretné folytatni a megkezdett munkát, akkor válassza a MENTÉS ÉS KILÉPÉS opciót.<br>A mentett és elküldött munkáit a 
	FŐMENÜ > SAJÁT TERVEZETEK menüpont alat érheti el.</p>
	

	<button type="button" onclick="return confirmSave()"  class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>&nbsp;Mentés és kilépés</button>
	<button type="button" onclick="return confirmSend()" class="btn btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;Mentés és feladás</button>
	<button type="button" onclick="return confirmExit()" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>&nbsp;Elvetés</button>

	
	
	</div></div></div>
	</div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

<script>
var active = '<?php echo $active; ?>';
var inst = '<?php echo $inst;?>';
var unit = '<?php echo $unit;?>';
	
	
	function confirmChangePlace(){
		
		var x = confirm("Ha elhagyja az oldalt, akkor az el nem mentett módosításai el fognak veszni!\n\nA HELY módosításához MENTÉS után válassz a FŐMENÜ > SAJÁT TERVEZETEK menüpontot.\n\nHa ki szeretne lépni válassza az OK gombot.");
		if (x){
			location.href="form.php?institute="+inst+"&unit="+unit+"&discard_changes=1&rows=1&bev_rows=1&active_tab=kiad";
		}else{
			return false;
		}
	}
	
	
	function confirmSave(){
		
		var x = confirm("MENTI a költségtervezetet és KILÉP a főmenübe?\n\nMentett munkáit a FŐMENÜ > SAJÁT TERVEZETEK opció alatt érheti el!");
		if (x){
			
			location.href="form.php?institute="+inst+"&unit="+unit+"&save_exit=1&rows=1&bev_rows=1&active_tab=kiad";
		}else{
			return false;
		}
	}
		function confirmSend(){
		
		var x = confirm("Biztosan ELKÜLDI a költségtervezetet?\n\nA költségtervezet továbbításra kerül a pénzügy felé. Elküldött munkáit a FŐMENÜ > SAJÁT TERVEZETEK opció alatt érheti el! ");
		if (x){
			location.href="form.php?institute="+inst+"&unit="+unit+"&save_send=1&rows=1&bev_rows=1&active_tab=kiad";
		}else{
			return false;
		}
	}



(function(){
	if(active==0){
		
		showKiad();
	}else if(active==1){
		showBev();
	}
	})();




//formázás
function format(comma, period) {
  comma = comma || ',';
  period = period || '.';
  var split = this.toString().split('.');
  var numeric = split[0];
  var decimal = split.length > 1 ? period + split[1] : '';
  var reg = /(\d+)(\d{3})/;
  while (reg.test(numeric)) {
    numeric = numeric.replace(reg, '$1' + comma + '$2');
  }
  return numeric + decimal;
}

$('[id=myinput]').live('keyup', function(){
    $(this).val(format.call($(this).val().split(' ').join(''),' ','.'));
});


	function options(){
		location.href="option.php";
	}
</script>

<?php


if(isset($_GET['save_exit'])){
	
	$inst = $_GET['institute'];
	$unit = $_GET['unit'];
	
	$SaveSub=$connect_db->query("INSERT INTO `kltsg_submissions` (`user_id`) VALUES ('".$userid."')");
	
	$SaveKiadas=$connect_db->query("INSERT INTO `kltsg_submissions_kiadas_saved` (`row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `created_time`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `brutto_egysegar`, `mennyiseg`, `quant`, `netto_osszes`, `afa_osszes`, `brutto_osszes`)
	SELECT id, (SELECT id FROM kltsg_submissions WHERE user_id=kltsg_submissions_kiadas.user_id ORDER BY id DESC LIMIT 1 ) AS submiss_id, sub_id, user_id, institute_id, unit_id, created_time, megnevezes, netto_egysegar, tax, category_tax_field, afa_ossz_egyseg, brutto_egysegar, mennyiseg, quant, netto_osszes, afa_osszes, brutto_osszes FROM kltsg_submissions_kiadas WHERE institute_id='".$inst."' AND unit_id='".$unit."'");
	
	$SaveBevetel=$connect_db->query("INSERT INTO `kltsg_submissions_bevetel_saved` (`row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `created_time`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `brutto_egysegar`, `mennyiseg`, `quant`, `netto_osszes`, `afa_osszes`, `brutto_osszes`)
	SELECT id, (SELECT id FROM kltsg_submissions WHERE user_id=kltsg_submissions_bevetel.user_id ORDER BY id DESC LIMIT 1 ) AS submiss_id, sub_id, user_id, institute_id, unit_id, created_time, megnevezes, netto_egysegar, tax, category_tax_field, afa_ossz_egyseg, brutto_egysegar, mennyiseg, quant, netto_osszes, afa_osszes, brutto_osszes FROM kltsg_submissions_bevetel WHERE institute_id='".$inst."' AND unit_id='".$unit."'");
	
	$deleteRows=$connect_db->query("DELETE FROM kltsg_submissions_bevetel WHERE id IN (SELECT row_id FROM kltsg_submissions_bevetel_saved)");
	
	$deleteRows=$connect_db->query("DELETE FROM kltsg_submissions_kiadas WHERE id IN (SELECT row_id FROM kltsg_submissions_kiadas_saved)");
	include ('rendez.php');
	header ("location:option.php?success");
	echo '<script>location.href="option.php?success";</script>';
	
}
if(isset($_GET['save_send'])){
require("lib/class.phpmailer.php");

	$inst = $_GET['institute'];
	$unit = $_GET['unit'];
	
	$SaveSub=$connect_db->query("INSERT INTO `kltsg_submissions` (`user_id`) VALUES ('".$userid."')");
	
	$newsub=$connect_db->query("SELECT * FROM `kltsg_submissions` WHERE user_id='".$userid."' ORDER BY created_time DESC LIMIT 1");
	$subrec=mysqli_fetch_array($newsub);
	
	$SaveKiadas=$connect_db->query("INSERT INTO `kltsg_submissions_kiadas_sent` (`row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `created_time`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `brutto_egysegar`, `mennyiseg`, `quant`, `netto_osszes`, `afa_osszes`, `brutto_osszes`)
	SELECT id, (SELECT id FROM kltsg_submissions WHERE user_id=kltsg_submissions_kiadas.user_id ORDER BY id DESC LIMIT 1 ) AS submiss_id, sub_id, user_id, institute_id, unit_id, created_time, megnevezes, netto_egysegar, tax, category_tax_field, afa_ossz_egyseg, brutto_egysegar, mennyiseg, quant, netto_osszes, afa_osszes, brutto_osszes FROM kltsg_submissions_kiadas WHERE institute_id='".$inst."' AND unit_id='".$unit."'");
	
	$SaveBevetel=$connect_db->query("INSERT INTO `kltsg_submissions_bevetel_sent` (`row_id`, `submissions_id`, `sub_id`, `user_id`, `institute_id`, `unit_id`, `created_time`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `brutto_egysegar`, `mennyiseg`, `quant`, `netto_osszes`, `afa_osszes`, `brutto_osszes`)
	SELECT id, (SELECT id FROM kltsg_submissions WHERE user_id=kltsg_submissions_bevetel.user_id ORDER BY id DESC LIMIT 1 ) AS submiss_id, sub_id, user_id, institute_id, unit_id, created_time, megnevezes, netto_egysegar, tax, category_tax_field, afa_ossz_egyseg, brutto_egysegar, mennyiseg, quant, netto_osszes, afa_osszes, brutto_osszes FROM kltsg_submissions_bevetel WHERE institute_id='".$inst."' AND unit_id='".$unit."'");
	
	$deleteRows=$connect_db->query("DELETE FROM kltsg_submissions_bevetel WHERE id IN (SELECT row_id FROM kltsg_submissions_bevetel_sent)");
	
	$deleteRows=$connect_db->query("DELETE FROM kltsg_submissions_kiadas WHERE id IN (SELECT row_id FROM kltsg_submissions_kiadas_sent)");
	
	$hely=$connect_db->query("SELECT (SELECT name FROM kltsg_institute WHERE id=kltsg_unit.parent) AS inst,name AS unit FROM kltsg_unit WHERE id=".$unit."");
	$helyrec=mysqli_fetch_array($hely);
	
	$username=$connect_db->query("SELECT * FROM `kltsg_users` WHERE id=".$userid."");
	$userec=mysqli_fetch_array($username);
	include ('rendez.php');
	///email küldés
	$email_add = 'voros.peter@ke.hu';
	$mail = new PHPMailer();
	$mail->AddAddress($email_add);
	$mail->IsSMTP();  // telling the class to use SMTP
	$mail->Host     = "193.224.52.50"; // SMTP server
	$mail->From     = "koltseg@ke.hu";
	$mail->FromName = "Kölségtervezés";
	$mail->Subject  = "Új költségtervezet: ".$helyrec['inst']." > ".$helyrec['unit'];
	$mail->Body     = "\n\nTisztelt Cím!\n\nKüldöm Önnek a(z) ".$helyrec['inst']." > ".$helyrec['unit']." költséghelyhez tartozó tervezetet.\n\nEgység analitikus: http://localhost/koltsegterv/makeanlist.php?export&type=an&user=".$userec['id']."&subm=".$subrec['id']."\n\nEgység aggregált: http://localhost/koltsegterv/makeaggrlist.php?export&type=rag&user=".$userec['id']."&subm=".$subrec['id']."\n\nTisztelettel: ".$userec['last_name']." ".$userec['first_name']."";
	$mail->WordWrap = 500;
	if(!$mail->Send()) {
			echo 'Mailer error: ' . $mail->ErrorInfo;
			echo '<script>location.href="option.php?send_fail";</script>';
	} else {
			echo '<script>location.href="option.php?send_success";</script>';
	}
	
	
	
	
}
if(isset($_GET['discard_changes'])){

	$inst = $_GET['institute'];
	$unit = $_GET['unit'];
		
	$deleteBevRow=$connect_db->query("
	DELETE FROM kltsg_submissions_bevetel 
	WHERE user_id=".$userid." AND institute_id=".$inst." AND unit_id=".$unit."");
	
	$deleteKiadRow=$connect_db->query("
	DELETE FROM kltsg_submissions_kiadas WHERE user_id=".$userid." AND institute_id=".$inst." AND unit_id=".$unit." ");

	echo '<script>location.href="option.php";</script>';
}

if(isset($_GET['upload_kiad'])){


	for($i=0;$i<count($adatok);$i++){
		
		$insertNewRow=$connect_db->query("INSERT INTO `kltsg_submissions_kiadas`
		
		(`sub_id`, `user_id`, `institute_id`, `unit_id`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `brutto_egysegar`, `mennyiseg`, `quant`, `netto_osszes`, `afa_osszes`, `brutto_osszes`) VALUES ('".$adatok[$i]['rovat_id']."','".$userid."','".$inst."','".$unit."','".$adatok[$i]['megnev']."','".$adatok[$i]['nt_egys']."','".$adatok[$i]['afk_egys']."','0','".$adatok[$i]['af_egys']."','".$adatok[$i]['bt_egys']."','".$adatok[$i]['menny']."','".$adatok[$i]['egyseg']."','".$adatok[$i]['nt_ossz']."','".$adatok[$i]['af_ossz']."','".$adatok[$i]['bt_ossz']."')");

	}
	echo '<script>location.href="form.php?institute='.$inst.'&unit='.$unit.'&rows=1&bev_rows=1&active_tab=kiad";</script>';
}
if(isset($_GET['upload_bev'])){
		
	for($i=0;$i<count($bev_adatok);$i++){

		$insertNewRow=$connect_db->query("INSERT INTO `kltsg_submissions_bevetel`
		
		(`sub_id`, `user_id`, `institute_id`, `unit_id`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `brutto_egysegar`, `mennyiseg`, `quant`, `netto_osszes`, `afa_osszes`, `brutto_osszes`) VALUES 
		
		('".$bev_adatok[$i]['rovat_id']."','".$userid."','".$inst."','".$unit."','".$bev_adatok[$i]['megnev']."','".$bev_adatok[$i]['nt_egys']."','".$bev_adatok[$i]['afk_egys']."','0','".$bev_adatok[$i]['af_egys']."','".$bev_adatok[$i]['bt_egys']."','".$bev_adatok[$i]['menny']."','".$bev_adatok[$i]['egyseg']."','".$bev_adatok[$i]['nt_ossz']."','".$bev_adatok[$i]['af_ossz']."','".$bev_adatok[$i]['bt_ossz']."')");

	}
	echo '<script>location.href="form.php?institute='.$inst.'&unit='.$unit.'&rows=1&bev_rows=1&active_tab=bev";</script>';
}
if(isset($_GET['delete_bev_row'])){
		
	$row_id = $_GET['rowid'];
	$deleteRow=$connect_db->query("DELETE FROM kltsg_submissions_bevetel WHERE id='".$row_id."'");
	echo '<script>location.href="form.php?institute='.$inst.'&unit='.$unit.'&rows=1&bev_rows=1&active_tab=bev";</script>';
}
if(isset($_GET['delete_kiad_row'])){
		
	$row_id = $_GET['rowid'];
	$deleteRow=$connect_db->query("DELETE FROM kltsg_submissions_kiadas WHERE id='".$row_id."'");
	echo '<script>location.href="form.php?institute='.$inst.'&unit='.$unit.'&rows=1&bev_rows=1&active_tab=kiad";</script>';
}
if(isset($_GET['save_edit_kiad'])){

	$row_id = $_GET['rowid'];
	$deleteRow=$connect_db->query("DELETE FROM kltsg_submissions_kiadas WHERE id='".$row_id."'");
	
	for($i=0;$i<count($adatok);$i++){
		
		$insertNewRow=$connect_db->query("INSERT INTO `kltsg_submissions_kiadas`
		
		(`sub_id`, `user_id`, `institute_id`, `unit_id`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `brutto_egysegar`, `mennyiseg`, `quant`, `netto_osszes`, `afa_osszes`, `brutto_osszes`) VALUES ('".$adatok[$i]['rovat_id']."','".$userid."','".$inst."','".$unit."','".$adatok[$i]['megnev']."','".$adatok[$i]['nt_egys']."','".$adatok[$i]['afk_egys']."','0','".$adatok[$i]['af_egys']."','".$adatok[$i]['bt_egys']."','".$adatok[$i]['menny']."','".$adatok[$i]['egyseg']."','".$adatok[$i]['nt_ossz']."','".$adatok[$i]['af_ossz']."','".$adatok[$i]['bt_ossz']."')");

	}
	echo '<script>location.href="form.php?institute='.$inst.'&unit='.$unit.'&rows=1&bev_rows=1&active_tab=kiad";</script>';
}

if(isset($_GET['save_edit_bev'])){

	$row_id = $_GET['rowid'];
	$deleteRow=$connect_db->query("DELETE FROM kltsg_submissions_bevetel WHERE id='".$row_id."'");
	
	for($i=0;$i<count($bev_adatok);$i++){
		
		$insertNewRow=$connect_db->query("INSERT INTO `kltsg_submissions_bevetel`
		
		(`sub_id`, `user_id`, `institute_id`, `unit_id`, `megnevezes`, `netto_egysegar`, `tax`, `category_tax_field`, `afa_ossz_egyseg`, `brutto_egysegar`, `mennyiseg`, `quant`, `netto_osszes`, `afa_osszes`, `brutto_osszes`) VALUES ('".$bev_adatok[$i]['rovat_id']."','".$userid."','".$inst."','".$unit."','".$bev_adatok[$i]['megnev']."','".$bev_adatok[$i]['nt_egys']."','".$bev_adatok[$i]['afk_egys']."','0','".$bev_adatok[$i]['af_egys']."','".$bev_adatok[$i]['bt_egys']."','".$bev_adatok[$i]['menny']."','".$bev_adatok[$i]['egyseg']."','".$bev_adatok[$i]['nt_ossz']."','".$bev_adatok[$i]['af_ossz']."','".$bev_adatok[$i]['bt_ossz']."')");

	}
	echo '<script>location.href="form.php?institute='.$inst.'&unit='.$unit.'&rows=1&bev_rows=1&active_tab=bev";</script>';
}
?>