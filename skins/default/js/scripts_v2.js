"use strict";

function hideShow(x) {
	let y = document.getElementById(x);
	if(y.style.display === 'block') {
		y.style.display = 'none';
	} else {
		y.style.display = 'block';
	}
}

function changeAndBlue(x) {
	let y = document.getElementsByClassName(x);
	for( let i = 0; i < y.length; i++){
		if(y[i].style.color === 'red') {
			y[i].style.color = 'blue';
		} else {
			y[i].style.color = 'red';
		}
	}
}

function areYouSure(x){
	return confirm('Вы уверены?');
}

function check(x){
	let l = document.getElementById(x).value.length
	if(l < 2 || y >= 14) {
		alert('!!!!AAAAA!!!!');
		return false;
	} else {
		return true;
	}
}
