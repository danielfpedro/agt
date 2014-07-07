<?php
App::uses('AppController', 'Controller');
/**
 * Protos Controller
 *
 * @property Proto $Proto
 * @property PaginatorComponent $Paginator
 */
class ProtosController extends AppController {

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
			$options['conditions'][] = array('Proto.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->Proto->recursive = 0;

		$this->Paginator->settings = $options;
		$this->set('protos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Proto->exists($id)) {
			throw new NotFoundException(__('Invalid proto'));
		}
		$options = array('conditions' => array('Proto.' . $this->Proto->primaryKey => $id));
		$this->set('proto', $this->Proto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Proto->create();
			if ($this->Proto->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>proto</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>proto</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Proto->exists($id)) {
			throw new NotFoundException(__('Invalid proto'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Proto->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>proto</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>proto</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Proto.' . $this->Proto->primaryKey => $id));
			$this->request->data = $this->Proto->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Proto->id = $id;
		if (!$this->Proto->exists()) {
			throw new NotFoundException(__('Invalid proto'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Proto->delete()) {
			$this->Session->setFlash(__('O <strong>proto</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
		} else {
			$this->Session->setFlash(__('O <strong>proto</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$options = array();
		if (!empty($this->request->query['q'])) {
			$q = str_replace(' ', '%', $this->request->query['q']);
			$options['conditions'][] = array('Proto.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->Proto->recursive = 0;

		$this->Paginator->settings = $options;
		$this->set('protos', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Proto->exists($id)) {
			throw new NotFoundException(__('Invalid proto'));
		}
		$options = array('conditions' => array('Proto.' . $this->Proto->primaryKey => $id));
		$this->set('proto', $this->Proto->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Proto->create();
			if ($this->Proto->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>proto</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>proto</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
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
	public function admin_edit($id = null) {
		if (!$this->Proto->exists($id)) {
			throw new NotFoundException(__('Invalid proto'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Proto->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>proto</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>proto</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Proto.' . $this->Proto->primaryKey => $id));
			$this->request->data = $this->Proto->find('first', $options);
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
		$this->Proto->id = $id;
		if (!$this->Proto->exists()) {
			throw new NotFoundException(__('Invalid proto'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Proto->delete()) {
			$this->Session->setFlash(__('O <strong>proto</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
		} else {
			$this->Session->setFlash(__('O <strong>proto</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
