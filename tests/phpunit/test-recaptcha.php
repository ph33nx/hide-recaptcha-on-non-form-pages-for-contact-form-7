<?php

class Test_Recaptcha extends WP_UnitTestCase {

	private int $form;

	public function set_up(): void {
		parent::set_up();
		$reset = static function (): void {
			self::$form_rendered = false;
		};
		$reset->bindTo( null, RFPOCF7_Hide_Recaptcha::class )();
		$form = WPCF7_ContactForm::get_template();
		$form->set_title( 'Contact' );
		$this->form = $form->save();
		wp_register_script( 'google-recaptcha', 'https://example.com/api.js', array(), '3.0', true );
		wp_register_script( 'wpcf7-recaptcha', 'https://example.com/index.js', array( 'google-recaptcha' ), '1', true );
		wp_enqueue_script( 'wpcf7-recaptcha' );
	}

	public function tear_down(): void {
		wp_dequeue_script( 'wpcf7-recaptcha' );
		wp_deregister_script( 'wpcf7-recaptcha' );
		wp_deregister_script( 'google-recaptcha' );
		parent::tear_down();
	}

	private function visit( string $content ): void {
		$this->go_to( get_permalink( self::factory()->post->create( array( 'post_content' => $content ) ) ) );
	}

	private function shortcode(): string {
		return '[contact-form-7 id="' . $this->form . '"]';
	}

	private function loads(): bool {
		RFPOCF7_Hide_Recaptcha::dequeue();
		return wp_script_is( 'wpcf7-recaptcha' );
	}

	public function test_a_page_without_a_form_drops_the_scripts(): void {
		$this->visit( 'No form here.' );
		$this->assertFalse( $this->loads() );
	}

	public function test_an_archive_without_a_form_drops_the_scripts(): void {
		$this->go_to( home_url( '/?s=nothing' ) );
		$this->assertFalse( $this->loads() );
	}

	public function test_an_empty_page_drops_the_scripts(): void {
		$this->visit( '' );
		$this->assertFalse( $this->loads() );
	}

	public function test_a_form_rendered_outside_the_content_keeps_them(): void {
		$this->visit( 'No form here.' );
		$this->assertStringContainsString( 'wpcf7-form', do_shortcode( $this->shortcode() ) );
		$this->assertTrue( $this->loads() );
	}

	public function test_a_form_rendered_on_an_archive_keeps_them(): void {
		$this->go_to( home_url( '/?s=nothing' ) );
		do_shortcode( $this->shortcode() );
		$this->assertTrue( $this->loads() );
	}

	public function test_a_form_in_content_served_from_a_cache_keeps_them(): void {
		$this->visit( $this->shortcode() );
		$this->assertTrue( $this->loads() );
	}

	public function test_a_site_can_force_either_answer(): void {
		$this->visit( 'No form here.' );
		add_filter( 'rfpocf7_load_recaptcha', '__return_true' );
		$this->assertTrue( $this->loads() );
		remove_filter( 'rfpocf7_load_recaptcha', '__return_true' );
		add_filter( 'rfpocf7_load_recaptcha', '__return_false' );
		do_shortcode( $this->shortcode() );
		$this->assertFalse( $this->loads() );
	}

	public function test_it_decides_before_core_prints_the_footer_scripts(): void {
		$this->assertSame( 9, has_action( 'wp_print_footer_scripts', array( RFPOCF7_Hide_Recaptcha::class, 'dequeue' ) ) );
		$this->assertSame( 10, has_action( 'wp_print_footer_scripts', '_wp_footer_scripts' ) );
	}

	public function test_the_form_markup_is_returned_unchanged(): void {
		$this->assertSame( '<p>x</p>', RFPOCF7_Hide_Recaptcha::mark_form( '<p>x</p>' ) );
	}
}
