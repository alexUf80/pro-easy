function onWindowLoad() {

	let cart_count = document.querySelector('.cart span');
	cart_count.innerHTML = "0";

	let addedWrapper = document.querySelectorAll('.added-wrapper');
	let productCount = document.querySelectorAll('.product-count');
	let addButton = document.querySelectorAll('.addButton');
	let removeButton = document.querySelectorAll('.removeButton');

	addButton.forEach(function (el) {
		el.addEventListener("click", function () {
			let jsonObj = {};

			if(getCookie('cart') === undefined){
				jsonObj[el.dataset['id']] = 1;
				document.cookie = "cart=" + JSON.stringify(jsonObj) + ";max-age=86400";
			}
			else{
				// let jsonString = document.cookie.split("=")[1];
				let jsonString = getCookie('cart');
				jsonObj = JSON.parse(jsonString);

				if(jsonObj.hasOwnProperty(el.dataset['id'])){
					jsonObj[el.dataset['id']] += 1;
				}
				else{
					jsonObj[el.dataset['id']] = 1;
				}
				document.cookie = "cart=" + JSON.stringify(jsonObj) + ";max-age=86400";
			}

			addedWrapper.forEach(function (el) {
				if(jsonObj.hasOwnProperty(el.dataset['id'])){
					el.classList.remove('hidden');
				}
			});
			productCount.forEach(function (el) {
				if(jsonObj.hasOwnProperty(el.dataset['id'])){
					el.value = jsonObj[el.dataset['id']];
				}
			});
			addButton.forEach(function (el) {
				if(jsonObj.hasOwnProperty(el.dataset['id'])){
					el.innerHTML = "+";
					el.style.width = "30px";
				}
			});

			cart_count.innerHTML = Object.keys(jsonObj).length;
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

					addButton.forEach(function (eladd) {
						eladd.innerHTML = "Добавить в корзину";
						eladd.style.width = "auto";
						if(jsonObj.hasOwnProperty(eladd.dataset['id'])){
							eladd.innerHTML = "+";
							eladd.style.width = "30px";
						}
					});
				}
			}
			document.cookie = "cart=" + JSON.stringify(jsonObj) + ";max-age=86400";

			addedWrapper.forEach(function (el) {
				el.classList.add('hidden');
				if(jsonObj.hasOwnProperty(el.dataset['id'])){
					el.classList.remove('hidden');
				}
			});
			productCount.forEach(function (el) {
				if(jsonObj.hasOwnProperty(el.dataset['id'])){
					el.value = jsonObj[el.dataset['id']];
				}
			});

			cart_count.innerHTML = Object.keys(jsonObj).length;
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

		addedWrapper.forEach(function (el) {
			el.classList.add('hidden');
			if(jsonObj.hasOwnProperty(el.dataset['id'])){
				el.classList.remove('hidden');
			}
		});
		productCount.forEach(function (el) {
			if(jsonObj.hasOwnProperty(el.dataset['id'])){
				el.value = jsonObj[el.dataset['id']];
			}
		});
		addButton.forEach(function (el) {
			if(jsonObj.hasOwnProperty(el.dataset['id'])){
				el.innerHTML = "+";
				el.style.width = "30px";
			}
		});
	}

	function getCookie(name) {
		let matches = document.cookie.match(new RegExp(
		  "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
		));
		return matches ? decodeURIComponent(matches[1]) : undefined;
	  }
	
}

window.addEventListener("load", onWindowLoad);