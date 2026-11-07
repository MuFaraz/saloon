# Maison Belle: WordPress rebuild (project notes for Claude)

## What this is
WordPress rebuild of a Next.js nail-salon demo. Site: http://localhost/nail-saloon/ (XAMPP, WP 7.1.4, PHP 8.2.12, DB `nail_saloon`, user `root`, no password, table prefix `wp_`). No WP-CLI.
Live demo (visual reference): https://maison-belle-eight.vercel.app/

## Hard rules
- NEVER modify, move or delete the Next.js folder `nail saloon/` (name has a space) in the WP root. Read-only reference. Its compiled CSS is in `nail saloon/.next/static/chunks/*.css`.
- Never edit the parent theme (`generatepress`) or third-party plugins.
- Do not copy text/photos/branding from lebijounailsandspa.com. Work only inside this WP folder.
- No page builders, no ACF, no jQuery on the front end, no paid or nulled plugins.

## Architecture
- Parent: GeneratePress 3.6.1 (its CSS/JS are deliberately dequeued; filter `mb_child_load_parent_css` re-enables).
- Child theme `wp-content/themes/maison-belle-child`: presentation only (templates, `assets/css/main.css`, `assets/js/main.js`, fonts, `inc/*`). README.md, CHANGELOG.md, docs/CLIENT-HANDOVER.md live there.
- Core plugin `wp-content/plugins/maison-belle-core`: data and logic (CPTs: mb_service, mb_gallery, mb_review, mb_promo; Salon Settings in option `mb_settings`, schema in `inc/settings-schema.php`; NailSalon JSON-LD; CF7 helpers; seeder).
- Plugins and pinned versions: Contact Form 7 **6.1.7** (6.2+ needs PHP 8.3), Yoast SEO 28.8, WP Mail SMTP 4.10.3 (unconfigured on purpose), UpdraftPlus 1.26.14. No caching plugin locally.
- Theme calls `mb_*` functions from the plugin; `inc/fallbacks.php` defines stubs only on front-end `template_redirect` if the plugin is off.

## Workflows
- Seed demo content (idempotent): Salon Settings > General button, or `php` script that loads `wp-load.php` and calls `mb_seed_demo()`. Items are tracked by `_mb_seed_key` meta; re-running never duplicates or overwrites edits.
- After editing `main.css` / `main.js`, regenerate minified files (a stale `.min` is ignored automatically, but regenerate for production):
  `npx clean-css-cli -O1 -o assets/css/main.min.css assets/css/main.css` and `npx terser assets/js/main.js -c -m -o assets/js/main.min.js` (run in the child theme folder).
- Exports to the WP root: `maison-belle-child.zip`, `maison-belle-core.zip` (built with Python `zipfile`, forward-slash paths; not PowerShell Compress-Archive) and `maison-belle-demo.sql` (mysqldump; remove `session_tokens` usermeta first, restore after). Rebuild zips after ANY code change.
- Debug: `WP_DEBUG` and `WP_DEBUG_LOG` on, display off; log at `wp-content/debug.log`.
- Run `php -l` on every changed PHP file.

## Decisions made (do not undo without asking)
- Layout was verified against the live demo at 375/768/1440 px (positions within ~1px). Header, footer, typography and spacing are pixel-matched. Keep it that way when editing CSS.
- **Hero and About photo frames use the originally intended overlap** (position:absolute: hero arch right + circle bottom-left; About square bottom-right). The live demo actually rendered them in normal flow because of a Tailwind class-order quirk; the user chose the intended overlap. Set `position:relative` on `.hero__img-main`, `.hero__img-accent`, `.about__img-accent` to restore demo-exact rendering.
- 5 seeded reviews (demo has 5; brief said 4).
- **Book Now** buttons use Salon Settings > Booking page URL. It is still the placeholder `#` (stays on the page, no new tab); a real `https://` URL opens in a new tab. Internal links never open new tabs.
- Added beyond the demo: prev/next links and related posts on articles, blog pagination, form note "We usually reply within one business day", thank-you card says message was sent.
- Contact form: CF7 form ID is stored in Salon Settings (`contact_form_id`); wpautop is disabled for CF7; honeypot field `mb_website`; mail recipient from Salon Settings (falls back to admin email). Mail cannot send on XAMPP until WP Mail SMTP is configured.
- SEO: Yoast handles titles/meta/sitemap; core plugin prints NailSalon schema (auto-off if a local-SEO plugin exists) and sets Yoast article type to BlogPosting for posts only.
- Map iframe is lazy-loaded by JS (`data-src`) with a `<noscript>` fallback.
- Lighthouse (mobile, local, no cache): Performance 95-100, Accessibility/Best Practices/SEO 100.

## Placeholders still to replace (client)
Booking URL, social links (`#`), all photos, sample reviews/promotions/blog posts, prices, policy text, footer "Demo design preview" line, rating figures, SMTP, CAPTCHA, Yoast default share image. Full checklist in the child theme README section 8.

## Other
- Admin login: existing `admin` account (password not known to Claude and never changed).
- User writes in Roman Urdu/Hinglish; answer in the same style.
