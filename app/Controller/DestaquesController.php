<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

App::uses('WideImage', 'Lib/WideImage/lib');
/**
 * Destaques Controller
 *
 * @property Destaque $Destaque
 * @property PaginatorComponent $Paginator
 */
class DestaquesController extends AppController {

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
	public function admin_index() {
		$options = array();
		if (!empty($this->request->query['q'])) {
			$q = str_replace(' ', '%', $this->request->query['q']);
			$options['conditions'][] = array('Destaque.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->Destaque->recursive = 0;

		$options['order'] = array('Destaque.ordem'=> 'asc');
		$this->Paginator->settings = $options;
		$this->set('destaques', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Destaque->exists($id)) {
			throw new NotFoundException(__('Invalid destaque'));
		}
		$options = array('conditions' => array('Destaque.' . $this->Destaque->primaryKey => $id));
		$this->set('destaque', $this->Destaque->find('first', $options));
	}

	public function _setImageName ($image_array) {
		$image_exploded = explode('.', $image_array['name']);
		$ext = array_pop($image_exploded);
		$image_name = $image_exploded[0];

		$this->request->data['Destaque']['imagem_540x390'] = $image_name . '-540x390.' . $ext;
		$this->request->data['Destaque']['imagem_70x70'] = $image_name . '-70x70.' . $ext;
	}

	public function _saveImage($image_array, $pasta_salvar) {
		$image = WideImage::load($image_array['tmp_name']);

		$image_exploded = explode('.', $image_array['name']);
		$ext = array_pop($image_exploded);
		$image_name = $image_exploded[0];

		$this->_setImageName($image_array);

		$image
			->resize(540, 390, 'outside')
			->crop('center', 'center', 540, 390)
			->saveToFile($pasta_salvar->path . DS . $image_name . '-540x390.' . $ext, 85);
		$image
			->resize(70, 70, 'outside')
			->crop('center', 'center', 70, 70)
			->saveToFile($pasta_salvar->path . DS . $image_name . '-70x70.' . $ext, 85);
	}	

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_form($id = null) {
		if ($this->request->is(array('post','put'))) {
			$erro = 0;
			$erro_desc = array();

			$tipo = $this->request->data['tipo'];

			//Valida valores se for do tipo 1
			if ($tipo == 1) {
				unset($this->request->data['Destaque']['estabelecimento_id']);

				$image_array = $this->request->data['Destaque']['imagem'];
				// Debugger::dump($this->request->data);
				// exit();

				if (empty($this->request->data['Destaque']['titulo'])) {
					$erro = 1;
					$erro_desc[] = 'Você não informou o título.';
				}

				if (!($image_array['error'] == 4 AND !empty($id))) {

					if ($this->request->data['Destaque']['imagem']['error'] == 4) {
						$erro = 1;
						$erro_desc[] = 'Você não adicionou uma imagem.';
					} elseif ($this->request->data['Destaque']['imagem']['error'] != 0) {
						$erro = 1;
						$erro_desc[] = 'Ocorreu um erro no upload da imagem.';
					}
					if ($this->request->data['Destaque']['imagem']['size'] > 2000000) {
						$erro = 1;
						$erro_desc[] = 'A imagem não pode ter mais de 2MB.';
					}
					if ($this->request->data['Destaque']['imagem']['type'] != 'image/jpeg' AND $this->request->data['Destaque']['imagem']['type'] != 'image/png') {
						$erro = 1;
						$erro_desc[] = 'A imagem deve estar no formato JPG ou PNG.';
					}

					if ($erro == 0) {
						$pasta_salvar = new Folder(
							WWW_ROOT . 'img' . DS . 'Carrossel',
							true,
							0755
						);
						$this->_saveImage($image_array, $pasta_salvar);
					}
				} else {
					unset($this->request->data['Destaque']['imagem']);
				}
			} else {
				if (!empty($this->request->data['Destaque']['estabelecimento_id'])) {
					$id = $this->request->data['Destaque']['id'];
					$this->request->data = array(
						'Destaque'=> array(
							'estabelecimento_id'=> $this->request->data['Destaque']['estabelecimento_id'],
							'ordem'=> $this->request->data['Destaque']['ordem']
						)
					);
					if (!empty($id)) {
						$this->request->data['Destaque']['id'] = $id;
					}
				} else {
					$erro = 1;
					$erro_desc[] = 'Você não informou o estabelecimento.';
				}
				
			}

			if ($erro == 0) {
				if (empty($id)) {
					$this->Destaque->create();
					unset($this->request->data['Destaque']['id']);
				}
				if ($this->Destaque->save($this->request->data)) {
					$this->Session->setFlash(__('O <strong>carrossel</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('O <strong>carrossel</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
				}
			} else {
				$this->Session->setFlash(join('<br>', $erro_desc), 'default', array('class'=> 'alert alert-danger', 'escape'=> false));
			}
		}

		if (!empty($id)) {
			$destaque = $this->Destaque->find('first', array('conditions'=> array('Destaque.id'=> $id)));
			$this->request->data = $destaque;
		}

		$estabelecimentos = $this->Destaque->Estabelecimento->find('list');
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
		if (!$this->Destaque->exists($id)) {
			throw new NotFoundException(__('Invalid destaque'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Destaque->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>destaque</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>destaque</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Destaque.' . $this->Destaque->primaryKey => $id));
			$this->request->data = $this->Destaque->find('first', $options);
		}
		$estabelecimentos = $this->Destaque->Estabelecimento->find('list');
		$this->set(compact('estabelecimentos'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Destaque->id = $id;
		if (!$this->Destaque->exists()) {
			throw new NotFoundException(__('Invalid destaque'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Destaque->delete()) {
			$this->Session->setFlash(__('O <strong>destaque</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
		} else {
			$this->Session->setFlash(__('O <strong>destaque</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
