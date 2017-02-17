<div id="content1">
			<h2>1. Egység kiválasztása</h2>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="dropdown">
					<select  id="egyseg" onchange="ajaxGetAlegyseg()" class="form-control" name="institute" autofocus >
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
