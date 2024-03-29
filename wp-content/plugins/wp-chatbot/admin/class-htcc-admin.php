<?php
/**
 * Creates top level menu
 * and options page
 *
 * @package htcc
 * @subpackage admin
 * @since 1.0.0
 *
 */

if (!defined('ABSPATH')) exit;

if (!class_exists('HTCC_Admin')) :

	class HTCC_Admin
	{

		private $api;
		private $fb_page_id;
		private $options;
		private $botid;
		private $token;
		private $test;
		private $internal;
		private $stepdis;

		public function __construct()
		{
			$this->api = new MobileMonkeyApi();
			$this->token = $this->api->connectMobileMonkey();
			$this->options = get_option('htcc_options');
			$this->fb_page_id = $this->options['fb_page_id'];
			$this->botid = $this->api->getActiveBotId();
			$this->internal = $this->api->getActivePage();
			$this->stepdis = "close";
		}

		private function getApi()
		{
			return $this->api;
		}

		/**
		 * Adds top level menu -> WP CSS Shapes
		 *
		 * @uses action hook - admin_menu
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function htcc_options_page()
		{
			$notification = '!';
			add_menu_page(
				'WP-Chatbot Setting page',
				!$this->fb_page_id || !$this->token || !$this->internal ? sprintf('WP-Chatbot <span class="awaiting-mod">%s</span>', $notification) : '<span data-tab="tab-1">WP-Chatbot</span>',
				'manage_options',
				'wp-chatbot',
				array($this, 'settings_page'),
				'dashicons-format-chat'
			);

			if ($this->fb_page_id && $this->token && $this->internal){
				add_submenu_page(
					'wp-chatbot',
					'wp-chatbot',
					'<span data-tab="tab-1">Setup</span>',
					'manage_options',
					'wp-chatbot',
					array($this, 'settings_page')
				);
                add_submenu_page(
                    'wp-chatbot',
                    'Customize',
                    '<span data-tab="tab-2">Customize</span>',
                    8,
                    '',
                    ''
                );
                add_submenu_page(
                    'wp-chatbot',
                    'Contacts',
                    '<span data-tab="tab-3">Contacts</span>',
                    8,
                    '',
                    ''
                );
			}

		}
		/**
		 * Incomplete Setup Notification
		 *
		 * @uses action hook - admin_init
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function htcc_incomplete_setup(){
			if (!$this->fb_page_id || !$this->token || !$this->internal){
				add_action( 'admin_bar_menu', function( \WP_Admin_Bar $bar )
				{
					$bar->add_menu( array(
						'id'     => 'wp-chatbot',
						'title'  => '<span class="ab-icon chat-bot"></span>',
						'parent' => 'top-secondary',
						'href'   => admin_url( 'admin.php?page=wp-chatbot' ),
						'meta'   => array(
							'target'   => '_self',
							'title'    => __( 'Wp-Chatbot', 'htcc_plugin' ),
							'html'     => '',
						),
					) );
				}, 210);
			}

		}
		public function example_admin_notice() {
			if (!$this->fb_page_id || !$this->token || !$this->internal){
				HT_CC::view('ht-cc-admin-notice-not-connected');
			}
		}
		/**
		 * Options page Content -
		 *   get settings form from a template settings_page.php
		 *
		 * Call back from - $this->htcc_options_page, add_menu_page
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function settings_page()
		{

			if (!current_user_can('manage_options')) {
				return;
			}

			// get options page form
			require_once('settings_page.php');
		}

		public function get_tab_done(){
			$response= array('done'=>true);
			if (isset($_SESSION['tab'])){
				$response = array(
					'tab-1' => $_SESSION['tab']['tab1'],
					'tab-2' => $_SESSION['tab']['tab2'],
					'tab-3' => $_SESSION['tab']['tab3'],
				);
			}
			wp_send_json_success ( $response);
        }

		public function set_tab_done(){
			$data = $_GET;
			$response= array('done'=>true);
			if (isset($data['state'])){
				$renameMap = [
					'tab-1' => 'tab1',
					'tab-2' => 'tab2',
					'tab-3' => 'tab3'
				];
				$data['state'] = array_combine(array_map(function($el) use ($renameMap) {
					return $renameMap[$el];
				}, array_keys($data['state'])), array_values($data['state']));
				$_SESSION['tab'] = array_merge($_SESSION['tab'],$data['state']);
                $response = array(
                    'success' => true,
                    'tab-1' => $_SESSION['tab']['tab1'],
                    'tab-2' => $_SESSION['tab']['tab2'],
                    'tab-3' => $_SESSION['tab']['tab3'],
				);
			}else {

            }
			if (isset($data['setup'])){
			    $_SESSION['setup'] = $data['setup'];
			}
			wp_send_json_success ( $response,$_SESSION['setup']);
		}

		public function set_current_tab(){
			$data = $_POST;
			$_SESSION['current'] = $data['current'];
			wp_send_json_success ( );
        }

		/**
		 * Options page - Regsiter, add section and add setting fields
		 *
		 * @uses action hook - admin_init
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function htcc_custom_settings()
		{

			add_settings_section('htcc_settings_as', '', array($this, 'htcc_section_as_render'), 'htcc-as-setting-section');

			add_settings_field('htcc_fb_welcome_message', __('Welcome Message', 'wp-chatbot'), array($this, 'htcc_fb_welcome_message_cb'), 'htcc-as-setting-section', 'htcc_settings_as');
			add_settings_field('htcc_fb_as_state',  '', array($this, 'htcc_fb_as_state_cb'), 'htcc-as-setting-section', 'htcc_settings_as');
			add_settings_field('htcc_fb_answer1','', array($this, 'htcc_fb_answer1_cb'), 'htcc-as-setting-section', 'htcc_settings_as');
			add_settings_field('htcc_fb_answer2','', array($this, 'htcc_fb_answer2_cb'), 'htcc-as-setting-section', 'htcc_settings_as');
			add_settings_field('htcc_fb_answer3','', array($this, 'htcc_fb_answer3_cb'), 'htcc-as-setting-section', 'htcc_settings_as');
			add_settings_field('htcc_fb_thank_answer', __('Thank you Message', 'wp-chatbot'), array($this, 'htcc_fb_thank_answer_cb'), 'htcc-as-setting-section', 'htcc_settings_as');
			add_settings_field('htcc_fb_email_trans', __('Email to send transcripts to', 'wp-chatbot'), array($this, 'htcc_fb_email_trans_cb'), 'htcc-as-setting-section', 'htcc_settings_as');
			register_setting('htcc_as_setting_group', 'htcc_as_options', array($this, 'htcc_as_options_sanitize'));



			add_settings_section('htcc_custom_settings', '', array($this, 'print_additional_settings_section_info'), 'wp-custom-settings-section');
			add_settings_field('htcc_fb_color', __('Color', 'wp-chatbot'), array($this, 'htcc_fb_color_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			add_settings_field('htcc_fb_greeting_login', __('Logged in Greeting', 'wp-chatbot'), array($this, 'htcc_fb_greeting_login_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			add_settings_field('htcc_fb_greeting_logout', __('Logged out Greeting', 'wp-chatbot'), array($this, 'htcc_fb_greeting_logout_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			add_settings_field('htcc_fb_greeting_dialog_display', __('Greeting Dialog Display', 'wp-chatbot'), array($this, 'htcc_fb_greeting_dialog_display_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			add_settings_field('htcc_fb_greeting_dialog_delay', __('Greeting Dialog Delay', 'wp-chatbot'), array($this, 'htcc_fb_greeting_dialog_delay_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			add_settings_field('htcc_fb_sdk_lang', __('Messenger language', 'wp-chatbot'), array($this, 'htcc_fb_sdk_lang_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			add_settings_field('htcc_show_hide', __('Hide Based on post type', 'wp-chatbot'), array($this, 'htcc_show_hide_post_types_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			add_settings_field('htcc_list_id_tohide', __('Post, Page IDs to Hide', 'wp-chatbot'), array($this, 'htcc_list_id_tohide_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			add_settings_field('htcc_list_cat_tohide', __('Categories to Hide', 'wp-chatbot'), array($this, 'htcc_list_cat_tohide_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			add_settings_field('htcc_devices_show_hide', __('Hide Based on Devices', 'wp-chatbot'), array($this, 'htcc_show_hide_devices_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			add_settings_field('htcc_shortcode', __('Shortcode name', 'wp-chatbot'), array($this, 'htcc_custom_shortcode_cb'), 'wp-custom-settings-section', 'htcc_custom_settings');
			register_setting('htcc_custom_setting_group', 'htcc_custom_options', array($this, 'htcc_custom_options_sanitize'));

			register_setting('htcc_setting_group', 'htcc_options', array($this, 'htcc_options_sanitize'));
		}


		function print_additional_settings_section_info() {
			?>
			<?php
		}
		function htcc_section_as_render() {
			?>
			<?php
		}


		// color - next new version added ..
		public function htcc_fb_color_cb_old()
		{
			$htcc_fb_color = get_option('htcc_custom_options');
			?>

            <div class="row">
                <div class="input-field col s12">

                    <!-- <input name="htcc_custom_options[fb_color]" data-default-color="#26a69a" value="<?php echo esc_attr($htcc_fb_color['fb_color']) ?>" type="text" class="htcc-color-wp" style="height: 1.375rem;" > -->

                    <input id="htcc-color-wp" class="htcc-color-wp" name="htcc_custom_options[fb_color]"
                           value="<?php echo esc_attr($htcc_fb_color['fb_color']) ?>" type="text"
                           style="height: 1.375rem;">
                    <p class="description"><?php _e('Messenger theme color; leave empty for default color', 'wp-chatbot') ?>
                        <a target="_blank"
                           href="https://mobilemonkey.com/wp-chatbot/messenger-theme-color/"><?php _e('more info', 'wp-chatbot') ?></a>
                    </p>
                </div>
            </div>
			<?php
		}

		// color
		public function htcc_fb_color_cb()
		{

			$htcc_fb_color = get_option('htcc_custom_options');
			?>
            <label for="htcc-color-wp" class="gray"> <?php _e('Messenger theme color; leave empty for default color -', 'wp-chatbot') ?>
                <a target="_blank"
                   href="https://mobilemonkey.com/wp-chatbot/messenger-theme-color/"><?php _e(' more info', 'wp-chatbot') ?></a>  </label>
            <div class="row">
                <div class="input-field col s12">
                    <!-- <input name="htcc_custom_options[fb_color]" value="<?php echo esc_attr($htcc_fb_color['fb_color']) ?>" type="color" class="htcc-color-wp" style="width: 5rem; height: 1.5rem;" > -->
                    <input name="htcc_custom_options[fb_color]" id="htcc-color-wp" value="<?php echo esc_attr($htcc_fb_color['fb_color']) ?>"
                           type="text" class="htcc-color-wp" style="height: 1.375rem;">

                    <!-- <p class="description"><?php _e('please open settings page in the browser that supports "type color", we are planning to make a better way to choose the color ', 'wp-chatbot') ?></p> -->
                </div>
            </div>
			<?php
		}


		// Welcome message
		public function htcc_fb_welcome_message_cb()
		{
			$htcc_fb_welcome_message = get_option('htcc_as_options');
			$ref = get_option('htcc_fb_ref');
			$htcc_fb_app_id = get_option('mobilemonkey_environment');
			?>
            <div class="row">
                <div class="test_button__wrap">
                    <div class="test-bot-button"  style="display: <?php echo $this->test; ?>">
                        <div class="test-bot-button__button-wrapper">
                            <div class="test-bot-button__messenger">
                                <div class="fb-send-to-messenger"
                                     messenger_app_id="<?php echo $htcc_fb_app_id->fb_app_id; ?>"
                                     page_id="<?php echo $this->fb_page_id; ?>"
                                     data-ref="<?php echo $ref;?>"
                                     color="blue"
                                     size="large">
                                </div>
                            </div>
                        </div>
                    </div>
                    <a target="_blank" rel="noopener noreferrer" style="display: none" href="https://www.m.me/<?php echo $this->fb_page_id?>" id="messanger" class="button testchat">Open Messenger</a>
                </div>
                <div class="input-field col s12">
                    <label for="fb_welcome_message"><?php _e('Welcome message - WP-Chatbot will greet your chat users with this message.', 'wp-chatbot') ?></label>
                    <textarea rows="2" style="width:100%" name="htcc_as_options[fb_welcome_message]" id="fb_welcome_message"> <?php echo esc_attr($htcc_fb_welcome_message['fb_welcome_message'])?></textarea>
                </div>
            </div>
			<?php
		}
		public function htcc_fb_as_state_cb()
		{
			$htcc_fb_as_state = get_option('htcc_as_options');
			?>
            <div class="row">
                <div class="input-field as_state col s12">
                    <label class="switch">
                        <input id="htcc_fb_as_state" name="htcc_as_options[fb_as_state]" type="checkbox" value="1" <?php isset($htcc_fb_as_state['fb_as_state']) ? checked($htcc_fb_as_state['fb_as_state'], 1) : checked(0); ?>/>
                        <span class="slider round"></span>
                    </label>
                    <p class="as_text"><?php _e('Answering Service', 'wp-chatbot') ?></p>
                </div>
            </div>
			<?php
		}
		public function htcc_fb_answer1_cb()
		{
			$htcc_fb_answer1 = get_option('htcc_as_options');
			?>
            <div class="row as">
                <div class="input-field col l12 m12">
                    <h6><?php _e('Quick Questions', 'wp-chatbot') ?></h6>
                    <label class="gray" for="fb_answer1"><?php _e('WP-Chatbot will ask your chat users a few questions.', 'wp-chatbot') ?></label>
                    <input type="text" name="htcc_as_options[fb_answer1]" id="fb_answer1"
                           value="<?php echo esc_attr($htcc_fb_answer1['fb_answer1']) ?>">
                </div>
            </div>
			<?php
		}
		public function htcc_fb_answer2_cb()
		{
			$htcc_fb_answer2 = get_option('htcc_as_options');
			?>
            <div class="row as">
                <div class="input-field col l12 m12">
                    <input type="text" name="htcc_as_options[fb_answer2]" id="fb_answer2"
                           value="<?php echo esc_attr($htcc_fb_answer2['fb_answer2']) ?>">
                </div>
            </div>
			<?php
		}
		public function htcc_fb_answer3_cb()
		{
			$htcc_fb_answer3 = get_option('htcc_as_options');
			?>
            <div class="row as">
                <div class="input-field col l12 m12">
                    <input type="text" name="htcc_as_options[fb_answer3]" id="fb_answer3"
                           value="<?php echo esc_attr($htcc_fb_answer3['fb_answer3']) ?>">
                </div>
            </div>
			<?php
		}
		public function htcc_fb_thank_answer_cb()
		{
			$htcc_fb_thank_answer = get_option('htcc_as_options');
			?>
            <div class="row as">
                <div class="input-field col l12 m12">
                    <label class="gray" for="fb_answer1"><?php _e('Thank your users for answering your questions, and let them know you\'ll get back to them.', 'wp-chatbot') ?></label>
                    <input type="text" name="htcc_as_options[thank_message]" id="thank_message"
                           value="<?php echo esc_attr($htcc_fb_thank_answer['thank_message']) ?>">
                </div>
            </div>
			<?php
		}
		public function htcc_fb_email_trans_cb()
		{
			$htcc_fb_email_trans = get_option('htcc_as_options');
			?>
            <div class="row as">
                <div class="input-field col l12 m12">
                    <label class="gray" for="htcc_fb_email_trans"><?php _e('When people answer all of the questions below, we can send the answers to an email address of your choice!', 'wp-chatbot') ?></label>
                    <input type="text" name="htcc_as_options[email]" id="email"
                           value="<?php echo esc_attr($htcc_fb_email_trans['email']) ?>">
                </div>
            </div>

			<?php
		}

		// Greeting for logged in user
		public function htcc_fb_greeting_login_cb()
		{

			$htcc_fb_greeting_login = get_option('htcc_custom_options');
			?>
            <div class="row">
                <div class="input-field col s12">
                    <label class="gray" for="fb_greeting_login"><?php _e('Greeting text - If logged into Facebook in the current browser; leave empty for default message - ', 'wp-chatbot') ?>
                        <a target="_blank"
                           href="https://mobilemonkey.com/wp-chatbot/change-facebook-messenger-greetings-text/"><?php _e('more info', 'wp-chatbot') ?></a>
                    </label>
                    <input type="text" name="htcc_custom_options[fb_logged_in_greeting]" id="fb_greeting_login"
                           value="<?php echo esc_attr($htcc_fb_greeting_login['fb_logged_in_greeting']) ?>">
                    <!-- <p class="description"><?php _e('Grettings can add in any language, this can be different to the messenger language', 'wp-chatbot') ?></p> -->
                    <!-- <p class="description"><?php _e('If this Greetings fields are blank, default Greetings will load based on Messenger Language', 'wp-chatbot') ?></p> -->
                </div>
            </div>
			<?php
		}

		// Greeting for logged out user
		public function htcc_fb_greeting_logout_cb()
		{

			$htcc_fb_greeting_logout = get_option('htcc_custom_options');
			?>
            <div class="row">
                <div class="input-field col s12">
                    <label class="gray" for="fb_greeting_logout"><?php _e('Greeting text - If logged out of Facebook in the current browser; leave empty for default message - ', 'wp-chatbot') ?>
                        <a target="_blank"
                           href="https://mobilemonkey.com/wp-chatbot/change-facebook-messenger-greetings-text/"><?php _e('more info', 'wp-chatbot') ?></a></label>
                    <input type="text" name="htcc_custom_options[fb_logged_out_greeting]" id="fb_greeting_logout"
                           value="<?php echo esc_attr($htcc_fb_greeting_logout['fb_logged_out_greeting']) ?>">
                </div>
            </div>
			<?php
		}

		// sdk lang. / messenger lang
		public function htcc_fb_sdk_lang_cb()
		{
			if ($this->fb_page_id && $this->token && $this->botid){
				$lang = $this->api->getLanguage($this->fb_page_id);
			}
			?>
            <div class="row">
                <div class="input-field col s12">
                    <label class="gray"><?php _e('Language displays in chat window, not user input - ', 'wp-chatbot') ?>
                        <a target="_blank"
                           href="https://mobilemonkey.com/wp-chatbot/messenger-language/"><?php _e('more info', 'wp-chatbot') ?></a>
                        <p>Facebook SDK does not support all languages</p>
                    </label>
                    <select name="htcc_custom_options[fb_sdk_lang]" id="htcc_sdk_lang">
						<?php
						$fb_lang = HTCC_Lang::$fb_lang;

						foreach ($fb_lang as $key => $value) {
							?>
                            <option value="<?php echo $value ?>"<?php if ($lang == $value) echo 'SELECTED'; ?> ><?php echo $value ?></option>
							<?php
						}
						?>
                    </select>
                </div>
            </div>
			<?php
		}

		// greeting_dialog_display - since v2.2
		public function htcc_fb_greeting_dialog_display_cb()
		{
			$greeting_dialog_display = get_option('htcc_custom_options');
			$min_value = esc_attr($greeting_dialog_display['fb_greeting_dialog_display']);
			?>
            <div class="row">
                <div class="input-field col s12">
                    <label class="gray"><?php _e('Greetings Dialog Display  - ', 'wp-chatbot') ?><a target="_blank" href="https://mobilemonkey.com/wp-chatbot/greeting-dialog-display/"><?php _e('more info', 'wp-chatbot') ?></a></label>
                    <select name="htcc_custom_options[fb_greeting_dialog_display]" class="select-1" id="htcc_greeting_dialog_display">
                        <option value="" <?php echo $min_value == "" ? 'SELECTED' : ''; ?> >Default</option>
                        <option value="show" <?php echo $min_value == "show" ? 'SELECTED' : ''; ?> >Show</option>
                        <option value="fade" <?php echo $min_value == "fade" ? 'SELECTED' : ''; ?> >Fade</option>
                        <option value="hide" <?php echo $min_value == "hide" ? 'SELECTED' : ''; ?> >Hide</option>
                    </select>
                    <p>Show - The greeting dialog will always be shown when the plugin loads.</p>
                    <p>Fade - The greeting dialog of the plugin will be shown, then fade away and stay minimized afterwards.</p>
                    <p>Hide - The greeting dialog of the plugin will always be minimized until a user clicks on the plugin.</p>
                </div>
            </div>
			<?php
		}
		// greeting_dialog_delay - since v2.2
		public function htcc_fb_greeting_dialog_delay_cb()
		{
			$greeting_dialog_delay = get_option('htcc_custom_options');
			$delay_time = esc_attr($greeting_dialog_delay['fb_greeting_dialog_delay']);
			?>
            <div class="row">
                <div class="input-field col s12">
                    <label class="gray" for="fb_greeting_dialog_delay"><?php _e('Sets the number of seconds of delay before the greeting dialog is shown after the plugin is loaded - ', 'wp-chatbot') ?>
                        <a target="_blank"
                           href="https://mobilemonkey.com/wp-chatbot/greeting-dialog-delay/"><?php _e('more info', 'wp-chatbot') ?></a></label>
                    <input type="number" min="0" name="htcc_custom_options[fb_greeting_dialog_delay]" id="fb_greeting_dialog_delay"
                           value="<?php echo $delay_time ?>">

                </div>
            </div>
			<?php
		}


		// minimized  - deprecated - since v2.2
		// removed since 3.2
		public function htcc_fb_is_minimized_cb()
		{
			$minimized = get_option('htcc_custom_options');
			$min_value = esc_attr($minimized['minimized']);
			?>
            <div class="row">
                <div class="input-field col s12">
                    <div>
                        <select name="htcc_custom_options[minimized]" class="select-1">
                            <option value="" <?php echo $min_value == "" ? 'SELECTED' : ''; ?> >Default</option>
                            <option value="false" <?php echo $min_value == "false" ? 'SELECTED' : ''; ?> >False</option>
                            <option value="true" <?php echo $min_value == "true" ? 'SELECTED' : ''; ?> >True</option>
                        </select> This attribute is now deprecated - <a target="_blank"
                                                                        href="https://mobilemonkey.com/wp-chatbot/minimize-messenger/"><?php _e('more info', 'wp-chatbot') ?></a>
                    </div>
                    <p class="description"><?php _e('Instead, use greeting_dialog_display, greeting_dialog_delay for customization', 'wp-chatbot') ?> </p>
                </div>
            </div>
			<?php
		}


		// checkboxes - Hide based on Type of posts ..
		public function htcc_show_hide_post_types_cb()
		{
			$htcc_checkbox = get_option('htcc_custom_options');
            ?>
            <label class="gray"><?php _e('Check the box to suppress Messenger chat; based on page type - ', 'wp-chatbot') ?>
                <a target="_blank"
                   href="https://mobilemonkey.com/wp-chatbot/show-hide-messenger-based-on-type-of-the-page/"><?php _e('more info', 'wp-chatbot') ?></a></label>
            <?php
			// Single Posts
			if (isset($htcc_checkbox['hideon_posts'])) {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_posts]" type="checkbox"
                               value="1" <?php checked($htcc_checkbox['hideon_posts'], 1); ?> id="filled-in-box1"/>
                        <span><?php _e('Hide on - Posts', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			} else {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_posts]" type="checkbox" value="1" id="filled-in-box1"/>
                        <span><?php _e('Hide on - Posts', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			}


			// Page
			if (isset($htcc_checkbox['hideon_page'])) {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_page]" type="checkbox"
                               value="1" <?php checked($htcc_checkbox['hideon_page'], 1); ?> id="filled-in-box2"/>
                        <span><?php _e('Hide on - Pages', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			} else {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_page]" type="checkbox" value="1" id="filled-in-box2"/>
                        <span><?php _e('Hide on - Pages', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			}


			// Home Page
			if (isset($htcc_checkbox['hideon_homepage'])) {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_homepage]" type="checkbox"
                               value="1" <?php checked($htcc_checkbox['hideon_homepage'], 1); ?> id="filled-in-box3"/>
                        <span><?php _e('Hide on - Home Page', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			} else {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_homepage]" type="checkbox" value="1" id="filled-in-box3"/>
                        <span><?php _e('Hide on - Home Page', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			}


			/* Front Page
			 A front page is also a home page, but home page is not a front page
			 if front page unchecked - it works on both homepage and fornt page
			 but if home page is unchecked - it works only on home page, not on front page */
			if (isset($htcc_checkbox['hideon_frontpage'])) {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_frontpage]" type="checkbox"
                               value="1" <?php checked($htcc_checkbox['hideon_frontpage'], 1); ?> id="filled-in-box4"/>
                        <span><?php _e('Hide on - Front Page', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			} else {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_frontpage]" type="checkbox" value="1" id="filled-in-box4"/>
                        <span><?php _e('Hide on - Front Page', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			}


			// Category
			if (isset($htcc_checkbox['hideon_category'])) {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_category]" type="checkbox"
                               value="1" <?php checked($htcc_checkbox['hideon_category'], 1); ?> id="filled-in-box5"/>
                        <span><?php _e('Hide on - Category', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			} else {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_category]" type="checkbox" value="1" id="filled-in-box5"/>
                        <span><?php _e('Hide on - Category', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			}


			// Archive
			if (isset($htcc_checkbox['hideon_archive'])) {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_archive]" type="checkbox"
                               value="1" <?php checked($htcc_checkbox['hideon_archive'], 1); ?> id="filled-in-box6"/>
                        <span><?php _e('Hide on - Archive', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			} else {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_archive]" type="checkbox" value="1" id="filled-in-box6"/>
                        <span><?php _e('Hide on - Archive', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			}


			// 404 Page
			if (isset($htcc_checkbox['hideon_404'])) {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_404]" type="checkbox"
                               value="1" <?php checked($htcc_checkbox['hideon_404'], 1); ?> id="filled-in-box7"/>
                        <span><?php _e('Hide on - 404 Page', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			} else {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[hideon_404]" type="checkbox" value="1" id="filled-in-box7"/>
                        <span><?php _e('Hide on - 404 Page', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			}
			?>



			<?php
		}


		// ID 's list to hide styles
		function htcc_list_id_tohide_cb()
		{
			$htcc_list_id_tohide = get_option('htcc_custom_options');
			?>
            <div class="row">
                <div class="input-field col s12">
                    <input name="htcc_custom_options[list_hideon_pages]"
                           value="<?php echo esc_attr($htcc_list_id_tohide['list_hideon_pages']) ?>"
                           id="list_hideon_pages" type="text">
                    <label for="list_hideon_pages" class="gray"><?php _e('Post, Page IDs to Hide', 'ht-click') ?></label>
                    <p class="description"> <?php _e('Add Post, Page, Media - IDs to hide', 'wp-chatbot') ?>
                        <br> <?php _e('Can add multiple IDs separate with comma ( , )', 'wp-chatbot') ?> - <a
                                target="_blank"
                                href="https://mobilemonkey.com/wp-chatbot/hide-messenger-based-on-post-id/"><?php _e('more info', 'wp-chatbot') ?></a>
                    </p>
                </div>
            </div>
			<?php
		}

		//  Categorys list - to hide
		function htcc_list_cat_tohide_cb()
		{
			$htcc_list_cat_tohide = get_option('htcc_custom_options');
			?>
            <div class="row">
                <div class="input-field col s12">
                    <input name="htcc_custom_options[list_hideon_cat]"
                           value="<?php echo esc_attr($htcc_list_cat_tohide['list_hideon_cat']) ?>"
                           id="list_hideon_cat" type="text">
                    <label for="list_hideon_cat" class="gray"><?php _e('Categories to Hide', 'ht-click') ?></label>
                    <p class="description"> <?php _e('Category names to hide', 'wp-chatbot') ?>
                        <br> <?php _e('Сan add multiple Categories separate by comma ( , )', 'wp-chatbot') ?> - <a
                                target="_blank"
                                href="https://mobilemonkey.com/wp-chatbot/hide-messenger-based-on-category/"><?php _e('more info', 'wp-chatbot') ?></a>
                    </p>
                </div>
            </div>
			<?php
		}


		// checkboxes - based on Type of device ..
		public function htcc_show_hide_devices_cb()
		{
			$htcc_devices = get_option('htcc_custom_options');

			// Hide on Mobile Devices
			if (isset($htcc_devices['fb_hide_mobile'])) {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[fb_hide_mobile]" type="checkbox"
                               value="1" <?php checked($htcc_devices['fb_hide_mobile'], 1); ?> id="fb_hide_mobile"/>
                        <span><?php _e('Hide on - Mobile Devices', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			} else {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[fb_hide_mobile]" type="checkbox" value="1" id="fb_hide_mobile"/>
                        <span><?php _e('Hide on - Mobile Devices', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			}


			// Hide on Desktop Devices
			if (isset($htcc_devices['fb_hide_desktop'])) {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[fb_hide_desktop]" type="checkbox"
                               value="1" <?php checked($htcc_devices['fb_hide_desktop'], 1); ?> id="fb_hide_desktop"/>
                        <span><?php _e('Hide on - Desktops', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			} else {
				?>
                <p>
                    <label>
                        <input name="htcc_custom_options[fb_hide_desktop]" type="checkbox" value="1" id="fb_hide_desktop"/>
                        <span><?php _e('Hide on - Desktops', 'wp-chatbot') ?></span>
                    </label>
                </p>
				<?php
			}
		}


		//  Custom shortcode
		function htcc_custom_shortcode_cb()
		{
			$htcc_shortcode = get_option('htcc_custom_options');
			?>
            <div class="row">
                <div class="input-field col s12">
                    <input name="htcc_custom_options[shortcode]" value="<?php echo esc_attr($htcc_shortcode['shortcode']) ?>"
                           id="shortcode" type="text" class="validate input-margin">
                    <label for="shortcode" class="gray"><?php _e('Shortcode name', 'ht-click') ?></label>
					<?php
					// $shorcode_list = '';
					// foreach ($GLOBALS['shortcode_tags'] AS $key => $value) {
					//    $shorcode_list .= $key . ', ';
					//  }
					?>
                    <p class="description"> <?php printf(__('Default value is \'%1$s\', can customize shortcode name', 'wp-chatbot'), 'chatbot') ?>
                        - <a target="_blank"
                             href="https://mobilemonkey.com/wp-chatbot/change-shortcode-name/"><?php _e('more info', 'wp-chatbot') ?></a>
                    </p>
                    <p class="description"> <?php _e('Please don\'t add an already existing shortcode name', 'wp-chatbot') ?>
                        <!-- <p class="description"> <?php _e('please dont add this already existing shorcode names', 'wp-chatbot') ?> - </p> -->
                </div>
            </div>
			<?php
		}



		public function htcc_options_sanitize($input)
		{
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( 'not allowed to modify - please contact admin ' );
			}
			$new_input = array();
			foreach ($input as $key => $value) {
				if( isset( $input[$key] ) ) {
					$new_input[$key] = sanitize_text_field( $input[$key] );
				}
			}
			return $new_input;
		}
		public function htcc_custom_options_sanitize($input)
		{
			$option = get_option('htcc_custom_options');
			$error=false;
			$error_delay_lenght =false;
			$error_delay_value =false;
			if (!current_user_can('manage_options')) {
				wp_die('not allowed to modify - please contact admin ');
			}

			$new_input = array();
			if(isset($_REQUEST['action']) && $_REQUEST['action']== 'update') {
				$_SESSION['tab-2'] = true;
			}
			foreach ($input as $key => $value) {

				if($key == 'fb_greeting_dialog_delay'&& isset($_REQUEST['action']) && $_REQUEST['action']== 'update'){
					if (strlen($value) > 9){
						$new_input[$key] = $option[$key];
						$error_delay_lenght = true;
					}else {
						if ($value == '0'){
							$error_delay_value = true;
							$new_input[$key] = $option[$key];
						}else {
							$new_input[$key] = sanitize_text_field($input[$key]);
						}
					}
				}elseif(isset($input[$key])) {
					$new_input[$key] = sanitize_text_field($input[$key]);
				}
			}

			if ($error_delay_lenght){
				$this->api->settingSaveError("delay_length");
			}
			if ($error_delay_value){
				$this->api->settingSaveError("delay_0");
			}
			return $new_input;
		}
		public function htcc_as_options_sanitize($input)
		{
			$error=false;
			$error_welcome=false;
			$error_email=false;
			$option = get_option('htcc_as_options');


			if (!current_user_can('manage_options')) {
				wp_die('not allowed to modify - please contact admin ');
			}
			if ($input){
				$new_input = array();
				if(isset($_REQUEST['action']) && $_REQUEST['action']== 'update') {
					$_SESSION['tab1'] = true;
				}
				foreach ($input as $key => $value) {
					if ($key == 'fb_welcome_message' && isset($_REQUEST['action']) && $_REQUEST['action']== 'update') {
						if ($value == '' || ctype_space($value)) {
							$new_input[$key] = $option[$key];
							$error_welcome = true;
						} else {
							$_SESSION['tab1'] = true;
							$new_input[$key] = sanitize_text_field($input[$key]);
						}
					}
					if ($value == '' || ctype_space($value)){
						if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' && !$this->api->mmOnlyCheck($this->fb_page_id)){
							$new_input[$key] = $option[$key];
							$error = true;
						}
					}elseif (isset($input[$key])) {
						if ($key == 'email' && !is_email($value)){
							$new_input[$key] = $option[$key];
							$error_email = true;
						}else {
							$new_input[$key] = sanitize_text_field($input[$key]);
						}
					}
				}
			}
			if ($error_welcome){
				$this->api->settingSaveError("welcome_message");
			}
			if ($error){
				$this->api->settingSaveError("AS");
			}
			if ($error_email){
				$this->api->settingSaveError("email");
			}
			return $new_input;
		}

	}

endif; // END class_exists check
