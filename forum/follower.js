//SCRIPT FÖR FORUMET
//funktion som ritar boll under headern i forumet
//bollen följer musens rörelser i sidled

//hämtar muspekarens koordinater
function getMouseCoords(e) {
	var e = e;
	document.getElementById('table').innerHTML = e.clientX + ', ' + 
	e.clientY + '<br>' + e.screenX + ', ' + e.screenY;
}

//skapar objekt och ger den ett id
var followCursor = (function() {
	var s = document.createElement('div');
	s.id='follower';
	
	return {
	init: function() {
			document.body.appendChild(s);
			},
	//säger åt objektet hur det ska ligga och följa med hjälp av musens koordinater
	run: function(e) {
			var e = e || window.event;
			s.style.left = (e.clientX - 5) + 'px';
			getMouseCoords(e);
			}
		};
}());

//säger åt objektet att uppdatera sina koordinater då muspekaren rör sig
window.onload = function() {
	followCursor.init();
	document.body.onmousemove = followCursor.run;
}
