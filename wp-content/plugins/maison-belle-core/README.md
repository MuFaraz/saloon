# Maison Belle Core

Content layer for the Maison Belle nail-salon site. It owns everything that is *data*, so the design (theme) can change without losing anything.

* **Post types**: Services (+ Service categories), Gallery (+ Gallery categories), Reviews, Promotions. Native meta boxes, no ACF.
* **Salon Settings** admin page (Settings API, single `mb_settings` option, tabs). Schema lives in `inc/settings-schema.php`: add one entry there to add a setting.
* **Structured data**: `NailSalon` JSON-LD (auto-disables when an SEO plugin already outputs LocalBusiness) and `BlogPosting` fallback.
* **Contact Form 7 helpers**: honeypot spam trap, recipient from Salon Settings, friendly validation messages, form template.
* **Seeder**: idempotent demo content (`wp mb seed`, or Salon Settings → General).
* **Shortcodes**: `[mb_phone] [mb_email] [mb_address] [mb_hours] [mb_booking_url] [mb_book_button]`.

## Template functions (for any theme)

```php
mb_get_setting( 'phone' );        mb_phone_tel();        mb_full_address();
mb_maps_url();   mb_map_embed_url();   mb_booking_url();  mb_get_hours();  mb_get_socials();
mb_get_services_menu();   // categories with items, prices, "from" price
mb_get_gallery_items( $limit );   mb_get_reviews();   mb_get_promotions();
mb_format_price( 40 );    mb_emphasis( 'Word *accent*' );
```

## Hooks

| Hook | Type | Purpose |
|---|---|---|
| `mb_salon_schema` | filter | Modify the NailSalon JSON-LD array |
| `mb_external_local_business_schema` | filter | Force the NailSalon schema off (true) or on (false) |
| `MB_CORE_REMOVE_DATA` | constant | Define as true in wp-config.php to delete settings when the plugin is deleted. Content is never deleted. |

## Requirements
WordPress 6.0+, PHP 7.4+. Works with or without Contact Form 7 and Yoast SEO.
