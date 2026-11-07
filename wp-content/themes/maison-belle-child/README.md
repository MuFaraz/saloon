# Maison Belle: WordPress site (child theme + core plugin)

A complete WordPress build of the approved "Maison Belle Nails & Spa" Next.js demo. Same pages, layout, typography, animations and mobile behaviour, but every text, price, photo and setting is editable from the WordPress dashboard.

This file is for whoever looks after the site. The salon owner's one-page guide is in [`docs/CLIENT-HANDOVER.md`](docs/CLIENT-HANDOVER.md).

---

## 1. How it is built (and why updates will not break it)

| Layer | What it is | Where it lives | Safe to update? |
|---|---|---|---|
| **Parent theme** | GeneratePress (free) 3.6.1. Provides updates, hooks, Customizer framework. Never edited. | `wp-content/themes/generatepress` | Yes |
| **Child theme** | `maison-belle-child`. **Presentation only**: templates, CSS, JS, fonts, menus markup, Customizer colours. | `wp-content/themes/maison-belle-child` | It is yours; updates never touch it |
| **Core plugin** | `maison-belle-core`. **Data and logic**: Services, Gallery, Reviews, Promotions, the Salon Settings page, the SEO structured data, the Contact Form 7 helpers, the demo-content seeder. | `wp-content/plugins/maison-belle-core` | It is yours. Survives a theme change |
| Third-party plugins | See section 5 | `wp-content/plugins/...` | Yes, follow section 6 |

Rule of thumb: **content questions go to the plugin, look-and-feel questions go to the theme.** If you change the theme in future, the salon's data stays safe in the plugin.

No page builders. No jQuery on the front end. No ACF (native meta boxes). Fonts are self-hosted (no Google calls).

### Folder map

```
maison-belle-child/
├── style.css            Theme header only (Template: generatepress)
├── functions.php        Tiny: loads the files in /inc
├── inc/                 setup · enqueue · customizer · icons · images · template-tags · nav-walker · forms
├── header.php  footer.php  front-page.php  home.php  single.php  page.php  index.php  archive.php  search.php  404.php
├── templates/           Page templates: services · gallery · promotions · contact · policy
├── template-parts/      hero · strip · about · marquee · service-cards · why · reviews · gallery-grid · visit
├── assets/css/main.css  Every style, in 15 numbered sections (tokens at the top)
├── assets/js/main.js    Vanilla JS: header, menu, reveal, carousel, gallery + lightbox, category nav, form card
├── assets/fonts/        Cormorant Garamond, Jost (+ optional Playfair Display, DM Sans), woff2
└── docs/CLIENT-HANDOVER.md

maison-belle-core/
├── maison-belle-core.php
├── inc/                 settings-schema · helpers · post-types · meta-boxes · term-meta · settings-page
│                        schema (JSON-LD) · contact-form (CF7) · shortcodes · seeder
├── assets/admin.js/css  Media picker + admin tidy-up
└── uninstall.php        Never deletes content
```

---

## 2. Logging in and first look

* Site: `http://localhost/nail-saloon/`  Admin: `http://localhost/nail-saloon/wp-admin/` (use your existing administrator account).
* **Salon Settings** (left menu) holds everything about the business. **Services, Gallery, Reviews, Promotions** each have their own menu item. Blog articles are normal **Posts**.
* Appearance → Customize → **Salon colours & fonts** changes colours and fonts.

Demo content is created by the seeder (safe to re-run, never duplicates, never overwrites edits):

* Dashboard: Salon Settings → General → *Install / repair demo content*, or
* WP-CLI: `wp mb seed`, or
* PHP: `mb_seed_demo();` after loading WordPress.

---

## 3. How to change things (no code)

### Salon info, hours, links
**Salon Settings** has five tabs:

* **General**: salon name, wordmark text, **logo** (optional), tagline, announcement bar, scrolling banner words.
* **Contact, hours & booking**: address, phone (click-to-call is built automatically), email, **booking URL** (every *Book Now* button opens it in a new tab), map address, opening hours (three rows), price range, currency, and which Contact Form 7 form is used. The *"Send contact form messages to"* address also lives here (empty = WordPress admin email).
* **Social links**: Instagram, Facebook, Google, Yelp. Empty links are hidden.
* **Home page**: hero text and photos, the three highlights, About section, Why choose us, headings, rating figures.
* **Footer & final call-to-action**: banner text, footer text, the small "demo preview" line (delete it before launch).

Tip: wrap a word in `*asterisks*` in a heading to get the italic accent colour, e.g. `Where every` / `detail *shines.*`.

### Colours and fonts
Appearance → Customize → **Salon colours & fonts**: primary, accent, background, text, blush, heading font, body font. Darker/lighter shades follow automatically. Defaults equal the approved design, so leaving everything untouched changes nothing.

### Logo
Salon Settings → General → Logo. Leave empty for the elegant text wordmark.

### Photos (every picture slot)
Every image slot shows a soft gradient placeholder until you add a photo, so nothing breaks while content is being collected.

| Slot | Where to add it | Best size |
|---|---|---|
| Hero (large arch, small circle) | Salon Settings → Home page | 900×1200, 600×600 |
| About (large arch, small square) | Salon Settings → Home page | 900×1200, 600×600 |
| Service category photo | Services → Service categories → edit | 900×1200 |
| Gallery photo | Gallery → edit → *Photo* (right column) | 1200 px long side |
| Blog photo | Post → *Featured image* | 1600×1000 |
| Logo | Salon Settings → General | wide PNG/SVG |

WordPress creates the responsive sizes (srcset), adds width/height and lazy-loads them. Add a short description (alt text) for accessibility.

### Services and prices
Services → **Add New**: title = service name, then *Price*, *Duration*, *Short description*, choose a **Service category** (right column), and use **Order** (Page Attributes) to sort. The Services page, price leaders, "From $X" and Google's price data update by themselves.
Categories (Manicure, Pedicure, Waxing, Eyelashes) are edited under Services → **Service categories**: order, tagline, description, icon and photo.

### Gallery
Gallery → **Add New**: title = description of the photo, set the *Photo*, pick a category (Nails / Pedicure / Lashes) and the grid shape. New categories automatically appear as filter buttons.

### Reviews
Reviews → **Add New**: title = client name, then review text, service, rating. The home carousel shows them in *Order*. Keep the rating figures on the Home settings tab honest.

### Promotions
Promotions → **Add New**: badge, big highlight (e.g. `15% off`), text, fine print, icon, button label and link (empty link = booking URL).

### Blog
Posts → **Add New**. Excerpt becomes the summary, the first Category is the small label, reading time is automatic, the first article is "featured". Previous/next links and related articles are added under each article. Posts without a featured image get a placeholder (colour/icon in the sidebar box).

### Pages and banners
Each page has a **Page banner** box (small line, big title, intro). The **Policy** page is an ordinary page: every *Heading 2* starts a new numbered section. Menus: Appearance → Menus (Primary menu = header and mobile menu, Footer menu = footer links).

### Shortcodes (for any page or post)
`[mb_phone]` `[mb_email]` `[mb_address]` `[mb_hours]` `[mb_booking_url]` `[mb_book_button label="Book now"]`

---

## 4. Contact form, email and spam

* The form is a **Contact Form 7** form (Contact → Contact forms). Its fields are styled by the theme. It posts to a REST endpoint, validates with friendly messages, and shows a "Thank you" card when sent.
* **Where mail goes**: Salon Settings → Contact → "Send contact form messages to" (empty = Settings → General → Administration Email).
* **Spam**: a hidden honeypot field is built in (bots fill it, humans never see it). For stronger protection add Cloudflare Turnstile or reCAPTCHA: Contact → **Integration** → set up the keys, then add the tag the plugin shows (e.g. `[turnstile]`) to the form, above the Send button. Nothing else needs to change.
* **Sending real email (important)**: out of the box WordPress uses PHP `mail()`, which many hosts block and Gmail often rejects. **WP Mail SMTP** is installed but intentionally *not configured*. On the live server: WP Mail SMTP → Settings → choose a mailer (Gmail/Google Workspace, Microsoft 365, Brevo, SendGrid, Mailgun or your host's SMTP) → follow the wizard → send a test email. Do this before launch.
* Locally (XAMPP) sending will fail unless you point WP Mail SMTP at a local catcher such as Mailpit. The form itself, validation and thank-you card all work.

---

## 5. Plugins, pinned versions and why

| Component | Version | Why it is here |
|---|---|---|
| WordPress | **7.1.4** | Core |
| GeneratePress (parent theme) | **3.6.1** | Light, well maintained, no builder. |
| Maison Belle Child | 1.0.0 | Custom, presentation. |
| Maison Belle Core | 1.0.0 | Custom, content + logic. |
| Contact Form 7 | **6.1.7** | Contact form. Pinned to 6.1.7 because 6.2+ requires PHP 8.3 and this local server runs PHP 8.2.12. If your live host runs PHP 8.3+ you may update to the latest 6.x. |
| Yoast SEO (free) | **28.8** | Titles, meta, Open Graph, canonical, XML sitemap, robots, article schema. Local business markup comes from the core plugin (see below). |
| WP Mail SMTP (Lite) | **4.10.3** | Reliable email delivery. Installed, **not configured**. |
| UpdraftPlus | **1.26.14** | Scheduled backups and one-click restore/migration. |

No paid plugins, nothing nulled; all from wordpress.org. Akismet and Hello Dolly were removed to keep the list short.

**Not installed on purpose: a caching plugin.** Do not activate caching locally. On the live server install **LiteSpeed Cache** (if the host runs LiteSpeed) or **WP Super Cache** (any host), enable page cache + browser cache + GZIP, and test the contact form afterwards. Also consider Cloudflare (free) for CDN.

### Structured data without duplicates
* The core plugin prints a **schema.org `NailSalon`** block (name, address, phone, geo, opening hours, price range, social links, service price catalogue) from Salon Settings.
* Yoast free outputs *no* `LocalBusiness`, so there is exactly one. If a local-SEO add-on (Yoast Local or Rank Math Local) is ever added, the core plugin switches its own block off automatically (filter `mb_external_local_business_schema` can force it either way).
* Articles: Yoast's article node is switched to `BlogPosting`; without an SEO plugin the core plugin outputs `BlogPosting` itself.

---

## 6. How to update safely

Always in this order. Takes about 15 minutes.

1. **Back up.** UpdraftPlus → *Backup Now* (database + files). Download the backup, don't leave it only on the server.
2. **Updates screen (Dashboard → Updates)**: update **one thing at a time**, in this order:
   1. WordPress core
   2. Parent theme (GeneratePress)
   3. Plugins (Yoast, Contact Form 7, WP Mail SMTP, UpdraftPlus)
3. **Never edit** the parent theme or any third-party plugin. All custom work belongs to `maison-belle-child` and `maison-belle-core`.
4. **Test checklist** after each batch (private window):
   * [ ] Home loads, animations run, no layout jump, no broken image
   * [ ] Header menu works on desktop and the mobile hamburger opens/closes (Esc closes)
   * [ ] Services page: sticky category bar highlights as you scroll
   * [ ] Gallery: filters work, lightbox opens, arrow keys and Esc work
   * [ ] Reviews carousel buttons work
   * [ ] *Book Now* opens the booking page in a new tab; phone link dials
   * [ ] Contact form: send a test message; it arrives; thank-you card shows
   * [ ] A blog post opens; the sitemap `/sitemap_index.xml` loads
   * [ ] Dashboard → Tools → Site Health: no critical issues; `wp-content/debug.log` has no new errors
5. If something breaks: restore the backup (UpdraftPlus → Restore) and tell your developer which update caused it. A broken plugin update can also be rolled back by uploading the previous version zip.

### Developer notes
* Child theme and core plugin are versioned in their own headers + `CHANGELOG.md`. Bump the version when you change them.
* Stylesheets and scripts load with `filemtime` versions, so your edits are never cached stale.
* The theme serves `main.min.css` / `main.min.js` when they exist and are newer than the readable source. After editing `main.css`/`main.js`, either delete the `.min` file or regenerate it:

  ```bash
  npx clean-css-cli -o assets/css/main.min.css assets/css/main.css
  npx terser assets/js/main.js -c -m -o assets/js/main.min.js
  ```
* The parent theme's own stylesheet is intentionally not loaded (the design is fully styled by `main.css`); `add_filter( 'mb_child_load_parent_css', '__return_true' );` loads it again.

### Demo-parity notes (for the developer)
The Next.js demo, as deployed, renders two details slightly differently from its source: the hero and About photo frames end up in normal flow (a CSS ordering quirk) instead of being absolutely positioned. This build copies the *rendered* demo exactly so the result matches what the client approved. The two CSS comments in `main.css` (search "Demo parity") show the one-line change to switch to the "intended" overlapping composition if the client prefers it.
Two small, deliberate additions beyond the demo: previous/next links under articles, and a thank-you card text that says the message *was* sent (the demo form said nothing is sent).

---

## 7. Moving the site to live hosting

1. **Create a backup** with UpdraftPlus *or* use the exported files below.
2. On the live host create an empty database and install WordPress (same major version, PHP 8.1+; PHP 8.3 lets you use the newest Contact Form 7).
3. Upload `maison-belle-child.zip` and `maison-belle-core.zip` via Appearance → Themes / Plugins → Add New → Upload, plus the parent theme and the plugins listed in section 5. Activate the child theme and all plugins.
4. **Import the database** (`maison-belle-demo.sql`) with phpMyAdmin, then **replace the URLs**:
   * with WP-CLI: `wp search-replace "http://localhost/nail-saloon" "https://yourdomain.com" --all-tables --skip-columns=guid`
   * or the *Better Search Replace* plugin (run, then delete it), or UpdraftPlus Migrator (premium).
   Do a dry run first. Serialized data (settings, widgets) is handled correctly by these tools; never use a plain text find/replace on the SQL file.
5. Update `wp-config.php` database name/user/password, set `WP_DEBUG` to `false`, add your salts, and use HTTPS.
6. Settings → Permalinks → *Save* (rebuilds rewrite rules). Settings → Reading: make sure *Discourage search engines* is **unticked** at launch.
7. Configure WP Mail SMTP, set the Contact Form 7 recipient (Salon Settings), install the caching plugin, and add the real site to Google Search Console (submit `sitemap_index.xml`) and Google Business Profile.
8. Replace the placeholders (section 8), then run the test checklist in section 6.

---

## 8. Placeholders to replace before launch

- [ ] Salon name, wordmark, **logo**, tagline (Salon Settings → General)
- [ ] Announcement text; scrolling banner words
- [ ] Address, phone, email, **map address**, latitude/longitude (SEO), price range
- [ ] **Booking URL** (currently `#`)
- [ ] Opening hours (and the line "Open daily" on Home)
- [ ] Instagram / Facebook / Google / Yelp links (currently `#`)
- [ ] Hero, About, service category and gallery **photos**; blog featured images
- [ ] Rating value, review count, "Placeholder rating" and "(placeholder figures)" labels
- [ ] The 5 sample **reviews** (real client quotes only)
- [ ] The 3 sample **promotions** (and remove "Placeholder offer" fine print)
- [ ] Service names, prices, durations, descriptions
- [ ] The 3 sample **blog posts** (replace or delete)
- [ ] **Policy** page text
- [ ] Footer "Demo design preview · All content … are placeholders" line (Footer tab)
- [ ] Page banner texts that mention "placeholder" (each page's *Page banner* box)
- [ ] Yoast: default social share image (SEO → Settings → Site basics), organisation logo
- [ ] Contact form recipient + WP Mail SMTP + CAPTCHA
- [ ] Delete the sample user/test content you no longer need, change the admin password

---

## 9. Troubleshooting

| Symptom | Fix |
|---|---|
| Contact form says "could not be sent" | Email is not configured: WP Mail SMTP (section 4). |
| Menu is empty | Appearance → Menus → assign *Primary menu* and *Footer menu* to their locations. |
| Photos not showing | Check the image is set in the right slot; placeholders mean the slot is empty. |
| Style changes not visible | Delete `assets/css/main.min.css` (or regenerate it), clear any cache plugin. |
| "Services" page empty | Services → make sure items have a *Service category*. |
| Pretty links give 404 | Settings → Permalinks → Save. |
| Need demo content again | Salon Settings → General → *Install / repair demo content* (does not duplicate or overwrite). |

Debug log: `wp-content/debug.log` (only when `WP_DEBUG_LOG` is on; turn all debug constants off on the live site).

---

## 10. Credits and licences
Fonts: Cormorant Garamond, Jost, Playfair Display, DM Sans (SIL Open Font License, self-hosted). Theme and plugin code: GPL-2.0-or-later. Placeholders are drawn with inline SVG/CSS; no photos are bundled and nothing was copied from other websites.
