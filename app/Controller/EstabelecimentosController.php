<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

App::uses('WideImage', 'Lib/WideImage/lib');
/**
 * Estabelecimentos Controller
 *
 * @property Estabelecimento $Estabelecimento
 * @property PaginatorComponent $Paginator
 */
class EstabelecimentosController extends AppController {

public $layout = 'BootstrapAdmin.default';	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'DataUtil');

/**
 * admin_index method
 *
 * @return void
 */

	public function setCarrossel($id = null, $value = null) {
		if (is_null($id) OR is_null($value)) {
			return false;
		}
		if (!$this->Estabelecimento->save(array('id'=> $id, 'carrossel'=> $value))) {
			return false;
		}
		$this->autoRender = false;
		return true;
	}

	public function admin_index() {
		$options = array();
		if (!empty($this->request->query['q'])) {
			$q = str_replace(' ', '%', $this->request->query['q']);
			$options['conditions'][] = array('Estabelecimento.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}

		if (!empty($this->request->query['categoria'])) {
			$categoria = $this->request->query['categoria'];

			$query = $this->Estabelecimento->CategoriasEstabelecimento->find('all',
				array(
					'recursive'=> -1,
					'fields'=> array('estabelecimento_id'),
					'conditions'=> array(
						'CategoriasEstabelecimento.categoria_id'=> $categoria
				)));

			$estabelecimentos_ids = array();

			if (!empty($query)) {
				foreach ($query as $row) {
					$estabelecimentos_ids[] = $row['CategoriasEstabelecimento']['estabelecimento_id'];
				}
			}
			$options['conditions'][] = array('Estabelecimento.id'=> $estabelecimentos_ids);
		} else {
			$this->request->query['categoria'] = '';	
		}

		if (!empty($this->request->query['carrossel'])) {
			$carrossel = $this->request->query['carrossel'];
			$options['conditions'][] = array('Estabelecimento.carrossel'=> $carrossel);
		} else {
			$this->request->query['carrossel'] = '';	
		}

		$this->Estabelecimento->recursive = -1;
		$options['contain'] = array('Categoria', 'Subcategoria');

		$options['order'] = array('Estabelecimento.created'=> 'desc');
		$this->Paginator->settings = $options;
		$this->set('estabelecimentos', $this->Paginator->paginate());

		$categorias = $this->Estabelecimento->Categoria->find('list');

		$this->set(compact('categorias'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Estabelecimento->exists($id)) {
			throw new NotFoundException(__('Invalid estabelecimento'));
		}
		$options = array('conditions' => array('Estabelecimento.' . $this->Estabelecimento->primaryKey => $id));
		$this->set('estabelecimento', $this->Estabelecimento->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {

		if ($this->request->is('post')) {

			$this->Estabelecimento->create();
			if ($this->Estabelecimento->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>estabelecimento</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash($this->Estabelecimento->validationErrorMessage(), 'default', array('class'=> 'alert alert-danger'));
			}
			// $erro = 0;
			
			// $image_array = $this->request->data['Estabelecimento']['imagem'];
			// $this->request->data['Estabelecimento']['imagem'] = $this->request->data['Estabelecimento']['imagem']['name'];
			// $this->request->data['Estabelecimento']['usuarios_administrativo_id'] = 1;
			// $this->request->data['Estabelecimento']['slug'] = Inflector::slug($this->request->data['Estabelecimento']['name'], '-');

			// if ($this->request->data['Estabelecimento']['horario_funcionamento_inicial'] > '23:59' AND $erro == 0) {
			// 	$this->Session->setFlash(__('O horário de funcionamento inicial do <strong>estabelecimento</strong> não foi informado corretamente.'), 'default', array('class'=> 'alert alert-danger'));
			// 	$erro = 1;
			// }

			// if ($this->request->data['Estabelecimento']['horario_funcionamento_final'] > '23:59' AND $erro == 0) {
			// 	$this->Session->setFlash(__('O horário de funcionamento final do <strong>estabelecimento</strong> não foi informado corretamente.'), 'default', array('class'=> 'alert alert-danger'));
			// 	$erro = 1;
			// }

			// if ($image_array['type'] == 'image/jpeg' OR $image_array['type'] == 'image/png') {
			// 	if ($this->request->data['Estabelecimento']['tipo_cadastro'] == 2 AND $erro == 0) {
			// 		$data_inaugurado_fake = $this->DataUtil->setPadrao($this->request->data['Estabelecimento']['inaugurado']);
			// 		if (!strtotime($data_inaugurado_fake)) {
			// 			$this->Session->setFlash(__('A data de inauguração do <strong>estabelecimento</strong> não foi informado corretamente.'), 'default', array('class'=> 'alert alert-danger'));
			// 			$erro = 1;
			// 		} else {
			// 			$this->request->data['Estabelecimento']['inaugurado'] = $data_inaugurado_fake;
			// 		}
			// 	}
			// 	if ($erro == 0) {
			// 		$this->_setImageNames($image_array);

			// 		$this->Estabelecimento->create();
			// 		if ($this->Estabelecimento->save($this->request->data)) {
			// 			$pasta_salvar = new Folder(WWW_ROOT . 'img' . DS . 'Estabelecimentos' . DS . $this->Estabelecimento->id, true, 0755);
			// 			$this->_saveImages($image_array, $pasta_salvar);

			// 			$this->Session->setFlash(__('O <strong>estabelecimento</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
			// 			return $this->redirect(array('action' => 'index'));
			// 		} else {
			// 			$this->Session->setFlash(__('O <strong>estabelecimento</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			// 		}
			// 	}
			// } else {
			// 	$this->Session->setFlash(__('A <strong>imagem</strong> deve estar no formato JPG ou PNG.'),
			// 		'default',
			// 		array('class'=> 'alert alert-danger'));
			// }
		}
		$categorias = $this->Estabelecimento->Categoria->find('list');
		
		$cartoes = $this->Estabelecimento->Cartao->find('list');

		$clientes = $this->Estabelecimento->Cliente->find('list');

		$subcategorias = $this->Estabelecimento->Subcategoria->find('list');

		$usuariosAdministrativos = $this->Estabelecimento->UsuariosAdministrativo->find('list');
		$this->set(compact('categorias', 'usuariosAdministrativos', 'cartoes', 'subcategorias', 'clientes'));
	}

	public function _setImageNames ($image_array) {
		$image_exploded = explode('.', $image_array['name']);
		$ext = array_pop($image_exploded);
		$image_name = $image_exploded[0];

		$this->request->data['Estabelecimento']['imagem_70x70'] = $image_name . '-70x70.' . $ext;
		$this->request->data['Estabelecimento']['imagem_300x170'] = $image_name . '-300x170.' . $ext;
		$this->request->data['Estabelecimento']['imagem_540x390'] = $image_name . '-540x390.' . $ext;
	}

	public function _saveImages($image_array, $pasta_salvar) {
		$image = WideImage::load($image_array['tmp_name']);

		$image_exploded = explode('.', $image_array['name']);
		$ext = array_pop($image_exploded);
		$image_name = $image_exploded[0];

		$this->_setImageNames($image_array);

		$image
			->resize(70, 67, 'outside')
			->crop('center', 'center', 70, 66)
			->saveToFile($pasta_salvar->path . DS . $image_name . '-70x70.' . $ext, 85);
		$image
			->resize(300, 170, 'outside')
			->crop('center', 'center', 300, 170)
			->saveToFile($pasta_salvar->path . DS . $image_name . '-300x170.' . $ext, 85);
		$image
			->resize(540, 390, 'outside')
			->crop('center', 'center', 540, 390)
			->saveToFile($pasta_salvar->path . DS . $image_name . '-540x390.' . $ext, 85);
		$image
			->saveToFile($pasta_salvar->path . DS . 'original_' . $image_array['name'], 85);
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Estabelecimento->exists($id)) {
			throw new NotFoundException(__('Invalid estabelecimento'));
		}

		$erro = 0;

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Estabelecimento->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>estabelecimento</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash($this->Estabelecimento->validationErrorMessage(), 'default', array('class'=> 'alert alert-danger'));
			}
			// $this->request->data['Estabelecimento']['usuarios_administrativo_id'] = 1;
			// $this->request->data['Estabelecimento']['slug'] = Inflector::slug($this->request->data['Estabelecimento']['name'], '-');


			// if ($this->request->data['Estabelecimento']['imagem']['error'] > 0) {
			// 	unset($this->request->data['Estabelecimento']['imagem']);
			// } else {
			// 	$image_array = $this->request->data['Estabelecimento']['imagem'];
			// 	$this->request->data['Estabelecimento']['imagem'] = $this->request->data['Estabelecimento']['imagem']['name'];
			// 	if ($image_array['type'] != 'image/jpeg' AND $image_array['type'] != 'image/png') {
			// 		$this->Session->setFlash(__('A <strong>imagem</strong> deve estar no formato JPG ou PNG.'),
			// 			'default',
			// 			array('class'=> 'alert alert-danger'));
			// 		$erro = 1;
			// 	}
			// }

			// if ($this->request->data['Estabelecimento']['horario_funcionamento_inicial'] > '23:59' AND $erro == 0) {
			// 	$this->Session->setFlash(__('O horário de funcionamento inicial do <strong>estabelecimento</strong> não foi informado corretamente.'), 'default', array('class'=> 'alert alert-danger'));
			// 	$erro = 1;
			// }

			// if ($this->request->data['Estabelecimento']['horario_funcionamento_final'] > '23:59' AND $erro == 0) {
			// 	$this->Session->setFlash(__('O horário de funcionamento final do <strong>estabelecimento</strong> não foi informado corretamente.'), 'default', array('class'=> 'alert alert-danger'));
			// 	$erro = 1;
			// }

			// if ($this->request->data['Estabelecimento']['tipo_cadastro'] == 2 AND $erro == 0) {
			// 	$data_inaugurado_fake = $this->DataUtil->setPadrao($this->request->data['Estabelecimento']['inaugurado']);
			// 	if (!strtotime($data_inaugurado_fake)) {
			// 		$this->Session->setFlash(__('A data de inauguração do <strong>estabelecimento</strong> não foi informado corretamente.'), 'default', array('class'=> 'alert alert-danger'));
			// 		$erro = 1;
			// 	} else {
			// 		$this->request->data['Estabelecimento']['inaugurado'] = $data_inaugurado_fake;
			// 	}
			// }
			// if ($erro == 0) {
			// 	if (isset($this->request->data['Estabelecimento']['imagem'])) {
			// 		$pasta_salvar = new Folder(
			// 			WWW_ROOT . 'img' . DS . 'Estabelecimentos' . DS . $this->request->data['Estabelecimento']['id'],
			// 			true,
			// 			0755
			// 		);
			// 		$this->_saveImages($image_array, $pasta_salvar);
			// 	}
			// 	if ($this->Estabelecimento->save($this->request->data)) {
			// 		$this->Session->setFlash(__('O <strong>estabelecimento</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
			// 		return $this->redirect(array('action' => 'index'));
			// 	} else {
			// 		$this->Session->setFlash(__('O <strong>estabelecimento</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			// 	}
			// }
		} else {
			$options = array('conditions' => array('Estabelecimento.' . $this->Estabelecimento->primaryKey => $id));
			$this->request->data = $this->Estabelecimento->find('first', $options);
			//$this->request->data['Estabelecimento']['inaugurado'] = $this->DataUtil->reverse($this->request->data['Estabelecimento']['inaugurado']);
		}

		$categorias = $this->Estabelecimento->Categoria->find('list');
		$subcategorias = $this->Estabelecimento->Subcategoria->find('list');
		$clientes = $this->Estabelecimento->Cliente->find('list');
		$cartoes = $this->Estabelecimento->Cartao->find('list');

		$usuariosAdministrativos = $this->Estabelecimento->UsuariosAdministrativo->find('list');
		$this->set(compact('categorias', 'usuariosAdministrativos', 'clientes', 'subcategorias', 'cartoes'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Estabelecimento->id = $id;
		if (!$this->Estabelecimento->exists()) {
			throw new NotFoundException(__('Invalid estabelecimento'));
		}
		$this->request->onlyAllow('post', 'delete');
		$count = $this->Estabelecimento->Comentario->find('count',
			array(
				'conditions'=> array('Comentario.estabelecimento_id'=> $id)
			)
		);
		if ($count == 0) {
			if ($this->Estabelecimento->delete()) {
				$this->Session->setFlash(__('O <strong>estabelecimento</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-success'));
			} else {
				$this->Session->setFlash(__('O <strong>estabelecimento</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$this->Session->setFlash(__('O <strong>estabelecimento</strong> não pode ser deletado pois ele já possui comentários.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
