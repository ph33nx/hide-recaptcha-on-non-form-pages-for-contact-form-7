=== Hide reCAPTCHA on Non-Form Pages for Contact Form 7 ===
Contributors: abhi9
Tags: contact form 7, recaptcha, performance, cf7, google recaptcha
Requires at least: 6.7
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 2.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Hides Google reCAPTCHA badge on pages without Contact Form 7 forms. Improves performance and user experience.

== Description ==

By default, Contact Form 7 loads Google reCAPTCHA scripts on every page of your site, even pages without forms. This plugin intelligently detects pages with Contact Form 7 shortcodes and only loads reCAPTCHA where needed.

**Benefits:**
✅ Improved page load speed
✅ Reduced HTTP requests
✅ Better user experience (no badge on non-form pages)
✅ Automatic detection - no configuration needed
✅ Works with all CF7 versions

**How it works:**
The plugin checks each page for Contact Form 7 shortcodes. If no form is found, it prevents reCAPTCHA scripts from loading, keeping your site fast and clean.

== Installation ==

1. Install from WordPress Plugin Directory or upload plugin files
2. Activate the plugin
3. Done! reCAPTCHA will only load on pages with forms

== Frequently Asked Questions ==

= Does this work with the latest Contact Form 7? =
Yes, tested up to Contact Form 7 6.1.3 and WordPress 6.8.

= Do I need to configure anything? =
No. The plugin works automatically after activation.

= Will this affect my form submissions? =
No. Forms with reCAPTCHA will work normally. The plugin only removes scripts from non-form pages.

= Does it support custom post types? =
Yes. It checks all singular pages/posts for CF7 shortcodes.

== Changelog ==

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

= 2.0.0 =
Major update with complete rewrite and improved performance. Requires PHP 7.4+, WP 6.7+, CF7 5.1+.