<?php
App::uses('AppController', 'Controller');
/**
 * Subcategorias Controller
 *
 * @property Subcategoria $Subcategoria
 * @property PaginatorComponent $Paginator
 */
class SubcategoriasController extends AppController {

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
			$options['conditions'][] = array('Subcategoria.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->Subcategoria->recursive = 0;

		$options['order'] = array('Subcategoria.name');
		$this->Paginator->settings = $options;
		$this->set('subcategorias', $this->Paginator->paginate());
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Subcategoria->create();
			if ($this->Subcategoria->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>subcategoria</strong> foi salva com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash($this->Subcategoria->validationErrorMessage(), 'default', array('class'=> 'alert alert-danger'));
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
		if (!$this->Subcategoria->exists($id)) {
			throw new NotFoundException(__('Invalid subcategoria'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Subcategoria->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>subcategoria</strong> foi salva com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash($this->Subcategoria->validationErrorMessage(), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Subcategoria.' . $this->Subcategoria->primaryKey => $id));
			$this->request->data = $this->Subcategoria->find('first', $options);
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
		$this->Subcategoria->id = $id;
		if (!$this->Subcategoria->exists()) {
			throw new NotFoundException(__('Invalid subcategoria'));
		}
		$this->request->onlyAllow('post', 'delete');

		$total = $this->Subcategoria->EstabelecimentosSubcategoria->find('count', array(
			'conditions'=> array(
				'EstabelecimentosSubcategoria.subcategoria_id'=> $id
				)
			)
		);

		if ($total == 0) {
			if ($this->Subcategoria->delete()) {
				$this->Session->setFlash(__('O <strong>subcategoria</strong> foi deletada com sucesso.'), 'default', array('class'=> 'alert alert-success'));
			} else {
				$this->Session->setFlash(__('O <strong>subcategoria</strong> não pode ser deletada, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$this->Session->setFlash(__('O <strong>subcategoria</strong> não pode ser deletada pois ela tem estabelecimentos ligados a ela.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
