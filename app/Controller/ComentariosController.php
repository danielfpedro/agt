<?php
App::uses('AppController', 'Controller');
/**
 * Comentarios Controller
 *
 * @property Comentario $Comentario
 * @property PaginatorComponent $Paginator
 */
class ComentariosController extends AppController {

public $layout = 'BootstrapAdmin.default';	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$options = array();
		if (!empty($this->request->query['q'])) {
			$q = str_replace(' ', '%', $this->request->query['q']);
			$options['conditions'][] = array('Comentario.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->Comentario->recursive = 0;

		$this->Paginator->settings = $options;
		$this->set('comentarios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Comentario->exists($id)) {
			throw new NotFoundException(__('Invalid comentario'));
		}
		$options = array('conditions' => array('Comentario.' . $this->Comentario->primaryKey => $id));
		$this->set('comentario', $this->Comentario->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Comentario->create();
			$this->request->data['Comentario']['usuario_id'] = 1;
			if ($this->Comentario->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>comentario</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>comentario</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		}
		$usuarios = $this->Comentario->Usuario->find('list');
		$estabelecimentos = $this->Comentario->Estabelecimento->find('list');
		$this->set(compact('usuarios', 'estabelecimentos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Comentario->exists($id)) {
			throw new NotFoundException(__('Invalid comentario'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Comentario->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>comentario</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>comentario</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Comentario.' . $this->Comentario->primaryKey => $id));
			$this->request->data = $this->Comentario->find('first', $options);
		}
		$usuarios = $this->Comentario->Usuario->find('list');
		$estabelecimentos = $this->Comentario->Estabelecimento->find('list');
		$this->set(compact('usuarios', 'estabelecimentos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Comentario->id = $id;
		if (!$this->Comentario->exists()) {
			throw new NotFoundException(__('Invalid comentario'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Comentario->delete()) {
			$this->Session->setFlash(__('O <strong>comentario</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
		} else {
			$this->Session->setFlash(__('O <strong>comentario</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */

	public function admin_status_ajax($id = null, $status = null) {
		$this->autoRender = false;
		if (!is_null($id) AND !is_null($status)) {
			$status = ($status == 0) ? 1 : 0;
			if ($this->Comentario->save(array('id'=> $id, 'ativo'=> $status))) {
				return true;

			} else {
				return false;	
			}
		} else {
			return false;
		}
	}
	public function admin_index() {
		$options = array();
		if (!empty($this->request->query['q'])) {
			$q = str_replace(' ', '%', $this->request->query['q']);
			$options['conditions'][] = array('Comentario.texto LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}

		if (!empty($this->request->query['estabelecimento'])) {
			$estabelecimento = $this->request->query['estabelecimento'];
			$options['conditions'][] = array('Comentario.estabelecimento_id'=> $estabelecimento);
		} else {
			$this->request->query['estabelecimento'] = '';
		}

		if (!empty($this->request->query['ativo'])) {
			$ativo = $this->request->query['ativo'];
			$ativo = ($ativo == 1) ? 1 : 0;
			$options['conditions'][] = array('Comentario.ativo'=> $ativo);
		} else {	
			$this->request->query['ativo'] = '';
		}

		$this->Comentario->recursive = 2;

		$options['order'] = array('Comentario.created'=> 'DESC');

		$this->Paginator->settings = $options;
		$this->set('comentarios', $this->Paginator->paginate());

		$estabelecimentos = $this->Comentario->Estabelecimento->find('list');
		$this->set(compact('estabelecimentos'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Comentario->exists($id)) {
			throw new NotFoundException(__('Invalid comentario'));
		}
		$options = array('conditions' => array('Comentario.' . $this->Comentario->primaryKey => $id));
		$this->set('comentario', $this->Comentario->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Comentario->create();
			if ($this->Comentario->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>comentario</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>comentario</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		}
		$usuarios = $this->Comentario->Usuario->find('list');
		$estabelecimentos = $this->Comentario->Estabelecimento->find('list');
		$this->set(compact('usuarios', 'estabelecimentos'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Comentario->exists($id)) {
			throw new NotFoundException(__('Invalid comentario'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Comentario->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>comentario</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>comentario</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Comentario.' . $this->Comentario->primaryKey => $id));
			$this->request->data = $this->Comentario->find('first', $options);
		}
		$usuarios = $this->Comentario->Usuario->find('list');
		$estabelecimentos = $this->Comentario->Estabelecimento->find('list');
		$this->set(compact('usuarios', 'estabelecimentos'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Comentario->id = $id;
		if (!$this->Comentario->exists()) {
			throw new NotFoundException(__('Invalid comentario'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Comentario->delete()) {
			$this->Session->setFlash(__('O <strong>comentario</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
		} else {
			$this->Session->setFlash(__('O <strong>comentario</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
