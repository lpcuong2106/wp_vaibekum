
jQuery(document).ready(function($){

    // for support wp-color-picker
    // $('.htcc-color-wp').wpColorPicker();

    // $('select').material_select();
    // $('select').formSelect();   // v1.0.0.rc.2

    // $('.collapsible').collapsible();


/**
 * Customer Chat - Messenger - position
 */
var cc_i_position = document.querySelectorAll('.cc_i_position');
var cc_g_position = document.querySelectorAll('.cc_g_position');

var cc_i_position_mobile = document.querySelectorAll('.cc_i_position-mobile');
var cc_g_position_mobile = document.querySelectorAll('.cc_g_position-mobile');
  $("#fb_greeting_dialog_delay").on("keypress", function( event ) {
    var key = event.charCode ? event.charCode : event.keyCode;
    if (key > 31 && (key < 48 || key > 57))
    {
      event.preventDefault();
      return false;
    }
  });

//  incase display-block is added remove it ..
var cc_i_remove = function cc_i_remove() {
  cc_i_position.forEach(function (e) {
    e.classList.remove('display-block');
  });
};

var cc_g_remove = function cc_g_remove() {
  cc_g_position.forEach(function (e) {
    e.classList.remove('display-block');
  });
};

var cc_i_remove_mobile = function cc_i_remove_mobile() {
  cc_i_position_mobile.forEach(function (e) {
    e.classList.remove('display-block');
  });
};

var cc_g_remove_mobile = function cc_g_remove_mobile() {
  cc_g_position_mobile.forEach(function (e) {
    e.classList.remove('display-block');
  });
};


function cc_default_display() {

  // icon position
  var val = $('.cc_i_select').find(":selected").val();

  var cc_i_position2 = document.querySelector('.cc_i_position-2');
  var cc_i_position1 = document.querySelector('.cc_i_position-1');
  var cc_i_position3 = document.querySelector('.cc_i_position-3');
  var cc_i_position4 = document.querySelector('.cc_i_position-4');

  if (val == '1') {
    cc_i_position1.classList.add('display-block');
  } else if (val == '2') {
    cc_i_position2.classList.add('display-block');
  } else if (val == '3') {
    cc_i_position3.classList.add('display-block');
  } else if (val == '4') {
    cc_i_position4.classList.add('display-block');
  }


  // onchange - icon - postion
  $(".cc_i_select").on("change", function (e) {
    var x = e.target;
    var val = e.target.value;

    if (val == '1') {
      cc_i_remove();
      cc_i_position1.classList.add('display-block');
    } else if (val == '2') {
      cc_i_remove();
      cc_i_position2.classList.add('display-block');
    } else if (val == '3') {
      cc_i_remove();
      cc_i_position3.classList.add('display-block');
    } else if (val == '4') {
      cc_i_remove();
      cc_i_position4.classList.add('display-block');
    }
  });


  // Greetings dialog position
  var val = $('.cc_g_select').find(":selected").val();

  var cc_g_position2 = document.querySelector('.cc_g_position-2');
  var cc_g_position1 = document.querySelector('.cc_g_position-1');
  var cc_g_position3 = document.querySelector('.cc_g_position-3');
  var cc_g_position4 = document.querySelector('.cc_g_position-4');

  if (val == '1') {
    cc_g_position1.classList.add('display-block');
  } else if (val == '2') {
    cc_g_position2.classList.add('display-block');
  } else if (val == '3') {
    cc_g_position3.classList.add('display-block');
  } else if (val == '4') {
    cc_g_position4.classList.add('display-block');
  }

  // onchange - Greetings - postion
  $(".cc_g_select").on("change", function (e) {
    var x = e.target;
    var val = e.target.value;

    if (val == '1') {
      cc_g_remove();
      cc_g_position1.classList.add('display-block');
    } else if (val == '2') {
      cc_g_remove();
      cc_g_position2.classList.add('display-block');
    } else if (val == '3') {
      cc_g_remove();
      cc_g_position3.classList.add('display-block');
    } else if (val == '4') {
      cc_g_remove();
      cc_g_position4.classList.add('display-block');
    }
  });


  // icon position - mobile
  var val = $('.cc_i_select-mobile').find(":selected").val();

  var cc_i_position2_mobile = document.querySelector('.cc_i_position-2-mobile');
  var cc_i_position1_mobile = document.querySelector('.cc_i_position-1-mobile');
  var cc_i_position3_mobile = document.querySelector('.cc_i_position-3-mobile');
  var cc_i_position4_mobile = document.querySelector('.cc_i_position-4-mobile');

  if (val == '1') {
    cc_i_position1_mobile.classList.add('display-block');
  } else if (val == '2') {
    cc_i_position2_mobile.classList.add('display-block');
  } else if (val == '3') {
    cc_i_position3_mobile.classList.add('display-block');
  } else if (val == '4') {
    cc_i_position4_mobile.classList.add('display-block');
  }

  // onchange - icon - postion - mobile
  $(".cc_i_select-mobile").on("change", function (e) {
    var x = e.target;
    var val = e.target.value;

    if (val == '1') {
      cc_i_remove_mobile();
      cc_i_position1_mobile.classList.add('display-block');
    } else if (val == '2') {
      cc_i_remove_mobile();
      cc_i_position2_mobile.classList.add('display-block');
    } else if (val == '3') {
      cc_i_remove_mobile();
      cc_i_position3_mobile.classList.add('display-block');
    } else if (val == '4') {
      cc_i_remove_mobile();
      cc_i_position4_mobile.classList.add('display-block');
    }
  });


  // Greetings dialog position - mobile
  var val = $('.cc_g_select-mobile').find(":selected").val();

  var cc_g_position2_mobile = document.querySelector('.cc_g_position-2-mobile');
  var cc_g_position1_mobile = document.querySelector('.cc_g_position-1-mobile');
  var cc_g_position3_mobile = document.querySelector('.cc_g_position-3-mobile');
  var cc_g_position4_mobile = document.querySelector('.cc_g_position-4-mobile');

  if (val == '1') {
    cc_g_position1_mobile.classList.add('display-block');
  } else if (val == '2') {
    cc_g_position2_mobile.classList.add('display-block');
  } else if (val == '3') {
    cc_g_position3_mobile.classList.add('display-block');
  } else if (val == '4') {
    cc_g_position4_mobile.classList.add('display-block');
  }

  // onchange - Greetings - postion - mobile
  $(".cc_g_select-mobile").on("change", function (e) {
    var x = e.target;
    var val = e.target.value;

    if (val == '1') {
      cc_g_remove_mobile();
      cc_g_position1_mobile.classList.add('display-block');
    } else if (val == '2') {
      cc_g_remove_mobile();
      cc_g_position2_mobile.classList.add('display-block');
    } else if (val == '3') {
      cc_g_remove_mobile();
      cc_g_position3_mobile.classList.add('display-block');
    } else if (val == '4') {
      cc_g_remove_mobile();
      cc_g_position4_mobile.classList.add('display-block');
    }
  });




};

cc_default_display();












/**
 * Custom Image positions
 */
var ci_position = document.querySelectorAll('.ci_position');
var ci_position_mobile = document.querySelectorAll('.ci_position-mobile');

//  incase display-block is added remove it ..
var remove = function remove() {
  ci_position.forEach(function (e) {
    e.classList.remove('display-block');
  });
};

//  incase display-block is added remove it ..
var remove_mobile = function remove() {
  ci_position_mobile.forEach(function (e) {
    e.classList.remove('display-block');
  });
};


function ci_default_display() {

  var val = $('.select').find(":selected").val();

  var position1 = document.querySelector('.ci_position-1');
  var position2 = document.querySelector('.ci_position-2');
  var position3 = document.querySelector('.ci_position-3');
  var position4 = document.querySelector('.ci_position-4');

  if (val == '1') {
    position1.classList.add('display-block');
  } else if (val == '2') {
    position2.classList.add('display-block');
  } else if (val == '3') {
    position3.classList.add('display-block');
  } else if (val == '4') {
    position4.classList.add('display-block');
  }


  // onchange - postion
  $(".select").on("change", function (e) {
    var x = e.target;
    var val = e.target.value;

    if (val == '1') {
      remove();
      position1.classList.add('display-block');
    } else if (val == '2') {
      remove();
      position2.classList.add('display-block');
    } else if (val == '3') {
      remove();
      position3.classList.add('display-block');
    } else if (val == '4') {
      remove();
      position4.classList.add('display-block');
    }
  });

};

ci_default_display();



function ci_default_display_mobile() {

  var val = $('.select-mobile').find(":selected").val();

  var position1 = document.querySelector('.ci_position-1-mobile');
  var position2 = document.querySelector('.ci_position-2-mobile');
  var position3 = document.querySelector('.ci_position-3-mobile');
  var position4 = document.querySelector('.ci_position-4-mobile');

  if (val == '1') {
    position1.classList.add('display-block');
  } else if (val == '2') {
    position2.classList.add('display-block');
  } else if (val == '3') {
    position3.classList.add('display-block');
  } else if (val == '4') {
    position4.classList.add('display-block');
  }

  // onchange - mobile position
$(".select-mobile").on("change", function (e) {
  var x = e.target;
  var val = e.target.value;

  if (val == '1') {
    remove_mobile();
    position1.classList.add('display-block');
  } else if (val == '2') {
    remove_mobile();
    position2.classList.add('display-block');
  } else if (val == '3') {
    remove_mobile();
    position3.classList.add('display-block');
  } else if (val == '4') {
    remove_mobile();
    position4.classList.add('display-block');
  }
});


};

ci_default_display_mobile();

});



/**
 * makes an ajax call
 * by default service_content will hide using style="display: none;"
 * if ht_cc_service_content option is not set or not equal to hide
 * then show the card  - set display: block
 * ajax action at admin.php
 */
jQuery.post(
    ajaxurl,
    {
        'action': 'ht_cc_service_content',
    },
    function(response){
        if ( 'hide' !== response ) {
            var service_content = document.querySelector(".service-content");
            if ( service_content ) {
                service_content.style.display = "block";
            }
        }
    }
);


/**
 * when clicked on hide at admin - service content
 * makes an ajax call an update / create the ht_cc_service_content option to hide
 * ajax action at admin.php
 */
function ht_cc_admin_hide_services_content() {

jQuery.post(
    ajaxurl,
    {
        'action': 'ht_cc_service_content_hide',
    },
);

var service_content = document.querySelector(".service-content");

if  ( service_content ) {
    service_content.style.display = "none";
}

}


// wpColorPicker
// jQuery(document).ready(function($){
//   $('.htcc-color-wp').wpColorPicker();
// });

jQuery(document).ready(function($){
  if ( $(".htcc-color-wp") ) {
    if ( $(".htcc-color-wp").spectrum ) {
      $(".htcc-color-wp").spectrum({
      preferredFormat: "hex",
      showInput: true,
      allowEmpty:true,
      chooseText:'Select',
      clickoutFiresChange: true
      // showPalette: true,
      // showSelectionPalette: true,
      // palette: [ 'red', 'green', 'blue' ],
      // localStorageKey: "spectrum.homepage",
      });
    }
  }

  $('.button-lazy-load').click(function () {
    $(this).addClass('opacity-button');
    $(this).find('.lazyload').css('display', 'block');
  });

  $('.button-copy').click(function () {
    $(this).siblings('.copiedtext').css('display', 'inline-block');
    var attr = $(this).data('elem');
    var temp = jQuery("<input>");
    jQuery("body").append(temp);
    temp.val(jQuery(attr + " .to-copy").val().trim()).select();
    document.execCommand("copy");
  });

  function addUserRefs() {
    var user_ref, elements = document.querySelectorAll(".fb-send-to-messenger[page_id='1754274684887439']");

    if (elements) {
      for (var i = 0; i < elements.length; i++) {
        user_ref = 'mobile-monkey_' + Math.random().toString(36).substring(2) + Math.random().toString(36).substring(2);
        elements[i].setAttribute('user_ref', user_ref);
        elements[i].setAttribute('origin', window.location.href);
      }
    }
  }

  function getFacebookSDK() {
    if (window.FB) {

      return Promise.resolve(window.FB);
    }

    var pollNumber = 0;

    return new Promise(function (resolve, reject) {
      var intervalId = setInterval(function () {
        if (window.FB) {
          clearInterval(intervalId);
          resolve(window.FB);
        } else if (pollNumber > 300) {
          reject('Cannot reach Facebook SDK');
        } else {
          pollNumber = pollNumber + 1;
        }
      }, 350);
    });
  }

  getFacebookSDK().then(function (FB) {
    var link = document.getElementById('get-mm-free-button__link');
    addUserRefs();

    // Listen to FB events
    FB.Event.subscribe('send_to_messenger', function (e) {

      if (e.event === 'rendered') {

        var iframe = document.getElementById('get-mm-free-button__iframe-container');

        if (iframe && !iframe.classList.contains('fb-send-to-messenger--loaded-iframe')) {
          iframe.classList.add('fb-send-to-messenger--loaded-iframe');
        }
      }


      // The logic below may be different for you if you don't need to open a link like I
      // did for send to messenger plugin

      // Always click the link or button if opt_in
      if (e.event === 'opt_in') {

        if (link) {
          link.click();
        }
      }

      if (e.event === 'clicked') {
        setTimeout(function () {
          setInterval(function () {
            var focused = document.hasFocus();

            // We open up a new modal and Facebook and need to make sure action still takes place if user does not
            // click opt_in
            if (focused && link) {
              setTimeout(function () {
                link.click();
              }, 450);
            }
          }, 200);
        }, 200);
      }
    });
  });

  $('.step-wrapper ul li.tab-link').each(function () {
    if ($(this).hasClass('current')){
      var cattr = $(this).attr('data-tab');
      $("#toplevel_page_wp-chatbot ul li").removeClass('current');
      $("#toplevel_page_wp-chatbot ul li span[data-tab='" + cattr +"']").parents('li').addClass('current');
    }
  });
  if (!$('#htcc_fb_as_state').prop('checked')){
    $('.as').css({'pointer-events':'none','opacity':'0.6'});
  }
  $('#htcc_fb_as_state').on('change', function (event) {
    if(!$(this).prop('checked')){
      $('.as').css({'pointer-events':'none','opacity':'0.6'});
    }else{
      $('.as').css({'pointer-events':'all','opacity':'1'});
    }
  });

  if ($('.bot_disabled').length>0){
    $('.step-wrapper').css({'pointer-events':'none','opacity':'0.6'});
  }
  $('h3.acc-title').on('click', function (event) {
    if (!$(this).hasClass('open')) {
      $(this).addClass('open');
      $(this).next().slideDown();
      $(this).next().css('display','block');
    } else {
      $(this).removeClass('open');
      $(this).next().slideUp();
    }
  });

  $('.connect-page a').on("click", function (event) {
    event.preventDefault();
    window.location.href = $(this).attr('href');
    $('.connect-page a').each(function () {
      $(this).removeAttr('href');
      $(this).off('click');
    });
  });
  $("#button_disconnect_page").on("click", function( ) {
    $("#to_pro").show();
    $('#modal-overlay').show();
    $('body').css({'overflow': 'hidden'});

  });
  $('#disconnect').on('click', function () {
    $('.modal_close').off('click');
    $('.button-close-modal').off('click');
  })

  $(".modal .button-close-modal,.modal .modal_close").on("click", function(event) {
    event.preventDefault();
    $(".modal").hide();
    $('body').css({'overflow': 'auto'});
    $('.button-lazy-load').removeClass('opacity-button');
    $('.lazyload').hide();
    $('#modal-overlay').hide();
    attr = $('.step-wrapper ul li.tab-link.current').attr("data-tab");
    set_current_tab(attr);
  });
  var datas = new Object();
  var tab ='';
  var attr ='';
  var error = false;
  var save_from_form=false;
  $('.tab-content').each(function () {
    var id = $(this).attr('id');
    datas[id] = new Object();
      $(this).find('input,textarea, select').each(function () {
        var name = $(this).attr('name');
        if ($(this).attr('type') == 'checkbox'){
          datas[id][$(this).attr('id')] = $(this).prop('checked')
        }else if ($(this).attr('id') == "htcc-color-wp" ) {
          datas[id][$(this).attr('id')]=$(this).val().toUpperCase();
        } else {
          if (name.indexOf("htcc") >= 0 && name.indexOf("htcc_options") < 0){
           datas[id][$(this).attr('id')] = $(this).val();
          }
        }
       });
  });

  $('#toplevel_page_wp-chatbot ul li:not(:first-child)').each( function () {
    $(this).on('click',function (event) {
      event.preventDefault();
      var current_li = $(".step-wrapper ul li.tab-link.current").attr('data-tab');
      attr = $(this).find('span').attr('data-tab');
      if (attr!=current_li){
        set_current_tab(attr);
      }
      tab = $("#"+attr)
      var li_next = $(".step-wrapper ul li.tab-link[data-tab='" + attr +"']");
      $('#toplevel_page_wp-chatbot ul li:not(:first-child)').removeClass('current');
      $(this).addClass('current');
      unsaved(current_li,li_next,attr);
    });
  });
  var flag = new Object();
  var second_flag = new Object();


  $(".step-wrapper ul li.tab-link").on("click", function() {
    attr = $(this).attr("data-tab");
    $('#toplevel_page_wp-chatbot ul li:not(:first-child)').removeClass('current');
    $("#toplevel_page_wp-chatbot ul li span[data-tab='" + attr +"']").parents('li').addClass('current');
    if (!$(this).hasClass('current')){
      set_current_tab(attr);
    }
    tab = $(this);
    var current = $('.step-wrapper ul li.tab-link.current').attr("data-tab");
    unsaved(current,tab,attr);

  });

  $.ajax({
    type: 'GET',
    url: ajaxurl,
    data: {
      action: 'get_done',
    },
    dataType: 'json',
    success: function(data) {
      second_flag = data.data;
    }
  });

  if($(".step-wrapper ul li.tab-link").length == $(".step-wrapper ul li.tab-link.done").length) {
    $('.setup_statement').css({'display':'none'})
  }


  function set_current_tab(attr) {
    $.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
        action: 'set_current_tab',
        current: attr
      },
      dataType: 'json',
    });
  }

  $('.htcc-color-wp').on("dragstop.spectrum", function(e, color) {
    $("#htcc-color-wp").val(color.toHexString());
  });
  function unsaved(cur_link,link,attr){
    var setup = false;
    if (!link.hasClass('current')){
      for (var key in datas[cur_link]) {
        if (datas[cur_link].hasOwnProperty(key)){
          var obj = $('#'+key);
          if (obj.attr('type')== 'checkbox'){
            if (datas[cur_link][obj.attr('id')]!=obj.prop('checked')){
              error=true;
            }
          }else if (obj.attr('id') == "htcc-color-wp" ) {
            if (datas[cur_link][obj.attr('id')]!=obj.val().toUpperCase()){
              error=true;
            }
          }else {
            if (datas[cur_link][obj.attr('id')]!=obj.val()){
              error=true;
            }
          }
        }
      }
      if(!error){
        $(".step-wrapper ul li.tab-link").removeClass("current");
        $(".step-wrapper ul li.tab-link.current").addClass('done');
        $(".tab-content").removeClass("current");
        link.addClass("current");
        $("#"+attr).addClass("current");
      }else {
        $("#unsaved_option").show();
        $('#modal-overlay').show();
        $('body').css({'overflow':'hidden'});
        $('.save_change').on('click',function () {
          error = false;
          $('div.modal_close').off('click');
          $('#discard_button').off('click');
          save_from_form = true;
          $('#'+cur_link).find('#submit').click();
        });
      }
    }
    link.addClass('done');
    $(".step-wrapper ul li.tab-link").each(function () {
      var index = $(this).attr("data-tab");
      if ($(this).hasClass('done')) {
        flag[index] = true;
      }
    });

    if($(".step-wrapper ul li.tab-link").length == $(".step-wrapper ul li.tab-link.done").length) {
      $('.setup_statement').css({'display':'none'})
      setup = true;
    }
    if (JSON.stringify(flag)!==JSON.stringify(second_flag)){
      $.extend(second_flag,flag);
      $.ajax({
        type: 'GET',
        url: ajaxurl,
        data: {
          action: 'send_done',
          state: flag,
          setup: setup
        },
        dataType: 'json',
      });
    }

  }

  function send_next(next,setup){
    set_current_tab(next.attr('data-tab'));
    next.addClass('done');
    $(".step-wrapper ul li.tab-link").each(function () {
      var index = $(this).attr("data-tab");
      if ($(this).hasClass('done')) {
        flag[index] = true;
      }
    });
    if (JSON.stringify(flag)!==JSON.stringify(second_flag)){
      $.extend(second_flag,flag);
      $.ajax({
        type: 'GET',
        url: ajaxurl,
        data: {
          action: 'send_done',
          state: flag,
          setup: setup
        },
        dataType: 'json',
      });
    }
  }

  $(document).on("click", "#submit", function() {
    if (!save_from_form){
      var next = $(".step-wrapper ul li.tab-link.current").next();
      if (next.attr('data-tab')!=='tab-3'){
        var second_next = next.next();
      }
      var setup = false;
      if($(".step-wrapper ul li.tab-link").length == $(".step-wrapper ul li.tab-link.done").length) {
        setup = true;
      }
      if (!next.hasClass('done')){
        send_next(next,setup)
      }else if (second_next && !second_next.hasClass('done')){
        send_next(second_next,setup)
      }else {
        var cur = $(".step-wrapper ul li.tab-link.current");
        send_next(cur,setup);
      }

    }
  });

  $("#discard_button").on("click", function(event) {
    var current = $('.step-wrapper ul li.tab-link.current').attr("data-tab");
    event.preventDefault();
    for (var key in datas[current]) {
      if (datas[current].hasOwnProperty(key)){
        var obj = $('#'+key);
        if (obj.attr('type') == 'checkbox'){
          if (datas[current][key]!=obj.prop('checked')){
            obj.click();
          }
        }else {
          obj.val(datas[current][obj.attr('id')]);
        }
      }
    }
    $(".htcc-color-wp").spectrum("set", $("#htcc-color-wp").val());

    $(".step-wrapper ul li.tab-link").removeClass("current");
    $(".tab-content").removeClass("current");
    $(".step-wrapper ul li.tab-link[data-tab='" + attr +"']").addClass('current');
    $("#"+attr).addClass("current");
    $('.lazyload').hide();
    $('.button-lazy-load').removeClass('opacity-button');
    $('body').css({'overflow':'auto'});
    $(".modal").hide();
    $('#modal-overlay').hide();
    error = false;
  });

});

