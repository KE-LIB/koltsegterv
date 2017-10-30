<div calss="container" id="teto">
<div class="card ">
 <h1 class="card-header bg-primary text-white">Bevezető</h1>
  <div class="card-block">
   <h4 class="card-title">Üdvözöllek kalandor!</h4>
 <p class="card-text"><span id="history">Gondolom azért tévedtél ide hogy segítsek neked el magyarázni, hogy is müködik ez, amit össze raktunk neked.<br>
Hát akkor figyelj nagyon, és kezdődjön az utazása költségtervező ezen részén!</span></div></div>
<div class="card">
 <h1 class="card-header bg-danger text-white">Kiadások-Bevételek</h1>
  <div class="card-block">
   <h4 class="card-title">Elmagyarázom neked a kiadások-Bevételek müködését!</h4>
 <p class="card-text"><span id="history">Mikor megérkezel a honlapra, az alábbi kép fogad.
 <br><img src="<?php echo base_url(); ?>img/alapkep.png" ><br>
 Itt a kiadások  fülre kattintva, az alábbi kép fogad:
 <br><img src="<?php echo base_url(); ?>img/kiadas.png" ><br>
Bal fent látjuk az aktuális mérleg állását, ha az összeg pozitív akkor zöld a mérlegünk, ha negatív akkor piros.
 <br><img src="<?php echo base_url(); ?>img/merleg.png" ><br>
 Jobb fent van kiírva hová szeretnénk rögzíteni az adatokat, melyik egységhez illetve alegységhez. 
 <br><img src="<?php echo base_url(); ?>img/tervezesHelye.png" ><br>
Mikor ezeket ellenőriztük és meggyőzödtünk róla hogy jó helyen járunk, szép sorba haladva elkezdjük kitölteni a mezőket.<br>
Előszőr a rovat mezőt töltjük ki.
 <br><img src="<?php echo base_url(); ?>img/kRovat.png" ><br>
 Ezután a hozzá tartozó Áfát és az Évet.(megjegyzés: az év automatán kitöltődik mindig a következő évre,nyugodtan bele lehet javítani ha nem tetszik az év amit oda beírt.)
 <br><img src="<?php echo base_url(); ?>img/KAfaesEv.png" ><br> 
 Majd ezután ki kell tölteni a kiadáshoz tartozó CPV kódokat! <br>
 -És, hogy mi az a CPV kód?<br>
 -Fogalmam sincs. Azt mondták ez legyen ott, és ezt mindenki használta már, nekem meg ennyi elég volt-mondotta a programozó.
 <br><img src="<?php echo base_url(); ?>img/cpv1.png" ><br>
 Miután kiválasztottuk a cpv 1 es kódot ,lehetőség nyillík a cpv 2 kód kiválasztása, mely egy szűkebb halmaza az előbbinek.
 <br><img src="<?php echo base_url(); ?>img/cpv2.png" ><br>
 Ezek után ,mindent értelem szerűen beírva a rovat rögzítés gombra kattintunk.<br>
 Ha esetleg valamit nem töltöttünk volna ki, akkor a program nem enged minket tovább és pirossal kiírja hogy nem töltöttünk ki minden mezőt, ezen kívül kipirosítja az elmaradt részeket.
 <br><img src="<?php echo base_url(); ?>img/rogzit.png" ><br> 
Ha még is úgy döntünk hogy nem jó amit csináltunk ,mielőtt rákattintunk a rögzit gombra,kitörlhetjük azt amit ez előbb beírtunk a kis piros kuka gombbal
 <br><img src="<?php echo base_url(); ?>img/torol.png" ><br>
 Ha még is megnyomtuk a rögzit gombot, de rájöttünk hogy nem jó dolgot írtunk be, mert közbe Pisti befut az irodába hogy találtunk még 5 bontatlan csomag tollat, tehát azt nem kell megrendelni.<br>
 akkor lejebb megjelenő költséget a mellette lévő gombbal ki tudjuk töröllni.
 <br><img src="<?php echo base_url(); ?>img/torol2.png" ><br>
 Ha szerkeszteni szeretnénk az előbb felvitt anyagokat, <br>
 akkor lejebb megjelenő költségek a mellette lévő kis ceruzára kattintva ezt megtehetjük.
 <br><img src="<?php echo base_url(); ?>img/szerkeszt.png" ><br> 
 Ami fontos tudni! Ha szerkesztjük az adott recordot, akkor minden vissza töltődik a fenti mezőbe, kivéve a CPV-2 es kódot, azt újra nekünk kell kiválasztani.<br>
 Ezen felül a rovat rögzit gomb helyett, 2 másik gomb jelenik meg, a <img src="<?php echo base_url(); ?>img/rovMod.png" > illetve a <img src="<?php echo base_url(); ?>img/megsem.png" >. <br>
 Ha az utobbira kattintunk, nem történik semmi, a record vissz kerül a helyére, és folytathatunk mindent tovább.<br>
 Ha viszont a rovat frissítésére kattintunk, akkor minden változtatás amit beírtunk az frissítve lesz benne!<br>
 Ezta folyamatot bármeddig ismételhetjük.
 <br><img src="<?php echo base_url(); ?>img/szerKiad.png" ><br> 
A bevétel oldalon minden úgyan úgy müködik, csak ott nincs cpv kód.
 <br><img src="<?php echo base_url(); ?>img/bevetel.png" ><br>
 Amint végeztünk mind a kiadás mind a bevételek felvitelével 3 lehetőségünk van.
 <br><img src="<?php echo base_url(); ?>img/mentes.png" ><br>
 Ha a mentés későbbre kattintunk, akkor a főoldalon <img src="<?php echo base_url(); ?>img/sajatTervek.png" > menűpont alatt a <br>
 <img src="<?php echo base_url(); ?>img/mentett.png" > fülre kattintva megnézhetjük, őket. Itt újra szerkeszthetjük, vagy csak simán előnézettel megnézzük mit írtunk bele, nincs e benne helyesírási hiba, mint ebben az útmutatóban :) stb..
<br><img src="<?php echo base_url(); ?>img/mentes.png" > a mentés feladásra akkor kattintsunk ha már über prók vagyunk és tudjuk hogy mi aztán sosem hibázunk meg <br>különben is! Mert ez egyből elhelyezi úgy a tételt, hogy azt többé nem szerkeszthető. Tehát ez csak azoknak ajánlom egyből akik kellő Önbizalommal rendlekeznek.
<br><img src="<?php echo base_url(); ?>img/mentes.png" > a harmadik gomb pedig arra való, hogy ha még sem akarom elmenti azt a 300 sort amit 4 óra alatt gépeltem ide bele, rákattíntok és törlődik az eddigi munkám.<br> Sőt ha a programozó elírt valamit még az is amit más csinált eddig :) 
 </span></div></div>
 <div class="card">
 <h1 class="card-header bg-success text-white">Köszönöm</h1>
  <div class="card-block">
   <h4 class="card-title">Végeztünk mára!</h4>
 <p class="card-text"><span id="history">Köszönöm hogy végig olvastad ezt és ha valami hibát találsz nyugodtan írj nekem:<br>
 Diszterhöft Zoltán<br>
 diszterhoft.zoltan@ke.hu<br>
 telefon : 1306</span></div>
 <div class="card-footer text-muted">
    ugrás az oldal <a href="#teto">tetejére</a>.
  </div></div><div class="card">
 <div>
