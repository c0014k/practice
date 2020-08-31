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

function check(x,y,a,b){
	let lengthLogin = document.getElementById(x).value.length;
	let errorLogin = document.getElementById(y);
	let lengthPassword = document.getElementById(a).value.length;
	let errorPassword = document.getElementById(b);
	if(lengthLogin < 2 || lengthLogin >= 14) {
		errorLogin.style.display = 'block';
		return false;
	}
	if(lengthPassword < 4) {
		errorPassword.style.display = 'block';
		return false;
	} else
	return true;
}
/*
function myAjax(x){
	let login =  x;
	let pass =  document.getElementById(y);
	let email =  document.getElementById(z);
	$.ajax({
	url: '/test_ajax.php',
	type: "POST",
	cache: false,
	data: {login: login, password: 'pass44', email: 'email@mail.lo'},
	timeout: 5000,
		success: function(msg) {
			alert(msg);
		}
	});
}
*/