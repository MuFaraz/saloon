<?php
/**
 * Demo content seeder (idempotent).
 *
 * Creates pages, menus, services, gallery items, reviews, promotions, blog posts,
 * the contact form and default Salon Settings. Every item carries a `_mb_seed_key`
 * meta value, so running it again only creates what is missing and never overwrites
 * edits made by the client.
 *
 * Run it from: Salon Settings → General → "Install / repair demo content",
 * or with WP-CLI:  wp mb seed
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Find a post of any type by its seed key.
 *
 * @param string $key Seed key.
 * @return int Post ID or 0.
 */
function mb_seed_find( $key ) {
	$found = get_posts(
		array(
			'post_type'      => array_values( get_post_types() ), // "any" would skip types hidden from search (e.g. Contact Form 7 forms).
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => '_mb_seed_key', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => $key, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
		)
	);
	return $found ? (int) $found[0] : 0;
}

/**
 * Create a post unless its seed key already exists.
 *
 * @param string $key  Seed key.
 * @param array  $post wp_insert_post args.
 * @param array  $meta Meta values.
 * @return int Post ID.
 */
function mb_seed_post( $key, $post, $meta = array() ) {
	$existing = mb_seed_find( $key );
	if ( $existing ) {
		return $existing;
	}
	$post    = array_merge( array( 'post_status' => 'publish' ), $post );
	$post_id = wp_insert_post( wp_slash( $post ), true );
	if ( is_wp_error( $post_id ) ) {
		return 0;
	}
	update_post_meta( $post_id, '_mb_seed_key', $key );
	foreach ( $meta as $meta_key => $meta_value ) {
		update_post_meta( $post_id, $meta_key, $meta_value );
	}
	return (int) $post_id;
}

/**
 * Get or create a term.
 *
 * @param string $name     Term name.
 * @param string $taxonomy Taxonomy.
 * @return int Term ID.
 */
function mb_seed_term( $name, $taxonomy ) {
	$term = term_exists( $name, $taxonomy );
	if ( ! $term ) {
		$term = wp_insert_term( $name, $taxonomy );
	}
	return is_wp_error( $term ) ? 0 : (int) ( is_array( $term ) ? $term['term_id'] : $term );
}

/**
 * Demo data (mirrors the approved design).
 *
 * @return array
 */
function mb_seed_data() {
	return array(
		'services' => array(
			'Manicure' => array(
				'short' => 'Sculpted, polished, perfected.',
				'blurb' => 'From a clean classic polish to a bespoke gel finish, every manicure begins with a gentle cuticle ritual and ends with a flawless, long-wearing shine.',
				'icon'  => 'bottle', 'tone' => 'blush', 'alt' => 'Soft pink manicure with a glossy finish',
				'items' => array(
					array( 'Classic Manicure', 28, '30 min', 'Shape, cuticle care, hand massage and polish.' ),
					array( 'Gel Manicure', 40, '45 min', 'Chip-resistant colour with a mirror-like gloss.' ),
					array( 'Signature Spa Manicure', 52, '60 min', 'Exfoliating scrub, warm mask and extended massage.' ),
					array( 'Dip Powder Set', 55, '60 min', 'Lightweight, durable colour with natural strength.' ),
					array( 'Gel Extensions', 70, '90 min', 'Sculpted length in your chosen shape and finish.' ),
					array( 'Nail Art (per nail)', 5, '', 'Hand-painted details, chrome, French and more.' ),
				),
			),
			'Pedicure' => array(
				'short' => 'Slow, restorative, indulgent.',
				'blurb' => 'Sink into a warm soak and let the stress melt away. Our pedicures pair meticulous care with a deeply relaxing massage.',
				'icon'  => 'foot', 'tone' => 'mauve', 'alt' => 'Relaxing spa pedicure with warm towels',
				'items' => array(
					array( 'Classic Pedicure', 40, '45 min', 'Soak, shape, callus care and polish.' ),
					array( 'Gel Pedicure', 52, '60 min', 'Our classic pedicure finished in long-wear gel.' ),
					array( 'Signature Spa Pedicure', 68, '75 min', 'Sugar scrub, mineral mask, hot towels and massage.' ),
					array( 'Luxury Rose Pedicure', 82, '90 min', 'Rose-infused ritual with paraffin treatment.' ),
					array( 'Kids’ Pedicure', 28, '30 min', 'A gentle treat for guests under 12.' ),
					array( 'Polish Change', 15, '15 min', 'Fresh colour on hands or feet.' ),
				),
			),
			'Waxing' => array(
				'short' => 'Smooth, quick, comfortable.',
				'blurb' => 'Gentle, skin-friendly wax applied by trained hands, with a fresh spatula every time and a calm, private setting.',
				'icon'  => 'wax', 'tone' => 'ivory', 'alt' => 'Calm waxing room with soft linens',
				'items' => array(
					array( 'Eyebrow Shaping', 15, '15 min', '' ),
					array( 'Upper Lip', 8, '10 min', '' ),
					array( 'Chin', 10, '10 min', '' ),
					array( 'Underarms', 20, '15 min', '' ),
					array( 'Half Leg', 35, '30 min', '' ),
					array( 'Full Leg', 58, '45 min', '' ),
				),
			),
			'Eyelashes' => array(
				'short' => 'Soft, defined, effortless.',
				'blurb' => 'Lightweight lash extensions and lifts designed around your eye shape, for a look that is polished from the moment you wake up.',
				'icon'  => 'lash', 'tone' => 'gold', 'alt' => 'Close-up of fluttering natural-look lashes',
				'items' => array(
					array( 'Classic Full Set', 95, '2 hrs', 'One extension per natural lash for a refined look.' ),
					array( 'Hybrid Full Set', 115, '2 hrs', 'A blend of classic and volume for texture.' ),
					array( 'Volume Full Set', 135, '2.5 hrs', 'Fuller, fluffier fans with soft drama.' ),
					array( 'Classic Fill (2–3 wks)', 55, '1 hr', '' ),
					array( 'Lash Lift & Tint', 70, '1 hr', 'Curl and colour for your own lashes.' ),
					array( 'Lash Removal', 20, '20 min', '' ),
				),
			),
		),
		'gallery'  => array(
			array( 'Nails', 'tall', 'Nude gel manicure with a glossy finish', 'blush', 'bottle' ),
			array( 'Pedicure', 'square', 'Rose-toned spa pedicure', 'mauve', 'foot' ),
			array( 'Lashes', 'portrait', 'Soft hybrid lash set', 'gold', 'lash' ),
			array( 'Nails', 'square', 'Chrome champagne nail art', 'gold', 'sparkle' ),
			array( 'Nails', 'portrait', 'Classic French tip manicure', 'ivory', 'gem' ),
			array( 'Pedicure', 'tall', 'Deep rosewood gel pedicure', 'rose', 'foot' ),
			array( 'Lashes', 'square', 'Natural classic lash extensions', 'blush', 'lash' ),
			array( 'Nails', 'wide', 'Pearl and blush ombré set', 'mauve', 'gem' ),
			array( 'Pedicure', 'portrait', 'Pale pink pedicure with minimal florals', 'blush', 'flower' ),
			array( 'Nails', 'tall', 'Almond-shaped sculpted extensions', 'ivory', 'bottle' ),
			array( 'Lashes', 'portrait', 'Volume lash set with a gentle curl', 'rose', 'lash' ),
			array( 'Pedicure', 'square', 'Glossy red gel pedicure', 'rose', 'sparkle' ),
		),
		'reviews'  => array(
			array( 'Sample Client A.', 'Gel Manicure', 'Placeholder review: the most serene salon I have visited. The attention to detail was extraordinary and my nails stayed perfect for weeks.' ),
			array( 'Sample Client B.', 'Spa Pedicure', 'Placeholder review: an hour of complete calm. The massage, the warm towels, the polish – every moment felt considered.' ),
			array( 'Sample Client C.', 'Lash Set', 'Placeholder review: my lashes look natural yet defined. I have never felt so looked after in a salon chair.' ),
			array( 'Sample Client D.', 'Mani + Pedi', 'Placeholder review: spotless, welcoming and genuinely skilled. This has become my monthly ritual.' ),
			array( 'Sample Client E.', 'Nail Art', 'Placeholder review: I brought a tiny inspiration photo and left with something even prettier. Truly artists.' ),
		),
		'promos'   => array(
			array( 'First Visit Offer', 'New guests', '15% off', 'Treat yourself to your first Maison Belle experience with 15% off any service. Mention this offer when you book.', 'Placeholder offer. New clients only. Not combinable with other offers.', 'sparkle' ),
			array( 'Mani + Pedi Combo', 'Best value', 'Save $15', 'Pair any gel manicure with a spa pedicure and enjoy a complimentary paraffin upgrade for your hands.', 'Placeholder offer. Valid Monday to Thursday.', 'bottle' ),
			array( 'Refer a Friend', 'Share the glow', '$10 credit', 'Introduce a friend and you will both receive $10 towards your next visit once their first appointment is complete.', 'Placeholder offer. One credit per referral.', 'flower' ),
		),
		'posts'    => array(
			array(
				'slug' => 'the-art-of-a-lasting-manicure', 'title' => 'The Art of a Manicure That Lasts', 'date' => '2026-09-12 12:00:00', 'cat' => 'Nail Care', 'tone' => 'blush', 'icon' => 'bottle',
				'excerpt' => 'Salon-fresh nails for three weeks and beyond: what happens in the chair, and the small habits that make the difference at home.',
				'body' => array(
					array( 'p', 'A manicure that stays flawless is rarely luck. It is preparation, patience and a few quiet habits, and most of them begin long before the polish touches the nail.' ),
					array( 'h2', 'It begins with preparation' ),
					array( 'p', 'Every lasting finish starts with a clean, dry, gently buffed nail plate. Cuticles are softened and eased back, never cut aggressively, so the colour can sit close to the skin without lifting. Skipping this step is the most common reason polish chips early.' ),
					array( 'quote', 'Beautiful nails are built in the first ten minutes, not the last.' ),
					array( 'h2', 'Choose the right finish for your life' ),
					array( 'p', 'Gel suits busy weeks and travel. Dip powder adds strength to nails that tend to bend. Classic polish is perfect when you love changing colour often. A good technician will help you choose based on your routine rather than a trend.' ),
					array( 'h2', 'Small habits at home' ),
					array( 'list', array( 'Apply cuticle oil every evening. It keeps the skin supple and the finish glossy.', 'Wear gloves for washing up and cleaning products.', 'Use your fingertips, not your nails, to open cans and packaging.', 'Book your next visit before the edges begin to grow out.' ) ),
					array( 'p', 'Treat your hands with a little daily care and your manicure will reward you with weeks of quiet polish.' ),
				),
			),
			array(
				'slug' => 'why-a-spa-pedicure-is-worth-the-pause', 'title' => 'Why a Spa Pedicure Is Worth the Pause', 'date' => '2026-08-03 12:00:00', 'cat' => 'Spa Rituals', 'tone' => 'mauve', 'icon' => 'flower',
				'excerpt' => 'More than polish: a spa pedicure is circulation, softness and a rare hour of stillness. Here is what to expect from your first one.',
				'body' => array(
					array( 'p', 'Our feet carry us through every day, and they rarely get a moment of thanks. A spa pedicure is part grooming, part restoration, and entirely a pause you have earned.' ),
					array( 'h2', 'What happens during your visit' ),
					array( 'p', 'You begin with a warm, lightly scented soak that softens skin and eases tension. Nails are shaped, cuticles tended, and rough areas smoothed with care. A sugar scrub and mineral mask follow, then hot towels and an unhurried massage of the feet and calves.' ),
					array( 'quote', 'The best part is the quiet. For one hour, nothing else needs you.' ),
					array( 'h2', 'How often should you book?' ),
					array( 'p', 'Every four to six weeks keeps feet soft and nails tidy. In sandal season, many guests prefer a shorter interval so polish always looks fresh.' ),
					array( 'h2', 'Before you arrive' ),
					array( 'list', array( 'Skip shaving your legs for 24 hours beforehand to avoid irritation.', 'Wear loose, open footwear so your polish can dry properly.', 'Let us know about any skin sensitivities or medical concerns.' ) ),
				),
			),
			array(
				'slug' => 'choosing-the-right-lash-style', 'title' => 'Choosing the Right Lash Style for Your Eyes', 'date' => '2026-06-21 12:00:00', 'cat' => 'Lashes', 'tone' => 'gold', 'icon' => 'lash',
				'excerpt' => 'Classic, hybrid or volume? A calm guide to finding the lash look that suits your eye shape, lifestyle and maintenance appetite.',
				'body' => array(
					array( 'p', 'Lash extensions should feel like your best natural lashes: lifted, defined and effortless. The right style depends on your eye shape, your own lash health and how much upkeep you enjoy.' ),
					array( 'h2', 'Classic: refined and natural' ),
					array( 'p', 'One extension is applied to each natural lash. The result is a softly defined, polished look, ideal for first-timers and anyone who prefers a minimal finish.' ),
					array( 'h2', 'Hybrid: texture with softness' ),
					array( 'p', 'A mix of classic lashes and handmade fans creates a gently fuller, textured effect that still looks natural from every angle.' ),
					array( 'quote', 'The most beautiful lashes are the ones that look like they belong to you.' ),
					array( 'h2', 'Volume: fuller and fluffier' ),
					array( 'p', 'Lightweight fans create density and soft drama, suited to those who like to wake up with their eyes already defined.' ),
					array( 'list', array( 'Avoid oil-based products around the eyes.', 'Brush your lashes gently each morning with a clean spoolie.', 'Book fills every two to three weeks to keep the set full.' ) ),
				),
			),
		),
		'pages'    => array(
			'home'       => array( 'Home', '', array( '', '', '' ), '%%sitename%% %%sep%% Nail Salon & Spa in Houston', 'Maison Belle Nails & Spa is a boutique nail salon in Houston offering refined manicures, pedicures, waxing and eyelash services in a calm, beautifully clean space.' ),
			'services'   => array( 'Services', 'templates/services.php', array( 'Services & prices', 'The *menu*', 'Transparent pricing for every treatment. All prices are placeholders and may vary by length, design and artist.' ), 'Services & Prices', 'Explore our manicure, pedicure, waxing and eyelash menu with transparent prices. Walk-ins welcome.' ),
			'gallery'    => array( 'Gallery', 'templates/gallery.php', array( 'Gallery', 'Our *work*', 'Filter by category and tap an image to view it larger. Placeholder imagery shown, real photos coming soon.' ), 'Gallery', 'A look at our nail art, pedicures and lash sets. Browse by category and tap any image to enlarge.' ),
			'promotions' => array( 'Promotions', 'templates/promotions.php', array( 'Promotions', 'Little *indulgences*', 'A few thoughtful ways to enjoy a little more for a little less. Offers shown are placeholders.' ), 'Promotions', 'Seasonal offers and thoughtful extras: a first-visit treat, a mani + pedi combo and a refer-a-friend reward.' ),
			'blog'       => array( 'Blog', '', array( 'The journal', 'Notes on *beauty* & care', 'Advice, rituals and small luxuries from our team. Sample articles for the demo.' ), 'Journal', 'Nail care, spa rituals and beauty notes from the team: practical advice for beautiful hands, feet and lashes.' ),
			'contact'    => array( 'Contact', 'templates/contact.php', array( 'Contact', 'Say *hello*', 'Questions, special requests or group bookings? Send a note or simply walk in. We would love to see you.' ), 'Contact & Location', 'Visit us, call or send us a message. Find our address, opening hours and map.' ),
			'policy'     => array( 'Policy', 'templates/policy.php', array( 'Good to know', 'Our *policy*', 'A few gentle guidelines that help us keep every visit calm and on time. This text is a placeholder.' ), 'Booking & Cancellation Policy', 'How booking, cancellations and late arrivals work at our salon. Placeholder policy text.' ),
		),
	);
}

/**
 * Convert simple block descriptions to block-editor markup.
 *
 * @param array[] $blocks Each: [ type, content ].
 * @return string
 */
function mb_seed_blocks( $blocks ) {
	$out = '';
	foreach ( $blocks as $block ) {
		list( $type, $content ) = $block;
		if ( 'p' === $type ) {
			$out .= "<!-- wp:paragraph -->\n<p>" . esc_html( $content ) . "</p>\n<!-- /wp:paragraph -->\n\n";
		} elseif ( 'h2' === $type ) {
			$out .= "<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">" . esc_html( $content ) . "</h2>\n<!-- /wp:heading -->\n\n";
		} elseif ( 'quote' === $type ) {
			$out .= "<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><!-- wp:paragraph -->\n<p>" . esc_html( $content ) . "</p>\n<!-- /wp:paragraph --></blockquote>\n<!-- /wp:quote -->\n\n";
		} elseif ( 'list' === $type ) {
			$out .= "<!-- wp:list -->\n<ul class=\"wp-block-list\">";
			foreach ( $content as $item ) {
				$out .= "<!-- wp:list-item -->\n<li>" . esc_html( $item ) . "</li>\n<!-- /wp:list-item -->";
			}
			$out .= "</ul>\n<!-- /wp:list -->\n\n";
		}
	}
	return trim( $out );
}

/**
 * Run the full seeding routine.
 *
 * @return string[] Log lines.
 */
function mb_seed_demo() {
	$log  = array();
	$data = mb_seed_data();

	// 1. Settings: write defaults only if the client never saved anything.
	if ( false === get_option( 'mb_settings', false ) ) {
		add_option( 'mb_settings', mb_settings_defaults() );
		$log[] = 'Salon Settings filled with demo defaults.';
	}

	// 2. Service categories + services.
	$order = 0;
	foreach ( $data['services'] as $cat_name => $cat ) {
		$order++;
		$term_id = mb_seed_term( $cat_name, 'mb_service_cat' );
		if ( $term_id && '' === get_term_meta( $term_id, 'mb_order', true ) ) {
			update_term_meta( $term_id, 'mb_order', $order );
			update_term_meta( $term_id, 'mb_short', $cat['short'] );
			update_term_meta( $term_id, 'mb_blurb', $cat['blurb'] );
			update_term_meta( $term_id, 'mb_icon', $cat['icon'] );
			update_term_meta( $term_id, 'mb_tone', $cat['tone'] );
			update_term_meta( $term_id, 'mb_alt', $cat['alt'] );
		}
		$menu_order = 0;
		foreach ( $cat['items'] as $item ) {
			$menu_order++;
			$id = mb_seed_post(
				'service-' . sanitize_title( $item[0] ),
				array( 'post_type' => 'mb_service', 'post_title' => $item[0], 'menu_order' => $menu_order ),
				array( 'mb_price' => (string) $item[1], 'mb_duration' => $item[2], 'mb_description' => $item[3] )
			);
			if ( $id && ! has_term( $term_id, 'mb_service_cat', $id ) ) {
				wp_set_object_terms( $id, array( (int) $term_id ), 'mb_service_cat' );
			}
		}
	}
	$log[] = 'Services ready.';

	// 3. Gallery.
	mb_seed_term_list( array( 'Nails', 'Pedicure', 'Lashes' ), 'mb_gallery_cat' ); // Creates the filter order.
	foreach ( $data['gallery'] as $i => $g ) {
		$id = mb_seed_post(
			'gallery-' . ( $i + 1 ),
			array( 'post_type' => 'mb_gallery', 'post_title' => $g[2], 'menu_order' => $i + 1 ),
			array( 'mb_aspect' => $g[1], 'mb_tone' => $g[3], 'mb_icon' => $g[4] )
		);
		if ( $id && ! has_term( '', 'mb_gallery_cat', $id ) ) {
			wp_set_object_terms( $id, array( mb_seed_term( $g[0], 'mb_gallery_cat' ) ), 'mb_gallery_cat' );
		}
	}
	$log[] = 'Gallery ready.';

	// 4. Reviews.
	foreach ( $data['reviews'] as $i => $r ) {
		mb_seed_post(
			'review-' . ( $i + 1 ),
			array( 'post_type' => 'mb_review', 'post_title' => $r[0], 'menu_order' => $i + 1 ),
			array( 'mb_service' => $r[1], 'mb_text' => $r[2], 'mb_rating' => 5 )
		);
	}
	$log[] = 'Reviews ready.';

	// 5. Promotions.
	foreach ( $data['promos'] as $i => $p ) {
		mb_seed_post(
			'promo-' . ( $i + 1 ),
			array( 'post_type' => 'mb_promo', 'post_title' => $p[0], 'menu_order' => $i + 1 ),
			array( 'mb_tag' => $p[1], 'mb_highlight' => $p[2], 'mb_text' => $p[3], 'mb_fine' => $p[4], 'mb_icon' => $p[5], 'mb_cta_label' => 'Book now' )
		);
	}
	$log[] = 'Promotions ready.';

	// 6. Blog posts.
	foreach ( $data['posts'] as $p ) {
		$cat_id = mb_seed_term( $p['cat'], 'category' );
		$id     = mb_seed_post(
			'post-' . $p['slug'],
			array(
				'post_type'     => 'post',
				'post_title'    => $p['title'],
				'post_name'     => $p['slug'],
				'post_excerpt'  => $p['excerpt'],
				'post_content'  => mb_seed_blocks( $p['body'] ),
				'post_date'     => $p['date'],
				'comment_status' => 'closed',
			),
			array( 'mb_tone' => $p['tone'], 'mb_icon' => $p['icon'] )
		);
		// Meta description for search engines (only when still empty).
		if ( $id && ! metadata_exists( 'post', $id, '_yoast_wpseo_metadesc' ) ) {
			update_post_meta( $id, '_yoast_wpseo_metadesc', $p['excerpt'] );
		}
		if ( $id && $cat_id ) {
			wp_set_post_categories( $id, array( $cat_id ) );
		}
	}
	// Remove WordPress's default sample post/page if they are untouched.
	foreach ( array( 'hello-world' => 'post', 'sample-page' => 'page' ) as $slug => $type ) {
		$default = get_page_by_path( $slug, OBJECT, $type );
		if ( $default && ! get_post_meta( $default->ID, '_mb_seed_key', true ) ) {
			wp_delete_post( $default->ID, true );
		}
	}
	$log[] = 'Blog posts ready.';

	// 7. Pages.
	$page_ids = array();
	foreach ( $data['pages'] as $slug => $p ) {
		$content = '';
		if ( 'policy' === $slug ) {
			$content = mb_seed_blocks(
				array(
					array( 'h2', 'Booking' ),
					array( 'p', 'Appointments can be reserved online or by phone. Walk-ins are always welcome and seated in order of arrival, subject to availability.' ),
					array( 'p', 'For groups of four or more, please call ahead so we can prepare a comfortable space for everyone.' ),
					array( 'h2', 'Cancellation' ),
					array( 'p', 'We kindly ask for at least 24 hours’ notice if you need to cancel or reschedule, so that we can offer your time to another guest.' ),
					array( 'p', 'Repeated late cancellations or missed appointments may require a deposit for future bookings.' ),
					array( 'h2', 'Late arrival' ),
					array( 'p', 'We hold your appointment for 15 minutes. After that, your service may need to be shortened or rescheduled so that we can respect the guests who follow.' ),
					array( 'p', 'If you are running behind, a quick call helps us do our best to accommodate you.' ),
				)
			);
		}
		$meta = array(
			'mb_hero_eyebrow' => $p[2][0],
			'mb_hero_title'   => $p[2][1],
			'mb_hero_intro'   => $p[2][2],
		);
		if ( ! empty( $p[1] ) ) {
			$meta['_wp_page_template'] = $p[1];
		}
		if ( ! empty( $p[3] ) ) {
			// A title that already contains Yoast variables is used as is; otherwise "Page | Site name".
			$meta['_yoast_wpseo_title']    = false !== strpos( $p[3], '%%' ) ? $p[3] : $p[3] . ' %%sep%% %%sitename%%';
			$meta['_yoast_wpseo_metadesc'] = $p[4];
		}
		$page_ids[ $slug ] = mb_seed_post(
			'page-' . $slug,
			array( 'post_type' => 'page', 'post_title' => $p[0], 'post_name' => $slug, 'post_content' => $content, 'comment_status' => 'closed' ),
			$meta
		);
		// Back-fill missing meta on pages created by an earlier run (never overwrites edits).
		foreach ( $meta as $meta_key => $meta_value ) {
			if ( $page_ids[ $slug ] && ! metadata_exists( 'post', $page_ids[ $slug ], $meta_key ) ) {
				update_post_meta( $page_ids[ $slug ], $meta_key, $meta_value );
			}
		}
	}
	if ( $page_ids['home'] ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page_ids['home'] );
	}
	if ( $page_ids['blog'] ) {
		update_option( 'page_for_posts', $page_ids['blog'] );
	}
	$log[] = 'Pages ready.';

	// 8. Contact form (Contact Form 7).
	mb_seed_contact_form( $log );

	// 9. Menus.
	mb_seed_menus( $page_ids );
	$log[] = 'Menus ready.';

	// 10. Site options.
	update_option( 'blogname', mb_get_setting( 'salon_name' ) );
	update_option( 'blogdescription', mb_get_setting( 'tagline' ) );
	global $wp_rewrite;
	$wp_rewrite->set_permalink_structure( '/%postname%/' ); // Updates the option and the in-memory rules together.
	update_option( 'default_comment_status', 'closed' );
	mb_seed_seo_options();
	flush_rewrite_rules( false );
	$log[] = 'Permalinks, site title and SEO defaults set.';

	return $log;
}

/**
 * Ensure a list of terms exists.
 *
 * @param string[] $names    Term names.
 * @param string   $taxonomy Taxonomy.
 * @return int[] Term IDs.
 */
function mb_seed_term_list( $names, $taxonomy ) {
	return array_map(
		function ( $name ) use ( $taxonomy ) {
			return mb_seed_term( $name, $taxonomy );
		},
		$names
	);
}

/**
 * Create the Contact Form 7 form and remember its ID in Salon Settings.
 *
 * @param string[] $log Log lines (by reference).
 */
function mb_seed_contact_form( &$log ) {
	if ( ! class_exists( 'WPCF7_ContactForm' ) ) {
		$log[] = 'Contact Form 7 is not active: contact form skipped.';
		return;
	}
	$form_id = mb_seed_find( 'cf7-contact' );
	if ( ! $form_id ) {
		$host   = wp_parse_url( home_url(), PHP_URL_HOST );
		$form   = WPCF7_ContactForm::get_template( array( 'title' => 'Contact form' ) );
		$props  = $form->get_properties();
		$props['form'] = mb_cf7_form_template();
		$props['mail'] = array(
			'active'             => true,
			'subject'            => '[_site_title]: new message from [your-name]',
			'sender'             => '[_site_title] <wordpress@' . $host . '>',
			'recipient'          => get_option( 'admin_email' ),
			'body'               => mb_cf7_mail_body(),
			'additional_headers' => 'Reply-To: [your-email]',
			'attachments'        => '',
			'use_html'           => false,
			'exclude_blank'      => false,
		);
		$props['messages'] = array_merge( $props['messages'], mb_cf7_messages() );
		$form->set_properties( $props );
		$form_id = (int) $form->save();
		if ( $form_id ) {
			update_post_meta( $form_id, '_mb_seed_key', 'cf7-contact' );
		}
	}
	if ( $form_id ) {
		$settings = get_option( 'mb_settings', array() );
		if ( empty( $settings['contact_form_id'] ) ) {
			$settings['contact_form_id'] = $form_id;
			update_option( 'mb_settings', $settings );
		}
		$log[] = 'Contact form ready (ID ' . $form_id . ').';
	}
}

/**
 * Create primary + footer menus and assign them to theme locations.
 *
 * @param int[] $page_ids Page IDs keyed by slug.
 */
function mb_seed_menus( $page_ids ) {
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	$sets      = array(
		'primary' => array( 'Primary menu', array( 'home', 'services', 'gallery', 'promotions', 'blog', 'contact' ) ),
		'footer'  => array( 'Footer menu', array( 'home', 'services', 'gallery', 'promotions', 'blog', 'contact', 'policy' ) ),
	);
	foreach ( $sets as $location => $set ) {
		$menu = wp_get_nav_menu_object( $set[0] );
		if ( $menu ) {
			$menu_id = (int) $menu->term_id;
			if ( wp_get_nav_menu_items( $menu_id ) ) {
				$locations[ $location ] = $menu_id;
				continue; // Already built: leave client edits alone.
			}
		} else {
			$menu_id = (int) wp_create_nav_menu( $set[0] );
		}
		if ( ! $menu_id ) {
			continue;
		}
		foreach ( $set[1] as $slug ) {
			if ( empty( $page_ids[ $slug ] ) ) {
				continue;
			}
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-object-id' => $page_ids[ $slug ],
					'menu-item-object'    => 'page',
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
				)
			);
		}
		$locations[ $location ] = $menu_id;
	}
	set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Sensible Yoast SEO defaults (no-op when Yoast is not installed).
 */
function mb_seed_seo_options() {
	if ( false === get_option( 'wpseo_titles', false ) ) {
		return;
	}
	$titles = get_option( 'wpseo_titles', array() );
	$name   = mb_get_setting( 'salon_name' );
	$titles = array_merge(
		(array) $titles,
		array(
			'separator'             => 'sc-pipe',
			'title-home-wpseo'      => $name . ' %%sep%% Nail Salon & Spa in ' . mb_get_setting( 'city' ),
			'metadesc-home-wpseo'   => mb_get_setting( 'description' ),
			'title-page'            => '%%title%% %%sep%% %%sitename%%',
			'title-post'            => '%%title%% %%sep%% %%sitename%%',
			'company_or_person'     => 'company',
			'company_name'          => $name,
			'website_name'          => $name,
			'noindex-author-wpseo'  => true,
			'disable-author'        => true,
			'disable-date'          => true,
			'disable-attachment'    => true,
		)
	);
	update_option( 'wpseo_titles', $titles );

	$social = get_option( 'wpseo_social', array() );
	if ( is_array( $social ) ) {
		$social['og_default_image_id'] = $social['og_default_image_id'] ?? '';
		$social['opengraph']          = true;
		$social['twitter']            = true;
		$social['twitter_card_type']  = 'summary_large_image';
		foreach ( array( 'facebook_site' => 'Facebook', 'instagram_url' => 'Instagram' ) as $opt => $net ) {
			$url = (string) mb_get_setting( 'social_' . strtolower( $net ) );
			if ( 0 === strpos( $url, 'http' ) ) {
				$social[ $opt ] = $url;
			}
		}
		update_option( 'wpseo_social', $social );
	}
}

// Admin button.
add_action(
	'admin_post_mb_seed_demo',
	function () {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to do this.', 'maison-belle-core' ) );
		}
		check_admin_referer( 'mb_seed_demo' );
		mb_seed_demo();
		wp_safe_redirect( add_query_arg( array( 'page' => 'mb-salon-settings', 'mb_seeded' => 1 ), admin_url( 'admin.php' ) ) );
		exit;
	}
);

// WP-CLI: wp mb seed
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command(
		'mb seed',
		function () {
			foreach ( mb_seed_demo() as $line ) {
				WP_CLI::log( $line );
			}
			WP_CLI::success( 'Demo content is ready.' );
		}
	);
}
