<!DOCTYPE html lang="hrv">
<html>
	<head>
		<title>
			Moja prva web stranica
		</title>
		
		<meta name="google-signin-client_id" content="963226075194-2j4b9nt70uqh81in35et7vr2t90ht4uc.apps.googleusercontent.com">
		
		<meta charset="utf-8">
		
		<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no' />

		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		
		<link rel="stylesheet" type="text/css" href="Css/css.css">
		
		<link rel="icon" href="Slike/Kekislika.jpg">
	</head>
	<div class="beforeic">
		<div class="beforeic2">
		
		<i class="fas fa-circle-notch"></i>
		
		</div>
	</div>
	<body onload="prijava()">
	<?php
		session_start();
		if(isset($_GET["log"]) && $_GET["log"]=="no"){
			unset($_SESSION["ime"]);
		}
		error_reporting(E_ERROR); 
	?>
	<div id="header">
		<div id="Naslov">
			<p>Dobrodošli na web stranicu Krešimira Kozića, poduzetnika iz nužde</p>
		</div>
		<nav>
			<a href="Bitne inf.html" class="menu" target="_blank">Bitni događaji</a>
			<a href="Kontakt.html" class="menu" target="_blank">Kontakt</a>
			<a href="Kekijeve izreke.docx" class="menu" target="_blank">Izreke</a>
			<a href="Ponuda.php" class="menu" target="_blank">Ponuda robe</a>
		</nav>
	</div>
		<form class="prijava" method="POST" action=""> 
			<input class="polja_unos" type="name" placeholder="Korisničko ime" name="ime" required>
			<input class="polja_unos" type="password" placeholder="Lozinka" name="lozinka" required>
			<input id="subic" type="submit" value="Prijavi" name="predaja">
		</form>
	<div id="content">
		<h1 id="titula">Prvostupnik informatike</h1>
		<div class="g-signin2" data-onsuccess="onSignIn"></div>
		<button id="OPM" onclick="promjeni(),promjenisliku()">OPM nije uvjet za diplomski</button>
	</div>
	<div id="content1">
		<div class="slika">
		</div>
		<p class="pretplata" style="font-weight: bold; text-align: center;">Još nisi član Kekijevog fan kluba!?</p>
		<a class="pretplata" href="registracija.php"><p style="text-align: center; color: black;">Učlani se, besplatno je!</p></a> 
	</div>
	<div id="slusanje">
	<p> Himna poduzetnika iz nužde</p>
	<audio id="negasi" controls src="Dragostea.mp3"> 
	</audio>
	</div>
	<?php
		$nadeno=false;
		if(isset($_POST["ime"]) && isset($_POST["lozinka"])){
			include "spajanje_na_bazu.php";
			$ime_value=$_POST["ime"];
			$lozinka_value=$_POST["lozinka"];
			$upit="SELECT Ime_i_prezime, Lozinka from korisnici_tablica";
			$upit_nad_bazom=$spajanje->query($upit);
			if(!$upit_nad_bazom){
				echo "Upit nije uspješan";
				exit();
			}
			while($provjera=$upit_nad_bazom->fetch_object()){
				if($provjera->Ime_i_prezime==$ime_value && $provjera->Lozinka==$lozinka_value){ 
	?>
					<p id="unutarnju" style="text-align: right; font-size: 18pt;"><?php echo "Dobrodošli" ." " .$ime_value ."<br>"; ?></p>
			<?php		
					$nadeno=true;
					$_SESSION["ime"]=$ime_value;
				}
			}
			if(!$nadeno){ 
			?> 
				<p style="text-align: right;"><?php echo "Korisnik nije pronađen <br>"; ?></p>	
			<?php
			}
			$spajanje->close();
		}
	?>
	</body>
	<script>
		$(document).ready(function(){
			setTimeout(() => {
				$('.beforeic').remove();
				$('body>div').css('display', 'block');
			}, 5000);			
		});
		var signOutButton=document.createElement('button');
		var slika_profila=document.createElement('img');

		let negasiscr=document.querySelector('#negasi');
		let cijstr=document.querySelector('#content1');
		let cc=document.querySelector('#slusanje');
		let dd=document.querySelector('#content');
		var tekst=document.querySelector('#unutarnju');
		var unutra=document.querySelector('#subic');
		var polja=document.querySelectorAll('.polja_unos');
		var micitekst=document.querySelectorAll('.pretplata'); 		
		unutra.addEventListener('click', refresh);
		function promjeni() {
			let paragraf=document.querySelector('#titula');
			paragraf.innerText="Magistar informatike";
			let pozadina=document.querySelector('#content1');
			cijstr.style.backgroundImage='linear-gradient(blue, yellow)';
			cc.style.backgroundImage='linear-gradient(yellow, red)';
			dd.style.backgroundColor='white';
		}
		function promjenisliku(){
			let slika=document.querySelector('.slika');
			if(slika.style.backgroundImage=="url(Kekislika.jpg)"){
				slika.style.backgroundImage="url(giphy1.gif)";
			}
		}
		function prijava(){
			var current_user="<?php echo $_SESSION["ime"] ?>";
			if(current_user!=null && current_user!=""){
				unutra.value="Odjava";
				unutra.style.height='40px';
				unutra.style.width='80px';
				polja[0].style.display='none';
				polja[1].style.display='none';
				micitekst[0].style.display='none';
				micitekst[1].style.display='none';
			}
		}
		function refresh(){
			if(unutra.value=="Odjava"){
				tekst=null;
				open("Keki.php?log=no", "_self");
			}
		}
		function onSignIn(googleUser){
			var profile=googleUser.getBasicProfile();
			var google_div=document.querySelector('#content');
			slika_profila.setAttribute('src', profile.getImageUrl());
			slika_profila.style.position='absolute';
			slika_profila.style.right='0';
			slika_profila.style.top='0';
			slika_profila.style.width='50px';
			slika_profila.style.height='50px';
			slika_profila.style.borderRadius='50%';
			slika_profila.style.marginBottom='50px';
			google_div.appendChild(slika_profila);
			document.querySelector('.prijava').style.display='none';
			signOutButton.setAttribute('onclick', 'signOut()');
			signOutButton.setAttribute('class', 'signOutButton');
			signOutButton.innerHTML='Sign out';
			signOutButton.style.position='absolute';
			signOutButton.style.right='0';
			signOutButton.style.height='35px';
			google_div.appendChild(signOutButton);
			document.querySelector('.g-signin2').style.display='none';
		}
		function signOut(googleUser){
			gapi.auth2.getAuthInstance().signOut().then(function () {
				document.querySelector('.g-signin2').style.display='block';
				document.querySelector('.prijava').style.display='block';
				document.querySelector('#content').removeChild(signOutButton);
				document.querySelector('#content').removeChild(slika_profila);
			});
		}
	</script>
</html>
