function onWindowLoad() {

	let cart_count = document.querySelector('.cart span');
	let cartProducts = document.querySelectorAll('.cartProduct');
	let emptyCart = document.querySelector('.emptyCart');
	let orderDone = document.querySelector('.orderDone');
	let productCount = document.querySelectorAll('.product-count');
	let addButton = document.querySelectorAll('.addButton');
	let removeButton = document.querySelectorAll('.removeButton');
	let popupProd = document.querySelector('.popup-prod');
	let popup = document.querySelector('.popup');
	let popupAddress = document.querySelector('.popup-address');
	let popupTel = document.querySelector('.popup-tel');

	if(posted == 1){
		
		popupAddress.value = address;	
		popupTel.value = tel;


		let popupAddressSpan = document.querySelector('.popup-address-span');
		if(!address){
			popupAddressSpan.classList.remove('hidden')
		}
		let popupTelSpan = document.querySelector('.popup-email-span');
		if(tel.indexOf('_') > 0){
			popupTelSpan.classList.remove('hidden')
		}
	}
	else if(posted == 2){
		document.cookie = "cart={};max-age=86400";
	}

	if(!document.cookie){
		if(posted == 2){
			orderDone.classList.remove('hidden');
		}
		else{
			emptyCart.classList.remove('hidden');
		}
	}
	else{
		// let jsonString = document.cookie.split("=")[1];
		let jsonString = getCookie('cart');
		let jsonObj = JSON.parse(jsonString);

		if(jsonString == '{}'){
			if(posted == 2){
				orderDone.classList.remove('hidden');
				setTimeout(function(){ window.location="/"; },5000);
			}
			else{
				emptyCart.classList.remove('hidden');
			}
		}

		cartProducts.forEach(function (el) {
			if(jsonObj.hasOwnProperty(el.dataset['id'])){
				el.classList.remove('hidden');
			}
		});

	}


	addButton.forEach(function (el) {
		el.addEventListener("click", function () {
			let jsonObj = {};

			// let jsonString = document.cookie.split("=")[1];
			let jsonString = getCookie('cart');
			jsonObj = JSON.parse(jsonString);

			if(jsonObj.hasOwnProperty(el.dataset['id'])){
				jsonObj[el.dataset['id']] += 1;
			}
			document.cookie = "cart=" + JSON.stringify(jsonObj) + ";max-age=86400";

			productCount.forEach(function (el) {
				if(jsonObj.hasOwnProperty(el.dataset['id'])){
					el.value = jsonObj[el.dataset['id']];
				}
			});

			cart_count.innerHTML = Object.keys(jsonObj).length;
			popupProd.value = JSON.stringify(jsonObj);
		});
	});

	removeButton.forEach(function (el) {
		el.addEventListener("click", function () {
			let jsonObj = {};

			// let jsonString = document.cookie.split("=")[1];
			let jsonString = getCookie('cart');
			jsonObj = JSON.parse(jsonString);

			if(jsonObj.hasOwnProperty(el.dataset['id'])){
				if(jsonObj[el.dataset['id']] > 1){
					jsonObj[el.dataset['id']] -= 1;
				}
				else{
					delete jsonObj[el.dataset['id']];

					cartProducts.forEach(function (el) {
						el.classList.add('hidden');	
						popup.classList.add("hidden")
						popupProd.value = "";
						if(jsonObj.hasOwnProperty(el.dataset['id'])){
							el.classList.remove('hidden');	
						}
					});
				}
			}
			document.cookie = "cart=" + JSON.stringify(jsonObj) + ";max-age=86400";
			popupProd.value = JSON.stringify(jsonObj);

			productCount.forEach(function (el) {
				if(jsonObj.hasOwnProperty(el.dataset['id'])){
					el.value = jsonObj[el.dataset['id']];
				}
			});

			cart_count.innerHTML = Object.keys(jsonObj).length;
			if(JSON.stringify(jsonObj)=='{}'){
				cart_count.innerHTML = 0;
				emptyCart.classList.remove('hidden');
			}
		});
	});

	if(document.cookie){

		// let jsonString = document.cookie.split("=")[1];
		let jsonString = getCookie('cart');
		let jsonObj = JSON.parse(jsonString);
		let size = Object.keys(jsonObj).length;

		if(size > 0){
			cart_count.innerHTML = Object.keys(jsonObj).length;
		}
		else{
			cart_count.innerHTML = "0";
		}
		productCount.forEach(function (el) {
			if(jsonObj.hasOwnProperty(el.dataset['id'])){
				el.value = jsonObj[el.dataset['id']];
			}
		});

		if(size > 0){
			popup.classList.remove("hidden")
		}

		popupProd.value = jsonString;

	}






	var element = document.getElementById('popup-tel');
	var maskOptions = {
		mask: '+7(000)000-00-00',
		lazy: false
	} 
	var mask = new IMask(element, maskOptions);

	function getCookie(name) {
		let matches = document.cookie.match(new RegExp(
		  "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
		));
		return matches ? decodeURIComponent(matches[1]) : undefined;
	  }
	
}

window.addEventListener("load", onWindowLoad);