<?php
/* CREATE SHORT CODE HỖ TRỢ ONLINE */
if(!function_exists('create_short_code_support_online')) {
  	function create_short_code_support_online() {
  		$address = get_field('vbk_address', 'option');
  		$phone = get_field('vbk_phone', 'option');
  		$emailHotline = get_field('vbk_email_hotline', 'option');
  		$timeWork = get_field('vbk_time_work', 'option');
  		$xhtml = '';
  		$xhtml.= '<div class="vbk-support">
        					<div class="support" id="support" data-api="smartsupp" data-operation="open">
        						<i class="fa fa-phone"></i>
        						<div class="container-dot-hotline">
        							<div class="animation animation1">
        								<span class="help dot-help-hotline"></span> Hỗ trợ online
        							</div>
        						</div>
        					</div>
        					<div id="contact-infomation-store-load" class="contact-show-info">
        						<i class="icon-bottom"></i>
        						<div class="hotline">Hotline: '.$phone.'</div>
        						<div><strong>Email:</strong>&nbsp;<strong><a href="mailto:">'.$emailHotline.'</a></strong></div>
        						<div class="support-content">
        							<h4>Vải bé kum</h4>
        							<div class="add-item showroom-item">
        								<div><i class="fa fa-map-marker" title="'.$address.'"></i>'.$address.'</div>
        								<span>Thời gian làm việc: '.$timeWork.'</span>
        							</div>
        						</div>
        					</div>
        				</div>';
  		return $xhtml;
  	}
	  add_shortcode('SUPPORT-ONLINE', 'create_short_code_support_online');
}
