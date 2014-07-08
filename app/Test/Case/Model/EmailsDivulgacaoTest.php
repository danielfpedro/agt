<?php
App::uses('EmailsDivulgacao', 'Model');

/**
 * EmailsDivulgacao Test Case
 *
 */
class EmailsDivulgacaoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.emails_divulgacao'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->EmailsDivulgacao = ClassRegistry::init('EmailsDivulgacao');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EmailsDivulgacao);

		parent::tearDown();
	}

}
