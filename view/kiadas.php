<div class="row labels">
<div class="col-xs-11 col-md-11"><h2 style="margin-top:0px;">Kiadások hozzáadása</h2></div>
<div class="eye col-xs-1 col-md-1"><!--button type="button" id="shbt" onclick="showHiddenKiad(this.value)" value="0" name="hide_show" class="btn btn-default"><span id="show_hide" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button--></div>
</div>
<div class="row labels">
<div class="col-xs-3 col-md-3">Rovat</div>
<div class=" collapsed col-xs-1 col-md-1">Nettó</div>
<div class="col-xs-1 col-md-1">Áfakulcs</div>
<div class="collapsed col-xs-1 col-md-1">Áfa</div>
<div class=" collapsed col-xs-1 col-md-1">Bruttó</div>
<div class="col-xs-1 col-md-1"></div>
</div>
<div class="row">
<div class="col-xs-3 col-md-3">
<div class="dropdown">
<select name="rovat"  id="rovat" onchange="setRovatKiadas()" class="form-control add-panel-select" >
<option value="999" selected>Válasszon...</option>

</select>
</div>    
</div>

<div class=" collapsed col-xs-1 col-md-1">
<input name="nt_summa" type="number" min="0" step="any" id="" value="" class="form-control" placeholder="Összesen" readonly/>
</div>
<div class="col-xs-1 col-md-1">
<div class="dropdown">
<select name="afk"  id="afaKulcs" onchange="setAfa()" class="form-control add-panel-select" >

<option value="999" selected>Válasszon...</option>
</select>
</div>
</div>
<div class=" collapsed col-xs-1 col-md-1">
<input type="number" name="af_summa" min="0" step="any" id="data5"  value="" class="form-control" placeholder="Összesen" readonly/>
</div>
<div class="collapsed col-xs-1 col-md-1">
<input type="number" name="bt_summa" min="0" step="any" id="data6"  value="" class="form-control" placeholder="Összesen" readonly/>
</div>




<div class="col-xs-1 col-md-1">

</div>
<div class="col-xs-2 col-md-2">

</div>
</div>
<div id="details">
<table class="table table-bordered"><thead>
<tr class="subtable"><th colspan="" >Tervezett beszerzés/igénylés</th><th class="collapsed">Nettó egységár</th><th class="collapsed">Áfakulcs</th><th class="collapsed">Áfa egységár</th><th>Bruttó egységár</th><th>Mennyiség</th><th>Mértékegység</th><th class="collapsed">Nettó összesen</th><th class="collapsed">Áfa összesen</th><th class="collapsed">Brutto összesen</th></tr>
</thead>
<tr>
<td>

<textarea placeholder="Megnevezés" maxlength="150" style="height:34px"  id="megnevezes" name="" class="form-control" required></textarea>
</td>
<td>
<input  type="number" min="0" step="any"  class="form-control" placeholder="Egységár" id="egysegAr" name="bt_" value="" pattern="\d+(\.\d{2})?" required/></td>
<td class="">
<input  type="number" min="0" step="any"  class="form-control" placeholder="Mennyiség" id="mennyiseg" name="menny" value="" required/></td>
<td>
<div class="dropdown">
<select id="mertekegyseg" onchange="setMertek()" class="form-control add-panel-select" required >
<option value="" selected>Válasszon...</option>
</select>
</div>
</td>
<td class="muv"><button type="submit" id="" onclick="return deleteSelectedRow(this.id)" value="" name="rfd" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
<td class="muv"><button type="submit" name="ujsor" value="1" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>
</tr>
</table>
<div id="EditRow">
<button type="submit" value="1" name="save_edit_kiad" class="btn btn-success">
<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;Sor mentése</button>&nbsp;
<button type="button" value="1" id="" onclick="delKiadRow(this.id)" class="btn btn-danger">
<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Sor törlése</button>&nbsp;
<button type="button" value="1" onclick="cancel_kiad()" class="btn btn-warning">
<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>&nbsp;Mégse</button>
</div>
<button type="submit" onclick="ajaxAddKiadas()" value="1" name="upload_kiad" class="btn btn-success"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>&nbsp;Rovat rögzítése</button>

</div>
<div id="content2">
<h2 class="h2-text" >Tervezett kiadások</h2> 
<table class="table table-bordered"><thead>
      <tr><th>#</th><th colspan="6">Rovat</th><th >Rovat összesen (nettó)</th><th>Áfa összeg</th><th colspan="1">Rovat összesen (bruttó)</th></tr>
    </thead><tbody id="table_rows">
<tr class="main-table" id="" >
<td ><div class="line-num">-</div></td>
<td colspan="6"></td>
<td colspan=""></td>
<td colspan=""></td>
<td colspan=""></td>
</tr>

</table>
<div id="kiadsSubmission"></div>

</div>