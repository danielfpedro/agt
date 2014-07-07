<?php
App::uses('AppModel', 'Model');

/**
 * Perfil Model
 *
 * @property Usuario $Usuario
 */
class Perfil extends AppModel {

	public $actsAs = array('Containable');

	public $virtualFields = array(
		'data_nascimento_formatada' => 'DATE_FORMAT(Perfil.data_nascimento, \'%d/%m/%Y\')'
	);
	
	
	/**
	 * afterSave callback
	 *
	 * @param $created boolean
	 * @param $options array
	 * @return void
	 */
		public function afterSave($created, $options = array()) {
			if (!$created) {
				if ($this->data['Perfil']['imagem_array']['error'] == 0) {
					$image = WideImage::load($this->data['Perfil']['imagem_array']['tmp_name']);
					$pasta_salvar = new Folder(WWW_ROOT . 'img' . DS . 'Usuarios/' . $this->data['Perfil']['usuario_id'], true, 0755);
					$image
						->resize(60, 60, 'outside')
						->crop('center', 'center', 60, 60)
						->saveToFile($pasta_salvar->path . DS . $this->data['Perfil']['imagem'], 85);
				}
			}
		}
	

	public function beforeSave($options = array()) {
		

		// Se nao upou imagem ele unseta
		// if (isset($this->data['Perfil']['imagem'])) {
		// 	if ($this->data['Perfil']['imagem']['error'] > 0) {
		// 		unset($this->data['Perfil']['imagem']);
		// 	} else {
		// 		$this->data['Perfil']['imagem'] = $this->data['Perfil']['imagem']['name'];
		// 	}
			
		// }

		if (!empty($this->data['Perfil']['imagem'])) {
			$this->data['Perfil']['imagem_array'] = $this->data['Perfil']['imagem'];
			$this->data['Perfil']['imagem'] = $this->data['Perfil']['imagem']['name'];
		}

		$dt = explode('/', $this->data['Perfil']['data_nascimento']);
		$this->data['Perfil']['data_nascimento'] = $dt[2] .  '-' . $dt[1] . '-' . $dt[0];
		return true;
    }

    public function valida_imagem_extensao() {
  //   	$image_array = $image_array['imagem'];

  //   	if ($image_array['error'] != 4) {
		// 	if ($image_array['type'] != 'image/jpeg' AND $image_array['type'] != 'image/png') {
		// 		return false;
		// 	}
		// }
		return true;
    }

    public function valida_imagem_tamanho($image_array) {
    	$image_array = $image_array['imagem'];

    	if ($image_array['error'] != 4) {
			if ($image_array['size'] > 1000000) {
				return false;
			}
			if ($image_array['error'] != 0 AND $image_array['error'] != 2) {
				return false;
			}
		}
		return true;
    }

	public function data_nascimento_valida($field) {
		$dt = explode('/', $field['data_nascimento']);
		$dt_formated = $dt[1] .  '/' . $dt[0] . '/' . $dt[2];

		if (strtotime($dt_formated) > strtotime('now -16 years')) {
			return false;
		} else {
			return true;
		}
	}

	// public function isUniqueOnUpdate($fields) {
	// 	$options['conditions'] = array(
	// 		'Perfil.apelido'=> $fields['apelido'],
	// 		'Perfil.apelido !='=> $this->Auth->user('Perfil.id')
	// 	);
	// 	Debugger::dump($options);
	// 	exit();
	// 	$check = $this->find('count', $options);
	// 	return ($check == 0) ? true : false;
	// }

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O nome deve ser informado.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'apelido' => array(
			'between'=> array(
				'rule'=> array('between', 3, 16),
				'message'=> 'O apelido deve conter entre 3 e 16 caracteres..',
				//'on'=> 'create'
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Este apelido já está em uso.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			// 'uniqueOnUpdate' => array(
			// 	'rule' => array('isUniqueOnUpdate'),
			// 	'message' => 'Este apelido já está em uso tey.',
			// 	'on' => 'update',
			// ),
		),
		// 'imagem' => array(
		// 	'valida_imagem_extensao' => array(
		// 		'rule' => array('valida_imagem_extensao'),
		// 		'message' => 'A imagem deve estar no formato JPG ou PNG',
		// 		'on' => 'update'
		// 	),
		// 	'valida_imagem_tamanho' => array(
		// 		'rule' => array('valida_imagem_tamanho'),
		// 		'message' => 'O tamanho da imagem está acima do permitido',
		// 		'on' => 'update'
		// 	),
		//),
		'imagem'=> array(
			'extension'=> array(
				'rule'=> array('extension', array('jpg', 'jpeg', 'png')),
				'message'=> 'A imagem deve estar no formato JPG ou PNG',
				'required'=> false,
				'on'=> 'update'
			),
			'fileSize'=> array(
				'rule' => array('fileSize', '<=', '1MB'),
				'message'=> 'A imagem de conter no máximo 1MB'
			)
		),
		'usuario_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'ID do usuário não informado',
			),
		),
		'data_nascimento' => array(
			'data_valida' => array(
				'rule' => array('date', 'dmy'),
				'message' => 'Data de nascimento inválida.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'data_nascimento_valida' => array(
				'rule' => array('data_nascimento_valida'),
				'message' => 'Você deve ter no mínimo 16 anos para se cadastrar no site.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cidade' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'A cidade deve ser informada.',
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
		)
	);
}
