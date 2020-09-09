$(function() {
	$('.lazy').Lazy({
        // your configuration goes here
        scrollDirection: 'vertical',
        effect: 'fadeIn',
        visibleOnly: true,
        onError: function(element) {
            console.log('error loading ' + element.data('src'));
        }
    });
	$(".fancybox").fancybox();
	$(".flexnav").flexNav();
	$("#myCarousel").carousel();

	// hide #back-top first
	$("#back-bottom").hide();


	$(window).scroll(function () {
		if ($(this).scrollTop() < $(document).height()-$(window).height()-200) {
			$('#back-bottom').slideDown();
		} else {
			$('#back-bottom').slideUp();
		}
	});

	// scroll body to 0px on click
	$('#back-bottom a').click(function () {
		$('body,html').animate({
			scrollTop: $(document).height()-$(window).height()
		}, 800);
		return false;
	});

	$("#back-top").hide();

	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#back-top').slideDown();
		} else {
			$('#back-top').slideUp();
		}
	});

	// scroll body to 0px on click
	$('#back-top a').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});


	//handle click button receive messages
	$('#receive-messages').on('click', function() {
		content = $('#form-messages').serialize();

		$.ajax({
			type : 'POST',
			url	 : './receive_messages',
			data : content,
			success: function(data) {
				result = JSON.parse(data);

				if(result.result) {
					$('div.messages-register').empty().html('<div class = "success-messages"><p>' + result.result + '</p></div>');
				} else {
					$('div.messages-register').empty().append('<p class= "error-messages">' + result.error + '</p>');
				}
			}
		})
		
		return false;
	});

	$('.error-re').on('click', function() {
		$(this).empty();
	});

	//handle click button receive messages
	$('#submit-phone').on('click', function(e) {
		content = $('#callback_form').serialize();
		
		$.ajax({
			type : 'POST',
			url	 : './gui-so-dien-thoai.html',
			data : content,
			success: function(data){
				result = JSON.parse(data);

				if(result.success) {
					$('#callback_form input.lazi-alo-number').val('');
					$('div.messages-register').empty().html('<div class = "success-messages"><p>' + result.success + '</p></div>');
				} else {
					$('div.messages-register').empty().append('<p class= "error-messages">' + result.error + '</p>');
				}
			}
		})
		
		return false;
	});


	$('#search-fast').click(function() {
		$('.td-drop-down-search').toggleClass('td-drop-down-search-open');
	});

	$(".tab_content").hide();
	
    tabActive = $('ul.tabs li.active').attr("rel");
    $("#"+tabActive).show();

	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).attr("rel"); 
		$("#"+activeTab).show(); 
	});
	$("#list-partner").owlCarousel({
		items:1,
		nav:true,
		loop: true,
		autoPlay : 5000,
		nav:false,dots:true,
		animateOut: 'slideOutUp',
	  	animateIn: 'slideInUp',
		itemsCustom:[[0, 2], [480, 5], [768, 5], [992, 5], [1200, 7] ],
		pagination: false,
		slideSpeed : 800,
		addClassActive: true,  
		afterAction: function (e) {
		if(this.$owlItems.length > this.options.items){
		$('.slider-partner .navslider').show();
		}else{
		$('.slider-partner .navslider').hide();
		}
		}            
		});
		$('.slider-partner .navslider .prev').on('click', function(e){
		e.preventDefault();
		$('.parter-slider .inner').trigger('owl.prev');
		});

		$('.slider-partner .navslider .next').on('click', function(e){
		e.preventDefault();
		$('.slider-partner .inner').trigger('owl.next');
	});



	$(window).scroll(function() {
		headerTop = $('.header-top').height();

		if($(window).scrollTop() > headerTop) {
			$('.header-top').addClass('header-fixed');
			$('.header-top').addClass('fadeInDown animated');
		} else {
			$('.header-top').removeClass('header-fixed fadeInDown animated');
		}
	});

	$('#search').click(function() {
		$('.td-drop-down-search').toggleClass('td-drop-down-search-open');
	});
		
	$('#sidebar-left .box-cate-left').on('click','h3', function(){
		if($(this).parent('.box-cate-left').hasClass('show')){
			$(this).parent('.box-cate-left').removeClass('show').find('ul').slideUp(300);
		}else{
			$(this).parent('.box-cate-left').addClass('show').find('ul').slideDown(300);
		}
		

	});

	$('#sidebar-left ').on('click','h2', function(){
		if($(this).parent('#sidebar-left').hasClass('show')){
			$(this).parent('#sidebar-left').removeClass('show').find('filter-main').slideUp(300);
		}else{
			$(this).parent('#sidebar-left').addClass('show').find('filter-main').slideDown(300);
		}
		

	});

	$('#sidebar-left .box-cate-left i.fa-sort-desc').on('click', function(){
		$(this).closest('li').find('ul').first().slideToggle();
	});

	$('.about-pannel button.btn-link').click(function(){
		idCollape = $(this).attr('data-target');
		$('.about-pannel button.btn-link').addClass('collapsed');
		$('.about .collapse').removeClass('in');
	});



	$('a.buy-now').on('click', function(e){
		e.preventDefault();
		data = $('#cart-submit-detail').serialize();
		if (! validateForm()) {
			return false;
		}
		$.ajax({
			type : 'POST',
			url  : './gio-hang',
			data : data,
			success : function(data){
				result = JSON.parse(data);
				if( result.result){
					window.location.href = './xem-gio-hang';
				}else{
					alert(result.error);
				}
				
			}
		})
	});

	$('#responsive-btn').on('click', function(e){
		e.preventDefault();
		$(this).next().slideToggle();
	})
	jQuery(document).on('click','.has-child span.menu-btn-wrapper', function() { 
		$(this).parent().find('ul').slideToggle();
	})


	jQuery(document).on('click', 'a.add-to-cart', function(e){
		e.preventDefault();
		var name = $(this).attr('data-name');
		var qty = $(this).attr('data-qty');
		var price = $(this).attr('data-price');
		var id = $(this).attr('data-id');
		$.ajax({
			type : 'POST',
			url  : './gio-hang',
			data : { name : name, qty: qty , price : price, id: id, checkout : 0},
			success : function(data){
				result = JSON.parse(data);
				if(result.result){
					// $('#cart-content span').empty().html(result.total);
					$('#cart-top .number-cart').empty().html(result.total);
					$('#minicart').empty().html(result.minicart);
					$('body,html').animate({
						scrollTop: 0
					}, 800);
				}else{
					alert('Thêm giỏ hàng thất bại');
				}
			}
		})
	});


	$('.product-item .quick-view').on('click',  function(e){
		e.preventDefault();
		url = $(this).attr('href');
		if($(this).data('active') > 0) {
			$('#cartModal .modal-body').load(url, function(data) {
				$('#cartModal').modal({show:true});
			});
		} else {
			$('#notifyModal').modal({show: true});
		}
	});

	//handel cart

	$('#cartModal #hidden-btn-add').on('click', function(){
		
		data = $('#cart-submit').serialize();
		$.ajax({
			type : 'POST',
			url  : $('#cart-submit').attr('action'),
			data : data,
			success : function(data){
				result = JSON.parse(data);
				if(result.result){
					$('#cart-content span').empty().html(result.total);
					$('#cart-top .number-cart').empty().html(result.total);
					$('#cartModal').modal('hide');
				}else{
					alert('Thêm giỏ hàng thất bại');
				}
			}
		})
	});


	$('#add_to_cart').on('click', function(e){

		e.preventDefault();
		data = $('#cart-submit-detail').serialize();
		if (! validateForm()) {
			return false;
		}
		$.ajax({
			type : 'POST',
			url  : $('#cart-submit-detail').attr('action'),
			data : data,
			success : function(data){
				result = JSON.parse(data);
				if(result.result){
					$('#cart-content span').empty().html(result.total);
					$('#cart-top .number-cart').empty().html(result.total);
					$('#cartModal').modal('hide');
				}else{
					alert('Thêm giỏ hàng thất bại');
				}
			}
		})
	});



	$('#list-cart-hover .action-cart a').on('click', function(e){
		e.preventDefault();
		_this = $(this);

		$.ajax({
			type : 'POST',
			url  : _this.attr('href'),
			data : 'cart=remove-cart',
			success : function(data){
				
				result = JSON.parse(data);
				if(result.result) {
					_this.closest('li').slideUp();
					$('.cart-hover-body #grand-total-all').empty().html(result.grand_total);
					$('.cart-hover-body #grand-total').empty().html(result.grand_total);
					$('#cart-top .number-cart').empty().html(result.total);
					
				} else {
					alert('Xóa giỏ hàng thất bại');
				}
			}
		})
	});

	$('#store-shop ').on('change', 'select', function(e){
		e.preventDefault();
		var store = $(this).val();
		$('.list-store ul li').each(function(){
			sub_store = $(this).attr('data-parent');
			if(store == sub_store) {
				$(this).css({'display' : 'block'});
			} else {
				$(this).css({'display' : 'none'});
			}
		});

	});

	$('.list-store ul li').on('click', 'a', function(e){
		e.preventDefault();
		_this = $(this);

		$.ajax({
			type : 'GET',
			url  : './getStoreBranch',
			data : 'id=' + _this.attr('data-id'),
			success : function(data){
				result = JSON.parse(data);
				if(result.error) {
					alert('Bài viết không tồn tại');
				} else {
					$('.main-store-shop').empty().html(result.data);
				}
			}
		})
	});

	$('#form-check-order').on('click', 'input[type="submit"]', function(e){
		e.preventDefault();
		_this = $(this);
		_data = $('#form-check-order').serialize();
		$('#list-order-check').empty()
		$.ajax({
			type : 'GET',
			url  : './checkCustomerOrder',
			data : _data,
			success : function(data){
				result = JSON.parse(data);
				if(result.error) {
					$('#list-order-check').html('<p class="error">Không tìm thấy order của khách hàng ...</p>');
				} else {
					$('#list-order-check').empty().html(result.data);
				}
			}
		})
	});

	$('.product-number-input').on('click', 'button', function() {
		var qty = $('.product-number-input input').val();
		if ( $(this).hasClass('bootstrap-touchspin-down')) {
			if (qty > 1) {
				--qty;
			}
		} else {
			++qty;
		}

		$('.product-number-input input').val(qty);
	});

	$('.product-option-size').on('click', '.product-size', function() {
		// $('.product-option-size input').removeAttr('checked');
		// $('.product-option-size input').attr('checked');
		$(this).parent('.lb_size_gs').find('input').attr('checked');
		$('.product-option-size .product-size').removeClass('selected');
		$(this).addClass('selected');
	})

	$('.product-option-color').on('click', '.product-color', function() {
		$('.product-option-color input').removeAttr('checked');
		// $('.product-option-color input').attr('checked');
		$(this).parent('.lb_size_gs').find('input').attr('checked');
		$('.product-option-color .product-color').removeClass('selected');
		$(this).addClass('selected');
	});

	//handle click button receive messages
	$('#registerLearnForm').on('click', 'button[type="submit"]', function(e) {
		content = $('#registerLearnForm').serialize();
		e.preventDefault();
		if ( msg = validRegisterForm()) {
			$('#registerLearnForm .messages-register').empty().html('<p class= "error-messages">' + msg + '</p>');
			return true;
		}
		
		$.ajax({
			type : 'POST',
			url	 : './register-learn.html',
			data : content,
			success: function(data){
				result = JSON.parse(data);

				if(result.success) {
					$(this).find('p.error').val('');
					$('.messages-register').empty().html('<div class = "success-messages"><p>' + result.message + '</p></div>');
					$("#registerLearnForm").find('input[name="form_key"]').val(result.form_key);
					$("#registerLearnForm").find('input:text, select, textarea').val('');
				} else {
					$(this).find('p.error').val('');
					$('.messages-register').empty().append('<p class= "error-messages">' + result.message + '</p>');
				}
			}
		})
		
		return false;
	});
});

function validRegisterForm() {
	$('#registerLearnForm .messages-register').empty();
	var name = $('#registerLearnForm input[name="name"]').val(),
		phone = $('#registerLearnForm input[name="phone"]').val(),
		email = $('#registerLearnForm input[name="email"]').val(),
		degree = $('#registerLearnForm select[name="degree"]').val();

	if (! name)  {
		message = "Vui lòng nhập họ tên";
	} else if (! phone) {
		message = "Vui lòng nhập số điện thoại";
	} else if (! email) {
		message = "Vui lòng nhập email";
	} else if (! degree) {
		message = "Vui lòng chọn hạng đăng ký";
	} else {
		message = '';
	}

	return message;
}

function validateForm() {
	$('p.error').empty();
	var choose_color = $('#cart-submit-detail input[name="choose_color"]').val();
	var color = $('#cart-submit-detail input[name="color"]:checked').val();
	if (choose_color && typeof color === "undefined") {
		$('.color-error').html('Vui lòng chọn mẫu màu !');
		return false;
	}

	var size = $('#cart-submit-detail input[name="size"]:checked').val();
	var choose_size = $('#cart-submit-detail input[name="choose_size"]').val();
	if (choose_size && typeof size  === "undefined") {
		console.log(232323)
		$('.size-error').html('Vui lòng chọn size !');
		return false;
	}

	return true;
}

///