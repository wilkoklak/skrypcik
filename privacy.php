<!doctype html>
<html lang="pl" ng-app="mainApp" ng-controller="mainCtrl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style_alt.css?r_=<?=mt_rand()?>">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<title>Skrypcik - Prywatność</title>
</head>
<body>
	<div class="center">
	<h1>Prywatność</h1>
	<p>Jest jedna rzecz, o której możesz chcieć wiedzieć - mój serwis zbiera adresy IP użytkowników.</p>
	<p>To jedyna z informacji jaką ja osobiście pobieram - nie odpowiadam za informacje pobierane przez
		hosting CBA i jego reklamodawców</p>
	<h2>W jakim celu wykorzystuję Twój IP?</h2>
	<p>Dopóki nie zaimplementuję możliwości utworzenia konta, jest to najłatwiejsza metoda
		zagwarantowania możliwości edycji utworzonych przez Ciebie skrypcików, przynajmniej do momentu
		dopóki korzystasz z tego samego adresu IP, z którego utworzyłeś ten skrypcik.
	</p>
	<p>Oprócz tego, jeśli Twoja przeglądarka obsługuje WebStorage (poniżej możesz sprawdzić),
		to zapiszę w tym schowku listę adresów IP, z których tworzysz skrypciki. Dzięki temu możesz edytować
		wszystkie skrypciki, które utworzyłeś z tej przeglądarki od momentu ostatniego wyczyszczenia.
		Ja nie mam dostępu do tej listy, jest ona zapisana w pamięci Twojej przeglądarki.
	</p>
	<h2>Czego mogę dowiedzieć się z Twojego IP?</h2>
	<p>Oprócz tego, że moja strona będzie wiedzieć, że jesteś autorem tego skrypcika, to ja osobiście
		mogę sprawdzić przybliżony adres serwera Twojego ISP, ale musiałbym to robić ręcznie.
		Dopóki nie łamiesz prawa, nie mam podstaw tego sprawdzać, ani nikomu udostępniać tego adresu IP.
	</p>
	<p>Możesz być pewien, że nie wykorzystuję Twojego IP w żadnym innym celu oprócz podanego wyżej.
		Nigdy też nie sprzedam, ani nie udostępnie tej informacji osobom trzecim, dopóki nie są to organy ścigania.
	</p>
	<h1>Czy wspierasz WebStorage?</h1>
	<p id="webstorage"></p>
</body>
<script>
var pole = document.querySelector("#webstorage");
function lsTest() {
	var test = "test";
	try {
		window.localStorage.setItem(test, test);
		window.localStorage.removeItem(test);
		return window.localStorage;
	} catch(e) {
		return false;
	}
}
if(lsTest()) {
	pole.textContent = "WebStorage wspierane :)";
	pole.style.color = "#00cc00";
} else {
	pole.textContent = "WebStorage niewspierane :(";
	pole.style.color = "#cc0000";
}
</script>
</html>
