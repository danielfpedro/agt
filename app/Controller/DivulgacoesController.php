<?php
App::uses('AppController', 'Controller');
/**
 * Divulgacoes Controller
 *
 * @property Divulgacao $Divulgacao
 * @property PaginatorComponent $Paginator
 */
class DivulgacoesController extends AppController {

public $layout = 'BootstrapAdmin.default';	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$options = array();
		if (!empty($this->request->query['q'])) {
			$q = str_replace(' ', '%', $this->request->query['q']);
			$options['conditions'][] = array('Divulgacao.email LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->Divulgacao->recursive = 0;

		$this->Paginator->settings = $options;
		$this->set('divulgacoes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Divulgacao->exists($id)) {
			throw new NotFoundException(__('Invalid divulgacao'));
		}
		$options = array('conditions' => array('Divulgacao.' . $this->Divulgacao->primaryKey => $id));
		$this->set('divulgacao', $this->Divulgacao->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Divulgacao->create();
			if ($this->Divulgacao->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>divulgacao</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>divulgacao</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
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
		if (!$this->Divulgacao->exists($id)) {
			throw new NotFoundException(__('Invalid divulgacao'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Divulgacao->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>divulgacao</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>divulgacao</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Divulgacao.' . $this->Divulgacao->primaryKey => $id));
			$this->request->data = $this->Divulgacao->find('first', $options);
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
		$this->Divulgacao->id = $id;
		if (!$this->Divulgacao->exists()) {
			throw new NotFoundException(__('Invalid divulgacao'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Divulgacao->delete()) {
			$this->Session->setFlash(__('O <strong>email</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('O <strong>email</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
