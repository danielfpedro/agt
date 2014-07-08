<?php
App::uses('AppModel', 'Model');
/**
 * Usuario Model
 *
 * @property Comentario $Comentario
 * @property Perfil $Perfil
 */
class Usuario extends AppModel {

	public $actsAs = array('Containable');	


	public function isUniqueOnUpdate($fields) {
		// $options['conditions'] = array(
		// 	'Usuario.email'=> $fields['email'],
		// 	'Usuario.email !='=> $this->data['Usuario']['email_antigo']
		// );
		// $check = $this->find('count', $options);
		// return ($check == 0) ? true : false;
		return true;
	}

	public function confirma_senha($field) {
		if ($field['senha'] != '' AND ($field['senha'] == $this->data['Usuario']['repetir_senha'])) {
			return true;
		} else {
			return false;
		}
	}


	public function confirma_nova_senha($field) {
		if (!empty($this->data['Usuario']['nova_senha'])) {
			if ($this->data['Usuario']['nova_senha'] == $this->data['Usuario']['repetir_senha']) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	public function confirma_senha_atual($field) {
		if (!empty($this->data['Usuario']['nova_senha'])) {
			$senha = AuthComponent::password($field['senha']);
			$options['conditions'] = array(
				'Usuario.id'=> $this->data['Usuario']['id'],
				'Usuario.senha'=> $senha
			);
			$check = $this->find('count', $options);
			return ($check == 0) ? false : true;
		} else {
			return true;
		}
	}

	public function tamanho_nova_senha () {
		if (!empty($this->data['Usuario']['nova_senha'])) {
			$tamanho = strlen($this->data['Usuario']['nova_senha']);
			if ($tamanho < 6 OR $tamanho > 10) {
				return false;
			}
		}
		return true;
	}

	public function beforeSave($options = array()) {
		if (!empty($this->data['Usuario']['id'])) {
			if (!empty($this->data['Usuario']['nova_senha'])) {
				$this->data['Usuario']['senha'] = $this->data['Usuario']['nova_senha'];
			}
		}
        if (!empty($this->data['Usuario']['senha'])) {
        	$this->data[$this->alias]['senha'] = AuthComponent::password($this->data[$this->alias]['senha']);
 	  		return true;
        } else {
        	unset($this->data['Usuario']['senha']);
        }
        return true;
    }

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Você informou um email inválido.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'O email informado já está sendo usado por outro usuário.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			// 'uniqueOnUpdate' => array(
			// 	'rule' => array('isUniqueOnUpdate'),
			// 	'message' => 'O email informado já está sendo usado por outro usuário.',
			// 	'on' => 'update',
			// ),
		),
		'senha' => array(
			'between'=> array(
				'rule'=> array('between', 6, 10),
				'message'=> 'A senha deve conter no mínimo 6 e no máximo 10 caracteres.',
				'on'=> 'create'
			),
			'confirma_senha'=> array(
				'rule'=> array('confirma_senha'),
				'message'=> 'Você não confirmou a sua senha corretamente.',
				'on'=> 'create'
			),
			'confirma_nova_senha'=> array(
				'rule'=> array('confirma_nova_senha'),
				'message'=> 'Você não confirmou a sua nova senha corretamente.',
				'on'=> 'update',
				'last'=> false
			),
			'tamanho_nova_senha'=> array(
				'rule'=> array('tamanho_nova_senha'),
				'message'=> 'A sua nova senha deve conter no mínimo 6 e no máximo 10 caracteres.',
				'on'=> 'update',
			),
			'confirma_senha_atual'=> array(
				'rule'=> array('confirma_senha_atual'),
				'message'=> 'Você não informou a sua senha atual corretamente.',
				'on'=> 'update',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Comentario' => array(
			'className' => 'Comentario',
			'foreignKey' => 'usuario_id',
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

	public $hasOne = array(
		'Perfil' => array(
			'className' => 'Perfil',
			'foreignKey' => 'usuario_id',
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

}
