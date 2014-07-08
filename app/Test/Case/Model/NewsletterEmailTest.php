<?php
App::uses('NewsletterEmail', 'Model');

/**
 * NewsletterEmail Test Case
 *
 */
class NewsletterEmailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.newsletter_email'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NewsletterEmail = ClassRegistry::init('NewsletterEmail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NewsletterEmail);

		parent::tearDown();
	}

}
