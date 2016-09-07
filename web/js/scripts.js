$(document).ready(function () {
	var keyBoardItem = $('.keyboard-inp').find('.keybaord-inp-item');
	var keyBoardItemCount = keyBoardItem.length;
	var loginInp = $('#loginform-password');

	loginInp.val('').trigger('change');

	loginInp.on('change', function() {
		var inp = $(this);
		var inpVal = inp.val();
		var delBtn = $('.keybaord-btn-item[data-val="del"]');
		var loginBtn = $('.keybaord-btn-item[data-val="login"]');

		if(inpVal.length == 1) {
			delBtn.prop('disabled', false);
		} else if(inpVal.length == 0) {
			delBtn.prop('disabled', true);
		}

		if(inpVal.length == 4) {
			loginBtn.prop('disabled', false);
		} else if(inpVal.length == 3) {
			loginBtn.prop('disabled', true);
		}

		keyBoardItem.find('.fa').removeClass('fa-circle').addClass('fa-circle-o');
		for(var i = 0; i < inpVal.length; i++) {
			keyBoardItem.find('.fa').eq(i).removeClass('fa-circle-o').addClass('fa-circle');
		}
	});

	$('#login-form').on('click', '.keybaord-btn-item', function() {
		var btn = $(this);
		var btnVal = btn.attr('data-val');
		var loginInpVal = loginInp.val();

		if(btnVal == 'login') {
			//Login
		} else if(btnVal == 'del') {
			loginInp.val(loginInpVal.substring(0, loginInpVal.length - 1)).trigger('change');
		} else {
			if(loginInpVal.length >= keyBoardItemCount) {
				//Input is full
			} else {
				loginInp.val(loginInpVal + btnVal).trigger('change');
			}
		}
	});

	$(document).on('keydown', function(e) {
		var code = parseInt(e.keyCode);
		var codeArr = {
			96: '0', 97: '1', 98: '2', 99: '3', 100: '4', 101: '5', 102: '6', 103: '7', 104: '8', 105: '9',
			48: '0', 49: '1', 50: '2', 51: '3', 52: '4', 53: '5', 54: '6', 55: '7', 56: '8', 57: '9'
		};

		if(code == 13) {
			$('.keybaord-btn-item[data-val="login"]').trigger('click');
		} else if(code == 8) {
			$('.keybaord-btn-item[data-val="del"]').trigger('click');
			return false;
		} else if((code >= 96 && code <= 105) || (code >= 48 && code <= 57)) {
			$('.keybaord-btn-item[data-val="' + codeArr[code] + '"]').trigger('click');
		}
	});

	$('#myTabs a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});

	$(document)
		.on('click', '.goods-item', function() {
			var goods = $(this);
			var id = goods.attr('data-id');
			addToBasket(id);
			/*var price = goods.attr('data-price');
			var name = goods.attr('data-name');
			var basketList = $('.custom-basket-table-body-list');
			var goodsInBasket = basketList.find('.custom-basket-table-tr[data-goods-id="' + id + '"]');

			if(goodsInBasket.length) {
				var goodsCount = goodsInBasket.find('.goods-count');
				var count = parseFloat(goodsCount.html()) + 1;
				var price = parseFloat(goodsInBasket.find('.goods-price').html());
				var totalPrice = price * count;

				goodsCount.html(count);
				goodsInBasket.find('.goods-total-price').html(totalPrice);
			} else {
				var newGoodsForBasket = $('.custom-basket-table-tr-example').clone(true).removeClass('custom-basket-table-tr-example hidden');
				newGoodsForBasket
					.attr('data-goods-id', id)
					.find('.goods-name').html(name)
					.siblings('.goods-count').html(1)
					.siblings('.goods-price').html(price)
					.siblings('.goods-total-price').html(price);
				basketList.append(newGoodsForBasket);
			}

			calcTotalPrice();*/

			return false;
		})
		.on('click', '.basket-goods-remove', function() {
			var tr = $(this).closest('.custom-basket-table-tr');
			var id = tr.attr('data-goods-id');
			removeFromBasket(id);
			/*
			var goodsCount = tr.find('.goods-count');
			var count = parseInt(goodsCount.html());

			count--;
			if(count > 0) {
				var price = parseFloat(tr.find('.goods-price').html());
				var totalPrice = parseFloat(count) * price;

				goodsCount.html(count);
				tr.find('.goods-total-price').html(totalPrice);
			} else {
				tr.remove();
			}

			calcTotalPrice();*/

			return false;
		})
		.on('click', '.basket-goods-clear', function() {
			if(confirm('Clear basket?')) {
				clearBasket();
			}

			return false;
		})
		.on('click', '.basket-goods-save', function() {
			saveBasket();
			return false;
		})
		.on('click', '.basket-goods-return-saved', function() {
			$('.saved-basket-side').slideDown();
			return false;
		});

	var calcTotalPrice = function() {
		var basket = getBasketCookie();
		var total = 0;

		for(var id in basket) {
			var info = getItemInfo(id);
			total += parseFloat(basket[id]) * parseFloat(info['price']);
		}

		$('.basket-total-price').html(total);

		var saveBtn = $('.basket-goods-save');
		var payBtn = $('.basket-goods-pay');
		if(total == 0) {
			saveBtn.addClass('disabled');
			payBtn.addClass('disabled');
		} else {
			saveBtn.removeClass('disabled');
			payBtn.removeClass('disabled');
		}
		/*var basketList = $('.custom-basket-table-body-list');
		var total = 0;

		basketList.find('.custom-basket-table-tr').each(function() {
			var item = $(this);

			total += parseFloat(item.find('.goods-total-price').html());
		});

		$('.basket-total-price').html(total);*/
	};

	//calcTotalPrice();

	var addToBasket = function(id) {
		var goodsCount = getBasketCookie(id);

		if(!goodsCount) {
			goodsCount = 1;
		} else {
			goodsCount++;
		}

		setBasketCookie(id, goodsCount);

		drawItem(id, goodsCount);

		calcTotalPrice();
	};

	var removeFromBasket = function(id) {
		var goodsCount = getBasketCookie(id);

		if(!goodsCount) {
			goodsCount = 0;
		} else {
			goodsCount--;
		}

		setBasketCookie(id, goodsCount);

		drawItem(id, goodsCount);

		calcTotalPrice();
	};

	var drawItem = function(id, n) {
		var itemInfo = getItemInfo(id);
		var item = $('.custom-basket-table-tr[data-goods-id="' + id + '"]');

		if(!n) {
			item.remove();
			return false;
		}

		if(!item.length) {
			item = $('.custom-basket-table-tr.custom-basket-table-tr-example').clone(true).removeClass('custom-basket-table-tr-example hidden');
			item.attr('data-goods-id', id);
			item.find('.goods-name').text(itemInfo['name']);
			item.find('.goods-price').text(itemInfo['price']);
			$('.custom-basket-table-body-list').append(item);
		}

		item.find('.goods-count').text(n);
		item.find('.goods-total-price').text(parseFloat(n) * parseFloat(itemInfo['price']));
	};

	var getItemInfo = function(id) {
		var result = {'name': '', 'price': 0, 'img': ''};
		var item = $('.goods-item[data-id="' + id + '"]');

		result['name'] = item.attr('data-name');
		result['price'] = item.attr('data-price');
		//result['img'] = item.find('.img-responsive').attr('src');

		return result;
	};

	var initBasket = function() {
		var basket = getBasket();

		for(var id in basket) {
			drawItem(id, basket[id]);
		}

		calcTotalPrice();
	};

	var checkBasket = function() {
		var basket = $.cookie('basket');

		if(!basket) {
			basket = {};
			setBasket(basket);
		} else {
			basket = $.parseJSON(basket);
		}

		return basket;
	};

	var getBasket = function() {
		return checkBasket();
	};

	var setBasket = function(basket) {
		$.cookie('basket', JSON.stringify(basket));
	};

	var getBasketCookie = function(id) {
		var result = getBasket();

		if(id) {
			result = result[id];
		}

		return result;
	};

	var setBasketCookie = function(id, n) {
		var basket = getBasketCookie();

		basket[id] = n;

		setBasket(basket);
	};

	var clearBasket = function() {
		var basket = getBasket();
		for(var id in basket) {
			var count = parseInt(basket[id]);
			for(var i = 0; i < count; i++) {
				removeFromBasket(id);
			}
		}
	};

	var getGoodsCount = function() {
		var count = 0;
		var basket = getBasket();

		for(var id in basket) {
			count += parseInt(basket[id]);
		}

		return count;
	};

	var setSavedBasket = function(savedBasket) {
		$.cookie('savedBasket', JSON.stringify(savedBasket));
	};

	var getSavedBasket = function() {
		var savedBasket = $.cookie('savedBasket');

		if(!savedBasket) {
			savedBasket = [];
			setSavedBasket(savedBasket);
		} else {
			savedBasket = $.parseJSON(savedBasket);
		}

		return savedBasket;
	};

	var initSavedBasket = function() {
		var savedBasket = getSavedBasket();
		var returnBtn = $('.basket-goods-return-saved');

		if(savedBasket.length) {
			returnBtn.removeClass('disabled');
		} else {
			returnBtn.addClass('disabled');
		}
	};

	var saveBasket = function() {
		var savedBasket = getSavedBasket();
		var basket = getBasket();
		var basketGoodsCount = getGoodsCount();

		if(basketGoodsCount) {
			savedBasket.push(basket);
			setSavedBasket(savedBasket);
			clearBasket();

			if(savedBasket.length == 1) {
				$('.basket-goods-return-saved').removeClass('disabled');
			}
		}
	};



	initBasket();
	initSavedBasket();
});