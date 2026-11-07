# Changelog: Maison Belle Child

All notable changes to this theme. Format based on [Keep a Changelog](https://keepachangelog.com/); versions follow [SemVer](https://semver.org/).

## [1.0.0] - 2026-11-07

### Added
- First release: a WordPress build of the approved Maison Belle Next.js demo, as a GeneratePress 3.6.1 child theme.
- Templates: front page, Services, Gallery, Promotions, Contact, Policy, Blog index, single article (with previous/next and related articles), archive, search, 404.
- Header (announcement bar, sticky header, mobile menu with focus trap), 4-column footer with oversized wordmark, sticky mobile Call / Book bar.
- Vanilla JS: scroll reveal, review carousel, gallery filter + lightbox, services category nav, contact form thank-you card.
- Self-hosted, preloaded fonts (Cormorant Garamond, Jost; Playfair Display and DM Sans as Customizer options).
- Customizer: five colours and two fonts, output as CSS variables (defaults equal the demo palette).
- Media-library image slots with the demo's gradient/pattern placeholders as fallback (`mb_image()`).
- Contact Form 7 styling (validation, errors, honeypot field, success card).
- `main.min.css` / `main.min.js` served automatically when present and newer than the source.
- README, client handover guide, theme screenshot.

### Notes
- Hero and About photo frames overlap as originally designed (the live demo rendered them in normal flow).
