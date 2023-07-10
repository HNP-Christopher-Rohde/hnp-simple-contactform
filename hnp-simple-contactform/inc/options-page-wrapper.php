<div class="hnp_simple_contactform_wrap">
<style>#wpfooter {display: none !important;}</style>
	<div class="hnp_flex_container">
	   <div class="hnp_simple_contactform_icon">
		  <img src="<?php echo plugins_url('/img/hnp-logo.png', dirname(__FILE__)); ?>" alt="Plugin Icon">
	   </div>
	   <div class="hnp_flex_content">
		  <h2 class="hnp_simple_contactform_backend-heading"><?php echo esc_html__('HNP Simple Contact Form', 'hnp-simple_contactform-textdomain'); ?></h2>
		  <?php echo hnp_simple_contactform_check_licence_key_status(); ?>
	   </div>
	</div>
   <?php settings_errors(); ?>
   <?php
   $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'plugin';
   ?>
   <div class="hnp_simple_contactform_nav-tab-wrapper">
		<div class="hnp-tab">
		   <h2><a href="?page=hnp_simple_contactform_options&tab=plugin" class="hnp-nav-tab <?php echo isset($active_tab) && $active_tab == 'plugin' ? 'hnp-nav-tab-active' : ''; ?>"><?php echo esc_html__('Option', 'hnp-simple_contactform-textdomain'); ?></a></h2>
		</div>
		<div class="hnp-tab">
		   <h2>
			  <a href="?page=hnp_simple_contactform_options&tab=other" class="hnp-nav-tab <?php echo isset($active_tab) && $active_tab == 'other' ? 'hnp-nav-tab-active' : ''; ?>"><?php echo esc_html__('Other', 'hnp-simple_contactform-textdomain'); ?></a>
		   </h2>
		</div>
   </div>
   <form id="featured_upload" method="post" action="">
      <?php
      if ($active_tab == 'plugin') {
         $options = get_option('hnp-simple_contactform-plugin-options-main');
         if (!is_array($options)) {
            $options = array();
         }
         if (!array_key_exists('hnp_simple_contactform_data_checked', $options)) {
            $options['hnp_simple_contactform_data_checked'] = '';
         }		 
         if (!array_key_exists('hnp_simple_contactform_data_more_checked', $options)) {
            $options['hnp_simple_contactform_data_more_checked'] = '';
         }	 
		 if (isset($_POST['hnp_simple_contactform_data_radio_design'])) {
			$options['hnp_simple_contactform_data_radio_design'] = esc_html($_POST['hnp_simple_contactform_data_radio_design']);
		 } else {
			if (empty($options['hnp_simple_contactform_data_radio_design'])) {
				$options['hnp_simple_contactform_data_radio_design'] = 'simple_contactform_design_1'; 
			}
		 }	 
		 if (!array_key_exists('hnp_simple_contactform_data_comp_nonce_checkbox', $options)) {
            $options['hnp_simple_contactform_data_comp_nonce_checkbox'] = '';
         }	
		 if (!array_key_exists('hnp_simple_contactform_data_defer_checkbox', $options)) {
            $options['hnp_simple_contactform_data_defer_checkbox'] = '';
         }
         if (!array_key_exists('hnp_simple_contactform_captcha', $options)) {
            $options['hnp_simple_contactform_captcha'] = '';
         }
         if (!array_key_exists('hnp_simple_contactform_data_honeypot', $options)) {
            $options['hnp_simple_contactform_data_honeypot'] = '';
         }		
         if (!array_key_exists('hnp_simple_contactform_data_cache', $options)) {
            $options['hnp_simple_contactform_data_cache'] = '';
         }
         if (!array_key_exists('hnp_simple_contactform_data_phone', $options)) {
            $options['hnp_simple_contactform_data_phone'] = '';
         }	
         if (!array_key_exists('hnp_simple_contactform_data_phone_required', $options)) {
            $options['hnp_simple_contactform_data_phone_required'] = '';
         }	
		 if (!array_key_exists('hnp_simple_contactform_data_border_enable', $options)) {
            $options['hnp_simple_contactform_data_border_enable'] = '';
         }
		 if (!array_key_exists('hnp_simple_contactform_data_show_love', $options)) {
            $options['hnp_simple_contactform_data_show_love'] = '';
         }		 
		 
      ?>
		<input type="hidden" name="hnp_form_submitted_1" value="hnp_1">
		<?php echo hnp_simple_contactform_check_status_main(); ?>

		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="activate">
			<strong><?php echo esc_html__('Enable the Contact Form?', 'hnp-simple_contactform-textdomain'); ?></strong><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Enable the functionality of the Contact Form.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_data_checked" type="checkbox" id="hnp_simple_contactform_data_checked" value="1" <?php checked($options['hnp_simple_contactform_data_checked'], 1); ?> onchange="toggleSecondCheckbox(this);" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_shortcode"><?php echo esc_html__('Shortcode for the Frontend:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Add your Contact Form to the Frontend with the &#x5B;hnp_simple_contactform] shortcode.', 'hnp-simple_contactform-textdomain')); ?></label>
			<span style="color: #3772f1; font-weight: bold; font-size: 15px;">&#x5B;hnp_simple_contactform]</span>
		</div>
			  
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="more"><?php echo esc_html__('Disable Pre-Styling CSS?', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Disable the pre-styling Frontend-CSS-File for the Function.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_data_more_checked" type="checkbox" id="hnp_simple_contactform_data_more_checked" value="1" <?php checked($options['hnp_simple_contactform_data_more_checked'], 1); ?> <?php if ($options['hnp_simple_contactform_data_checked'] != '1') echo 'disabled'; ?> />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_comp_nonce_checkbox"><?php echo esc_html__('Activate compatibility mode?', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('If this function is enabled, an attempt will be made to prevent caching, minification, and concatenation of the frontend script. If you encounter error messages or if a function is not working as expected, try using this mode.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_data_comp_nonce_checkbox" type="checkbox" id="hnp_simple_contactform_data_comp_nonce_checkbox" value="1" <?php checked($options['hnp_simple_contactform_data_comp_nonce_checkbox'], 1); ?> />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_cache"><?php echo esc_html__('Activate Captcha Cache Mode?', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('If you using a Cache-Plugin and the Captcha Function, then activate this Option.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_data_cache" type="checkbox" id="hnp_simple_contactform_data_cache" value="1" <?php checked($options['hnp_simple_contactform_data_cache'], 1); ?> />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_defer_checkbox"><?php echo esc_html__('Use Defer mode?', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('When this function is enabled, the "defer" tag will be added to the frontend script, which prevents the script from blocking rendering. This function should be tested after activation.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_data_defer_checkbox" type="checkbox" id="hnp_simple_contactform_data_defer_checkbox" value="1" <?php checked($options['hnp_simple_contactform_data_defer_checkbox'], 1); ?> />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_sendmail_email_text"><?php echo esc_html__('Recipients Email Address', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Recipient email address. This email address is where the contact form submissions will be sent to.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_sendmail_email_text" id="hnp_simple_contactform_data_sendmail_email_text" value="<?php echo isset($options['hnp_simple_contactform_data_sendmail_email_text']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_sendmail_email_text'])) : ''; ?>" placeholder="<?php echo esc_attr__('admin@website.com', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
				
		<div class="hnp-option-desc hnp-option-spacing">
			<h3><?php echo esc_html__('Fields:', 'hnp-simple_contactform-textdomain'); ?></h3>
		</div>
		
		<div class="hnp-option-container hnp_30_pro">
			<label for="hnp_simple_contactform_data_name_text"><?php echo esc_html__('Name Field Text:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('The Frontend-Text for the Name Field', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_name_text" id="hnp_simple_contactform_data_name_text" value="<?php echo isset($options['hnp_simple_contactform_data_name_text']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_name_text'])) : ''; ?>" placeholder="<?php echo esc_attr__('Name:', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_phone"><?php echo esc_html__('Enable the Phone Field?', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Enable the Phone Field in the Frontend', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_data_phone" type="checkbox" id="hnp_simple_contactform_data_phone" value="1" <?php checked($options['hnp_simple_contactform_data_phone'], 1); ?> />
		</div>

		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_phone_text"><?php echo esc_html__('Phone Field Text:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('The Frontend-Text for the Phone Field', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_phone_text" id="hnp_simple_contactform_data_phone_text" value="<?php echo isset($options['hnp_simple_contactform_data_phone_text']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_phone_text'])) : ''; ?>" placeholder="<?php echo esc_attr__('Phone:', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_phone_required"><?php echo esc_html__('Enable Phone Field is required?', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Make the Phone Field to a required Field.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_data_phone_required" type="checkbox" id="hnp_simple_contactform_data_phone_required" value="1" <?php checked($options['hnp_simple_contactform_data_phone_required'], 1); ?> />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_email_text"><?php echo esc_html__('Email Field Text:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('The Frontend-Text for the Email Field', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_email_text" id="hnp_simple_contactform_data_email_text" value="<?php echo isset($options['hnp_simple_contactform_data_email_text']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_email_text'])) : ''; ?>" placeholder="<?php echo esc_attr__('Email:', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_message_text"><?php echo esc_html__('Message Field Text:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('The Frontend-Text for the Message Field', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_message_text" id="hnp_simple_contactform_data_message_text" value="<?php echo isset($options['hnp_simple_contactform_data_message_text']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_message_text'])) : ''; ?>" placeholder="<?php echo esc_attr__('Message:', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_honeypot"><?php echo esc_html__('Enable the Honeypot?', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Enable the honeypot function against spambots. This function creates a hidden field that only spambots can see and fill out. As a result, spambots are detected and the email is not sent.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_data_honeypot" type="checkbox" id="hnp_simple_contactform_data_honeypot" value="1" <?php checked($options['hnp_simple_contactform_data_honeypot'], 1); ?> />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_captcha"><?php echo esc_html__('Enable the Captcha?', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Enable the captcha function against spambots. Note that if you are using a cache plugin, you need to activate the cache captcha function on top.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_captcha" type="checkbox" id="hnp_simple_contactform_captcha" value="1" <?php checked($options['hnp_simple_contactform_captcha'], 1); ?> />
		</div>
				
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_captcha_text"><?php echo esc_html__('Captcha Field Text:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('The Frontend-Text for the Captcha Field', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_captcha_text" id="hnp_simple_contactform_data_captcha_text" value="<?php echo isset($options['hnp_simple_contactform_data_captcha_text']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_captcha_text'])) : ''; ?>" placeholder="<?php echo esc_attr__('Please enter the CAPTCHA:', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_button_text"><?php echo esc_html__('Send Button Text:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('The Frontend-Text for the Send Button', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_button_text" id="hnp_simple_contactform_data_button_text" value="<?php echo isset($options['hnp_simple_contactform_data_button_text']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_button_text'])) : ''; ?>" placeholder="<?php echo esc_attr__('Send Message', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_sucess_text"><?php echo esc_html__('Success Text:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('The success message if a message has been successfully sent.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_sucess_text" id="hnp_simple_contactform_data_sucess_text" value="<?php echo isset($options['hnp_simple_contactform_data_sucess_text']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_sucess_text'])) : ''; ?>" placeholder="<?php echo esc_attr__('Thank you for your message. We will get back to you shortly.', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
		
		<div class="hnp-option-desc hnp-option-spacing">
			<h3><?php echo esc_html__('Style:', 'hnp-simple_contactform-textdomain'); ?></h3>
		</div>
		
		<div class="hnp-option-container hnp_30_pro">
			<label for="hnp_simple_contactform_data_font_size"><?php echo esc_html__('Text Font-Size (Pixels):', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Size of Frontend Text in pixels. Default value = 16.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="number" step="1" name="hnp_simple_contactform_data_font_size" id="hnp_simple_contactform_data_font_size" value="<?php echo !empty($options['hnp_simple_contactform_data_font_size']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_font_size'])) : ''; ?>" placeholder="16" />
		</div>
				
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_text_color"><?php echo esc_html__('Text-Color:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('The Color of the Frontend Text. Default value = #333333.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_text_color" id="hnp_simple_contactform_data_text_color" value="<?php echo isset($options['hnp_simple_contactform_data_text_color']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_text_color'])) : ''; ?>" placeholder="#333333" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_border_enable"><?php echo esc_html__('Disable Border?', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Removes the border area around the form.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_data_border_enable" type="checkbox" id="hnp_simple_contactform_data_border_enable" value="1" <?php checked($options['hnp_simple_contactform_data_border_enable'], 1); ?> />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_border_size"><?php echo esc_html__('Border Size (Pixels):', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Size of the Border in pixels. Default value = 2.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="number" step="1" name="hnp_simple_contactform_data_border_size" id="hnp_simple_contactform_data_border_size" value="<?php echo !empty($options['hnp_simple_contactform_data_border_size']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_border_size'])) : ''; ?>" placeholder="2" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_border_color"><?php echo esc_html__('Border-Color:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Border-Color of the Form. Default value = #CCCCCC.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_border_color" id="hnp_simple_contactform_data_border_color" value="<?php echo isset($options['hnp_simple_contactform_data_border_color']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_border_color'])) : ''; ?>" placeholder="#CCCCCC" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_bg_color"><?php echo esc_html__('Background-Color:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Background-Color of the Form. Default value = #f4f4f4.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_bg_color" id="hnp_simple_contactform_data_bg_color" value="<?php echo isset($options['hnp_simple_contactform_data_bg_color']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_bg_color'])) : ''; ?>" placeholder="#F4F4F4" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_button_bg_color"><?php echo esc_html__('Button Background-Color:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('The Background Color of the Send Button. Default value = #4CAF50.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_button_bg_color" id="hnp_simple_contactform_data_button_bg_color" value="<?php echo isset($options['hnp_simple_contactform_data_button_bg_color']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_button_bg_color'])) : ''; ?>" placeholder="#4CAF50" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_label_bg_color"><?php echo esc_html__('Input Field Background-Color:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Input Fields Background-Color. Default value = #FFFFFF.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_label_bg_color" id="hnp_simple_contactform_data_label_bg_color" value="<?php echo isset($options['hnp_simple_contactform_data_label_bg_color']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_label_bg_color'])) : ''; ?>" placeholder="#FFFFFF" />
		</div>
				
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_image_url"><?php echo esc_html__('Background Image:', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('If you want a Background Image in the Form, then you can choice it here.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_image_url" id="hnp_simple_contactform_data_image_url" value="<?php echo isset($options['hnp_simple_contactform_data_image_url']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_image_url'])) : ''; ?>" placeholder="<?php echo esc_attr__('www.image.com/image.jpg', 'hnp-simple_contactform-textdomain'); ?>" />
			<button class="button" id="select_image_button"><?php echo esc_html__('Select Image', 'hnp-simple_contactform-textdomain'); ?></button>
		</div>		
		
		<div class="hnp-option-desc hnp-option-spacing"><h3><?php echo esc_html__('Design:', 'hnp-simple_contactform-textdomain'); ?></h3></div>
		
		<div class="hnp-option-container hnp_radio hnp_30_pro">
			<label for="hnp_simple_contactform_data_radio_design"><?php echo esc_html__('Design', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Change the Design of the Frontend. This Function is not active now and coming on a later update. ', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="radio" name="hnp_simple_contactform_data_radio_design" id="hnp_simple_contactform_data_radio_design_1" value="simple_contactform_design_1" <?php checked($options['hnp_simple_contactform_data_radio_design'], 'simple_contactform_design_1'); ?> />
			<label id="hnp_radio" for="hnp_simple_contactform_data_radio_design_1"><?php echo esc_html__('Design 1', 'hnp-simple_contactform-textdomain'); ?></label>
			<!-- <?php /*
			<input type="radio" name="hnp_simple_contactform_data_radio_design" id="hnp_simple_contactform_data_radio_design_2" value="simple_contactform_design_2" <?php checked($options['hnp_simple_contactform_data_radio_design'], 'simple_contactform_design_2'); ?> />
			<label id="hnp_radio" for="hnp_simple_contactform_data_radio_design_2"><?php echo esc_html__('Design 2', 'hnp-simple_contactform-textdomain'); ?></label>
			*/ ?> -->
			<input type="radio" name="hnp_simple_contactform_data_radio_design" id="hnp_simple_contactform_data_radio_design_2" value="simple_contactform_design_2" <?php checked($options['hnp_simple_contactform_data_radio_design'], 'simple_contactform_design_2'); ?> disabled>
			<label id="hnp_radio" for="hnp_simple_contactform_data_radio_design_2" style="text-decoration: line-through;"><?php echo esc_html__('Design 2', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Function comes later.', 'hnp-simple_contactform-textdomain')); ?></label>
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_data_show_love"><?php echo esc_html__('Show Love?', 'hnp-simple_contactform-textdomain'); ?><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('This option generates a small "Powered by" text below the form. By enabling this option, you support us by increasing our reach, which allows us to continue working on plugins.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input name="hnp_simple_contactform_data_show_love" type="checkbox" id="hnp_simple_contactform_data_show_love" value="1" <?php checked($options['hnp_simple_contactform_data_show_love'], 1); ?> />
		</div>

		<div class="hnp-option-container hnp-option-spacing-2 hnp_30_pro">
			<input class="hnp-button-primary" type="submit" name="hnp_form_submit_1" value="<?php echo esc_html__('Update/Save', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
		
		  <p style="text-align: right;"><a href="https://homepage-nach-preis.de/" target="_blank"><?php echo esc_html__('HNP - Programming made with love in Germany.', 'hnp-simple_contactform-textdomain'); ?></a></p>   
		
	 							
       <?php } elseif ($active_tab == 'other') {
		$options = get_option('hnp-simple_contactform-plugin-options-other');?>
		
	    <input type="hidden" name="hnp_form_submitted_9" value="hnp_9">
		<p>
			<strong><?php echo esc_html__('Do you have any questions? Do you need a custom plugin or custom function for WordPress / WooCommerce? Send us an email:', 'hnp-simple_contactform-textdomain'); ?> <a href="mailto:info@Homepage-nach-Preis.de">info@Homepage-nach-Preis.de</a></strong>
		</p>
	  
		 <div class="info-container">
		 <div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_simple_contactform_plugin_data_licence"><strong><?php echo esc_html__('Licence Key:', 'hnp-simple_contactform-textdomain'); ?></strong><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Your Licence Key.', 'hnp-simple_contactform-textdomain')); ?></label>
			<input type="text" name="hnp_simple_contactform_data_licence" id="hnp_simple_contactform_data_licence" value="<?php echo isset($options['hnp_simple_contactform_data_licence']) ? esc_attr(sanitize_text_field($options['hnp_simple_contactform_data_licence'])) : ''; ?>" placeholder="<?php echo esc_attr__('Licence Code', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
		
		<div class="hnp-option-desc hnp-option-spacing"><h3><?php echo esc_html__('Custom Style:', 'hnp-simple_contactform-textdomain'); ?></h3></div>
		<div class="hnp-option-container hnp_30_pro">
		   <label for="hnp_simple_contactform_plugin_data_custom_css"><strong><?php echo esc_html__('Custom Style CSS:', 'hnp-simple_contactform-textdomain'); ?></strong><?php echo hnp_simple_contactform_generate_hover_box(esc_html__('Enter your custom CSS code here.', 'hnp-simple_contactform-textdomain')); ?></label>
		   <textarea name="hnp_simple_contactform_data_custom_css" rows="8" id="hnp_simple_contactform_data_custom_css" placeholder="<?php echo esc_attr__('.example-class{color: #000;}', 'hnp-simple_contactform-textdomain'); ?>"><?php echo isset($options['hnp_simple_contactform_data_custom_css']) ? esc_textarea($options['hnp_simple_contactform_data_custom_css']) : ''; ?></textarea>
		</div>
		
		<div class="hnp-option-container hnp-option-spacing-2 hnp_30_pro">
			<input class="hnp-button-primary" type="submit" name="hnp_form_submit_9" value="<?php echo esc_html__('Update/Save', 'hnp-simple_contactform-textdomain'); ?>" />
		</div>
		<div class="hnp-option-desc hnp-option-spacing"><h3><?php echo esc_html__('Plugin Style:', 'hnp-simple_contactform-textdomain'); ?></h3></div>
		<table class="info-table">
		   <tr>
			  <th><?php esc_html_e('Area', 'hnp-simple_contactform-textdomain'); ?></th>
			  <th><?php esc_html_e('CSS-Class', 'hnp-simple_contactform-textdomain'); ?></th>
		   </tr>
		   <tr>
			  <td><?php esc_html_e('Main-Container Border', 'hnp-simple_contactform-textdomain'); ?></td>
			  <td>.hnp-contact-form-border</td>
		   </tr>
		   <tr>
			  <td><?php esc_html_e('Main-Container', 'hnp-simple_contactform-textdomain'); ?></td>
			  <td>.hnp-contact-form</td>
		   </tr>
		   <tr>
			  <td><?php esc_html_e('Form', 'hnp-simple_contactform-textdomain'); ?></td>
			  <td>.hnp-front-form</td>
		   </tr>
			<tr>
			  <td><?php esc_html_e('Captcha Container', 'hnp-simple_contactform-textdomain'); ?></td>
			  <td>.hnp-captcha-container</td>
		   </tr>
		   	<tr>
			  <td><?php esc_html_e('Refresh Button', 'hnp-simple_contactform-textdomain'); ?></td>
			  <td>.hnp-refresh-captcha-button</td>
		   </tr>
		   	<tr>
			  <td><?php esc_html_e('Send Button', 'hnp-simple_contactform-textdomain'); ?></td>
			  <td>.hnp-contact-form input[type="submit"]</td>
		   </tr>
		    <tr>
			  <td><?php esc_html_e('Fields', 'hnp-simple_contactform-textdomain'); ?></td>
			  <td>.hnp-contact-form input</td>
		   </tr>
		   	<tr>
			  <td><?php esc_html_e('Textarea', 'hnp-simple_contactform-textdomain'); ?></td>
			  <td>.hnp-contact-form textarea</td>
		   </tr>
		</table>
		</div>
		   </br></br><p style="text-align: right;"><a href="https://homepage-nach-preis.de/" target="_blank"><?php echo esc_html__('HNP - Programming made with love in Germany.', 'hnp-simple_contactform-textdomain'); ?></a></p>   
		</div>

      <?php } ?>
   </form>
</div>