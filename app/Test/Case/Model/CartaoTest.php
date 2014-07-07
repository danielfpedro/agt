<?php
App::uses('Cartao', 'Model');

/**
 * Cartao Test Case
 *
 */
class CartaoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cartao',
		'app.estabelecimento',
		'app.usuarios_administrativo',
		'app.cliente',
		'app.estado',
		'app.comentario',
		'app.usuario',
		'app.perfil',
		'app.destaque',
		'app.cartoes_estabelecimento',
		'app.categoria',
		'app.categorias_estabelecimento',
		'app.subcategoria',
		'app.estabelecimentos_subcategoria'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cartao = ClassRegistry::init('Cartao');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cartao);

		parent::tearDown();
	}

}
