=== Hide reCAPTCHA Badge on Non-Form Pages for Contact Form 7 ===
Contributors: abhi9
Tags: contact form 7, recaptcha, recaptcha badge, cf7, performance
Requires at least: 6.7
Tested up to: 7.2
Requires PHP: 7.4
Stable tag: 2.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Hide the reCAPTCHA badge on every page without a Contact Form 7 form, and stop its scripts slowing those pages. No setup.

== Description ==

**Hide reCAPTCHA Badge on Non-Form Pages for Contact Form 7 loads Google reCAPTCHA v3 only on the pages that show a Contact Form 7 form.** Every other page loses the badge and the Google scripts behind it.

Contact Form 7 loads reCAPTCHA v3 on your whole site once you connect it, so the badge sits on pages that have no form. This plugin removes it there and leaves your forms protected.

**What you get**

* The reCAPTCHA badge disappears from pages without a form
* Fewer third-party scripts on those pages, so they load faster
* Forms keep full reCAPTCHA spam protection
* Forms are found wherever they are: content, footer, sidebar, widgets, page builders and popups
* Nothing to configure

**How it works**

The plugin watches whether Contact Form 7 puts a form on the page. If it does, reCAPTCHA loads as usual. If it does not, the scripts are never printed, so there is no badge to hide with CSS.

Source code and issues: [GitHub](https://github.com/ph33nx/hide-recaptcha-on-non-form-pages-for-contact-form-7)

== Installation ==

1. Install the plugin from Plugins > Add New, or upload it.
2. Activate it. Contact Form 7 must be active.
3. Visit a page without a form. The reCAPTCHA badge is gone.

== Frequently Asked Questions ==

= How do I hide the reCAPTCHA badge in WordPress? =
If the badge comes from Contact Form 7, activate this plugin. The badge disappears from every page that has no Contact Form 7 form, with no CSS and no settings.

= Can I hide the reCAPTCHA badge with CSS instead? =
CSS hides the badge but the reCAPTCHA scripts still load on every page. This plugin stops the scripts, so the badge and its loading cost both go.

= Does reCAPTCHA slow down my website? =
reCAPTCHA v3 adds Google scripts to each page that loads it. On pages without a form they do nothing for you, and this plugin removes them.

= Does it remove the badge from pages with a form? =
No. reCAPTCHA stays on those pages, because it protects the form.

= Does it work with reCAPTCHA v3? =
Yes. It works with the reCAPTCHA v3 integration built into Contact Form 7.

= Does it work with reCAPTCHA v2 plugins for Contact Form 7? =
It controls the reCAPTCHA integration built into Contact Form 7. A separate v2 plugin loads its own scripts.

= Contact Form 7 reCAPTCHA v3 is not working or not showing. What should I check? =
Check the keys under Contact > Integration, and that the page shows a Contact Form 7 form. If JavaScript adds your form after the page loads, turn reCAPTCHA on for that page with the `rfpocf7_load_recaptcha` filter.

= Does it find forms in footers, widgets, Elementor and popups? =
Yes. A form counts wherever it is placed on the page.

= Does it support custom post types and archives? =
Yes. It works on every page, archive and post type.

= Can I force reCAPTCHA on or off for a page? =
Yes, with the `rfpocf7_load_recaptcha` filter. Return true to load it and false to remove it.

= Does this work with the latest Contact Form 7? =
Yes, tested up to Contact Form 7 6.2.6 and WordPress 7.2.

== Changelog ==

= 2.1.0 =
* Fixed: forms in a footer, widget, page builder section or popup keep reCAPTCHA, so their submissions go through.
* Improved: tested against WordPress 7.2, PHP 8.6 and Contact Form 7 6.2.6.

= 2.0.0 =
* Complete rewrite with modern PHP 8+ practices
* Improved performance with optimized detection
* Better code structure with singleton pattern
* Added CF7 dependency check
* Updated for WordPress 6.8 and Contact Form 7 6.1.3
* Requires PHP 7.4+, WordPress 6.7+, Contact Form 7 5.1+

= 1.0.2 =
* Removed CSS to hide grecaptcha-badge

= 1.0.1 =
* Bug fixes

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 2.1.0 =
Forms outside the page content keep reCAPTCHA. Tested against WordPress 7.2 and PHP 8.6.

= 2.0.0 =
Major update with complete rewrite and improved performance. Requires PHP 7.4+, WP 6.7+, CF7 5.1+.