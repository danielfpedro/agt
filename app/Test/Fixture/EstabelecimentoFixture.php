<?php
/**
 * EstabelecimentoFixture
 *
 */
class EstabelecimentoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descricao' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'endereco' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 80, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'cidade' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'telefone' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tipo_comida' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'horario_funcionamento_inicial' => array('type' => 'time', 'null' => false, 'default' => null),
		'horario_funcionamento_final' => array('type' => 'time', 'null' => false, 'default' => null),
		'site' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 80, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'area_fumantes' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'ar_livre' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'ar_condicionado' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'faz_reserva' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'estacionamento' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'faz_entrega' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4),
		'wifi' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'acesso_deficiente' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'inaugurado' => array('type' => 'date', 'null' => true, 'default' => null),
		'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tipo_cadastro' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4),
		'usuarios_administrativo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'cliente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'ativo' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 4),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'carrossel' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'imagem' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 80, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'imagem2_300x170' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 80, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'imagem3_300x170' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 80, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'imagem_300x170' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 60, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'imagem_70x70' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 60, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'imagem_540x390' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 60, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'imagem2_540x390' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'imagem3_540x390' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_estabelecimentos_usuarios_administrativos1_idx' => array('column' => 'usuarios_administrativo_id', 'unique' => 0),
			'fk_estabelecimentos_clientes1_idx' => array('column' => 'cliente_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'descricao' => 'Lorem ipsum dolor sit amet',
			'endereco' => 'Lorem ipsum dolor sit amet',
			'cidade' => 'Lorem ipsum dolor sit amet',
			'telefone' => 'Lorem ipsum dolor sit a',
			'tipo_comida' => 'Lorem ipsum dolor sit amet',
			'horario_funcionamento_inicial' => '21:04:08',
			'horario_funcionamento_final' => '21:04:08',
			'site' => 'Lorem ipsum dolor sit amet',
			'area_fumantes' => 1,
			'ar_livre' => 1,
			'ar_condicionado' => 1,
			'faz_reserva' => 1,
			'estacionamento' => 1,
			'faz_entrega' => 1,
			'wifi' => 'Lorem ipsum dolor sit amet',
			'acesso_deficiente' => 1,
			'inaugurado' => '2014-07-05',
			'slug' => 'Lorem ipsum dolor sit amet',
			'tipo_cadastro' => 1,
			'usuarios_administrativo_id' => 1,
			'cliente_id' => 1,
			'ativo' => 1,
			'created' => '2014-07-05 21:04:08',
			'modified' => '2014-07-05 21:04:08',
			'carrossel' => 1,
			'imagem' => 'Lorem ipsum dolor sit amet',
			'imagem2_300x170' => 'Lorem ipsum dolor sit amet',
			'imagem3_300x170' => 'Lorem ipsum dolor sit amet',
			'imagem_300x170' => 'Lorem ipsum dolor sit amet',
			'imagem_70x70' => 'Lorem ipsum dolor sit amet',
			'imagem_540x390' => 'Lorem ipsum dolor sit amet',
			'imagem2_540x390' => 'Lorem ipsum dolor sit amet',
			'imagem3_540x390' => 'Lorem ipsum dolor sit amet'
		),
	);

}
