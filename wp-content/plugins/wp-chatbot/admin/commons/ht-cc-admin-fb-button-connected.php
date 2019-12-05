<?php

/**
 *  View of Facebook button area when connected.
 * 
 * @uses at class-htcc-admin.php 
 */

if (!defined('ABSPATH')) exit;
?>
<h2><?php settings_errors(); ?> </h2>

<div class="connected-page">    
    <div class="active-page-info">
   <p class="page_name"><?php echo $connected_page['name']; ?></p><p class="connect_check"> <i class="fa fa-check"></i>Connected</p>
    </div>
</div>



