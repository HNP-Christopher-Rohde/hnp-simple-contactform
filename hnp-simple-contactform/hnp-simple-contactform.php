<?php

/*
  Plugin Name: HNP - Simple Contact Form
  Description: A Simple Contactform-Plugin with Honeypot and Captcha. All what you need and not more. 
  Author: Christopher Rohde
  Version: 1.0
  Author URI: https://homepage-nach-preis.de/
  License: GPLv3
  Text Domain: hnp-simple_contactform-textdomain
  Domain Path: /languages
 */

defined('ABSPATH') or die('Huh, are you trying to cheat?');
$plugin_url = plugin_dir_url(__FILE__);
$options = array();

function hnp_simple_contactform_load_textdomain() {
   $domain = 'hnp-simple_contactform-textdomain';
   $locale = apply_filters('plugin_locale', get_locale(), $domain);
   $mofile = WP_PLUGIN_DIR . '/hnp-simple_contactform-plugin/languages/' . $domain . '-' . $locale . '.mo';

   if (file_exists($mofile)) {
      load_textdomain($domain, $mofile);
   } else {
      load_plugin_textdomain($domain, false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
   }
}
add_action('plugins_loaded', 'hnp_simple_contactform_load_textdomain');

function hnp_simple_contactform_menu() {
   add_menu_page(
      esc_html__('HNP - Simple Contact Form', 'hnp-simple_contactform-textdomain'),
      esc_html__('HNP - Simple Contact Form', 'hnp-simple_contactform-textdomain'),
      'manage_options',
      'hnp_simple_contactform_options',
      'hnp_simple_contactform_display',
      plugin_dir_url(__FILE__) . 'img/hnp-favi.png'
   );
}
add_action('admin_menu', 'hnp_simple_contactform_menu');

function hnp_simple_contactform_plugin_settings_link($links) {
   $settings_link = '<a href="admin.php?page=hnp_simple_contactform_options">' . esc_html__('Settings', 'hnp-simple_contactform-textdomain') . '</a>';
   array_push($links, $settings_link);
   return $links;
}
$plugin_file = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin_file", 'hnp_simple_contactform_plugin_settings_link');

function hnp_simple_contactform_display() {
   if (!current_user_can('manage_options')) {     
	  wp_die(esc_html__('You do not have enough permission to view this page', 'hnp-simple_contactform-textdomain'));
   }

   global $plugin_url;
   global $options;
   
	// Main OPTIONS 	
   if (isset($_POST['hnp_form_submit_1'])) {
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      require_once(ABSPATH . 'wp-admin/includes/file.php');
      require_once(ABSPATH . 'wp-admin/includes/media.php');

      echo '<h2 style="color:green">' . esc_html__('Saved', 'hnp-simple_contactform-textdomain') . '</h2>';
      echo '<script src="' . plugin_dir_url(__FILE__) . 'js/hnp_simple_contactform_admin_save.js"></script>';
	  	  
	   // Main 
      $options['hnp_simple_contactform_data_checked'] = isset($_POST['hnp_simple_contactform_data_checked']) ? esc_html($_POST['hnp_simple_contactform_data_checked']) : '';
	  $options['hnp_simple_contactform_data_more_checked'] = isset($_POST['hnp_simple_contactform_data_more_checked']) ? esc_html($_POST['hnp_simple_contactform_data_more_checked']) : '';
	  $options['hnp_simple_contactform_data_defer_checkbox'] = isset($_POST['hnp_simple_contactform_data_defer_checkbox']) ? esc_html($_POST['hnp_simple_contactform_data_defer_checkbox']) : '';
	  $options['hnp_simple_contactform_data_comp_nonce_checkbox'] = isset($_POST['hnp_simple_contactform_data_comp_nonce_checkbox']) ? esc_html($_POST['hnp_simple_contactform_data_comp_nonce_checkbox']) : '';   
	  $options['hnp_simple_contactform_data_radio_design'] = isset($_POST['hnp_simple_contactform_data_radio_design']) ? $_POST['hnp_simple_contactform_data_radio_design'] : ''; 	  
	  $options['hnp_simple_contactform_data_cache'] = isset($_POST['hnp_simple_contactform_data_cache']) ? esc_html($_POST['hnp_simple_contactform_data_cache']) : '';
	  $options['hnp_simple_contactform_data_sendmail_email_text'] = isset($_POST['hnp_simple_contactform_data_sendmail_email_text']) ? esc_html($_POST['hnp_simple_contactform_data_sendmail_email_text']) : '';
	  
	  // Form Fields
	  $options['hnp_simple_contactform_data_button_text'] = isset($_POST['hnp_simple_contactform_data_button_text']) ? esc_html($_POST['hnp_simple_contactform_data_button_text']) : '';
	  $options['hnp_simple_contactform_data_name_text'] = isset($_POST['hnp_simple_contactform_data_name_text']) ? esc_html($_POST['hnp_simple_contactform_data_name_text']) : '';
	  $options['hnp_simple_contactform_data_email_text'] = isset($_POST['hnp_simple_contactform_data_email_text']) ? esc_html($_POST['hnp_simple_contactform_data_email_text']) : '';
	  $options['hnp_simple_contactform_data_message_text'] = isset($_POST['hnp_simple_contactform_data_message_text']) ? esc_html($_POST['hnp_simple_contactform_data_message_text']) : '';
	  $options['hnp_simple_contactform_data_phone_text'] = isset($_POST['hnp_simple_contactform_data_phone_text']) ? esc_html($_POST['hnp_simple_contactform_data_phone_text']) : '';
	  $options['hnp_simple_contactform_data_captcha_text'] = isset($_POST['hnp_simple_contactform_data_captcha_text']) ? esc_html($_POST['hnp_simple_contactform_data_captcha_text']) : '';
	  $options['hnp_simple_contactform_data_honeypot'] = isset($_POST['hnp_simple_contactform_data_honeypot']) ? esc_html($_POST['hnp_simple_contactform_data_honeypot']) : '';
	  $options['hnp_simple_contactform_captcha'] = isset($_POST['hnp_simple_contactform_captcha']) ? esc_html($_POST['hnp_simple_contactform_captcha']) : '';
	  $options['hnp_simple_contactform_data_phone'] = isset($_POST['hnp_simple_contactform_data_phone']) ? esc_html($_POST['hnp_simple_contactform_data_phone']) : '';	
	  $options['hnp_simple_contactform_data_sucess_text'] = isset($_POST['hnp_simple_contactform_data_sucess_text']) ? esc_html($_POST['hnp_simple_contactform_data_sucess_text']) : '';	  
	  $options['hnp_simple_contactform_data_phone_required'] = isset($_POST['hnp_simple_contactform_data_phone_required']) ? esc_html($_POST['hnp_simple_contactform_data_phone_required']) : '';
	  
	  // Style
	  $options['hnp_simple_contactform_data_image_url'] = isset($_POST['hnp_simple_contactform_data_image_url']) ? esc_url($_POST['hnp_simple_contactform_data_image_url']) : '';
	  $options['hnp_simple_contactform_data_font_size'] = isset($_POST['hnp_simple_contactform_data_font_size']) ? absint($_POST['hnp_simple_contactform_data_font_size']) : '';
	  $options['hnp_simple_contactform_data_border_size'] = isset($_POST['hnp_simple_contactform_data_border_size']) ? absint($_POST['hnp_simple_contactform_data_border_size']) : '';
	  $options['hnp_simple_contactform_data_text_color'] = isset($_POST['hnp_simple_contactform_data_text_color']) ? sanitize_hex_color($_POST['hnp_simple_contactform_data_text_color']) : '';
	  $options['hnp_simple_contactform_data_border_color'] = isset($_POST['hnp_simple_contactform_data_border_color']) ? sanitize_hex_color($_POST['hnp_simple_contactform_data_border_color']) : '';	
	  $options['hnp_simple_contactform_data_bg_color'] = isset($_POST['hnp_simple_contactform_data_bg_color']) ? sanitize_hex_color($_POST['hnp_simple_contactform_data_bg_color']) : '';
	  $options['hnp_simple_contactform_data_button_bg_color'] = isset($_POST['hnp_simple_contactform_data_button_bg_color']) ? sanitize_hex_color($_POST['hnp_simple_contactform_data_button_bg_color']) : '';	  
	  $options['hnp_simple_contactform_data_border_enable'] = isset($_POST['hnp_simple_contactform_data_border_enable']) ? esc_html($_POST['hnp_simple_contactform_data_border_enable']) : '';
	  $options['hnp_simple_contactform_data_label_bg_color'] = isset($_POST['hnp_simple_contactform_data_label_bg_color']) ? sanitize_hex_color($_POST['hnp_simple_contactform_data_label_bg_color']) : '';	
	  $options['hnp_simple_contactform_data_show_love'] = isset($_POST['hnp_simple_contactform_data_show_love']) ? esc_html($_POST['hnp_simple_contactform_data_show_love']) : '';	  
	  
	  //Save 
      update_option('hnp-simple_contactform-plugin-options-main', $options);
   }
	
	// Other OPTIONS   
	if (isset($_POST['hnp_form_submit_9'])) {
	  require_once(ABSPATH . 'wp-admin/includes/image.php');
      require_once(ABSPATH . 'wp-admin/includes/file.php');
      require_once(ABSPATH . 'wp-admin/includes/media.php');

      echo '<h2 style="color:green">' . esc_html__('Saved', 'hnp-simple_contactform-textdomain') . '</h2>';
      echo '<script src="' . plugin_dir_url(__FILE__) . 'js/hnp_simple_contactform_admin_save.js"></script>';
	  
	  $options['hnp_simple_contactform_data_licence'] = isset($_POST['hnp_simple_contactform_data_licence']) ? esc_html($_POST['hnp_simple_contactform_data_licence']) : '';
	  $options['hnp_simple_contactform_data_custom_css'] = isset($_POST['hnp_simple_contactform_data_custom_css']) ? esc_html($_POST['hnp_simple_contactform_data_custom_css']) : '';
	
	  update_option('hnp-simple_contactform-plugin-options-other', $options);
	}

   $options = get_option('hnp-simple_contactform-plugin-options-main');
   $options = get_option('hnp-simple_contactform-plugin-options-other');
   require('inc/options-page-wrapper.php');
}


// ******* CHECK THE FUNCTION ******

// Check the Licence
// Its just a test, Main-Function comes later
// This plugin will never be paid for. Also, all features will be available for free without limitation. This function should be present for "possible" external addons.
function hnp_simple_contactform_check_licence_key_status() {
    $options = get_option('hnp-simple_contactform-plugin-options-other');

    $hnp_licence_key = 'Free Version';
    $color = '';

    if (isset($options['hnp_simple_contactform_data_licence'])) {
        $licence_key = $options['hnp_simple_contactform_data_licence'];

        if (substr($licence_key, 0, 4) === 'hnp-' || substr($licence_key, 0, 4) === 'HNP-') {
            $hnp_licence_key = esc_html__('Licence Activated', 'hnp-simple_contactform-textdomain');
            $color = 'green';
        } elseif (strlen($licence_key) === 9 && substr($licence_key, -1) === '-') {
            $hnp_licence_key = esc_html__('Licence Activated', 'hnp-simple_contactform-textdomain');
            $color = 'green';
        }
    }

    if ($hnp_licence_key === '') {
        $hnp_licence_key = esc_html__('Licence Not activated', 'hnp-simple_contactform-textdomain');
        $color = 'red';
    }

    return '<div class="hnp_plugin_data_active" style="color: ' . $color . '; font-weight: bold;">' . esc_html($hnp_licence_key) . '</div>';
}


// Check Status of Function
function hnp_simple_contactform_check_status_main() {
    $options = get_option('hnp-simple_contactform-plugin-options-main');

    $hnp_function_status = '';
    $function_color = '';

    if (isset($options['hnp_simple_contactform_data_checked'])) {
        $function_activate = $options['hnp_simple_contactform_data_checked'];

        if ($function_activate === '1') {
            $hnp_function_status = esc_html__('Activated', 'hnp-simple_contactform-textdomain');
            $function_color = 'green';
        } else {
            $hnp_function_status = esc_html__('Not Activated', 'hnp-simple_contactform-textdomain');
            $function_color = 'red';
        }
    } else {
        $hnp_function_status = esc_html__('Not Activated', 'hnp-simple_contactform-textdomain');
        $function_color = 'red';
    }

    $hnp_comp_mode_status = '';
    $comp_mode_color = '';

    if (isset($options['hnp_simple_contactform_data_comp_nonce_checkbox'])) {
        $comp_mode_activate = $options['hnp_simple_contactform_data_comp_nonce_checkbox'];

        if ($comp_mode_activate === '1') {
            $hnp_comp_mode_status = esc_html__('Activated', 'hnp-simple_contactform-textdomain');
            $comp_mode_color = 'green';
        } else {
            $hnp_comp_mode_status = esc_html__('Not Activated', 'hnp-simple_contactform-textdomain');
            $comp_mode_color = 'red';
        }
    } else {
        $hnp_comp_mode_status = esc_html__('Not Activated', 'hnp-simple_contactform-textdomain');
        $comp_mode_color = 'red';
    }


		$output = '<div class="hnp_simple_contactform_data_active" style="font-weight: bold;">';
		$output .= sprintf(
			__('Function: <span style="color: %s;">%s</span> | ', 'hnp-simple_contactform-textdomain'),
			$function_color,
			esc_html($hnp_function_status)
		);
		$output .= sprintf(
			__('Compatibility Mode: <span style="color: %s;">%s</span>', 'hnp-simple_contactform-textdomain'),
			$comp_mode_color,
			esc_html($hnp_comp_mode_status)
		);
		$output .= '</div>';


    return $output;
}


//**** END CHECK FUNCTION

//Frontend-Inline CSS
function hnp_simple_contactform_output_custom_css() {
   $options = get_option('hnp-simple_contactform-plugin-options-other');
   $custom_css = !empty($options['hnp_simple_contactform_data_custom_css']) ? $options['hnp_simple_contactform_data_custom_css'] : '';

   if (!empty($custom_css)) {
      echo '<style>' . esc_html($custom_css) . '</style>';
   }
}
add_action('wp_head', 'hnp_simple_contactform_output_custom_css');


//Hover Box
function hnp_simple_contactform_generate_hover_box($text) {
    $html = '<div class="hover-box">';
    $html .= '<span class="hover-text">' . esc_html($text) . '</span>';
    $html .= '</div>';
    
    return $html;
}


// Enqueue Scripts
function hnp_simple_contactform_plugin_admin_styles() {
   wp_enqueue_style('hnp_simple_contactform_unique-admin-styles', plugin_dir_url(__FILE__) . 'css/hnp_simple_contactform_backend.css', array(), '1.0');
   wp_enqueue_script('hnp_simple_contactform_custom-admin-script', plugin_dir_url(__FILE__) . 'js/hnp_simple_contactform_custom_admin_script.js', array('jquery'), '1.4', true);
   wp_enqueue_media();
   wp_enqueue_style( 'wp-color-picker' ); // Style for the color picker box
   wp_enqueue_script( 'wp-color-picker' ); // Script for the color picker box
}

add_action('admin_enqueue_scripts', 'hnp_simple_contactform_plugin_admin_styles', 999);

// #### Start the Contact function  ####

// *** Frontend Script ***
function hnp_contactform_custom_scripts_and_auto_click() {
    $options = get_option('hnp-simple_contactform-plugin-options-main');
    if (isset($options['hnp_simple_contactform_data_checked']) && $options['hnp_simple_contactform_data_checked'] != '') {
        // Use defer Checkbox
        $use_defer = isset($options['hnp_simple_contactform_data_defer_checkbox']) && $options['hnp_simple_contactform_data_defer_checkbox'] == 1;

        // Nonce Modus Checkbox
        $use_nonce = isset($options['hnp_simple_contactform_data_comp_nonce_checkbox']) && $options['hnp_simple_contactform_data_comp_nonce_checkbox'] == 1;

        // Create the Nonce
        $nonce = $use_nonce ? wp_create_nonce('hnp_contactform_custom_scripts_and_auto_clic') : '';
        ?>
        <script id="hnp_simple_contactform_data_protection" type="text/javascript"<?php if ($use_nonce) { echo ' nonce="' . $nonce . '"'; } ?> <?php if ($use_defer) { echo 'defer'; } ?>>
           jQuery(function($) {
              // Check the nonce before executing the script, if enabled
              <?php if ($use_nonce) { ?>
              var hnp_simple_contactform_nonce = '<?php echo $nonce; ?>';
              $.ajaxSetup({
                 beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', hnp_simple_contactform_nonce);
                 }
              });
              <?php } ?>

        
              // Refresh the Image
              $(document).on('click', '.hnp-refresh-captcha-button', function(e) {
                e.preventDefault();
                refreshCaptcha();
              });

              function refreshCaptcha() {
                $.ajax({
                  url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                  type: 'POST',
                  data: {
                    action: 'hnp_refresh_captcha'
                  },
                  success: function(response) {
                    // Switch the Captcha Image
                    $('.hnp-captcha-image').attr('src', 'data:image/png;base64,' + response);
                  },
                  error: function(xhr, status, error) {
                    console.log(error);
                  }
                });
              }
           });

           // Autoclick on Cache Plugins
           <?php if (isset($options['hnp_simple_contactform_data_cache']) && $options['hnp_simple_contactform_data_cache'] != '') { ?>
				jQuery(function($) {
					var refreshButton = $('.hnp-refresh-captcha-button');
					if (refreshButton.length) {
						refreshButton.trigger('click');
					}
				});

           <?php } ?>
        </script>
        <?php
    }
}

$options = get_option('hnp-simple_contactform-plugin-options-main');
if (isset($options['hnp_simple_contactform_data_checked']) && $options['hnp_simple_contactform_data_checked'] != '') {
    add_action('wp_head', 'hnp_contactform_custom_scripts_and_auto_click');
}

// Frontend CSS
function hnp_simple_contactform_frontend_custom_styles() {
	$options = get_option('hnp-simple_contactform-plugin-options-main');
	$more_checked = isset($options['hnp_simple_contactform_data_more_checked']) ? $options['hnp_simple_contactform_data_more_checked'] : '';
	$checked = isset($options['hnp_simple_contactform_data_checked']) ? $options['hnp_simple_contactform_data_checked'] : '';

   // Checkbox
   if (empty($more_checked) && $checked) {
      wp_enqueue_style('hnp_simple_contactform_css_unique-styles', plugin_dir_url(__FILE__) . 'css/hnp_simple_contactform_frontend.css', array(), '2.2');	  
	  wp_localize_script( 'hnp-captcha-script', 'hnp_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	  
   }
}

add_action('wp_enqueue_scripts', 'hnp_simple_contactform_frontend_custom_styles');

// Start Contactform Function
session_start(); 

function hnp_generateCaptcha() {
	$options = get_option('hnp-simple_contactform-plugin-options-main');
	$captcha_enabled = isset($options['hnp_simple_contactform_captcha']) ? $options['hnp_simple_contactform_captcha'] : false;

	if (!$captcha_enabled) {
		return '';
	}

	$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnopqrstuvwxyz123456789';
	$length = 4;
	$captcha = '';

	for ($i = 0; $i < $length; $i++) {
		$captcha .= $chars[rand(0, strlen($chars) - 1)];
	}

	$_SESSION['hnp_captcha'] = $captcha;

	$image = imagecreate(120, 40);
	$background = imagecolorallocate($image, 255, 255, 255);
	$textColor = imagecolorallocate($image, 51, 51, 51);
	$fontSize = 20;

	// Path to Font
	$fontFile = plugin_dir_path(__FILE__) . 'font/opensans-regular.ttf';

	imagettftext($image, $fontSize, 0, 25, 30, $textColor, $fontFile, $captcha);

	ob_start();
	imagepng($image);
	$image_data = ob_get_clean();

	return base64_encode($image_data);
}

function hnp_validateCaptcha($userCaptcha) {
	if (isset($_SESSION['hnp_captcha']) && $_SESSION['hnp_captcha'] === $userCaptcha) {
		unset($_SESSION['hnp_captcha']);
		return true;
	}

	return false;
}

// Refresh Captcha
function hnp_refresh_captcha() {
	$new_captcha = hnp_generateCaptcha();
	echo $new_captcha;
	die();
}

// Ajax Action
add_action('wp_ajax_hnp_refresh_captcha', 'hnp_refresh_captcha');
add_action('wp_ajax_nopriv_hnp_refresh_captcha', 'hnp_refresh_captcha');

function hnp_contact_form_shortcode() {
	
	$options = get_option('hnp-simple_contactform-plugin-options-main');
	
	//Main
	$sendmail_email = !empty($options['hnp_simple_contactform_data_sendmail_email_text']) && $options['hnp_simple_contactform_data_sendmail_email_text'] != '' ? esc_html($options['hnp_simple_contactform_data_sendmail_email_text']) : get_option('admin_email');	
	$radio_design = isset($options['hnp_simple_contactform_data_radio_design']) ? $options['hnp_simple_contactform_data_radio_design'] : '';
	$captcha_enabled = isset($options['hnp_simple_contactform_captcha']) ? $options['hnp_simple_contactform_captcha'] : false;
	$honeypot_enabled = isset($options['hnp_simple_contactform_data_honeypot']) ? $options['hnp_simple_contactform_data_honeypot'] : false;
	$border_enabled = isset($options['hnp_simple_contactform_data_border_enable']) ? $options['hnp_simple_contactform_data_border_enable'] : false;
	$hnp_form_message = '';

	//Options
	$button_text = !empty($options['hnp_simple_contactform_data_button_text']) && $options['hnp_simple_contactform_data_button_text'] != '' ? esc_html__($options['hnp_simple_contactform_data_button_text'], 'hnp-simple_contactform-textdomain') : esc_html__('Send Message', 'hnp-simple_contactform-textdomain');
	$email_text = !empty($options['hnp_simple_contactform_data_email_text']) && $options['hnp_simple_contactform_data_email_text'] != '' ? esc_html__($options['hnp_simple_contactform_data_email_text'], 'hnp-simple_contactform-textdomain') : esc_html__('Email:', 'hnp-simple_contactform-textdomain');
	$name_text = !empty($options['hnp_simple_contactform_data_name_text']) && $options['hnp_simple_contactform_data_name_text'] != '' ? esc_html__($options['hnp_simple_contactform_data_name_text'], 'hnp-simple_contactform-textdomain') : esc_html__('Name:', 'hnp-simple_contactform-textdomain');
	$phone_text = !empty($options['hnp_simple_contactform_data_phone_text']) && $options['hnp_simple_contactform_data_phone_text'] != '' ? esc_html__($options['hnp_simple_contactform_data_phone_text'], 'hnp-simple_contactform-textdomain') : esc_html__('Phone:', 'hnp-simple_contactform-textdomain');
	$message_text = !empty($options['hnp_simple_contactform_data_message_text']) && $options['hnp_simple_contactform_data_message_text'] != '' ? esc_html__($options['hnp_simple_contactform_data_message_text'], 'hnp-simple_contactform-textdomain') : esc_html__('Message:', 'hnp-simple_contactform-textdomain');
	$captcha_text = !empty($options['hnp_simple_contactform_data_captcha_text']) && $options['hnp_simple_contactform_data_captcha_text'] != '' ? esc_html__($options['hnp_simple_contactform_data_captcha_text'], 'hnp-simple_contactform-textdomain') : esc_html__('Please enter the CAPTCHA:', 'hnp-simple_contactform-textdomain');
	$phone_enabled = isset($options['hnp_simple_contactform_data_phone']) ? $options['hnp_simple_contactform_data_phone'] : false;
	$sucess_text = !empty($options['hnp_simple_contactform_data_sucess_text']) && $options['hnp_simple_contactform_data_sucess_text'] != '' ? esc_html__($options['hnp_simple_contactform_data_sucess_text'], 'hnp-simple_contactform-textdomain') : esc_html__('Thank you for your message. We will get back to you shortly.', 'hnp-simple_contactform-textdomain');
	$phone_required = isset($options['hnp_simple_contactform_data_phone_required']) ? $options['hnp_simple_contactform_data_phone_required'] : false;

	//Style
	$font_size = !empty($options['hnp_simple_contactform_data_font_size']) ? esc_html($options['hnp_simple_contactform_data_font_size']) : '16';
	$border_size = !empty($options['hnp_simple_contactform_data_border_size']) ? esc_html($options['hnp_simple_contactform_data_border_size']) : '2';
	$font_color = !empty($options['hnp_simple_contactform_data_text_color']) ? esc_html($options['hnp_simple_contactform_data_text_color']) : '#333333';
	$bg_color = !empty($options['hnp_simple_contactform_data_bg_color']) ? esc_html($options['hnp_simple_contactform_data_bg_color']) : '#f4f4f4';
	$button_bg_color = !empty($options['hnp_simple_contactform_data_button_bg_color']) ? esc_html($options['hnp_simple_contactform_data_button_bg_color']) : '#4CAF50';
	$label_bg_color = !empty($options['hnp_simple_contactform_data_label_bg_color']) ? esc_html($options['hnp_simple_contactform_data_label_bg_color']) : '#FFFFFF';
	$border_color = !empty($options['hnp_simple_contactform_data_border_color']) ? esc_html($options['hnp_simple_contactform_data_border_color']) : '#CCCCCC';
	$bg_image = !empty($options['hnp_simple_contactform_data_image_url']) && $options['hnp_simple_contactform_data_image_url'] != '' ? esc_html($options['hnp_simple_contactform_data_image_url']) : '';
	$show_love = isset($options['hnp_simple_contactform_data_show_love']) ? $options['hnp_simple_contactform_data_show_love'] : false;	
	
	if (isset($_POST['hnp_submit'])) {
		$honeypot = isset($_POST['hnp_name_2']) ? $_POST['hnp_name_2'] : '';

		if ((!$captcha_enabled || (isset($_POST['hnp_captcha']) && hnp_validateCaptcha($_POST['hnp_captcha']))) && (!$honeypot_enabled || empty($honeypot))) {
			// Proceed with form submission

			$name = isset($_POST['hnp_name']) ? esc_html($_POST['hnp_name']) : '';
			$email = isset($_POST['hnp_email']) ? esc_html($_POST['hnp_email']) : '';
			$message = isset($_POST['hnp_message']) ? esc_html($_POST['hnp_message']) :
			$phone = isset($_POST[$phone_text]) ? esc_html($_POST[$phone_text]) : '';
			
			// Set Reply-To header
			$headers = array(
				 'Reply-To: ' . $email
			);

			// The Email
			$to = $sendmail_email;
			$subject = esc_html__('New Contact Request from', 'hnp-simple_contactform-textdomain') . ' ' . $name;
			$body = '' . __('Contact Request:', 'hnp-simple_contactform-textdomain') . '' . "\n\n" . $name_text . " $name";

			if ($phone_enabled) {
				$phone = isset($_POST['hnp_phone']) ? esc_html($_POST['hnp_phone']) : '';
				$body .= "\n\n" . $phone_text . " $phone";
			}

			$body .= "\n\n" . $email_text . " $email\n\n" . $message_text . " $message";
			$body .= "\n\n" . esc_html__('---', 'hnp-simple_contactform-textdomain');
			$body .= "\n\n" . sprintf(esc_html__('This Email was sent from the Contactform on %s', 'hnp-simple_contactform-textdomain'), get_site_url());


			if (wp_mail($to, $subject, $body, $headers)) {
				$hnp_form_message = $sucess_text;
			} else {
				$hnp_form_message = esc_html__('An error occurred while sending the message. Please try again.', 'hnp-simple_contactform-textdomain');
			}
		} elseif ($honeypot_enabled && !empty($honeypot)) {
			// Honey Pot Message
			$hnp_form_message = esc_html__('Spam Bot Detection!', 'hnp-simple_contactform-textdomain');
		} elseif ($captcha_enabled && isset($_POST['hnp_captcha']) && !hnp_validateCaptcha($_POST['hnp_captcha'])) {
			// CAPTCHA invalid
			$hnp_form_message = esc_html__('Invalid CAPTCHA!', 'hnp-simple_contactform-textdomain');
		} else {
			// Default error message
			$hnp_form_message = esc_html__('Form submission failed. Please try again.', 'hnp-simple_contactform-textdomain');
		}
	}

	ob_start();

	if ($radio_design === 'simple_contactform_design_1' || empty($radio_design)) {
		include_once(plugin_dir_path(__FILE__) . 'inc/contactform-template-1.php'); // Template 1
	} elseif ($radio_design === 'simple_contactform_design_2') {
		echo esc_html__('Coming soon', 'hnp-simple_contactform-textdomain');
	}

	return ob_get_clean();
}

$options = get_option('hnp-simple_contactform-plugin-options-main');
if (isset($options['hnp_simple_contactform_data_checked']) && $options['hnp_simple_contactform_data_checked'] != '') {
    add_shortcode('hnp_simple_contactform', 'hnp_contact_form_shortcode');
}