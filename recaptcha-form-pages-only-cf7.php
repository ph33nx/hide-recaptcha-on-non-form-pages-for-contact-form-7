<?php
/**
 * Plugin Name:       Hide reCAPTCHA Badge on Non-Form Pages for Contact Form 7
 * Plugin URI:        https://wordpress.org/plugins/hide-recaptcha-on-non-form-pages-for-contact-form-7/
 * Description:       Hide the reCAPTCHA badge on every page without a Contact Form 7 form, and stop its scripts slowing those pages. No setup.
 * Version:           2.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            abhi9
 * Author URI:        https://github.com/ph33nx
 * License:           GPL-2.0-or-later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hide-recaptcha-on-non-form-pages-for-contact-form-7
 * Requires Plugins:  contact-form-7
 *
 * @package Rfpocf7
 */

declare( strict_types=1 );

defined( 'ABSPATH' ) || exit;

final class RFPOCF7_Hide_Recaptcha {

	private static bool $form_rendered = false;

	public static function register(): void {
		add_filter( 'wpcf7_form_elements', array( self::class, 'mark_form' ) );
		// Core prints the footer scripts at priority 10, after every widget, builder section and popup has rendered.
		add_action( 'wp_print_footer_scripts', array( self::class, 'dequeue' ), 9 );
	}

	/**
	 * Records that a form is on the page, wherever it was placed.
	 *
	 * @param mixed $elements The form markup.
	 * @return mixed The form markup, unchanged.
	 */
	public static function mark_form( $elements ) {
		self::$form_rendered = true;
		return $elements;
	}

	public static function dequeue(): void {
		/**
		 * Filters whether this page loads the Contact Form 7 reCAPTCHA scripts.
		 *
		 * @param bool $load Whether a form rendered on the page or sits in its content.
		 */
		if ( apply_filters( 'rfpocf7_load_recaptcha', self::$form_rendered || self::content_has_form() ) ) {
			return;
		}

		wp_dequeue_script( 'wpcf7-recaptcha' );
		wp_dequeue_script( 'google-recaptcha' );
	}

	/**
	 * Whether the page content holds a form that another plugin served from its own cache.
	 */
	private static function content_has_form(): bool {
		$post = get_post();
		return is_singular() && $post && has_shortcode( $post->post_content, 'contact-form-7' );
	}
}

RFPOCF7_Hide_Recaptcha::register();
