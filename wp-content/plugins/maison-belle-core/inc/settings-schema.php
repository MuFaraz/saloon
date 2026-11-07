<?php
/**
 * Salon Settings schema: every editable value, its default (the demo content) and its type.
 *
 * Adding a new setting = adding one entry here. The admin page, sanitising and
 * defaults are all generated from this array.
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Icons available for service categories, reasons, promotions, placeholders.
 *
 * @return array<string,string>
 */
function mb_icon_choices() {
	return array(
		'bottle'  => __( 'Polish bottle', 'maison-belle-core' ),
		'hand'    => __( 'Hand', 'maison-belle-core' ),
		'foot'    => __( 'Foot', 'maison-belle-core' ),
		'lash'    => __( 'Eye / lash', 'maison-belle-core' ),
		'wax'     => __( 'Leaf (waxing)', 'maison-belle-core' ),
		'sparkle' => __( 'Sparkle', 'maison-belle-core' ),
		'flower'  => __( 'Flower', 'maison-belle-core' ),
		'gem'     => __( 'Gem', 'maison-belle-core' ),
	);
}

/**
 * Colour tones used by the placeholder images.
 *
 * @return array<string,string>
 */
function mb_tone_choices() {
	return array(
		'blush' => __( 'Blush', 'maison-belle-core' ),
		'rose'  => __( 'Rose', 'maison-belle-core' ),
		'gold'  => __( 'Gold', 'maison-belle-core' ),
		'ivory' => __( 'Ivory', 'maison-belle-core' ),
		'mauve' => __( 'Mauve', 'maison-belle-core' ),
	);
}

/**
 * Full settings schema, grouped by admin tab.
 *
 * Field keys: type (text|textarea|url|email|number|media|select|lines|hours|repeater),
 * label, default, help, options (select), columns + rows (repeater).
 *
 * @return array<string,array>
 */
function mb_settings_schema() {
	$icons = mb_icon_choices();

	$reason_cols = array(
		'icon'  => array( 'type' => 'select', 'label' => __( 'Icon', 'maison-belle-core' ), 'options' => $icons ),
		'title' => array( 'type' => 'text', 'label' => __( 'Title', 'maison-belle-core' ) ),
		'text'  => array( 'type' => 'textarea', 'label' => __( 'Text', 'maison-belle-core' ) ),
	);

	return array(
		'general'   => array(
			'label'  => __( 'General', 'maison-belle-core' ),
			'fields' => array(
				'salon_name'     => array( 'type' => 'text', 'label' => __( 'Salon name', 'maison-belle-core' ), 'default' => 'Maison Belle Nails & Spa', 'help' => __( 'Full legal / display name. Used in titles, schema and the footer copyright.', 'maison-belle-core' ) ),
				'wordmark_main'  => array( 'type' => 'text', 'label' => __( 'Wordmark: main word(s)', 'maison-belle-core' ), 'default' => 'Maison Belle', 'help' => __( 'Big text used when no logo image is uploaded.', 'maison-belle-core' ) ),
				'wordmark_sub'   => array( 'type' => 'text', 'label' => __( 'Wordmark: small line', 'maison-belle-core' ), 'default' => 'Nails & Spa' ),
				'logo'           => array( 'type' => 'media', 'label' => __( 'Logo (optional)', 'maison-belle-core' ), 'default' => 0, 'help' => __( 'Leave empty to show the text wordmark. A wide PNG/SVG with transparent background works best.', 'maison-belle-core' ) ),
				'tagline'        => array( 'type' => 'text', 'label' => __( 'Tagline', 'maison-belle-core' ), 'default' => 'Where every detail shines.' ),
				'description'    => array( 'type' => 'textarea', 'label' => __( 'Short description', 'maison-belle-core' ), 'default' => 'Maison Belle Nails & Spa is a boutique nail salon in Houston offering refined manicures, pedicures, waxing and eyelash services in a calm, beautifully clean space.', 'help' => __( 'Used for search engines and structured data.', 'maison-belle-core' ) ),
				'announcement'   => array( 'type' => 'text', 'label' => __( 'Announcement bar text', 'maison-belle-core' ), 'default' => 'Walk-ins welcome · Open daily', 'help' => __( 'Shown above the header and under the hero buttons. Leave empty to hide the bar.', 'maison-belle-core' ) ),
				'marquee_words'  => array( 'type' => 'lines', 'label' => __( 'Scrolling banner words', 'maison-belle-core' ), 'default' => "Manicure\nPedicure\nGel Extensions\nWaxing\nLash Extensions\nNail Art\nSpa Rituals\nLash Lift", 'help' => __( 'One per line.', 'maison-belle-core' ) ),
			),
		),
		'contact'   => array(
			'label'  => __( 'Contact, hours & booking', 'maison-belle-core' ),
			'fields' => array(
				'street'         => array( 'type' => 'text', 'label' => __( 'Street address', 'maison-belle-core' ), 'default' => '123 Main Street' ),
				'city'           => array( 'type' => 'text', 'label' => __( 'City', 'maison-belle-core' ), 'default' => 'Houston' ),
				'region'         => array( 'type' => 'text', 'label' => __( 'State / region', 'maison-belle-core' ), 'default' => 'TX' ),
				'postal'         => array( 'type' => 'text', 'label' => __( 'Postal code', 'maison-belle-core' ), 'default' => '77001' ),
				'country'        => array( 'type' => 'text', 'label' => __( 'Country code', 'maison-belle-core' ), 'default' => 'US', 'help' => __( 'Two letters, e.g. US, CA, GB.', 'maison-belle-core' ) ),
				'phone'          => array( 'type' => 'text', 'label' => __( 'Phone (as shown)', 'maison-belle-core' ), 'default' => '(555) 123-4567' ),
				'phone_tel'      => array( 'type' => 'text', 'label' => __( 'Phone (dial format)', 'maison-belle-core' ), 'default' => '+15551234567', 'help' => __( 'Used for click-to-call. Leave empty to build it from the number above.', 'maison-belle-core' ) ),
				'email'          => array( 'type' => 'email', 'label' => __( 'Public email', 'maison-belle-core' ), 'default' => 'hello@example.com' ),
				'notify_email'   => array( 'type' => 'email', 'label' => __( 'Send contact form messages to', 'maison-belle-core' ), 'default' => '', 'help' => __( 'Leave empty to use the WordPress administration email (Settings → General).', 'maison-belle-core' ) ),
				'booking_url'    => array( 'type' => 'url', 'label' => __( 'Booking page URL', 'maison-belle-core' ), 'default' => '#', 'help' => __( 'Your online booking platform. Opens in a new tab from every Book Now button.', 'maison-belle-core' ) ),
				'book_label'     => array( 'type' => 'text', 'label' => __( 'Book button label', 'maison-belle-core' ), 'default' => 'Book Now' ),
				'map_query'      => array( 'type' => 'text', 'label' => __( 'Map address / search', 'maison-belle-core' ), 'default' => '123 Main Street, Houston, TX 77001', 'help' => __( 'Used for the Google Map and the Get directions link. Or paste a full Google Maps embed URL.', 'maison-belle-core' ) ),
				'lat'            => array( 'type' => 'text', 'label' => __( 'Latitude (SEO)', 'maison-belle-core' ), 'default' => '29.7604' ),
				'lng'            => array( 'type' => 'text', 'label' => __( 'Longitude (SEO)', 'maison-belle-core' ), 'default' => '-95.3698' ),
				'price_range'    => array( 'type' => 'text', 'label' => __( 'Price range (SEO)', 'maison-belle-core' ), 'default' => '$$' ),
				'currency'       => array( 'type' => 'text', 'label' => __( 'Currency symbol', 'maison-belle-core' ), 'default' => '$' ),
				'currency_code'  => array( 'type' => 'text', 'label' => __( 'Currency code (SEO)', 'maison-belle-core' ), 'default' => 'USD' ),
				'contact_form_id' => array( 'type' => 'number', 'label' => __( 'Contact Form 7 form ID', 'maison-belle-core' ), 'default' => 0, 'help' => __( 'The form shown on the Contact page. Filled in automatically when demo content is installed.', 'maison-belle-core' ) ),
				'hours'          => array(
					'type'    => 'hours',
					'label'   => __( 'Opening hours', 'maison-belle-core' ),
					'rows'    => 3,
					'default' => array(
						array( 'label' => 'Mon – Sat', 'time' => '10am – 7pm', 'days' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ), 'opens' => '10:00', 'closes' => '19:00' ),
						array( 'label' => 'Sunday', 'time' => '11am – 5pm', 'days' => array( 'Sunday' ), 'opens' => '11:00', 'closes' => '17:00' ),
					),
					'help'    => __( '"Label" and "Hours as shown" are what visitors read. Days and 24-hour times feed Google (leave a row empty to hide it).', 'maison-belle-core' ),
				),
			),
		),
		'social'    => array(
			'label'  => __( 'Social links', 'maison-belle-core' ),
			'fields' => array(
				'social_instagram' => array( 'type' => 'url', 'label' => 'Instagram', 'default' => '#' ),
				'social_facebook'  => array( 'type' => 'url', 'label' => 'Facebook', 'default' => '#' ),
				'social_google'    => array( 'type' => 'url', 'label' => 'Google', 'default' => '#', 'help' => __( 'Your Google Business Profile / reviews link.', 'maison-belle-core' ) ),
				'social_yelp'      => array( 'type' => 'url', 'label' => 'Yelp', 'default' => '#' ),
			),
		),
		'home'      => array(
			'label'  => __( 'Home page', 'maison-belle-core' ),
			'fields' => array(
				'hero_eyebrow'    => array( 'type' => 'text', 'label' => __( 'Hero: small line', 'maison-belle-core' ), 'default' => 'Nail salon & spa · Houston' ),
				'hero_line1'      => array( 'type' => 'text', 'label' => __( 'Hero heading: line 1', 'maison-belle-core' ), 'default' => 'Where every', 'help' => __( 'Wrap a word in *asterisks* to make it italic and coloured.', 'maison-belle-core' ) ),
				'hero_line2'      => array( 'type' => 'text', 'label' => __( 'Hero heading: line 2', 'maison-belle-core' ), 'default' => 'detail *shines.*' ),
				'hero_text'       => array( 'type' => 'textarea', 'label' => __( 'Hero subheading', 'maison-belle-core' ), 'default' => 'An unhurried, beautifully clean sanctuary for manicures, pedicures, waxing and lashes, where craft meets calm.' ),
				'hero_cta_book'   => array( 'type' => 'text', 'label' => __( 'Hero button 1 (booking)', 'maison-belle-core' ), 'default' => 'Book an appointment' ),
				'hero_cta_view'   => array( 'type' => 'text', 'label' => __( 'Hero button 2 (services)', 'maison-belle-core' ), 'default' => 'View services' ),
				'hero_image_main'   => array( 'type' => 'media', 'label' => __( 'Hero image: large arch', 'maison-belle-core' ), 'default' => 0, 'help' => __( 'Portrait photo, about 900 × 1200 px.', 'maison-belle-core' ) ),
				'hero_image_accent' => array( 'type' => 'media', 'label' => __( 'Hero image: small circle', 'maison-belle-core' ), 'default' => 0, 'help' => __( 'Square photo, about 600 × 600 px.', 'maison-belle-core' ) ),
				'rating_value'    => array( 'type' => 'text', 'label' => __( 'Rating value', 'maison-belle-core' ), 'default' => '4.9' ),
				'rating_count'    => array( 'type' => 'text', 'label' => __( 'Number of reviews', 'maison-belle-core' ), 'default' => '500+' ),
				'rating_label'    => array( 'type' => 'text', 'label' => __( 'Small label under rating', 'maison-belle-core' ), 'default' => 'Placeholder rating', 'help' => __( 'Remove the word "placeholder" once you enter real figures.', 'maison-belle-core' ) ),
				'rating_note'     => array( 'type' => 'text', 'label' => __( 'Note beside Reviews heading', 'maison-belle-core' ), 'default' => '(placeholder figures)' ),
				'strip'           => array(
					'type'    => 'repeater',
					'label'   => __( 'Three highlights under the hero', 'maison-belle-core' ),
					'rows'    => 3,
					'columns' => $reason_cols,
					'default' => array(
						array( 'icon' => 'hand', 'title' => 'Walk-ins welcome', 'text' => 'Drop by any day and we will do our best to seat you right away.' ),
						array( 'icon' => 'sparkle', 'title' => 'Appointments preferred', 'text' => 'Reserve online to guarantee your time, especially on weekends.' ),
						array( 'icon' => 'flower', 'title' => 'Open daily', 'text' => 'Mon–Sat 10am–7pm · Sun 11am–5pm. Tea on arrival.' ),
					),
				),
				'about_eyebrow'   => array( 'type' => 'text', 'label' => __( 'About: small line', 'maison-belle-core' ), 'default' => 'Our story' ),
				'about_title'     => array( 'type' => 'text', 'label' => __( 'About: heading', 'maison-belle-core' ), 'default' => 'A quieter kind of *luxury*' ),
				'about_p1'        => array( 'type' => 'textarea', 'label' => __( 'About: intro paragraph', 'maison-belle-core' ), 'default' => 'Maison Belle Nails & Spa was imagined as a place to slow down. Soft light, thoughtful details and a team who treats every nail as a small work of art.' ),
				'about_p2'        => array( 'type' => 'textarea', 'label' => __( 'About: second paragraph', 'maison-belle-core' ), 'default' => 'We pair meticulous technique with premium products and a spotless, serene space, so you leave not only with beautiful nails, but with the feeling of having been truly looked after.' ),
				'about_list'      => array( 'type' => 'lines', 'label' => __( 'About: tick list', 'maison-belle-core' ), 'default' => "Hospital-grade sanitation, every guest, every time\nPremium, long-wear and gentle formulas\nTea, quiet music and zero rush", 'help' => __( 'One per line.', 'maison-belle-core' ) ),
				'about_link'      => array( 'type' => 'text', 'label' => __( 'About: link label', 'maison-belle-core' ), 'default' => 'Explore services' ),
				'about_image_main'   => array( 'type' => 'media', 'label' => __( 'About image: large arch', 'maison-belle-core' ), 'default' => 0, 'help' => __( 'Portrait photo, about 900 × 1200 px.', 'maison-belle-core' ) ),
				'about_image_accent' => array( 'type' => 'media', 'label' => __( 'About image: small square', 'maison-belle-core' ), 'default' => 0 ),
				'services_eyebrow' => array( 'type' => 'text', 'label' => __( 'Services: small line', 'maison-belle-core' ), 'default' => 'Our services' ),
				'services_title'  => array( 'type' => 'text', 'label' => __( 'Services: heading', 'maison-belle-core' ), 'default' => 'Crafted *care*, from fingertip to toe' ),
				'services_intro'  => array( 'type' => 'textarea', 'label' => __( 'Services: intro', 'maison-belle-core' ), 'default' => 'Four signature collections, each delivered with patience, precision and a little ceremony.' ),
				'why_eyebrow'     => array( 'type' => 'text', 'label' => __( 'Why us: small line', 'maison-belle-core' ), 'default' => 'Why Maison Belle' ),
				'why_title'       => array( 'type' => 'text', 'label' => __( 'Why us: heading', 'maison-belle-core' ), 'default' => 'The little things, *done beautifully*' ),
				'reasons'         => array(
					'type'    => 'repeater',
					'label'   => __( 'Why choose us: four items', 'maison-belle-core' ),
					'rows'    => 4,
					'columns' => $reason_cols,
					'default' => array(
						array( 'icon' => 'sparkle', 'title' => 'Spotless by design', 'text' => 'Hospital-grade sterilisation and single-use files, buffers and liners for every guest.' ),
						array( 'icon' => 'gem', 'title' => 'Premium products', 'text' => 'Long-wear, gentle formulas chosen for quality, colour depth and nail health.' ),
						array( 'icon' => 'hand', 'title' => 'Skilled artists', 'text' => 'A team trained in precision, patient with detail and fluent in every shape.' ),
						array( 'icon' => 'flower', 'title' => 'An unhurried ritual', 'text' => 'Soft lighting, quiet music and tea on arrival. Your time here is yours.' ),
					),
				),
				'reviews_eyebrow' => array( 'type' => 'text', 'label' => __( 'Reviews: small line', 'maison-belle-core' ), 'default' => 'Kind words' ),
				'reviews_title'   => array( 'type' => 'text', 'label' => __( 'Reviews: heading', 'maison-belle-core' ), 'default' => 'Loved by our *guests*' ),
				'gallery_eyebrow' => array( 'type' => 'text', 'label' => __( 'Gallery preview: small line', 'maison-belle-core' ), 'default' => 'Gallery' ),
				'gallery_title'   => array( 'type' => 'text', 'label' => __( 'Gallery preview: heading', 'maison-belle-core' ), 'default' => 'A glimpse of our *work*' ),
				'gallery_intro'   => array( 'type' => 'textarea', 'label' => __( 'Gallery preview: intro', 'maison-belle-core' ), 'default' => 'Soft nudes, glossy classics and delicate nail art. Placeholder imagery shown here.' ),
				'visit_eyebrow'   => array( 'type' => 'text', 'label' => __( 'Visit us: small line', 'maison-belle-core' ), 'default' => 'Visit us' ),
				'visit_title'     => array( 'type' => 'text', 'label' => __( 'Visit us: heading', 'maison-belle-core' ), 'default' => 'Come in, *unwind*' ),
			),
		),
		'footer'    => array(
			'label'  => __( 'Footer & final call-to-action', 'maison-belle-core' ),
			'fields' => array(
				'cta_eyebrow'     => array( 'type' => 'text', 'label' => __( 'CTA banner: small line', 'maison-belle-core' ), 'default' => 'Book your visit' ),
				'cta_title'       => array( 'type' => 'text', 'label' => __( 'CTA banner: heading', 'maison-belle-core' ), 'default' => 'Your moment of *calm* awaits.' ),
				'cta_text'        => array( 'type' => 'textarea', 'label' => __( 'CTA banner: text', 'maison-belle-core' ), 'default' => 'Walk in or reserve your time. Either way, we will take beautiful care of you.' ),
				'footer_blurb'    => array( 'type' => 'textarea', 'label' => __( 'Footer: description', 'maison-belle-core' ), 'default' => 'A boutique nail salon & spa devoted to quiet luxury, flawless detail and a calmer pace.' ),
				'footer_hours_note' => array( 'type' => 'text', 'label' => __( 'Footer: note under hours', 'maison-belle-core' ), 'default' => 'Walk-ins welcome. Appointments recommended on weekends.' ),
				'footer_credit'   => array( 'type' => 'text', 'label' => __( 'Footer: middle line', 'maison-belle-core' ), 'default' => 'Demo design preview · All content, prices and reviews are placeholders.', 'help' => __( 'Remove or replace this line before launch.', 'maison-belle-core' ) ),
				'footer_policy'   => array( 'type' => 'text', 'label' => __( 'Footer: policy link label', 'maison-belle-core' ), 'default' => 'Booking & cancellation policy' ),
			),
		),
	);
}

/**
 * Flat list of all fields: key => field definition (with its tab).
 *
 * @return array<string,array>
 */
function mb_settings_fields() {
	static $flat = null;
	if ( null === $flat ) {
		$flat = array();
		foreach ( mb_settings_schema() as $tab => $def ) {
			foreach ( $def['fields'] as $key => $field ) {
				$field['tab'] = $tab;
				$flat[ $key ] = $field;
			}
		}
	}
	return $flat;
}

/**
 * Default values for every setting.
 *
 * @return array<string,mixed>
 */
function mb_settings_defaults() {
	$out = array();
	foreach ( mb_settings_fields() as $key => $field ) {
		$out[ $key ] = isset( $field['default'] ) ? $field['default'] : '';
	}
	return $out;
}
