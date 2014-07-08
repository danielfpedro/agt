<?php
App::uses('AppModel', 'Model');
/**
 * Anuncio Model
 *
 */
class Anuncio extends AppModel {

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
		$options['conditions'] = array('Categoria.id'=> $this->id);
		$imagem = $this->find('first', $options);
		$this->imagem = $imagem['Categoria']['imagem'];

		return true;
	}
	
	public function afterDelete() {
		$file = new File(WWW_ROOT . 'img' . DS . 'Categorias' . DS . $this->imagem, true, 0755);
		$file->delete();
		return true;
	}
	

	public function beforeSave($options = array()) {
		$pasta_salvar = new Folder(WWW_ROOT . 'img' . DS . 'Banners', true, 0755);
		if (!empty($this->data['Anuncio']['imagem'])) {
			$this->uploadImage(
				$this->data['Anuncio']['imagem'],
				$this->data['Anuncio']['largura'],
				$this->data['Anuncio']['altura'],
				$pasta_salvar);
		}
		return true;
	}

	
	public function uploadImage($image_array, $w, $h, $pasta_salvar) {

		$image = WideImage::load($image_array['tmp_name']);
		$extension = pathinfo($image_array['name'], PATHINFO_EXTENSION);

		$new_name = Inflector::slug(strtolower($this->data['Anuncio']['name']), '-') . '.' . $extension;
		$image
			->resize($w, $h, 'outside')
			->crop('center', 'center', $w, $h)
			->saveToFile($pasta_salvar->path . DS . $new_name, 85);
		$this->data['Anuncio']['imagem'] = $new_name;
	}


	public function beforeValidate($options = array()) {
		if (!empty($this->data['Anuncio']['id'])) {
			if ($this->data['Anuncio']['imagem']['error'] == 4) {
				unset($this->data['Anuncio']['imagem']);
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
			'valida_ext2'=> array(
				'rule'=> array('extension', array('jpg', 'jpeg', 'png')),
				'message'=> 'A imagem deve estar no formato \'JPG\' OU \'PNG\'.',
				'required'=> false,
				'allowEmpty'=> true,
				'on'=> 'update'
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
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
