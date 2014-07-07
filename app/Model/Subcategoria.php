<?php
App::uses('AppModel', 'Model');
/**
 * Subcategoria Model
 *
 * @property Estabelecimento $Estabelecimento
 */
class Subcategoria extends AppModel {

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

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
				'message' => 'Já existe uma subcategoria cadastrada com este nome.',
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
			'joinTable' => 'estabelecimentos_subcategorias',
			'foreignKey' => 'subcategoria_id',
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
