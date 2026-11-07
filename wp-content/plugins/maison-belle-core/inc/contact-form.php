<?php
/**
 * Contact Form 7 integration: spam trap, recipient from Salon Settings, friendly
 * validation messages, and the form template used by the demo seeder.
 *
 * Everything here only runs when Contact Form 7 is active.
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Is this submission for the salon's contact form?
 *
 * @param WPCF7_ContactForm $form Form object.
 * @return bool
 */
function mb_is_salon_form( $form ) {
	$id = (int) mb_get_setting( 'contact_form_id' );
	return $id > 0 && (int) $form->id() === $id;
}

// The theme styles the form itself, so skip CF7's stylesheet.
add_filter( 'wpcf7_load_css', '__return_false' );

// The form template is already structured HTML: stop WordPress wrapping fields in stray <p>/<br> tags.
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * Honeypot: a hidden "website" field humans never fill in.
 *
 * @param bool                 $spam       Current spam verdict.
 * @param WPCF7_Submission|null $submission Submission.
 * @return bool
 */
function mb_cf7_honeypot( $spam, $submission = null ) {
	if ( $spam ) {
		return $spam;
	}
	// phpcs:ignore WordPress.Security.NonceVerification.Missing -- CF7 verifies its own request; we only read a trap field.
	if ( ! empty( $_POST['mb_website'] ) ) {
		return true;
	}
	return $spam;
}
add_filter( 'wpcf7_spam', 'mb_cf7_honeypot', 10, 2 );

/**
 * Send messages to the address set in Salon Settings (falls back to the admin email).
 *
 * @param array             $components Mail components.
 * @param WPCF7_ContactForm $form       Form.
 * @return array
 */
function mb_cf7_recipient( $components, $form ) {
	if ( mb_is_salon_form( $form ) ) {
		$to = sanitize_email( (string) mb_get_setting( 'notify_email' ) );
		$components['recipient'] = $to ? $to : get_option( 'admin_email' );
	}
	return $components;
}
add_filter( 'wpcf7_mail_components', 'mb_cf7_recipient', 10, 2 );

/**
 * Friendly, field-specific validation messages (same wording as the design).
 *
 * @param WPCF7_Validation $result Validation result.
 * @param WPCF7_FormTag[]  $tags   Form tags.
 * @return WPCF7_Validation
 */
function mb_cf7_validate( $result, $tags ) {
	$form = function_exists( 'wpcf7_get_current_contact_form' ) ? wpcf7_get_current_contact_form() : null;
	if ( ! $form || ! mb_is_salon_form( $form ) ) {
		return $result;
	}
	$tag_map = array();
	foreach ( $tags as $tag ) {
		$tag_map[ $tag->name ] = $tag;
	}
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- CF7 verifies the request before running validation.
	$name    = isset( $_POST['your-name'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['your-name'] ) ) ) : '';
	$email   = isset( $_POST['your-email'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['your-email'] ) ) ) : '';
	$message = isset( $_POST['your-message'] ) ? trim( sanitize_textarea_field( wp_unslash( $_POST['your-message'] ) ) ) : '';
	// phpcs:enable

	if ( isset( $tag_map['your-name'] ) && strlen( $name ) < 2 ) {
		$result->invalidate( $tag_map['your-name'], __( 'Please enter your name.', 'maison-belle-core' ) );
	}
	if ( isset( $tag_map['your-email'] ) && ! is_email( $email ) ) {
		$result->invalidate( $tag_map['your-email'], __( 'Please enter a valid email address.', 'maison-belle-core' ) );
	}
	if ( isset( $tag_map['your-message'] ) && strlen( $message ) < 10 ) {
		$result->invalidate( $tag_map['your-message'], __( 'Tell us a little more (at least 10 characters).', 'maison-belle-core' ) );
	}
	return $result;
}
add_filter( 'wpcf7_validate', 'mb_cf7_validate', 20, 2 );

/**
 * The form markup (CF7 template language). Classes match the theme's CSS.
 *
 * @return string
 */
function mb_cf7_form_template() {
	return <<<'HTML'
<div class="mb-form__grid">
<div class="mb-field">
<label for="cf-name" class="mb-label">Name</label>
[text your-name id:cf-name class:mb-input autocomplete:name placeholder "Your full name"]
</div>
<div class="mb-field">
<label for="cf-email" class="mb-label">Email</label>
[email your-email id:cf-email class:mb-input autocomplete:email placeholder "you@example.com"]
</div>
<div class="mb-field">
<label for="cf-phone" class="mb-label">Phone <span class="mb-label__opt">(optional)</span></label>
[tel your-phone id:cf-phone class:mb-input autocomplete:tel placeholder "(555) 000-0000"]
</div>
<div class="mb-field">
<label for="cf-service" class="mb-label">Interested in</label>
[select your-service id:cf-service class:mb-input first_as_placeholder "Select a service" "Manicure" "Pedicure" "Waxing" "Eyelashes" "Something else"]
</div>
<div class="mb-field mb-field--full">
<label for="cf-message" class="mb-label">Message</label>
[textarea your-message id:cf-message class:mb-input rows:5 placeholder "How can we help?"]
</div>
</div>
<div class="mb-form__trap" aria-hidden="true"><label>Leave this field empty<input type="text" name="mb_website" tabindex="-1" autocomplete="off"></label></div>
<div class="mb-form__foot">
<p class="mb-form__note">We usually reply within one business day.</p>
<button type="submit" class="btn btn-primary mb-form__submit">Send message</button>
</div>
HTML;
}

/**
 * Mail body (sent to the salon).
 *
 * @return string
 */
function mb_cf7_mail_body() {
	return "From: [your-name] <[your-email]>\nPhone: [your-phone]\nInterested in: [your-service]\n\nMessage:\n[your-message]\n\n-- \nSent from the contact form at [_site_url]";
}

/**
 * CF7 messages: keep them short, calm and in the design's voice.
 *
 * @return array<string,string>
 */
function mb_cf7_messages() {
	return array(
		'mail_sent_ok'             => 'Thank you. Your message has been received.',
		'mail_sent_ng'             => 'Sorry, your message could not be sent. Please call us instead.',
		'validation_error'         => 'Please check the highlighted fields and try again.',
		'spam'                     => 'Sorry, your message could not be sent. Please call us instead.',
		'accept_terms'             => 'Please accept the terms to continue.',
		'invalid_required'         => 'This field is required.',
		'invalid_too_long'         => 'This entry is too long.',
		'invalid_too_short'        => 'This entry is too short.',
		'invalid_email'            => 'Please enter a valid email address.',
		'invalid_tel'              => 'Please enter a valid phone number.',
	);
}
