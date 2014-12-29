jQuery(document).ready(function(){

	/*********************************************************************************************************** Superfish Menu *********************************************************************/
	/* toggle nav */
	jQuery("#menu-icon").on("click", function(){
		jQuery(".sf-menu").slideToggle();
		jQuery(this).toggleClass("active");
	});

	if (jQuery('.container_24').width() < 450) {
		jQuery('.sf-menu').removeClass('sf-js-enabled').find('li.parent').append('<strong></strong>');
		jQuery('.sf-menu li.parent strong').on("click", function(){
			if (jQuery(this).attr('class') == 'opened') { jQuery(this).removeClass().parent('li.parent').find('> ul').slideToggle(); } 
				else {
					jQuery(this).addClass('opened').parent('li.parent').find('> ul').slideToggle();
				}
		});
	};

	/*********************************************************************************************************** Cart Truncated *********************************************************************/
	
	if (jQuery('.container_24').width() < 450) {
		jQuery('.truncated span').click(function(){
				jQuery(this).parent().find('.truncated_full_value').stop().slideToggle();
			}
		)
	}
	else {
		jQuery('.truncated span').hover(function(){
				jQuery(this).parent().find('.truncated_full_value').stop().slideToggle();
			}
		)
	};

	/*********************************************************************************************************** Product View Accordion *********************************************************************/
	if (jQuery('.container_24').width() < 450) {
		jQuery.fn.slideFadeToggle = function(speed, easing, callback) {
		  return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);  
		};
		jQuery('.box-collateral').not('.box-up-sell').find('h2').append('<span class="toggle"></span>');
		jQuery('.form-add').find('.box-collateral-content').css({'display':'block'}).parents('.form-add').find('> h2 > span').addClass('opened');
		
		jQuery('.box-collateral > h2').click(function(){
			OpenedClass = jQuery(this).find('> span').attr('class');
			if (OpenedClass == 'toggle opened') { jQuery(this).find('> span').removeClass('opened'); }
			else { jQuery(this).find('> span').addClass('opened'); }
			jQuery(this).parents('.box-collateral').find(' > .box-collateral-content').slideFadeToggle()
		});
	};
	/*********************************************************************************************************** Sidebar Accordion *********************************************************************/
	if (jQuery('.container_24').width() < 450) {
		jQuery('.sidebar .block .block-title').append('<span class="toggle"></span>');
		jQuery('.sidebar .block .block-title').on("click", function(){
			if (jQuery(this).find('> span').attr('class') == 'toggle opened') { jQuery(this).find('> span').removeClass('opened').parents('.block').find('.block-content').slideToggle(); }
			else {
				jQuery(this).find('> span').addClass('opened').parents('.block').find('.block-content').slideToggle();
			}
		});
	};

	/*********************************************************************************************************** Footer Accordion *********************************************************************/
	if (jQuery('.container_24').width() < 450) {
		jQuery('.footer .footer-col > h4').append('<span class="toggle"></span>');
		jQuery('.footer h4').on("click", function(){
			if (jQuery(this).find('span').attr('class') == 'toggle opened') { jQuery(this).find('span').removeClass('opened').parents('.footer-col').find('.footer-col-content').slideToggle(); }
			else {
				jQuery(this).find('span').addClass('opened').parents('.footer-col').find('.footer-col-content').slideToggle();
			}
		});
	};

	/*********************************************************************************************************** Header Buttons *********************************************************************/
	if (jQuery('.container_24').width() > 800) {
		jQuery('.header-button ul').css({'display':'none'});
		jQuery('.header-button').not('.top-login').hover(
			function(){
				/*ListHeight = jQuery(this).find('ul').height();*/
				jQuery(this).find('a').parent().find('ul').toggle()/*css({'display':'block','height':'0'}).stop().animate({height:ListHeight, opacity: 1}, 200)*/
				jQuery(this).find('a').addClass('active');
			},
			function(){jQuery(this).find('a').parent().find('ul').toggle()/*stop().animate({height:'0', opacity: 0}, 200, 
				function() {
					jQuery(this).css({'display':'none', 'height':ListHeight})
				});*/
			jQuery(this).find('a').removeClass('active');
			}
		);
	}
	else {
		jQuery('.header-button').not('.top-login').click(
			function(){
				Ulheight = jQuery(this).find('ul').css('display');
				if (Ulheight == 'none') {
					jQuery('.header-button').find('ul').hide(0);
					jQuery(this).find('ul').show(0);
					jQuery(this).find('a').addClass('active');
				}
				else {
					jQuery(this).find('ul').hide(0);
					jQuery(this).find('a').removeClass('active');
				}
			}
		)
	};
	
	qwe = jQuery('.lang-list ul li span').text();
	jQuery('.lang-list > a').text(qwe);
	
	/*********************************************************************************************************** Header Cart *********************************************************************/
		jQuery('.block-cart-header .cart-content').hide();
		if (jQuery('.container_24').width() < 800) {
			jQuery('.block-cart-header .summary, .block-cart-header .cart-content, .block-cart-header .empty').click(function(){
				jQuery('.block-cart-header .cart-content').stop(true, true).slideToggle(300);
			})
		}
		else {
			jQuery('.block-cart-header .summary, .block-cart-header .cart-content, .block-cart-header .empty').hover(
				function(){jQuery('.block-cart-header .cart-content').stop(true, true).slideDown(400);},
				function(){	jQuery('.block-cart-header .cart-content').stop(true, true).delay(400).slideUp(300);
				});
			}
});

(function(doc) {

	var addEvent = 'addEventListener',
	    type = 'gesturestart',
	    qsa = 'querySelectorAll',
	    scales = [1, 1],
	    meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

	function fix() {
		meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		doc.removeEventListener(type, fix, true);
	}

	if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		fix();
		scales = [.25, 1.6];
		doc[addEvent](type, fix, true);
	}

}(document));

/*************************************************************************************************************back-top*****************************************************************************/
jQuery(function () {
 jQuery(window).scroll(function () {
  if (jQuery(this).scrollTop() > 100) {
   jQuery('#back-top').fadeIn();
  } else {
   jQuery('#back-top').fadeOut();
  }
 });

 // scroll body to 0px on click
 jQuery('#back-top a').click(function () {
  jQuery('body,html').stop(false, false).animate({
   scrollTop: 0
  }, 800);
  return false;
 });
});

/***************************************************************************************************** Magento class **************************************************************************/
jQuery(document).ready(function() {
	jQuery('.sidebar .block').last().addClass('last_block');
	jQuery('.sidebar .block').first().addClass('first');
	jQuery('.box-up-sell li').eq(2).addClass('last');
	jQuery(' .form-alt li:last-child').addClass('last');
	jQuery('.product-collateral #customer-reviews dl dd, #cart-sidebar .item').last().addClass('last');
    jQuery('.product-view .product-img-box .more-views li:nth-child(4)').last().addClass('item-4');
    jQuery('.header .row-2 .links').first().addClass('LoginLink');
	jQuery('#checkout-progress-state li:odd').addClass('odd');
	jQuery('.product-view .product-img-box .product-image').append('<span></span>');
  
	if (jQuery('.container_24').width() < 450) {
		jQuery('.my-account table td.order-id').prepend('<strong>Order #:</strong>');
		jQuery('.my-account table td.order-date').prepend('<strong>Date: </strong>');
		jQuery('.my-account table td.order-ship').prepend('<strong>Ship To: </strong>');
		jQuery('.my-account table td.order-total').prepend('<strong>Order Total: </strong>');
		jQuery('.my-account table td.order-status').prepend('<strong>Status: </strong>');
		jQuery('.my-account table td.order-sku').prepend('<strong>SKU: </strong>');
		jQuery('.my-account table td.order-price').prepend('<strong>Price: </strong>');
		jQuery('.my-account table td.order-subtotal').prepend('<strong>Subtotal: </strong>');
		
		jQuery('.multiple-checkout td.order-qty, .multiple-checkout th.order-qty').prepend('<strong>Qty: </strong>');
		jQuery('.multiple-checkout td.order-shipping, .multiple-checkout th.order-shipping, ').prepend('<strong>Send To: </strong>');
		jQuery('.multiple-checkout td.order-subtotal, .multiple-checkout th.order-subtotal').prepend('<strong>Subtotal: </strong>');
		jQuery('.multiple-checkout td.order-price, .multiple-checkout th.order-price').prepend('<strong>Price: </strong>');
	}
});

jQuery(window).bind('load resize',function(){
		var maxHeight = 0;
		function setHeight(column) {
			column = jQuery(column);
			column.each(function() {       
				if(jQuery(this).height() > maxHeight) {
					maxHeight = jQuery(this).height();;
				}
			});
			column.height(maxHeight);
		};	
		(function($){$.fn.equalHeights=function(minHeight,maxHeight){tallest=(minHeight)?minHeight:0;this.each(function(){if($(this).height()>tallest){tallest=$(this).height()}});if((maxHeight)&&tallest>maxHeight)tallest=maxHeight;return this.each(function(){$(this).height(tallest)})}})(jQuery)
      sw = jQuery('.container_24').width();
	  if ( sw > 724 ) {
		   setHeight('.products-grid .product-shop');
			jQuery('.product-name-s').equalHeights();
	  } else { 
		  jQuery('.products-grid .product-shop').removeAttr('style');
		   jQuery('.products-grid .product-name-s').removeAttr('style');
	  };
});

jQuery(document).ready(function() {
	if (jQuery('.container_24').width() < 450) {
		jQuery('.related-carousel').jcarousel({
			vertical: false,
			visible:1,
			scroll: 1
		});
	}
	else {
		jQuery('.related-carousel').jcarousel({
			vertical: false,
			visible:3,
			scroll: 1
		});
	}
});
			


