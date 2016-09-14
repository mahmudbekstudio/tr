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

			return false;
		})
		.on('click', '.basket-goods-remove', function() {
			var tr = $(this).closest('.custom-basket-table-tr');
			var id = tr.attr('data-goods-id');

			removeFromBasket(id);

			return false;
		})
		.on('click', '.basket-goods-add', function() {
			var tr = $(this).closest('.custom-basket-table-tr');
			var id = tr.attr('data-goods-id');

			addToBasket(id);

			return false;
		})
		.on('click', '.basket-goods-clear', function() {
			if(confirm('Clear basket?')) {
				clearBasket();
			}

			return false;
		})
		.on('click', '.basket-goods-save', function() {
			var dTime = saveBasket();
			$('.custom-saved-basket-table-body-list').find('.custom-basket-table-tr[data-saved-basket-time="' + dTime + '"]').find('.saved-basket-goods-note').trigger('click');
			return false;
		})
		.on('click', '.saved-basket-goods-note', function() {
			var row = $(this).closest('.custom-basket-table-tr');
			var rowId = row.attr('data-saved-basket-time');
			var popup = $('#savePopup');
			var savedBasketList = getSavedBasket();
			var selectedBasket;

			for(var val in savedBasketList) {
				if(savedBasketList[val].date == rowId) {
					selectedBasket = savedBasketList[val];
					break;
				}
			}

			var savedBasketTotal = 0;
			for(var id in selectedBasket.basket) {
				var itemInfo = getItemInfo(id);

				savedBasketTotal += itemInfo.price * selectedBasket.basket[id];
			}

			popup.attr('data-row-id', selectedBasket.date);
			popup.find('.save-popup-total').html(getMoney(savedBasketTotal));
			popup.find('.save-popup-note').val(selectedBasket.note);

			popup.modal('show');
			return false;
		})
		.on('click', '.save-popup-btn', function() {
			var popup = $('#savePopup');
			var rowId = popup.attr('data-row-id');
			var savedBasketList = getSavedBasket();
			var newSavedBasketList = [];
			var activeRowId;

			for(var val in savedBasketList) {
				if(savedBasketList[val].date == rowId) {
					savedBasketList[val].note = popup.find('.save-popup-note').val();
				}

				newSavedBasketList.push(savedBasketList[val]);
			}

			var rowList = $('.custom-saved-basket-table-body-list');
			var activeRow = rowList.find('.custom-basket-table-tr.active-tr-row');
			if(activeRow.length) {
				activeRowId = activeRow.attr('data-saved-basket-time');
			}

			setSavedBasket(newSavedBasketList);
			initSavedBasket();

			if(activeRowId) {
				rowList.find('.custom-basket-table-tr[data-saved-basket-time="' + activeRowId + '"]').addClass('active-tr-row');
			}

			popup.modal('hide');
			return false;
		})
		.on('click', '.basket-goods-return-saved', function() {
			$('.saved-basket-side').slideDown(200, function() {
				$('.site-content-col1.basket-side').addClass('visible-hidden');
			});

			$('.saved-goods-right-side').slideDown(200, function() {
				$('.goods-right-side').addClass('visible-hidden');
			});
			return false;
		})
		.on('click', '.saved-basket-close', function() {
			$('.saved-basket-side').slideUp(200, function() {
				$('.site-content-col1.basket-side').removeClass('visible-hidden');
			});

			$('.saved-goods-right-side').slideUp(200, function() {
				$('.goods-right-side').removeClass('visible-hidden');
			});
			return false;
		})
		.on('click', '.saved-basket-name, .saved-basket-date, .saved-basket-total-price', function() {
			var row = $(this).closest('.custom-basket-table-tr');
			var list = row.closest('.custom-saved-basket-table-body-list');
			var rightSide = $('.saved-goods-right-side');
			var basket = rightSide.find('.basket');
			var checkout = rightSide.find('.checkout');

			if(row.hasClass('active-tr-row')) {
				hideSavedGoodsRightSide();
				row.removeClass('active-tr-row');
				return false;
			}

			list.find('.active-tr-row').removeClass('active-tr-row');

			var rowTime = row.attr('data-saved-basket-time');
			var savedBasketList = getSavedBasket();
			var savedBasket;

			row.addClass('active-tr-row');
			basket.attr('data-saved-basket-time', rowTime).removeClass('hidden');
			checkout.removeClass('hidden');

			for(var val in savedBasketList) {
				if(savedBasketList[val].date == rowTime) {
					savedBasket = savedBasketList[val];
					break;
				}
			}

			var totalPrice = 0;
			for(var id in savedBasket.basket) {
				totalPrice += drawSaveItem(id, savedBasket.basket[id]);
			}

			rightSide.find('.checkout').find('.saved-basket-right-total-price').html(getMoney(totalPrice));

			return false;
		})
		.on('click', '.saved-basket-clear', function() {
			if(confirm('Do you want clear saved basket?')) {
				clearSavedBasket();
			}
			return false;
		})
		.on('click', '.saved-basket-goods-return', function() {
			var basketList = $('.custom-basket-table-body-list').find('.custom-basket-table-tr');
			if(basketList.length) {
				if(confirm('Do you want clear basket?')) {
					clearBasket();
				} else {
					return false;
				}
			}

			var row = $(this).closest('.custom-basket-table-tr');
			var rowTime = row.attr('data-saved-basket-time');
			var savedBasketList = getSavedBasket();
			var newSavedBasketList = [];
			var selectedBasket;

			for(var val in savedBasketList) {
				if(savedBasketList[val].date == rowTime) {
					selectedBasket = savedBasketList[val].basket;
				} else {
					newSavedBasketList.push(savedBasketList[val]);
				}
			}

			setBasket(selectedBasket);
			setSavedBasket(newSavedBasketList);

			if(row.hasClass('active-tr-row')) {
				hideSavedGoodsRightSide();
			}

			initBasket();
			initSavedBasket();

			$('.saved-basket-close').trigger('click');

			return false;
		})
		.on('click', '.saved-basket-goods-right-remove', function() {
			var row = $(this).closest('.custom-basket-table-tr');
			var rowId = row.attr('data-goods-id');
			var basketTime = row.closest('.basket').attr('data-saved-basket-time');

			savedBasketActions(rowId, basketTime, 'remove');

			return false;
		})
		.on('click', '.saved-basket-goods-right-add', function() {
			var row = $(this).closest('.custom-basket-table-tr');
			var rowId = row.attr('data-goods-id');
			var basketTime = row.closest('.basket').attr('data-saved-basket-time');

			savedBasketActions(rowId, basketTime, 'add');
			return false;
		})
		.on('click', '.saved-basket-goods-right-clear', function() {
			var checkout = $(this).closest('.checkout');
			var basket = checkout.siblings('.basket');
			var basketTime = basket.attr('data-saved-basket-time');
			var savedBasket = getSavedBasket();
			var newSavedBasket = [];

			for(var val in savedBasket) {
				if(savedBasket[val].date != basketTime) {
					newSavedBasket.push(savedBasket[val]);
				}
			}

			setSavedBasket(newSavedBasket);
			initSavedBasket();
			checkout.addClass('hidden').find('.saved-basket-right-total-price').html(0);
			basket.addClass('hidden').find('.custom-saved-basket-table-right-body-list').html('');
			return false;
		})
		.on('click', '.basket-goods-item-remove', function() {
			var rowItem = $(this).closest('.custom-basket-table-tr');
			var rowId = rowItem.attr('data-goods-id');
			var basketList = getBasket();
			var newBasketList = {};

			for(var id in basketList) {
				if(id != rowId) {
					newBasketList[id] = basketList[id];
				}
			}

			setBasket(newBasketList);
			initBasket();

			return false;
		})
		.on('click', '.saved-basket-goods-item-right-remove', function() {
			var row = $(this).closest('.custom-basket-table-tr');
			var rowId = row.attr('data-goods-id');
			var basketTime = row.closest('.basket').attr('data-saved-basket-time');
			var savedBasketList = getSavedBasket();
			var newSavedBasket = [];

			for(var val in savedBasketList) {
				if(savedBasketList[val].date == basketTime) {
					var totalCount = 0;
					var savedBasketItem = savedBasketList[val].basket;
					savedBasketList[val].basket = {};

					for(var id in savedBasketItem) {
						if(id != rowId) {
							savedBasketList[val].basket[id] = savedBasketItem[id];
							totalCount += savedBasketList[val].basket[id];
						}
					}

					if(totalCount) {
						newSavedBasket.push(savedBasketList[val]);
					}
				} else {
					newSavedBasket.push(savedBasketList[val]);
				}
			}


			setSavedBasket(newSavedBasket);
			initSavedBasket();
			row.remove();
			var tr = $('.saved-basket-side').find('.custom-basket-table-tr[data-saved-basket-time="' + basketTime + '"]');
			if(tr.length) {
				tr.addClass('active-tr-row');
			} else {
				hideSavedGoodsRightSide();
			}

			return false;
		})
		.on('click', '.saved-basket-goods-right-return', function() {
			var basketTime = $(this).closest('.checkout').siblings('.basket').attr('data-saved-basket-time');

			$('.saved-basket-side').find('.custom-basket-table-tr[data-saved-basket-time="' + basketTime + '"]').find('.saved-basket-goods-return').trigger('click');

			return false;
		})
		.on('click', '.basket-goods-pay', function() {
			clickPayButton();
			return false;
		})
		.on('click', '.saved-basket-goods-pay', function() {
			clickPayButton(true);
			return false;
		})
		.on('click', '.pay-by-card', function() {
			payRequest('card');
			return false;
		})
		.on('click', '.pay-by-cash', function() {
			payRequest('cash');
			return false;
		})
		.on('click', '.vip-user-item', function() {
			var userId = $(this).attr('data-id');
			payRequest('vip:' + userId);
			return false;
		});

	$('#payPopup').on('hidden.bs.modal', function (e) {
		var btn = $('.show-vip-list');
		if(btn.siblings('.popover').length) {
			btn.trigger('click');
		}
	});

	$('.show-vip-list').popover({
		content: $('#vipUsersList'),
		html: true,
		placement: 'top',
		title: 'VIP'
	});

	var payRequest = function(type) {
		var sendSaveBasket = getSendBasket();
		var requestBasket = getRequestBasket();

		sendSaveBasket.type = type;
		requestBasket.push(sendSaveBasket);

		if(sendSaveBasket.saved) {
			var savedBasketList = getSavedBasket();
			var newSavedBasket = [];

			for(var val in savedBasketList) {
				if(savedBasketList[val].date != sendSaveBasket.date) {
					newSavedBasket.push(savedBasketList[val]);
				}
			}

			setSavedBasket(newSavedBasket);
			initSavedBasket();
			hideSavedGoodsRightSide();
		} else {
			setBasket({});
			initBasket();
		}

		setRequestBasket(requestBasket);
		setSendBasket({});

		$('#payPopup').modal('hide');

		sendRequest();
	};

	var sendRequest = function() {
		var requestBasket = getRequestBasket();

		var xhr = $.ajax({
			type: 'post',
			url: 'addbasket',
			data: 'requestBasket=' + JSON.stringify(requestBasket),
			success: function(data) {
				console.log(data);
				//TODO: after request
			},
			//error: this.error,
			dataType: 'json',
			async: true
		});
	};

	var clickPayButton = function(saved) {
		var basket;
		var dTime = (new Date()).getTime();
		saved = saved || false;

		if(saved) {
			var basketTime = $('.saved-basket-side').find('.custom-basket-table-tr.active-tr-row').attr('data-saved-basket-time');
			var savedBasketList = getSavedBasket();

			for(var val in savedBasketList) {
				if(basketTime == savedBasketList[val].date) {
					basket = savedBasketList[val].basket;
					dTime = savedBasketList[val].date;
					break;
				}
			}
		} else {
			basket = getBasket();
		}

		basket = {date: dTime, saved: saved, basket: basket};
		setSendBasket(basket);

		openPayPopup();
	};

	var openPayPopup = function() {
		var popup = $('#payPopup');
		var sendBasket = getSendBasket();
		var total = 0;

		if(!sendBasket.basket) {
			return false;
		}

		for(var id in sendBasket.basket) {
			var info = getItemInfo(id);
			total += sendBasket.basket[id] * info.price;
		}

		if(!total) {
			return false;
		}

		popup.find('.pay-popup-total').html(getMoney(total));

		popup.modal('show');
	};

	var getMoney = function(money) {
		money = parseFloat(money);
		return money.format(0, 3, ' ', ',');
	};

	var setRequestBasket = function(basket) {
		$.cookie('requestBasket', JSON.stringify(basket));
	};

	var getRequestBasket = function() {
		var basket = $.cookie('requestBasket');

		if(!basket) {
			basket = [];
			setSendBasket(basket);
		} else {
			basket = $.parseJSON(basket);
		}

		return basket;
	};

	var setSendBasket = function(basket) {
		$.cookie('sendBasket', JSON.stringify(basket));
	};

	var getSendBasket = function() {
		var basket = $.cookie('sendBasket');

		if(!basket) {
			basket = {};
			setSendBasket(basket);
		} else {
			basket = $.parseJSON(basket);
		}

		return basket;
	};

	var calcTotalPrice = function() {
		var basket = getBasketCookie();
		var total = 0;

		for(var id in basket) {
			var info = getItemInfo(id);
			total += parseFloat(basket[id]) * parseFloat(info['price']);
		}

		$('.basket-total-price').html(getMoney(total));

		var saveBtn = $('.basket-goods-save');
		var payBtn = $('.basket-goods-pay');
		if(total == 0) {
			saveBtn.addClass('disabled');
			payBtn.addClass('disabled');
		} else {
			saveBtn.removeClass('disabled');
			payBtn.removeClass('disabled');
		}
	};


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
		var item = $('.custom-basket-table-body-list').find('.custom-basket-table-tr[data-goods-id="' + id + '"]');

		if(!n) {
			item.remove();
			return false;
		}

		if(!item.length) {
			item = $('.custom-basket-table-tr.custom-basket-table-tr-example').clone(true).removeClass('custom-basket-table-tr-example hidden');
			item.attr('data-goods-id', id);
			item.find('.goods-name').text(itemInfo['name']);
			item.find('.goods-price').text(getMoney(itemInfo['price']));
			$('.custom-basket-table-body-list').append(item);
		}

		item.find('.goods-count').find('.value').text(n);
		item.find('.goods-total-price').text(getMoney(parseFloat(n) * parseFloat(itemInfo['price'])));

		var tdList = item.find('.custom-basket-table-td');
		tdList.removeClass('added').addClass('added');
		setTimeout(function() {
			tdList.removeClass('added');
		}, 500);
	};

	var getItemInfo = function(id) {
		var result = {'name': '', 'price': 0, 'img': ''};
		var item = $('.goods-item[data-id="' + id + '"]');

		result['name'] = item.attr('data-name');
		result['price'] = item.attr('data-price');
		result['img'] = item.attr('data-image');

		return result;
	};

	var initBasket = function() {
		var basket = getBasket();

		$('.custom-basket-table-body-list').html('');

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

		$('.custom-saved-basket-table-body-list').html('');

		for(var val in savedBasket) {
			addToListSavedBasket(savedBasket[val]);
		}
	};

	var addToListSavedBasket = function(savedBasket) {
		var basketHave = '';
		var basketTotal = 0;
		var basket = savedBasket.basket;
		var d = new Date(savedBasket.date);
		var example = $('.custom-saved-basket-table-tr-example').clone(true).removeClass('custom-saved-basket-table-tr-example hidden');
		var dDate = d.getDate() < 10 ? '0' + d.getDate() : d.getDate();
		var dMonth = (d.getMonth() + 1) < 10 ? '0' + (d.getMonth() + 1) : (d.getMonth() + 1);
		var dHours = d.getHours() < 10 ? '0' + d.getHours() : d.getHours();
		var dMinuts = d.getMinutes() < 10 ? '0' + d.getMinutes() : d.getMinutes();
		var dSeconds = d.getSeconds() < 10 ? '0' + d.getSeconds() : d.getSeconds();

		example.attr('data-saved-basket-time', savedBasket.date);
		example.find('.saved-basket-date').html(dDate + '.' + dMonth + '.' + d.getFullYear() + ' ' + dHours + ':' + dMinuts + ':' + dSeconds);
		example.find('.saved-basket-goods-note').html(savedBasket.note);

		for(var val in basket) {
			var item = $('.goods-item[data-id="' + val + '"]');
			var itemPrice = item.attr('data-price');
			var itemCount = basket[val];
			var itemName = item.attr('data-name');

			if(itemCount) {
				if(basketHave) {
					basketHave += ', ';
				}
				basketHave += itemName;

				basketTotal += itemPrice * itemCount;
			}
		}

		example.find('.saved-basket-name').html(basketHave);
		example.find('.saved-basket-total-price').html(getMoney(basketTotal));

		$('.custom-saved-basket-table-body-list').append(example);
	};

	var saveBasket = function() {
		var savedBasket = getSavedBasket();
		var basket = getBasket();
		var basketGoodsCount = getGoodsCount();

		if(basketGoodsCount) {
			var dTime = (new Date()).getTime();
			var addToSavedBasket = {date: dTime, basket: basket, note: ''};

			addToListSavedBasket(addToSavedBasket);
			savedBasket.push(addToSavedBasket);
			setSavedBasket(savedBasket);
			clearBasket();

			if(savedBasket.length == 1) {
				$('.basket-goods-return-saved').removeClass('disabled');
			}

			return dTime;
		}
	};

	var clearSavedBasket = function() {
		hideSavedGoodsRightSide();
		setSavedBasket([]);
		initSavedBasket();
	};

	var hideSavedGoodsRightSide = function() {
		var side = $('.saved-goods-right-side');
		side.find('.custom-saved-basket-table-right-body-list').html('');
		side.find('.basket').attr('data-saved-basket-time', '').addClass('hidden');
		side.find('.checkout').addClass('hidden');
		side.find('.saved-basket-right-total-price').html(0);
	};

	var drawSaveItem = function(id, n) {
		var itemInfo = getItemInfo(id);
		var side = $('.saved-goods-right-side');
		var item = side.find('.custom-basket-table-tr[data-goods-id="' + id + '"]');
		var totalPrice = parseFloat(n) * parseFloat(itemInfo['price']);

		if(!n) {
			item.remove();
			return 0;
		}

		if(!item.length) {
			item = $('.custom-saved-basket-table-right-tr-example').clone(true).removeClass('custom-saved-basket-table-right-tr-example hidden');
			item.attr('data-goods-id', id);
			item.find('.right-goods-name').text(itemInfo['name']);
			item.find('.right-goods-price').text(getMoney(itemInfo['price']));
			side.find('.custom-saved-basket-table-right-body-list').append(item);
		}

		item.find('.right-goods-count').find('.saved-value').text(n);
		item.find('.right-goods-total-price').text(getMoney(totalPrice));

		return totalPrice;
	};

	var savedBasketActions = function(rowId, basketTime, action) {
		var savedBasket = getSavedBasket();
		var newSavedBasket = [];

		if(!action || action != 'add') {
			action = 'remove';
		}

		for(var val in savedBasket) {
			if(savedBasket[val].date == basketTime) {
				var totalCount = 0;

				for(var id in savedBasket[val].basket) {
					if(id == rowId) {
						if(action == 'add') {
							savedBasket[val].basket[id]++;
						} else {
							savedBasket[val].basket[id]--;
						}
						drawSaveItem(id, savedBasket[val].basket[id]);
					}
					totalCount += savedBasket[val].basket[id];
				}

				if(totalCount) {
					newSavedBasket.push(savedBasket[val]);
				}
			} else {
				newSavedBasket.push(savedBasket[val]);
			}
		}

		setSavedBasket(newSavedBasket);
		initSavedBasket();
		var tr = $('.saved-basket-side').find('.custom-basket-table-tr[data-saved-basket-time="' + basketTime + '"]');
		if(tr.length) {
			tr.addClass('active-tr-row');
		} else {
			hideSavedGoodsRightSide();
		}
	};



	initBasket();
	initSavedBasket();
});