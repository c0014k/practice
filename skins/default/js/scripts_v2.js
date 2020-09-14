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

function areYouSure() {
	return confirm('Вы уверены?');
}

function check(x, y, a, b) {
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
	} else {
		return true;
	}
}

function myAjax(inputText, output) {
	let text = document.getElementById(inputText).value;
	$.ajax({
		url: 'http://praktika.ua/reviews',
		type: "POST",
		cache: false,
		data: {text: text},
		success: function(msg) {
			document.getElementById('myform').reset();
			let response = JSON.parse(msg);
			if(response.status !== 'ok') {
				document.getElementById('JSinfo').innerHTML = response.status;
			} else {
				document.getElementById('JSinfo').innerHTML = '';
				document.getElementById(output).innerHTML += '<br>' +response.name+','+response.date+'<br><b><div class="rev-text">'+response.text+'</div></b><div class="user-review"><input type="submit" value="Ответить" class="user-button"> <input type="submit" value="Пожаловаться" class="user-button"></div><hr>';
			}
		}
	});
	return false
}

/*
AKmsk<s>kewklnsvdfjfnlklkvs vm kN! lk om/knal lfn k1NW IKF<u>N ML1 LKm!!!cnocinicn ifn ow4n onie gngi oeg</s>sdlnelcnsvjsvnvjnvoivndfj nflskv</u>ncscncjecpcpcnslcnscmscinscnscscpsuehucvsjcnsjvuhfskbuhevjlbnijwivhencwivnosknvjfvnjfoiwjceuovhvojpmpcnsuhw8jc04yg78uf742ghq0cijouwhv98uf0hwugh9h
 */