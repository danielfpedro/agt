<?php
App::uses('Subcategoria', 'Model');

/**
 * Subcategoria Test Case
 *
 */
class SubcategoriaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.subcategoria',
		'app.estabelecimento',
		'app.usuarios_administrativo',
		'app.cliente',
		'app.estado',
		'app.comentario',
		'app.usuario',
		'app.perfil',
		'app.destaque',
		'app.cartao',
		'app.cartoes_estabelecimento',
		'app.categoria',
		'app.categorias_estabelecimento',
		'app.estabelecimentos_subcategoria'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Subcategoria = ClassRegistry::init('Subcategoria');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Subcategoria);

		parent::tearDown();
	}

}
