<?php
/**
 * Plugin Name:       Hide reCAPTCHA on Non-Form Pages for Contact Form 7
 * Plugin URI:        https://wordpress.org/plugins/hide-recaptcha-on-non-form-pages-for-contact-form-7/
 * Description:       Hides Google reCAPTCHA badge on pages without Contact Form 7 forms. Improves performance and user experience.
 * Version:           2.0.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            abhi9
 * Author URI:        https://github.com/ph33nx
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rfpocf7
 * CF7 requires at least: 5.1
 * CF7 tested up to:  6.1.3
 *
 * @package Rfpocf7
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!class_exists('RFPOCF7_Hide_Recaptcha')) :

final class RFPOCF7_Hide_Recaptcha {
    private const VERSION = '2.0.0';
    protected static ?self $_instance = null;

    public static function instance(): self {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __clone() {
        _doing_it_wrong(__FUNCTION__, 'Cloning is forbidden.', '2.0.0');
    }

    public function __wakeup() {
        _doing_it_wrong(__FUNCTION__, 'Unserializing instances is forbidden.', '2.0.0');
    }

    private function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'conditionally_dequeue_recaptcha'], 99);
    }

    /**
     * Dequeue reCAPTCHA scripts on pages without CF7 forms
     */
    public function conditionally_dequeue_recaptcha(): void {
        if ($this->has_cf7_form()) {
            return;
        }

        wp_dequeue_script('google-recaptcha');
        wp_dequeue_script('wpcf7-recaptcha');
    }

    /**
     * Check if current page has CF7 form
     */
    private function has_cf7_form(): bool {
        if (!is_singular()) {
            return false;
        }

        $post = get_post();
        
        if (!$post || empty($post->post_content)) {
            return false;
        }

        return has_shortcode($post->post_content, 'contact-form-7');
    }
}

endif;

/**
 * Initialize plugin after CF7 check
 */
function rfpocf7_initialize(): void {
    if (!function_exists('wpcf7')) {
        add_action('admin_notices', function() {
            echo '<div class="error"><p><strong>Hide reCAPTCHA on Non-Form Pages</strong> requires Contact Form 7 to be installed and active.</p></div>';
        });
        return;
    }

    $GLOBALS['rfpocf7'] = RFPOCF7_Hide_Recaptcha::instance();
}

add_action('plugins_loaded', 'rfpocf7_initialize', 10);
