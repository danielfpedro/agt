<?php
App::uses('AppController', 'Controller');
/**
 * HomeDestaques Controller
 *
 * @property HomeDestaque $HomeDestaque
 * @property PaginatorComponent $Paginator
 */
class HomeDestaquesController extends AppController {

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
			$options['conditions'][] = array('HomeDestaque.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->HomeDestaque->recursive = 0;

		$this->Paginator->settings = $options;
		$this->set('homeDestaques', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->HomeDestaque->exists($id)) {
			throw new NotFoundException(__('Invalid home destaque'));
		}
		$options = array('conditions' => array('HomeDestaque.' . $this->HomeDestaque->primaryKey => $id));
		$this->set('homeDestaque', $this->HomeDestaque->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->HomeDestaque->create();
			if ($this->HomeDestaque->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>home destaque</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>home destaque</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
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
		if (!$this->HomeDestaque->exists($id)) {
			throw new NotFoundException(__('Invalid home destaque'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->HomeDestaque->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>home destaque</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>home destaque</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('HomeDestaque.' . $this->HomeDestaque->primaryKey => $id));
			$this->request->data = $this->HomeDestaque->find('first', $options);
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
		$this->HomeDestaque->id = $id;
		if (!$this->HomeDestaque->exists()) {
			throw new NotFoundException(__('Invalid home destaque'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HomeDestaque->delete()) {
			$this->Session->setFlash(__('O <strong>home destaque</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
		} else {
			$this->Session->setFlash(__('O <strong>home destaque</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
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
			$options['conditions'][] = array('HomeDestaque.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->HomeDestaque->recursive = 0;

		$this->Paginator->settings = $options;
		$this->set('homeDestaques', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->HomeDestaque->exists($id)) {
			throw new NotFoundException(__('Invalid home destaque'));
		}
		$options = array('conditions' => array('HomeDestaque.' . $this->HomeDestaque->primaryKey => $id));
		$this->set('homeDestaque', $this->HomeDestaque->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->HomeDestaque->create();
			if ($this->HomeDestaque->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>home destaque</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>home destaque</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
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
		if (!$this->HomeDestaque->exists($id)) {
			throw new NotFoundException(__('Invalid home destaque'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->HomeDestaque->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>home destaque</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>home destaque</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('HomeDestaque.' . $this->HomeDestaque->primaryKey => $id));
			$this->request->data = $this->HomeDestaque->find('first', $options);
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
		$this->HomeDestaque->id = $id;
		if (!$this->HomeDestaque->exists()) {
			throw new NotFoundException(__('Invalid home destaque'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HomeDestaque->delete()) {
			$this->Session->setFlash(__('O <strong>home destaque</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
		} else {
			$this->Session->setFlash(__('O <strong>home destaque</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
