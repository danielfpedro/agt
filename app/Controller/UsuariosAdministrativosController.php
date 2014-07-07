<?php
App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * UsuariosAdministrativos Controller
 *
 * @property UsuariosAdministrativo $UsuariosAdministrativo
 * @property PaginatorComponent $Paginator
 */
class UsuariosAdministrativosController extends AppController {

public $layout = 'BootstrapAdmin.default';	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Session');

/**
 * admin_index method
 *
 * @return void
 */

	public function admin_login() {
		$this->layout = 'BootstrapAdmin.login';

		if ($this->request->is('post')) {
			if ($this->_admin_logar($this->request->data['UsuariosAdministrativo']['name'], $this->request->data['UsuariosAdministrativo']['senha'])) {
				return $this->redirect(array('controller'=> 'estabelecimentos', 'action'=> 'admin_index'));
			} else {
				$this->Session->setFlash('A combinação email/senha não foi informada corretamente.', 'default', array('class'=> 'alert alert-danger'));
			}
		}

		$this->set('title_for_layout', 'Painel Administrativo - ' . $this->site_name);
	}	
	public function _admin_logar($login, $senha) {

		$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
		$senha = $passwordHasher->hash($senha);

		$options = array();
		$options['fields'] = array('UsuariosAdministrativo.id', 'UsuariosAdministrativo.name');
		$options['conditions'] = array(
			'UsuariosAdministrativo.name'=> $login,
			'UsuariosAdministrativo.senha'=> $senha
		);
		$this->UsuariosAdministrativo->recursive = -1;
		$query = $this->UsuariosAdministrativo->find('first', $options);

		if (!empty($query)) {
			$this->_loginVars($query);
			return true;
		} else {
			return false;
		}
	}

	public function _loginVars ($usuario) {
		$this->Cookie->write('Auth_admin.id', $usuario['UsuariosAdministrativo']['id']);
		$this->Cookie->write('Auth_admin.login', $usuario['UsuariosAdministrativo']['name']);
	}

	public function admin_logout() {
		$this->Cookie->destroy();
		return $this->redirect(array('controller'=> 'usuariosAdministrativos', 'action'=> 'login'));
	}

	public function admin_index() {
		$options = array();
		if (!empty($this->request->query['q'])) {
			$q = str_replace(' ', '%', $this->request->query['q']);
			$options['conditions'][] = array('UsuariosAdministrativo.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->UsuariosAdministrativo->recursive = 0;

		$this->Paginator->settings = $options;
		$this->set('usuariosAdministrativos', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UsuariosAdministrativo->exists($id)) {
			throw new NotFoundException(__('Invalid usuarios administrativo'));
		}
		$options = array('conditions' => array('UsuariosAdministrativo.' . $this->UsuariosAdministrativo->primaryKey => $id));
		$this->set('usuariosAdministrativo', $this->UsuariosAdministrativo->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			if (!empty($this->request->data['UsuariosAdministrativo']['senha'])) {
				$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
					$this->request->data['UsuariosAdministrativo']['senha'] = $passwordHasher->hash(
					$this->request->data['UsuariosAdministrativo']['senha']
				);
			}
			$this->UsuariosAdministrativo->create();
			if ($this->UsuariosAdministrativo->save($this->request->data)) {
				$this->Session->setFlash(__('O seu usuário foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O usuário não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit() {
		$id = $this->Auth_vars['id'];

		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['UsuariosAdministrativo']['id'] = $id;

			if (!empty($this->request->data['UsuariosAdministrativo']['fake_senha'])) {
				$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
					$this->request->data['UsuariosAdministrativo']['senha'] = $passwordHasher->hash(
					$this->request->data['UsuariosAdministrativo']['fake_senha']
				);
			}

			if ($this->UsuariosAdministrativo->save($this->request->data)) {
				$this->Session->setFlash(__('O usuário foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				$this->_loginVars($this->request->data);
				return $this->redirect(array('action' => 'edit'));
			} else {
				$this->Session->setFlash(__('O usuário não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('UsuariosAdministrativo.' . $this->UsuariosAdministrativo->primaryKey => $id));
			$this->request->data = $this->UsuariosAdministrativo->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UsuariosAdministrativo->id = $id;
		if (!$this->UsuariosAdministrativo->exists()) {
			throw new NotFoundException(__('Invalid usuarios administrativo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UsuariosAdministrativo->delete()) {
			$this->Session->setFlash(__('O <strong>usuarios administrativo</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
		} else {
			$this->Session->setFlash(__('O <strong>usuarios administrativo</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
