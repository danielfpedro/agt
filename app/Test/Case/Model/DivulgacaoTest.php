<?php
App::uses('Divulgacao', 'Model');

/**
 * Divulgacao Test Case
 *
 */
class DivulgacaoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.divulgacao'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Divulgacao = ClassRegistry::init('Divulgacao');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Divulgacao);

		parent::tearDown();
	}

}
