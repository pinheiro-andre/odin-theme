/* HANDLING COOKIE */
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}


jQuery(document).ready(function($) {
	// fitVids.
	$( '.entry-content' ).fitVids();

	// Responsive wp_video_shortcode().
	$( '.wp-video-shortcode' ).parent( 'div' ).css( 'width', 'auto' );

	/**
	 * Odin Core shortcodes
	 */

	// Tabs.
	$( '.odin-tabs a' ).click(function(e) {
		e.preventDefault();
		$(this).tab( 'show' );
	});

	// Dropdown Menu
	$( '[data-toggle=dropdown-menu]' ).click(function(e) {
		e.preventDefault();
		if ($(this).parent('.ac-menu-item').hasClass('menu-open') || $(this).hasClass('close')) {
			$(this).parents('.ac-menu-item').removeClass('menu-open');
			$('body, html').removeClass('noscroll');
			$('.mask-menu-over').removeClass('active');
		} else {
			$(this).parents('.ac-menu').find('.ac-menu-item').removeClass('menu-open');
			$(this).parents('.ac-menu-item').addClass('menu-open');
			$('body, html').addClass('noscroll');
			$('.mask-menu-over').addClass('active');
		}
	});

	// Tooltip.
	$( '.odin-tooltip' ).tooltip();

	// Consulte-se
	// $( '.wengosense-block .ac-menu-sub-title' ).click(function() {
	// 	$('.wengosense-cached').slideToggle( 'fast' );
	// });

	//initialize swiper
	var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 0,
        loop: true
    });

/* search form */
	$('.search-form').validate({
		rules: {
			navbar_search: {
				minlength: 3
			}
		},
		// messages: {
		// 	navbar_search: 'O que você procura?',
		// },

		highlight: function(element) {
			$(element).closest('#search-result').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('#search-result').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			if(element.parent('#search-result').length) {
				error.insertBefore(element.parent());
			} else {
				error.insertBefore(element);
			}
		},

		submitHandler: function (form) {
			var $form = $('form.search-form');
			var $inputs = $form.find("input");
			$inputs.prop("disabled", true);
			request = $.ajax({
				url: ajaxVars.ajaxurl,
				data: {
					navbar_search : $('form.search-form #navbar_search').val(),
					action : 'astro_search'
				},
				type: "POST",
				timeout	: 50000,
			});

			request.done(function (data, textStatus, jqXHR) {
				console.log('data: '+data);
				console.log('jqXHR: '+jqXHR);

				$('#search-result').fadeIn().html(data);

  				if (jqXHR.status == '200') {
  					$('form.search-form #search-result').html(data);
  				} else {
  					$('form.search-form #search-result').html(jqXHR);
  				}
			});

			request.always(function () {
				$inputs.prop("disabled", false);
			});
		}
	});

/* Avoid empty search */
$('#navbar-search').keyup(function () {
	var target = $(this).parents('form').find('.btn');
    if ($(this).val() == '') {
        target.prop('disabled', true);
				console.log('vide');
    } else {
        target.prop('disabled', false);
    }
}).keyup();


/* Disable data-toggle on main menu */
	if ($(this).width() >= 992) {
		$("#menu-main_menu .menu-item-has-children > a").removeAttr('data-toggle class');
	}

	$(window).resize(function() {
		if ($(this).width() >= 992) {
			$("#menu-main_menu .menu-item-has-children > a").removeAttr('data-toggle class');
		} else {
			$("#menu-main_menu .menu-item-has-children > a").attr("data-toggle", "dropdown");
			$("#menu-main_menu .menu-item-has-children > a").attr("class", "dropdown-toggle");
		}
	});

/* Toggling Notifications button */
	jQuery.fn.extend({
	    toggleText: function(stateOne, stateTwo) {
	        return this.each(function() {
	            stateTwo = stateTwo || '';
	            console.log(stateOne, stateTwo, $(this).text());
	            $(this).text() !== stateTwo  && stateOne
	            ? $(this).text(stateTwo)
	            : $(this).text(stateOne);
	        });
	    }
	});

	$('#subscribe-link').on('click', function() {
		$(this).toggleText('Ativar as notificações', 'Desativar as notificações').next().toggle();
		$(this).toggleClass("is-subscribed-to-push");
	});

/* Estrelafone */
	if ( $('.tve-leads-conversion-object form').length ) {
		var $submit = $('#estrelafone_form button[type="Submit"]');

		$("#estrela_phonenumber").mask("(99) 9999?9-9999");

		$("#estrela_phonenumber").on("blur", function() {
		    var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );

		    if( last.length == 3 ) {
		        var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
		        var lastfour = move + last;

		        var first = $(this).val().substr( 0, 9 );

		        $(this).val( first + '-' + lastfour );
		    }
		});
	}

	$('.tve-leads-conversion-object form').validate({
		rules: {
			name: {
				required: true,
			},
			email: {
				required: true
			}
		},
		messages: {
			email: "Favor digitar um e-mail válido"
		},

		highlight: function(element) {
			$(element).closest($submit).addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest($submit).removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			if(element.parent($name).length) {
				error.insertBefore(element.parent());
			} else {
				error.insertBefore(element);
			}
		},

		submitHandler: function (form) {
			var $form = $('#estrelafone_form');
			var $name = $('#estrela_name');
			var $phonenumber = $('#estrela_phonenumber');

			var $inputs = $form.find("input");
			$inputs.prop("disabled", true);

			request = $.ajax({
				url: ajaxVars.ajaxurl,
				data: {
					name :	$name.val(),
					phonenumber : $phonenumber.val(),
					action : 'estrelafone_api'
				},
				type: "POST",
				timeout	: 50000,
			});

			request.done(function (data, textStatus, jqXHR) {

				var $result = data.slice(0,-1);
				// console.log(jqXHR);
				// console.log('---');
				var json = $.parseJSON($result);
				console.log(json);

				if (json.errorCode == '0') {
					$('.result').html('<strong style="color:green">Obrigado!</strong>');
				}
				else {
					$('.result').html(json.errorMessage);
				}

				$('.tcb-form-loader-icon, .tcb-form-loader').hide();
				$('.tve_submit_container button, .result').show();
			});

			request.always(function () {
				$inputs.prop("disabled", false);
			});
		}
	});

/* Remove AstroshopSense If Cartomancia & Videncia */
	if ( $('#astroshoppingsense_below_article').length ) {

	} else {
		$('.wengosense-cached #text-3').remove();
	}

});
