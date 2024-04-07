var menuHam = document.getElementById("menuHamburger");
var menuMain = document.getElementById("mainMenu");

if(menuHam != null && menuMain!= null) {
	menuHam.addEventListener('click', function(e){
		if(menuMain.className == 'navigation is-active') {
			menuMain.className = 'navigation';
		}
		else {
			menuMain.className = 'navigation is-active';
		}
	});
}
else {
	alert('un des deux éléments pas présents');
}