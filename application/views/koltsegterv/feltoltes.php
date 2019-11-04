<div class="row labels" id="feltoltes">
<script>
function startUpload(){
      document.getElementById('f1_upload_form').style.visibility = 'hidden';
      return true;
}

function stopUpload(success){
      var result = '';
      if (success == 1){
         result = '<span class="msg">A fáljt sikeresen feltöltötte!<\/span><br/><br/>';
		 
      }
      else {
         result = '<span class="emsg">Hiba történt a feltöltés közben<\/span><br/><br/>';
      }
      document.getElementById('f1_upload_form').innerHTML = result + '<label>File: <input name="myfile" type="file" size="30" /><\/label><label><input type="submit" name="submitBtn" class="sbtn" value="Upload" /><\/label>';
      document.getElementById('f1_upload_form').style.visibility = 'visible';      
      return true;   
}
//-->
</script>   
</head>

<body>
       <div id="container">
           
            <div id="content">
			<?php
			 $this->load->helper('form');
			 $seged= explode('_',$this->input->post('egysegegID'));
			 if(isset($egysegegID))
			 {
				 $seged= explode('_',$egysegegID);
			 }
			 $attributes = array(
			 'onsubmit' => 'startUpload()',
			 'enctype' => 'multipart/form-data',
			 'target' => 'upload_target',
			 );
			echo form_open('Koltsegterv/upload',$attributes);
			?>
               
                   
                     <p id="f1_upload_form" align="center"><br/>
                         <label>Fálj kiválasztása:  
                              <input name="myfile" type="file" size="30" />
                         </label>
                         <label>
						 <input name="institute" type="hidden" size="30"  value='<?php echo $seged[0];?>'/>
						 <input name="unit" type="hidden" size="30" value='<?php echo $seged[1];?>' />
                             <input type="submit" name="submitBtn" class="sbtn" value="feltöltés"  />
                         </label>
                     </p>
                     Miután feltöltötted a file-t, a Saját tervezetek/mentett tervezetek alatt meg is nézheted.
                     <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                 </form>
             </div>
         </div>
                 
</body>  

</script>
