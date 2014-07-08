<?php
App::uses('AppModel', 'Model');
/**
 * Estabelecimento Model
 *
 * @property UsuariosAdministrativo $UsuariosAdministrativo
 * @property Cliente $Cliente
 * @property Comentario $Comentario
 * @property Destaque $Destaque
 * @property Cartao $Cartao
 * @property Categoria $Categoria
 * @property Subcategoria $Subcategoria
 */
class Estabelecimento extends AppModel {

	public $actsAs = array('Containable');

	public $virtualFields = array(
		'rate' => 'SELECT ROUND(AVG(rate), 0) FROM comentarios WHERE estabelecimento_id = Estabelecimento.id AND ativo = 1'
	);

	public function validationErrorMessage() {
		$errors = $this->validationErrors;

		$retorno = array();
		foreach ($errors as $key => $value) {
			foreach ($value as $item) {
				$retorno[] = $item;
			}
		}
		return join('<br>', $retorno);
	}

	public function beforeDelete($cascade = true) {
		$options = array();
		$options['fields'] = array('slug');
		$options['conditions'] = array('Estabelecimento.id'=> $this->id);
		$slug = $this->find('first', $options);
		$this->slug = $slug['Estabelecimento']['slug'];
	}

	public function afterDelete() {
		$pasta = new Folder(WWW_ROOT . 'img' . DS . 'Estabelecimentos' . DS . $this->slug, true, 0755);
		$pasta->delete();
		return true;
	}
	

	public function beforeSave($options = array()) {
		$this->data['Estabelecimento']['slug'] = Inflector::slug($this->data['Estabelecimento']['name'], '-');
		$this->data['Estabelecimento']['usuarios_administrativo_id'] = 1;		

		$pasta_salvar = new Folder(WWW_ROOT . 'img' . DS . 'Estabelecimentos' . DS . $this->data['Estabelecimento']['slug'], true, 0755);
		if (!empty($this->data['Estabelecimento']['imagem'])) {
			$this->uploadImage($this->data['Estabelecimento']['imagem'], 'imagem', 70, 70, $pasta_salvar);
			$this->uploadImage($this->data['Estabelecimento']['imagem'], 'imagem', 300, 170, $pasta_salvar);
			$this->uploadImage($this->data['Estabelecimento']['imagem'], 'imagem', 540, 390, $pasta_salvar);
			$this->uploadImage($this->data['Estabelecimento']['imagem'], 'imagem', 800, 600, $pasta_salvar);
		}


		if (!empty($this->data['Estabelecimento']['imagem2'])) {
			$this->uploadImage($this->data['Estabelecimento']['imagem2'], 'imagem2', 300, 170, $pasta_salvar);
			$this->uploadImage($this->data['Estabelecimento']['imagem2'], 'imagem2', 800, 600, $pasta_salvar);
		}

		if (!empty($this->data['Estabelecimento']['imagem3'])) {
			$this->uploadImage($this->data['Estabelecimento']['imagem3'], 'imagem3', 300, 170, $pasta_salvar);
			$this->uploadImage($this->data['Estabelecimento']['imagem3'], 'imagem3', 800, 600, $pasta_salvar);
		}

		return true;
	}

	
	public function uploadImage($image_array, $name, $w, $h, $pasta_salvar) {

		$image = WideImage::load($image_array['tmp_name']);
		$extension = strtolower(pathinfo($image_array['name'], PATHINFO_EXTENSION));

		if ($extension == 'jpg' OR $extension == 'jpeg') {
			$compression = 85;
		} else {
			$compression = 8;
		}

		$new_name = strtolower($name . '-'.$w.'x'.$h.'.' . $extension);
		$image
			->resize($w, $h, 'outside')
			->crop('center', 'center', $w, $h)
			->saveToFile($pasta_salvar->path . DS . $new_name, $compression);
		$this->data['Estabelecimento'][$name . '_' .$w.'x'.$h.''] = $new_name;
	}

	public function afterSave($created, $options = array()) {

	}

	public function beforeValidate($options = array()) {

		if (!empty($this->data['Estabelecimento']['id'])) {
			if ($this->data['Estabelecimento']['imagem']['error'] == 4) {
				unset($this->data['Estabelecimento']['imagem']);
			}
		}

		//Caso a imagem nao tenha sido inserida tira
		if ($this->data['Estabelecimento']['imagem2']['error'] == 4) {
			unset($this->data['Estabelecimento']['imagem2']);
		}
		if ($this->data['Estabelecimento']['imagem3']['error'] == 4) {
			unset($this->data['Estabelecimento']['imagem3']);
		}

		if (empty($this->data['Categoria']['Categoria'])) {
			$this->invalidate('Categoria.categoria', 'Você deve selecionar ao menos uma categoria.');
			return false;
		} 
		if ($this->data['Estabelecimento']['tipo_cadastro'] == 1){
			//$this->validatior()->remove()
		}
		return true;
	}
	


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'cliente_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Você não selecionou um cliente para o estabelecimento.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'imagem'=> array(
			'valida_ext1'=> array(
				'rule'=> array('extension', array('jpg', 'jpeg', 'png')),
				'message'=> 'A imagem deve estar no formato \'JPG\' OU \'PNG\'.',
				'required'=> true,
				'allowEmpty'=> false,
				'on'=> 'create'
			),
			'valida_ext2'=> array(
				'rule'=> array('extension', array('jpg', 'jpeg', 'png')),
				'message'=> 'A imagem deve estar no formato \'JPG\' OU \'PNG\'.',
				'required'=> false,
				'allowEmpty'=> true,
				'on'=> 'update'
			),
			'valida_tamanho1'=> array(
				'rule'=> array('fileSize', '<=', '1MB'),
				'message'=> 'A imagem deve conter no máximo 1MB.',
				'required'=> true,
				'allowEmpty'=> false,
				'on'=> 'create'
			),
			'valida_tamanho2'=> array(
				'rule'=> array('fileSize', '<=', '1MB'),
				'message'=> 'A imagem deve conter no máximo 1MB.',
				'required'=> false,
				'allowEmpty'=> true,
				'on'=> 'update'
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O nome não pode ficar em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Já existe uma estabelecimento cadastrado com este nome.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'descricao' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'A descrição não pode ficar em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'max_length' => array(
				'rule' => array('maxLength', 300),
				'message' => 'A descrição deve conter no máximo 300 caracteres.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'endereco' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O endereço não pode ficar em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cidade' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'A cidade não pode ficar em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'telefone' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O telefone não pode ficar em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'horario_funcionamento_inicial' => array(
			'time' => array(
				'rule' => array('time'),
				'message' => 'Horário de funcionamento inicial inválido.',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'horario_funcionamento_final' => array(
			'time' => array(
				'rule' => array('time'),
				'message' => 'Horário de funcionamento final inválido.',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'slug' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O slug não pode ficar em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tipo_cadastro' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'imagem2'=> array(
			'valida_ext'=> array(
				'rule'=> array('extension', array('jpg', 'jpeg', 'png')),
				'message'=> 'A imagem extra 1 deve estar no formato \'JPG\' OU \'PNG\'.',
				'required'=> false,
				'allowEmpty'=> true,
			),
			'valida_tamanho2'=> array(
				'rule'=> array('fileSize', '<=', '1MB'),
				'message'=> 'A imagem extra 1 deve conter no máximo 1MB.',
				'required'=> false,
				'allowEmpty'=> true,
			),
		),
		'imagem3'=> array(
			'valida_ext'=> array(
				'rule'=> array('extension', array('jpg', 'jpeg', 'png')),
				'message'=> 'A imagem extra 2 deve estar no formato \'JPG\' OU \'PNG\'.',
				'required'=> false,
				'allowEmpty'=> true,
			),
			'valida_tamanho2'=> array(
				'rule'=> array('fileSize', '<=', '1MB'),
				'message'=> 'A imagem extra 2 deve conter no máximo 1MB.',
				'required'=> false,
				'allowEmpty'=> true,
			),
		),
		'inaugurado' => array(
			'valida_data' => array(
				'rule' => array('date'),
				'message' => 'A data de inauguração informada é inválida.',
				// 'required' => true,
				'allowEmpty' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'usuarios_administrativo_id' => array(
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
		'UsuariosAdministrativo' => array(
			'className' => 'UsuariosAdministrativo',
			'foreignKey' => 'usuarios_administrativo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Comentario' => array(
			'className' => 'Comentario',
			'foreignKey' => 'estabelecimento_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Destaque' => array(
			'className' => 'Destaque',
			'foreignKey' => 'estabelecimento_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Cartao' => array(
			'className' => 'Cartao',
			'joinTable' => 'cartoes_estabelecimentos',
			'foreignKey' => 'estabelecimento_id',
			'associationForeignKey' => 'cartao_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Categoria' => array(
			'className' => 'Categoria',
			'joinTable' => 'categorias_estabelecimentos',
			'foreignKey' => 'estabelecimento_id',
			'associationForeignKey' => 'categoria_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Subcategoria' => array(
			'className' => 'Subcategoria',
			'joinTable' => 'estabelecimentos_subcategorias',
			'foreignKey' => 'estabelecimento_id',
			'associationForeignKey' => 'subcategoria_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
