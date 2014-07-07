<?php
App::uses('AppModel', 'Model');
/**
 * Cartao Model
 *
 * @property Estabelecimento $Estabelecimento
 */
class Cartao extends AppModel {

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
		$options['fields'] = array('imagem');
		$options['conditions'] = array('Cartao.id'=> $this->id);
		$imagem = $this->find('first', $options);
		$this->imagem = $imagem['Cartao']['imagem'];

		return true;
	}
	
	public function afterDelete() {
		$file = new File(WWW_ROOT . 'img' . DS . 'Cartoes' . DS . $this->imagem, true, 0755);
		$file->delete();
		return true;
	}
	

	public function beforeSave($options = array()) {
		$pasta_salvar = new Folder(WWW_ROOT . 'img' . DS . 'Cartoes', true, 0755);
		if (!empty($this->data['Cartao']['imagem'])) {
			$this->uploadImage($this->data['Cartao']['imagem'], 51, 32, $pasta_salvar);
		}
		return true;
	}

	
	public function uploadImage($image_array, $w, $h, $pasta_salvar) {

		$image = WideImage::load($image_array['tmp_name']);
		$extension = pathinfo($image_array['name'], PATHINFO_EXTENSION);

		$new_name = Inflector::slug($this->data['Cartao']['name'], '-') . '.' . $extension;
		$image
			->resize($w, $h, 'outside')
			->crop('center', 'center', $w, $h)
			->saveToFile($pasta_salvar->path . DS . $new_name, 85);
		$this->data['Cartao']['imagem'] = $new_name;
	}


	public function beforeValidate($options = array()) {
		if (!empty($this->data['Cartao']['id'])) {
			if ($this->data['Cartao']['imagem']['error'] == 4) {
				unset($this->data['Cartao']['imagem']);
			}
		}

		return true;
	}


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Já existe outro cartão cadastrado com este nome.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Estabelecimento' => array(
			'className' => 'Estabelecimento',
			'joinTable' => 'cartoes_estabelecimentos',
			'foreignKey' => 'cartao_id',
			'associationForeignKey' => 'estabelecimento_id',
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
