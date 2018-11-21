<div calss="container" id="teto">
<div class="card ">
 <h1 class="card-header bg-primary text-white">Bevezető</h1>
  <div class="card-block">
   <h4 class="card-title">Üdvözöllek kalandor!</h4>
 <p class="card-text"> <blockquote>Gondolom azért tévedtél ide, hogy segítsek neked el magyarázni, hogy is müködik ez, amit össze raktunk neked.<br>
Hát akkor figyelj nagyon, és kezdődjön az utazás a költségvetés-tervező ezen részén! <blockquote></div></div>
<div class="card">
 <h1 class="card-header bg-danger text-white">Kiadások-Bevételek</h1>
  <div class="card-block">
   <h4 class="card-title">Elmagyarázom neked a kiadások-Bevételek müködését!</h4>
 <p class="card-text"> <blockquote>Mikor megérkezel a honlapra, az alábbi kép fogad.
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/alapkep.png" ><br>
 Itt a kiadások  fülre kattintva, az alábbi kép fogad:
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/kiadas.png" ><br>
Bal oldalon felül látjuk az aktuális mérleg állását, ha az összeg pozitív akkor zöld a mérlegünk, ha negatív akkor piros.
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/merleg.png" ><br>
 Jobb fent van kiírva hová szeretnénk rögzíteni az adatokat, melyik egységhez illetve alegységhez. 
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/tervezesHelye.png" ><br>
Mikor ezeket ellenőriztük és meggyőződtünk róla, hogy jó helyen járunk, sorban haladva elkezdjük kitölteni a mezőket.<br>
Először a rovat mezőt töltjük ki.
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/kRovat.png" ><br>
 Ezután a hozzá tartozó áfát és az évet (megjegyzés: az év automatikusan kitöltődik mindig a következő évre, nyugodtan bele lehet javítani ha nem tetszik az év amit oda beírt).
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/KAfaesEv.png" ><br> 
 Majd ezután ki kell tölteni a kiadáshoz tartozó CPV kódokat! <br>
 <blockquote>
 -És, hogy mi az a CPV kód?<br>
 -Fogalmam sincs. Azt mondták ez legyen ott, és ezt mindenki használta már, nekem meg ennyi elég volt
 </blockquote>
 <footer>-mondotta a programozó.</footer>
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/cpv1.png" ><br>
 Miután kiválasztottuk a cpv 1 es kódot ,lehetőség nyillík a cpv 2 kód kiválasztása, mely egy szűkebb halmaza az előbbinek.
 
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/cpv2.png" ><br>
 Ezek után ,mindent értelem szerűen beírva a rovat rögzítés gombra kattintunk.<br>
 Ha esetleg valamit nem töltöttünk volna ki, akkor a program nem enged minket tovább és pirossal kiírja hogy nem töltöttünk ki minden mezőt, ezen kívül kipirosítja az elmaradt részeket.
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/rogzit.png" ><br> 
 Be került egy új gomb a bevétel és kiadás fülön <button type="submit"  value="1" name="upload_kiad_andFill" class="btn btn-warning" id="upload_kiad"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Rovat rögzítése és újboli kitöltés</button> <br>Melynek segítségével ha ismétlődő tételt kell felvinni, ez a gomb újra kitölti ugyan azokkal az adatokattal a felületet a hónap kivételével.<br>
Ha még is úgy döntünk hogy nem jó amit csináltunk ,mielőtt rákattintunk a rögzit gombra,kitörlhetjük azt amit ez előbb beírtunk a kis piros kuka gombbal
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/torol.png" ><br>
 Ha még is megnyomtuk a rögzit gombot, de rájöttünk hogy nem jó dolgot írtunk be, mert közbe Pisti befut az irodába hogy találtunk még 5 bontatlan csomag tollat, tehát azt nem kell megrendelni.<br>
 akkor lejebb megjelenő költséget a mellette lévő gombbal ki tudjuk töröllni.
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/torol2.png" ><br>
 Ha szerkeszteni szeretnénk az előbb felvitt anyagokat, <br>
 akkor lejebb megjelenő költségek a mellette lévő kis ceruzára kattintva ezt megtehetjük.
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/szerkeszt.png" ><br> 
 Ami fontos tudni! Ha szerkesztjük az adott recordot, akkor minden vissza töltődik a fenti mezőbe, kivéve a CPV-2 es kódot, azt újra nekünk kell kiválasztani.<br>
 Ezen felül a rovat rögzit gomb helyett, 2 másik gomb jelenik meg, a <button type="submit"  value="1" name="mod_kiad" class="btn btn-primary" id="mod_kiad"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>&nbsp;Rovat Módosítása</button> illetve a <button type="submit"  value="1" name="cc_mod_kiad" class="btn btn-danger" id="cc_mod"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>&nbsp;Mégsem</button>. <br>
 Ha az utóbbira kattintunk, nem történik semmi, a record visszakerül a helyére, és folytathatunk mindent tovább.<br>
 Ha viszont a rovat frissítésére kattintunk, akkor minden változtatás amit beírtunk frissítve lesz benne!<br>
 Ezt a folyamatot bármeddig ismételhetjük.
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/szerKiad.png" ><br> 
A bevétel oldal kitöltése megegyezik a kiadás oldalla, csak ott értelemszerűen nincs cpv kód.
 <br><img style="width:100%;" src="<?php echo base_url(); ?>img/bevetel.png" ><br>
 Amint végeztünk mind a kiadás mind a bevételek felvitelével 3 lehetőségünk van.
 <br><button type="button"   class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>&nbsp;Mentés későbbre</button>
	<button type="button"  class="btn btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;Feladás</button>
	<button type="button"  class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>&nbsp;Elvetés</button><br>
 Ha a mentés későbbre kattintunk, akkor a főoldalon <button type="button"  class="btn btn-primary btn-lg opt-btn">
			<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span><br>Saját tervezetek
		</button> menűpont alatt a <br>
 <img style="width:100%;" src="<?php echo base_url(); ?>img/mentett.png" > fülre kattintva megnézhetjük, őket. Itt újra szerkeszthetjük, vagy csak simán előnézettel megnézzük mit írtunk bele, nincs e benne helyesírási hiba, mint ebben az útmutatóban :) stb..
<br>
	<button type="button"  class="btn btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;Feladás</button>
	<br>a mentés feladásra akkor kattintsunk ha már semmilyen további műveletet nem kívánunk végezni <br>Mert egyúttal megküldésre kerül a Gazdasági és Műszaki Igazgatóság részére és a későbbiekben szerkesztésre lehetőség nincs! 
<br><button type="button"  class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>&nbsp;Elvetés</button><br> a harmadik gomb pedig arra való, hogy ha még sem akarom elmenti azt a 300 sort amit 4 óra alatt gépeltem ide bele, rákattíntok és törlődik az eddigi munkám.<br> Sőt ha a programozó elírt valamit még az is amit más csinált eddig :) 
  </blockquote></div></div>
 <div class="card">
 <h1 class="card-header bg-success text-white">Köszönöm</h1>
  <div class="card-block">
   <h4 class="card-title">Végeztünk mára!</h4>
 <p class="card-text"> <blockquote>Köszönöm hogy végig olvastad ezt és ha valami hibát találsz nyugodtan írj nekem:<br>
 Diszterhöft Zoltán<br>
 diszterhoft.zoltan@ke.hu<br>
 telefon : 1306 </blockquote></div>
 <div class="card-footer text-muted">
    ugrás az oldal <a href="#teto">tetejére</a>.
  </div></div><div class="card">
 <div>
