<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

App::uses('WideImage', 'Lib/WideImage/lib');
/**
 * Cartoes Controller
 *
 * @property Cartao $Cartao
 * @property PaginatorComponent $Paginator
 */
class CartoesController extends AppController {

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
			$options['conditions'][] = array('Cartao.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->Cartao->recursive = 0;

		$this->Paginator->settings = $options;
		$this->set('cartoes', $this->Paginator->paginate());
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Cartao->create();
			if ($this->Cartao->save($this->request->data)) {

				$this->Session->setFlash(__('O <strong>cartão</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {

				$this->Session->setFlash($this->Cartao->validationErrorMessage(), 'default', array('class'=> 'alert alert-danger'));
			}
		}
		$estabelecimentos = $this->Cartao->Estabelecimento->find('list');
		$this->set(compact('estabelecimentos'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cartao->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>cartão</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {

				$this->Session->setFlash($this->Cartao->validationErrorMessage(), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$this->request->data = $this->Cartao->find('first', array('conditions'=> array('Cartao.id'=> $id)));	
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
		$this->Cartao->id = $id;
		if (!$this->Cartao->exists()) {
			throw new NotFoundException(__('Invalid cartao'));
		}
		$this->request->onlyAllow('post', 'delete');

		$total = $this->Cartao->CartoesEstabelecimento->find('count', array('CartoesEstabelecimentos.cartao_id'=> $id));
		if ($total == 0) {
			if ($this->Cartao->delete()) {
				$this->Session->setFlash(__('O <strong>cartão</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-success'));
			} else {
				$this->Session->setFlash(__('O <strong>cartão</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$this->Session->setFlash(__('O <strong>cartão</strong> não pode ser deletado pois ele está ligado a pelo menos um estabelecimento, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}

		return $this->redirect(array('action' => 'index'));
	}}
