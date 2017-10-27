	<?php			if(isset($message))
		{
	
	echo"<div class='center-block'><span id='errorclass'>".$message."</span></div>";
	}
	?>
				<div class="row" id="mainPage">
				<br>

				<div class="loginPanel">
					<div class="panel center panel-default">
						<div class="panel-heading clearfix"><b>
						<b>	<h1>Bejelentkezés<span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>
						</h1></b></div>
						<?php
						$this->load->helper('form');
						echo form_open('Koltsegterv/Login');
						?>
								<div class="input-group" >
									<span class="input-group-addon">
								<?php
									echo form_label('E-mail cím: ','email').'<i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>';
									$data = array(
									'name'          => 'email',
									'id'            => 'inputEmail',
									'title'			=>'emailcím megadása',
									'type'			=>'text',
									'placeholder'   => 'valaki@ke.hu',
									'class'     	=> 'form-control',			
									'required'		=>'required',
									);
									echo form_input($data);
								?>
									
								</div>
								<div class="input-group">
									<span class="input-group-addon">
									<?php
									echo form_label('Jelszó:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ','psw').'<i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>';
									$data = array(
									'name'          => 'psw',
									'id'            => 'inputPassword',
									'title'			=>'jelszó megadása',
									'type'			=>'password',
									'class'     	=> 'form-control',			
									'required'		=>'required',
									);
									echo form_input($data);
								?>
								</div>
								<br>
									<button class="btn btn-lg btn-primary btn-block"  id="login" name="login" onclick="login()">Bejelentkezés</button>
								</div>
							
					<?php	 $string = '</div></div>';
							 echo form_close($string);
							 ?>
			
		</div>
	