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

function clearinfo() {
	document.getElementById('JSinfo').innerHTML = '';
}

function AjaxInputReview(inputText) {
	let text = document.getElementById(inputText).value;
	$.ajax({
		url: 'http://praktika.ua/reviews',
		type: "POST",
		cache: false,
		timeout: 5000,
		data: {text: text},
		success: function(msg) {
			document.getElementById('myform').reset();
			let response = JSON.parse(msg);
			if(response.status !== 'Комментарий успешно добавлен') {
				document.getElementById('JSinfo').innerHTML = response.status;
			} else {
				document.getElementById('JSinfo').innerHTML = response.status;
			}
		}
	});
	setTimeout(clearinfo,2000);
	return false
}

function AjaxOutputReview() {
	$.ajax({
		url: 'http://praktika.ua/reviews',
		type: "POST",
		cache: false,
		data: {test:'test'},
		success: function(msg) {
			let response = JSON.parse(msg);
			if (response.status === 'ok') {
			document.getElementById('OutputDiv').innerHTML += '<br>' +response.name+','+response.date+'<br><b><div class="rev-text">'+response.text+'</div></b><div class="user-review"><input type="submit" value="Ответить" class="user-button"> <input type="submit" value="Пожаловаться" class="user-button"></div><hr>';
			}
		}
	});
}

function AjaxCheckAuth(x, y) {
	let email = document.getElementById(x).value;
	let password = document.getElementById(y).value;
	$.ajax({
		url: 'http://praktika.ua/cab/auth',
		type: "POST",
		cache: false,
		data: {email:email,pass:password},
		success: function(msg) {
			let response = JSON.parse(msg);
			if(response.status === 'error'){
				document.getElementById('errorAuth').innerHTML = response.error;
			} else {
				location="/index.php";
			}
		}
	});
return false;
}

function AjaxCheckRegistration(a, b, c, d) {
	let login = document.getElementById(a).value;
	let password = document.getElementById(b).value;
	let email = document.getElementById(c).value;
	let age = document.getElementById(d).value;
	$.ajax({
		url: 'http://praktika.ua/cab/registration',
		type: "POST",
		cache: false,
		data: {login:login, email:email, pass:password, age:age},
		success: function(msg) {
			let response = JSON.parse(msg);
			if(response.status === 'error'){
				document.getElementById('errorReg').innerHTML = response.error;
			} else {
				location="http://praktika.ua/cab/registration";
			}
		}
	});
	return false;
}
