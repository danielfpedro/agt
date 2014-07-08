<?php
App::uses('B', 'Model');

/**
 * B Test Case
 *
 */
class BTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.b'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->B = ClassRegistry::init('B');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->B);

		parent::tearDown();
	}

}
