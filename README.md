# Hide reCAPTCHA Badge on Non-Form Pages for Contact Form 7

[![WordPress plugin version](https://img.shields.io/wordpress/plugin/v/hide-recaptcha-on-non-form-pages-for-contact-form-7?label=WordPress%20plugin&logo=wordpress)](https://wordpress.org/plugins/hide-recaptcha-on-non-form-pages-for-contact-form-7/)
[![Tested up to](https://img.shields.io/wordpress/plugin/tested/hide-recaptcha-on-non-form-pages-for-contact-form-7?label=tested%20up%20to)](https://wordpress.org/plugins/hide-recaptcha-on-non-form-pages-for-contact-form-7/)
[![Requires PHP](https://img.shields.io/wordpress/plugin/required-php/hide-recaptcha-on-non-form-pages-for-contact-form-7)](https://wordpress.org/plugins/hide-recaptcha-on-non-form-pages-for-contact-form-7/)
[![CI](https://github.com/ph33nx/hide-recaptcha-on-non-form-pages-for-contact-form-7/actions/workflows/ci.yml/badge.svg)](https://github.com/ph33nx/hide-recaptcha-on-non-form-pages-for-contact-form-7/actions/workflows/ci.yml)
[![License: GPL v2 or later](https://img.shields.io/badge/license-GPL--2.0--or--later-blue)](LICENSE.txt)

**Hide reCAPTCHA Badge on Non-Form Pages for Contact Form 7 loads Google reCAPTCHA v3 only on the pages that show a Contact Form 7 form.** Every other page loses the badge and the Google scripts behind it.

Contact Form 7 loads reCAPTCHA v3 on your whole site once you connect it, so the badge sits on pages that have no form. This plugin removes it there and leaves your forms protected.

## What you get

-   The reCAPTCHA badge disappears from pages without a form
-   Fewer third-party scripts on those pages, so they load faster
-   Forms keep full reCAPTCHA spam protection
-   Forms are found wherever they are: content, footer, sidebar, widgets, page builders and popups
-   Nothing to configure

## How it works

The plugin watches whether Contact Form 7 puts a form on the page. If it does, reCAPTCHA loads as usual. If it does not, the scripts are never printed, so there is no badge to hide with CSS.

## Install

[Download it from WordPress.org](https://wordpress.org/plugins/hide-recaptcha-on-non-form-pages-for-contact-form-7/), or search for "Hide reCAPTCHA Badge on Non-Form Pages for Contact Form 7" under Plugins > Add New. Requires Contact Form 7, WordPress 6.7 and PHP 7.4 or newer.

## Questions

### How do I hide the reCAPTCHA badge in WordPress?

If the badge comes from Contact Form 7, activate this plugin. The badge disappears from every page that has no Contact Form 7 form, with no CSS and no settings.

### Can I hide the reCAPTCHA badge with CSS instead?

CSS hides the badge but the reCAPTCHA scripts still load on every page. This plugin stops the scripts, so the badge and its loading cost both go.

### Does reCAPTCHA slow down my website?

reCAPTCHA v3 adds Google scripts to each page that loads it. On pages without a form they do nothing for you, and this plugin removes them.

### Does it remove the badge from pages with a form?

No. reCAPTCHA stays on those pages, because it protects the form.

### Does it work with reCAPTCHA v3?

Yes. It works with the reCAPTCHA v3 integration built into Contact Form 7.

### Does it work with reCAPTCHA v2 plugins for Contact Form 7?

It controls the reCAPTCHA integration built into Contact Form 7. A separate v2 plugin loads its own scripts.

### Contact Form 7 reCAPTCHA v3 is not working or not showing. What should I check?

Check the keys under Contact > Integration, and that the page shows a Contact Form 7 form. If JavaScript adds your form after the page loads, turn reCAPTCHA on for that page with the `rfpocf7_load_recaptcha` filter.

### Does it find forms in footers, widgets, Elementor and popups?

Yes. A form counts wherever it is placed on the page.

### Does it support custom post types and archives?

Yes. It works on every page, archive and post type.

### Can I force reCAPTCHA on or off for a page?

Yes, with the `rfpocf7_load_recaptcha` filter. Return true to load it and false to remove it.

### Does this work with the latest Contact Form 7?

Yes, tested up to Contact Form 7 6.2.6 and WordPress 7.2.

## Development

Needs Docker, Node 24, PHP and Composer.

```bash
npm ci && composer install
npm run env:start   # http://localhost:8888, admin / password
npm test
npm run plugin-check
```

## License

GPL-2.0-or-later
