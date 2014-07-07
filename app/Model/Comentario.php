<?php
App::uses('AppModel', 'Model');
/**
 * Comentario Model
 *
 * @property Usuario $Usuario
 * @property Estabelecimento $Estabelecimento
 */
class Comentario extends AppModel {
	public $actsAs = array('Containable');

	public $perfil_limit = 5;

	public function get($estabelecimento_id, $limit, $offset = 0) {
		$this->recursive = -1;
		$options = array();

		$options['contain'] = array(
			'Usuario'=> array(
				'fields'=> array('id', 'facebook_id'),
				'Perfil'=> array(
					'fields'=> array('apelido', 'imagem')
				)
			)
		);
		$options['condition'] = array(
				'Comentario.ativo'=> 1,
				'Comentario.estabelecimento_id'=> $estabelecimento_id
			);
		$options['limit'] = $limit;
		$options['offset'] = $offset;
		$options['order'] = array('Comentario.created'=> 'desc');

		$query = $this->find('all', $options);

		$comentarios = array();
		$i = 0;
		foreach ($query as $row) {
			if (!empty($row['Usuario']['Perfil']['imagem'])) {
				$img_url = ''.
					'Usuarios/' . 
					$row['Usuario']['id'] .
					'/' . 
					$row['Usuario']['Perfil']['imagem'];
			}elseif (!empty($row['Usuario']['facebook_id'])) {
				$img_url = 'https://graph.facebook.com/' .
					$row['Usuario']['facebook_id'].
					'/picture?type=normal';
				
			} else {
				$img_url = 'Usuarios/default_avatar.png';
			}

			$row['Usuario']['Perfil']['imagem_final'] = $img_url;
			$comentarios[] = $row;

			$i++;
		}
		// Debugger::dump($comentarios[0]['Usuario']);
		// exit();

		return $comentarios;
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'texto' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength', 400),
			),
		),
		'rate' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'usuario_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'estabelecimento_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ativo' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Estabelecimento' => array(
			'className' => 'Estabelecimento',
			'foreignKey' => 'estabelecimento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
