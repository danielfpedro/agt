<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('WideImage', 'Lib/WideImage/lib');
/**
 * Anuncios Controller
 *
 * @property Anuncio $Anuncio
 * @property PaginatorComponent $Paginator
 */
class AnunciosController extends AppController {

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
			$options['conditions'][] = array('Anuncio.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->Anuncio->recursive = 0;

		$this->Paginator->settings = $options;
		$this->set('anuncios', $this->Paginator->paginate());
	}

	public function admin_edit($id = null) {
		if (!$this->Anuncio->exists($id)) {
			throw new NotFoundException(__('Invalid anuncio'));
		}

		$options = array('conditions' => array('Anuncio.' . $this->Anuncio->primaryKey => $id));
		$banner = $this->Anuncio->find('first', $options);
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Anuncio->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>banner</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash($this->Anuncio->validationErrorMessage(), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$this->request->data = $banner;
		}

		$this->set('largura', $banner['Anuncio']['largura']);
		$this->set('altura', $banner['Anuncio']['altura']);
		$this->set('imagem', $banner['Anuncio']['imagem']);
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Anuncio->id = $id;
		if (!$this->Anuncio->exists()) {
			throw new NotFoundException(__('Invalid anuncio'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Anuncio->delete()) {
			$this->Session->setFlash(__('O <strong>anuncio</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
		} else {
			$this->Session->setFlash(__('O <strong>anuncio</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
