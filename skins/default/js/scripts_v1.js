
function hideShow(x) {
	var y = document.getElementById(x);
	if(y.style.display == 'block') {
		y.style.display = 'none';
	} else {
		y.style.display = 'block';
	}
}

function red(x) {
	var y = document.getElementsByClassName(x);
	for( var i = 0; i < y.length; i++){
		if(y[i].style.color == 'red') {
			y[i].style.color = 'blue';
		} else {
			y[i].style.color = 'red';
		}
	}
}
