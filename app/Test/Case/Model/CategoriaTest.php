<?php
App::uses('Categoria', 'Model');

/**
 * Categoria Test Case
 *
 */
class CategoriaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.categoria',
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
		$this->Categoria = ClassRegistry::init('Categoria');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Categoria);

		parent::tearDown();
	}

}
