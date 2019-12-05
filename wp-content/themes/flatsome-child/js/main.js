/* HỖ TRỢ ONLINE */
$(document).ready(function($) {
    var hover = true;
    $(".vbk-support").hover(function() {
        if (hover === true) {
            $('.contact-show-info').addClass('open-show-support-online');
            hover = false;
        } else {
            $('.contact-show-info').removeClass('open-show-support-online');
            hover = true;
        }
    });


})