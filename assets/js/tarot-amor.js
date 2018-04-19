var card_container_width = jQuery('#pack_cont').width();
var total_cards = jQuery('.card').length;
var card_spacing = 10;


(function(jQuery){

    jQuery.fn.shuffle = function() {

        var allElems = this.get(),
            getRandom = function(max) {
                return Math.floor(Math.random() * max);
            },
            shuffled = jQuery.map(allElems, function(){
                var random = getRandom(allElems.length),
                    randEl = jQuery(allElems[random]).clone(true)[0];
                allElems.splice(random, 1);
                return randEl;
           });

        this.each(function(i){
            jQuery(this).replaceWith(jQuery(shuffled[i]));
        });

        return jQuery(shuffled);

    };

})(jQuery);

function shuffle(o){ //v1.0
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};

function shufle_cards(){
    //shuffle all cards in DOM
    jQuery('.card').shuffle();

    //create shuffle effect(just to show it to user)
    var i = 0;
    var time = 0;
    var shuffle_time = 4;
    var counter = 0;

    jQuery(jQuery('.card').get().reverse()).each(function(){
    	var card = jQuery(this);
    	setTimeout(function(){
    		card.animate({ 'margin-left' : '145px' },1);
    		setTimeout(function(){
    			card.animate({ 'z-index' : i });
    			card.animate({ 'margin-left' : '0px' },20);
    		},100);
    		i++;
    	},time);
    	time += 600;
    	counter++;
    	//limit shuffle to specific no of times.
    	if(counter > shuffle_time)
    		return false;
    });
    reset_cards();

}

function z_index_fix(){
    jQuery('.card:nth-last-child(5)').css("z-index", "19");
    jQuery('.card:nth-last-child(4)').css("z-index", "20");
    jQuery('.card:nth-last-child(3)').css("z-index", "21");
    jQuery('.card:nth-last-child(2)').css("z-index", "22");
    jQuery('.card:nth-last-child(1)').css("z-index", "23");
}


//slowly separate all cards in a line
function separate_one_by_one(){
    var left = 0;
    var card_width = jQuery('.card').width();
    var card_height = jQuery('.card').height();
    //initial top margin for card placement
    var top = card_height;
    //initial left margin for card placement
    var left_step =  card_width + card_spacing;

    	//time lag between each card placement
    	var sec_step = 100;
    	var time = 0;

    	//loop through all cards
    	jQuery('.card').each(function(){
    		var card = jQuery(this);
    		setTimeout(function(){
    			card.css({
    				'margin-top':top+'px',
    				'margin-left':left+'px',
    			});

    			left = left + left_step;
    			//if card cannot fit in current row then place it card in next row
    			if(left+card_width + card_spacing > card_container_width)
    			{
    				left = 0;
    				top += card_height + card_spacing;
    			}
    		},time);
    		//add time lag for next card placement
    		time += sec_step;
    	});
}

function stack_cards(margin){
	var left = 0;
	var step = margin;
	var i = 0;
	jQuery('.card').each(function(){
		jQuery(this).css({'z-index' : i});
		jQuery(this).css({'margin-left':left+'px'});
		jQuery(this).css({'margin-top':0+'px'});
		left = left + step;
		i++;
	});
}


//bring cards to initail stacked position
function reset_cards(){
	//hide all cards faces
	jQuery('.card').removeClass('open');
	//stack all cards
	stack_cards(0.2);
}



function final_animation(){
	shufle_cards();
	setTimeout(function(){
		separate_one_by_one();
        setTimeout(function(){
            z_index_fix();
        },2000);
	},4000);
}


jQuery(document).ready(function(jQuery) {

    var e = jQuery('#pack_cont .card');
    for (var i = 0; i < 23; i++) {
      e.clone().insertAfter(e);
    }

    //reset card on load
    stack_cards(0.2);
    var $count = 0;

    //card click event
    jQuery('.card').click(function(){
        var $card = jQuery(this);
        $count++;
        $each = [3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36, 39, 42, 45, 48, 51, 54, 57, 60];
        $card.toggleClass('open');

        jQuery.getJSON('/blog/wp-content/themes/odin/jogos/tarot-do-amor/amor.json').done(function(data){
            window.amor = data;
            var obj_keys = Object.keys(window.amor);
            var ran_key = obj_keys[Math.floor(Math.random() *obj_keys.length)];
            window.card = window.amor[ran_key];

            var $image_path = "/blog/wp-content/themes/odin/jogos/tarot-do-amor/img/" + window.card.image + ".jpg"

            jQuery('#modal_tda #modal_tda_label').html(window.card.name);
            jQuery('#modal_tda #image img').attr( 'src', $image_path);
            jQuery('#modal_tda #description').html(window.card.description);
        });


        if ( document.cookie.indexOf("tda") < 0 ) {
            //display modal each 3 clicks
            if( jQuery.inArray( $count, $each ) !== -1 ){
                jQuery('#modal_tda_register').modal('show');
            } else {
                jQuery('#modal_tda').modal('show');
            }
        } else{
            jQuery('#modal_tda').modal('show');
        }

        return false;
    });

//o jogo

/* Form EstrelaFone */
    var $submit = jQuery('#estrala-tarot button');

    jQuery("#tda_phone").mask("(99) 9999?9-9999");
    jQuery("#tda_phone").on("blur", function() {
        var last = jQuery(this).val().substr( jQuery(this).val().indexOf("-") + 1 );

        if( last.length == 3 ) {
            var move = jQuery(this).val().substr( jQuery(this).val().indexOf("-") - 1, 1 );
            var lastfour = move + last;

            var first = jQuery(this).val().substr( 0, 9 );

            jQuery(this).val( first + '-' + lastfour );
        }
    });




	jQuery('#estrala-tarot').validate({
		rules: {
			name: {
				required: true
			}
		},
		messages: {
			name: "Favor digitar seu nome",
		},

		highlight: function(element) {
			jQuery(element).closest($submit).addClass('has-error');
		},
		unhighlight: function(element) {
			jQuery(element).closest($submit).removeClass('has-error');
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
			var $form = jQuery('#estrala-tarot');
			var $name = jQuery('#tda_name');
			var $phonenumber = jQuery('#tda_phone');
            var $from = "";
            if ( jQuery( "#from" ).length ) {
                var $from = jQuery('#from');
            }

			var $inputs = $form.find("input");
			$inputs.prop("disabled", true);

			request = jQuery.ajax({
				url: ajaxVars.ajaxurl,
				data: {
					name :	$name.val(),
					phonenumber : $phonenumber.val(),
                    from : $from.val(),
					action : 'estrelafone_api'
				},
				type: "POST",
				timeout	: 50000,
			});

			request.done(function (data, textStatus, jqXHR) {

				var $result = data.slice(0,-1);
				var json = jQuery.parseJSON($result);

				if (json.errorCode == '0') {
					jQuery('.result').html('<strong style="color:green">Obrigado!</strong>');
                    if ( document.cookie.indexOf("tda") < 0 ) {
                        createCookie('tda','1',1);
                    }
				}
				else {
					jQuery('.result').html('<strong style="color:orange">' + json.errorMessage + '</strong>');
				}

				jQuery('.result').show();
			});

			request.always(function () {
				$inputs.prop("disabled", false);
			});
		}
	});

});
