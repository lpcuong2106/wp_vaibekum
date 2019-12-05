<?php
/**
 * template for options page
 * @uses HTCC_Admin::settings_page
 * @since 1.0.0
 */

if (!defined('ABSPATH')) exit;
$options = get_option('htcc_options');
?>

<!-- style="display: flex; flex-wrap: wrap;" -->

<div class="wrap">
    <div class="row mobile_wrap">
        <div class="col s12 m9 x9 options">
            <div class="mobilemonkey-logo"></div>
            <h6 class="options-subtitle">WP-Chatbot is <a href="https://mobilemonkey.com/" target="_blank">powered by
                    MobileMonkey</a>: an Official Facebook Messenger Solutions Provider Partner</h6>
			<?php

			$options = get_option('htcc_options');
			$options_as = get_option('htcc_as_options');
			$options_custom = get_option('htcc_custom_options');
			$api = $this->getApi();
			$api->logoutMobilemonkey();
			$token = $api->connectMobileMonkey();
			$internal =  get_option('mobilemonkey_active_page_id');

			if ($token) {
				$reset = FALSE;
				if ($api->connectPage() || $api->disconnectPage()) {
					$reset = TRUE;
				}

				$pages = $api->getPages();

				$activePage = $api->getActivePage($reset);
				if ($activePage) {
					if ($activePage['bot_id']){
						$mm_state = $this->api->mmOnlyCheck($this->fb_page_id);;
						if ( isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated']){
						    $test = $this->api->mmOnlyCheck($this->fb_page_id);
							if (!$test){
								$test = $api->getWidgets($activePage['remote_id']);
								if ((float)$test->enabled!== (float)$options_as['fb_as_state']){

									if ($options_as['fb_as_state']== null || $options_as['fb_as_state']==0){
										$valuse = false;
									} else {
										$valuse = true;
									}
									$api->AsStateSave($valuse,$activePage['remote_id']);
								}
								if ($test) {
									foreach ($test->widgets as $key=>$value){
										if ($value->type == "quick_question"){
											$key+=1;
											if ($options_as['fb_answer'.$key.'']!== $value->config->body){
												$dump_value = $value;
												$dump_value->config->body = $options_as['fb_answer'.$key.''];
												$api->updateWidgets($dump_value);
											}
										}
										if ($value->type == 'text'){
											if ($options_as['thank_message']!== $value->config->body) {
												$dump_value = $value;
												$dump_value->config->body = $options_as['thank_message'];
												$api->updateWidgets($dump_value);

											}
										}
										if ($value->type == 'email'){
											if ($options_as['email']!== $value->config->recipient) {
												$dump_value = $value;
												$dump_value->config->recipient = $options_as['email'];
												$api->updateWidgets($dump_value);

											}
										}
									}
								}
							}
							$current_welcome_message = $api->getWelcomeMessage($activePage['remote_id']);
							if ($options_as['fb_welcome_message'] !== $current_welcome_message) {
								$api->updateWelcomeMessage($options_as['fb_welcome_message'], $activePage['remote_id']);
							}
						}
						$custom_settings = $this->api->getCustomChatSettings($activePage['remote_id']);
						if (isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated']){
							if ($custom_settings) {

								foreach ($custom_settings as $key=>$value){
									if ($key != "js_src"){
										if ($key == 'hide_mobile' || $key == 'hide_desktop'){
											if (!$options_custom['fb_'.$key]){
												$options_custom['fb_'.$key] = false;
											}else{
												$options_custom['fb_'.$key] = true;
											}
										}
										if ($options_custom['fb_'.$key]!=$value){
											$new_value[$key] = $options_custom['fb_'.$key];

										}
									}
								}

								if (!empty($new_value)){
									$api->updateCustomChatSettings($new_value,$activePage['remote_id']);
								}
							}
							$current_language = $api->getLanguage($activePage['remote_id']);
							if (!empty($options_custom['fb_sdk_lang']) && $options_custom['fb_sdk_lang'] !== $current_language) {
								$api->updateLanguage($options_custom['fb_sdk_lang'], $activePage['remote_id']);
							}
						}

					}else {
						echo "<style>.settings-error{display: none}</style>";
						$this->api->renderNotice('<p class="bot_disabled">Your chatbot has been disabled in MobileMonkey. Please reactivate it before making additional edits. Go <a target="_blank" rel="noopener noreferrer" href="https://app.mobilemonkey.com/chatbot-editor/">here</a> to reactivate your chatbot</p>');

					}
					$fb_connected_area_active_page_settings = [
						'connected_page' => $activePage,
                        'mm_only' => $mm_state,
						'current_facebook_page_block' => '',
						'logout_path' => add_query_arg([
							'page' => HTCC_PLUGIN_MAIN_MENU,
							'logout' => true,
						], admin_url('admin.php')),
					];
					HT_CC::view('ht-cc-admin-fb-button-connected', $fb_connected_area_active_page_settings);
					HT_CC::view('ht-cc-admin-settings-form',$fb_connected_area_active_page_settings);

				} else {
					if ($internal){
						echo "<style>.settings-error{display: none}</style>";
						$this->api->renderNotice('Your Facebook page has been disconnected in MobileMonkey. Please connect to a page to reactivate your chatbot.');
					}
					$fb_connected_area_pages_settings = [
						'pages' => $pages,
						'logout_path' => add_query_arg([
							'page' => HTCC_PLUGIN_MAIN_MENU,
							'logout' => true,
						], admin_url('admin.php')),
					];
					HT_CC::view('ht-cc-admin-fb-button-select-page', $fb_connected_area_pages_settings);
				}

			} else {

				HT_CC::view('ht-cc-admin-fb-button-not-connected', [
					'options' => $options,
					'path' => $this->getApi()->connectLink(),
				]);
			}

			?>

</div>

<div class="col s12 m3 x3 ht-cc-admin-sidebar">
	<?php include_once 'commons/ht-cc-admin-sidebar.php'; ?>
</div>
</div>


</div>