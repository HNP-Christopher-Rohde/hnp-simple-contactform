<?php if (! $border_enabled) : ?>
  <div class="hnp-contact-form-border" style="background-color: <?php echo esc_attr($bg_color); ?>; border: <?php echo esc_html($border_size); ?>px solid <?php echo esc_attr($border_color); ?>;">
<?php endif; ?>
    <div class="hnp-contact-form" style="color: <?php echo esc_html($font_color); ?>; font-size: <?php echo esc_html($font_size); ?>px; background-color: <?php echo esc_attr($bg_color); ?>; background-image: url('<?php echo esc_url($bg_image); ?>'); background-size: cover;">
	  <form class="hnp-front-form" method="post" action="">
			<p>
				<label for="hnp_name"><?php echo esc_html($name_text); ?></label>
				<input type="text" name="hnp_name" style="background-color: <?php echo esc_attr($label_bg_color); ?>;" required>
			</p>
			<p>
				<label for="hnp_email"><?php echo esc_html($email_text); ?></label>
				<input type="email" name="hnp_email" style="background-color: <?php echo esc_attr($label_bg_color); ?>;" required>
			</p>
			<?php if ($phone_enabled) : ?>
				<p>
					<label for="hnp_phone"><?php echo esc_html($phone_text); ?></label>
					<input type="tel" name="hnp_phone"  style="background-color: <?php echo esc_attr($label_bg_color); ?>;" <?php if ($phone_required) echo 'required'; ?>>
				</p>
			<?php endif; ?>
			<p>
				<label for="hnp_message"><?php echo esc_html($message_text); ?></label>
				<textarea name="hnp_message" rows="5" style="background-color: <?php echo esc_attr($label_bg_color); ?>;" required></textarea>
			</p>
			<?php if ($honeypot_enabled) : ?>
				<p style="display: none;">
					<label for="hnp_name_2"><?php esc_html_e('Please leave this field empty:', 'hnp-simple_contactform-textdomain'); ?></label>
					<input type="text" name="hnp_name_2" style="background-color: <?php echo esc_attr($label_bg_color); ?>;">
				</p>
			<?php endif; ?>
			<?php if ($captcha_enabled) : ?>
				<p>
					<label for="hnp_captcha"><?php echo esc_html($captcha_text); ?></label>
					<div class="hnp-captcha-container">
						<img class="hnp-captcha-image" src="data:image/png;base64,<?php echo hnp_generateCaptcha(); ?>" alt="<?php esc_html_e('CAPTCHA Image', 'hnp-simple_contactform-textdomain'); ?>">
						<button type="button" class="hnp-refresh-captcha-button">&#8634;</button>
					</div>
				</p>
				<p>
					<input type="text" name="hnp_captcha" style="background-color: <?php echo esc_attr($label_bg_color); ?>;" required>
				</p>
			<?php endif; ?>
			<p>
				<input type="submit" name="hnp_submit" value="<?php echo esc_html($button_text); ?>" style="background-color: <?php echo esc_attr($button_bg_color); ?>">			
				<?php if (!empty($hnp_form_message)) { echo '<div class="hnp_message">' . $hnp_form_message . '</div>'; } ?>
			</p>
	  </form>
    </div>
<?php if (! $border_enabled) : ?>
  </div>
<?php endif; ?>
<?php if ($show_love) : ?>
  <div class="hnp_powered"><a href="https://homepage-nach-preis.de/" title="<?php echo esc_attr__('WordPress Webdesign', 'hnp-simple_contactform-textdomain'); ?>" target="_blank"><?php echo esc_html__('Contact Form powered by HNP', 'hnp-simple_contactform-textdomain'); ?></a></div>
<?php endif; ?>
