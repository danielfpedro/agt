<?php
App::uses('Estabelecimento', 'Model');

/**
 * Estabelecimento Test Case
 *
 */
class EstabelecimentoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->Estabelecimento = ClassRegistry::init('Estabelecimento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Estabelecimento);

		parent::tearDown();
	}

}
