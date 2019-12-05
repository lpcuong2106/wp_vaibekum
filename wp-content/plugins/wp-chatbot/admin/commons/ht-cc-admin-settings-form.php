<?php
/**
 * sidebar in admin area - plugin settings page.
 *
 * @uses at settings_page.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit;
include(HTCC_PLUGIN_DIR.'admin/contact_page.php');
$table = new MobileMonkey_Contacts_List_Table();
$table->prepare_items();
$_SESSION['tab']['tab1'] = true;
$setup = $_SESSION['setup_done'];
$current = str_replace('-', "", $_SESSION['current']);
foreach ($_SESSION['tab'] as $key=>$value){
    if ($value){
		$$key = 'done';
    }else {
        $$key = '';
    }
}
$$current.=' current';

?>
<div class="step-wrapper">
    <div class="tab_header">
        <ul class="tabs_wrapper">
            <li class="tab-link <?php echo $tab1?>" data-tab="tab-1">
                <span class="tab_number">1</span>
                <span class="tab_header">Setup</span>
            </li>
            <li class="tab-link <?php echo $tab2?>" data-tab="tab-2">
                <span class="tab_number">2</span>
                <span class="tab_header">Customize</span>
            </li>
            <li class="tab-link <?php echo $tab3?>" data-tab="tab-3">
                <span class="tab_number">3</span>
                <span class="tab_header">Contacts</span>
                <span class="tab_contacts__count"><?php echo $table->totalItems ?></span>
            </li>

        </ul>
        <div class="list_tabs__button">
            <ul class="list_tabs"></ul>
        </div>
        <div class="setup_statement" style="<?php echo ($setup ? "display:none": "display:block")?>">
            Setup Incomplete
        </div>
    </div>
<?php
$mm_only ? $state = 'none' : $state ='block';
!$mm_only ? $mm = 'none' : $mm ='block';?>
    <div id="tab-1" class="tab-content <?php echo $tab1?> setup_section">
        <div class="tab-content__wrapper">
            <div class="mm_only_block" style="display: <?php echo $mm?>">
                <h6><?php _e('Looks like you\'ve already worked in MobileMonkey. Please use the MobileMonkey app to make additional edits to the \'Welcome message\' and \'Answering Service\'.', 'wp-chatbot') ?></h6>
                <a target="_blank" rel="noopener noreferrer" href='https://app.mobilemonkey.com/chatbot-editor/<?php echo$connected_page['id']?>/home' class="button">Go to MobileMonkey</a>
            </div>
            <form method="post" action="options.php" style="display: <?php echo $state?>">
				<?php
				settings_fields( 'htcc_as_setting_group' );
				do_settings_sections( 'htcc-as-setting-section' );
				?>
                <div class="customization_button__wrapper">
                    <a target="_blank" rel="noopener noreferrer" href="https://app.mobilemonkey.com/chatbot-editor/<?php echo $connected_page['bot_id']?>/bot-builder" class="customization_button__link">
                        <div class="customization_button">
                            <div class="customization_button__content">More chatbot customization in <span class="customization_button__image"></span> MobileMonkey</div>
                            <div class="customization_button__action">
                                <span class="button_action__text">LEt's go</span>
                            </div>
                        </div>
                    </a>
                </div>
				<?php submit_button('Save Changes'); ?>
            </form>
            <?php
			$fb_connected_area_active_page_settings = [
				'connected_page' => $connected_page,
				'logout_path' => add_query_arg([
					'page' => HTCC_PLUGIN_MAIN_MENU,
					'logout' => true,
				], admin_url('admin.php')),
			];
            HT_CC::view('ht-cc-admin-form-bottom-connect',$fb_connected_area_active_page_settings);?>
        </div>
    </div>
    <div id="tab-2" class="tab-content customize_section <?php echo $tab2?>">
        <div class="tab-content__wrapper">
            <h1>Customize</h1>
            <form method="post" action="options.php">
				<?php
				settings_fields( 'htcc_custom_setting_group' );
				do_settings_sections( 'wp-custom-settings-section' );
				?>
				<?php submit_button('Save Changes'); ?>
            </form>

        </div>
    </div>
    <div id="tab-3" class="tab-content contact_tab <?php echo $tab3?>">
        <h1>Contacts</h1>
        <div class="contact_head__wrap">
            <h4><?php
                $text = $table->totalItems>1 ? 'contacts' : 'contact';
                if ($table->totalItems == 0){
					$table->totalItems = '';
					$text = "No contacts ";
                }
                echo $table->totalItems
            ?></h4>
            <p><?php echo $text ?> generated</p>
        </div>
        <div class="table__wrap">
            <?php
            $table->display();
            ?>
            <a target="_blank" rel="noopener noreferrer" href="https://app.mobilemonkey.com/chatbot-editor/<?php echo $connected_page['bot_id']?>/contacts" id="contacts_modal">
                <div class="contact_modal__wrapper">
                    <div class="contact_modal__content">
                        View your contacts in <span class="customization_button__image"></span> <span class="logo_name">MobileMonkey</span>
                    </div>
                    <div class="contact_modal__button">
                        <div>let's go!</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div id="to_pro" class="modal">
        <div class="modal_close">X</div>
        <div class="upgrade__wrapper">
            <div class="upgrade__content">
                <h4>Are you sure you want to disconnect this page?</h4>
                <p>Disconnecting will disable all chatbots on your Facebook page and remove the chat widget from your website.</p>
            </div>
            <div class="upgrade__button">
                <a class="button-close-modal blues" href="#">Cancel</a>
                <a href="<?php echo $connected_page['path']; ?>" id="disconnect" class="button-lazy-load reds">Disconnect
                    <div class="lazyload"></div>
                </a>


            </div>
        </div>
    </div>
    <div id="unsaved_option" class="modal">
        <div class="modal_close">X</div>
        <div class="unsaved__wrapper">
            <div class="unsaved__content">
                <h4>Do you want to save your changes?</h4>
            </div>
            <div class="unsaved__button">
                <a class="blues save_change button-lazy-load" href="#">Save
                    <div class="lazyload"></div>
                </a>
                <a href="#" id="discard_button" class="reds button-lazy-load">Discard<a>
            </div>
        </div>
    </div>
    <div class="modal-overlays" id="modal-overlay">
    </div>

</div>
