jQuery.noConflict();

$is_mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
if ($is_mobile) {
    console.log('is mobile');
    $form_device = '#play-mobile';
} else {
    console.log('is desktop');
    $form_device = '#play-desk';
}

/* handling cookie */
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

function removeAccents(str) {
    var accents    = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽžATGCLVESP';
    var accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZzatgclvesp";
    str = str.split('');
    var strLen = str.length;
    var i, x;
    for (i = 0; i < strLen; i++) {
        if ((x = accents.indexOf(str[i])) != -1) {
            str[i] = accentsOut[x];
        }
    }
    return str.join('');
}

/* remove duplicate in array */
function unique(list) {
  var result = [];
  jQuery.each(list, function(i, e) {
    if (jQuery.inArray(e, result) == -1) result.push(e);
  });
  return result;
}

/* scroll to anchor */
function scrollTo(element){
    element = element.replace("link", "");
    var $height = jQuery(window).height()/2;
    jQuery('html,body').unbind().animate({scrollTop: jQuery(element).offset().top-$height},'slow');
};

function resetSelection(){
    if ( !$is_mobile ) {
        jQuery('div').removeClass('selected second twice');
        dataArray.length = 0;
        jQuery("#play-desk").hide();
        scrollTo('#desktop-desk');
    }
    jQuery("#mobile-desk").hide();
    jQuery('#anwser').hide();
    jQuery('.starrr').remove();

    jQuery('#jogo-compatibilidade-de-signos').hide();
    jQuery('#ajax-loader').show();

    window.location.reload(false);

    $reset = true;
}

$urlGame = "../../wp-content/themes/odin/jogos/compatibilidade/game.php";

count = 0;
$reset = null;

(function(jQuery){

    var signs = [
        "Aries",
        "Touro",
        "Gêmeos",
        "Câncer",
        "Leão",
        "Virgem",
        "Libra",
        "Escorpião",
        "Sagitário",
        "Capricórnio",
        "Aquário",
        "Peixes"
    ];

    var $img = "https://" + document.location.hostname + "/blog/wp-content/themes/odin/jogos/compatibilidade/img/";

    var imagesSigns = [
        "",
        $img + "/aries.png",
        $img + "/touro.png",
        $img + "/gemeos.png",
        $img + "/cancer.png",
        $img + "/leao.png",
        $img + "/virgem.png",
        $img + "/libra.png",
        $img + "/escorpiao.png",
        $img + "/sagitario.png",
        $img + "/capricornio.png",
        $img + "/aquario.png",
        $img + "/peixes.png",
    ];

/* Desktop only */
    signsLength = signs.length;
    for (i = 0; i < signsLength; i++) {
        jQuery('<div class="col-md-3 sign" data-sign="'+ signs[i] +'"><a href="#"><img class="card-img-top" src="'+ $img + removeAccents(signs[i]) + '.png" alt="'+ signs[i] +'"></a></div>')
        .appendTo('#desktop-desk .card-deck');
    }

    var $twice=null;

    jQuery('.card-deck .sign').click(function() {
        var $this = jQuery(this);

        $this.addClass('selected', !$this.hasClass('selected') && jQuery('.card-deck .sign.selected').length < 2);

        dataArray = new Array();
        jQuery('.selected').each(function(){
            var dataSign = jQuery(this).attr("data-sign");
            if(dataArray.indexOf(dataSign)){
                dataArray.push(dataSign);
                jQuery('.selected[data-sign="'+ dataSign +'"]').each(function(){
                    dataArray.push(dataSign);
                });
            }

            $size = Object.keys(dataArray).length;
        });

        if ( $size == 4 ) {
            $this.addClass('selected second', !$this.hasClass('selected second') && jQuery('.card-deck .sign.selected').length < 2);
        }

        //if element clicked twice
        if(this === $twice) {
            $this.addClass('twice');
            jQuery("#play-desk").show();
            scrollTo('#play-desk');
            if ( jQuery('.selected').length == 2 ) {
                resetSelection();
            }
        }
        else {
            if ( jQuery('.selected').length == 2 ) {
                jQuery("#play-desk").show();
                scrollTo('#play-desk');
            }
            else if ( jQuery('.selected').length > 2 ) {
                resetSelection();
            }
            if ( jQuery('.twice').length ) {
                resetSelection();
            }
        }
        $twice = this;

        console.log($size);
        console.log($twice);

        //Reset All
        if ( dataArray.length == 0 ) {
            resetSelection();
        }

        return false;
    })

    jQuery($form_device).validate({

        submitHandler: function (form) {

        var $form = jQuery($form_device);
        var serializedData = $form.serialize();

          if ($is_mobile) {
              var $inputs = $form.find("select");

              sign1_value  = jQuery('#Sign1').val();
              sign2_value  = jQuery('#Sign2').val();
              sign1_label = jQuery('#Sign1').find('option:selected').text();
              sign2_label = jQuery('#Sign2').find('option:selected').text();

              $inputs.prop("disabled", true);

              console.log('Mobile data:');
              console.log('Sign 1 value && label: ' + sign1_value + ' | ' + sign1_label);
              console.log('Sign 2 value && label: ' + sign2_value + ' | ' + sign2_label);
          } else {

              sign1_label = dataArray["0"];
              if ( $size == 2 && dataArray[2] == null ) {
                  sign2_label = dataArray["0"];
              }
              else {
                  sign2_label = dataArray["2"];
              }

              sign1_value = jQuery.inArray(sign1_label, signs) + 1;
              sign2_value = jQuery.inArray(sign2_label, signs) + 1;

              console.log('Desktop data:');
              console.log('Sign 1 value && label: ' + sign1_value + ' | ' + sign1_label);
              console.log('Sign 2 value && label: ' + sign2_value + ' | ' + sign2_label);

          }

          jQuery('.btn-action').button('loading');

          request = jQuery.ajax({
            url: $urlGame,
            type: "POST",
            data : {
              sign1: sign1_value,
              sign2: sign2_value
            }
          });

          request.done(function (data, textStatus, jqXHR) {

            var answer = jQuery.parseJSON(data);
            console.log(answer);

            count++;
            x = readCookie('astrocmptblt');

            if ( x == null ){

              jQuery('#anwser').show();

              if ( $is_mobile ) {
                  scrollTo('#anwser');
              }


              jQuery('#love .tab-content h4 .sign1').html(sign1_label);
              jQuery('#love .tab-content h4 .sign2').html(sign2_label);
              jQuery('#love .tab-content p').html(answer.love_desc);
              jQuery('<div id="love-score" class="starrr" data-rating=""></div>').insertBefore('#love > label > i');
              jQuery('#love-score').starrr({ rating: answer.love_score, readOnly: true });

              jQuery('#friendship .tab-content h4 .sign1').html(sign1_label);
              jQuery('#friendship .tab-content h4 .sign2').html(sign2_label);
              jQuery('#friendship .tab-content p').html(answer.friendship_desc);
              jQuery('<div id="friendship-score" class="starrr" data-rating=""></div>').insertBefore('#friendship > label > i');
              jQuery('#friendship-score').starrr({ rating: answer.friendship_score, readOnly: true });

              jQuery('#work .tab-content h4 .sign1').html(sign1_label);
              jQuery('#work .tab-content h4 .sign2').html(sign2_label);
              jQuery('#work .tab-content p').html(answer.work_desc);
              jQuery('<div id="work-score" class="starrr" data-rating=""></div>').insertBefore('#work > label > i');
              jQuery('#work-score').starrr({ rating: answer.work_score, readOnly: true });

              jQuery('#sex .tab-content h4 .sign1').html(sign1_label);
              jQuery('#sex .tab-content h4 .sign2').html(sign2_label);
              jQuery('#sex .tab-content p').html(answer.sex_desc);
              jQuery('<div id="sex-score" class="starrr" data-rating=""></div>').insertBefore('#sex > label > i');
              jQuery('#sex-score').starrr({ rating: answer.sex_score, readOnly: true });
            }

            else if (x) {
                jQuery('#warning-modal').modal('hide');
                jQuery('#count').val(count);
            }

          });

          request.fail(function (jqXHR, textStatus, errorThrown) {
            console.error("NOK: " + textStatus, errorThrown);
            console.log(jqXHR.responseText);
          });

          request.always(function () {
              if ($is_mobile) {
                  $inputs.prop("disabled", false);
              }
              jQuery('.btn-action').button('reset');
          });

        }

    });



/* switch image according to sign selected */
  jQuery('#Sign1').change(function(){
      if ( count ) {
          resetSelection();
      } else {
          jQuery('#sign1-image')[0].src = imagesSigns[this.value];
          jQuery('#sign1-image').show();
      }
  });
  jQuery('#Sign2').change(function(){
      if ( count ) {
          resetSelection();
      } else {
          jQuery('#sign2-image')[0].src = imagesSigns[this.value];
          jQuery('#sign2-image').show();
      }
  });


  jQuery( ".bt_again" ).click(function() {
    resetSelection();
    scrollTo('#wrapper');
    jQuery('#anwser').hide();
  });


})(jQuery);
