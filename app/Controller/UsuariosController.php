<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

App::uses('CakeTime', 'Utility');

/**
 * Usuarios Controller
 *
 * @property Usuario $Usuario
 * @property PaginatorComponent $Paginator
 */
class UsuariosController extends AppController {

public $layout = 'BootstrapAdmin.default';	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function admin_export_xls() {
		$this->Usuario->recursive = -1;
		$options = array();
		$options['contain'] = array('Perfil'=> array(
			'fields'=> array(
				'name',
				'apelido',
				'cidade',
				'data_nascimento',

				)
			)
		);
		$options['fields'] = array('email', 'created');
		$usuarios = $this->Usuario->find('all', $options);

		$content = '<table>';

		$content .= '<thead>';
			$content .= '<tr>';
				$content .= '<th>';
					$content .= 'Email';
				$content .= '</th>';
				$content .= '<th>';
					$content .= 'Nome';
				$content .= '</th>';
				$content .= '<th>';
					$content .= 'Apelido';
				$content .= '</th>';
				$content .= '<th>';
					$content .= 'Data de nascimento';
				$content .= '</th>';
				$content .= '<th>';
					$content .= 'Cidade';
				$content .= '</th>';
				$content .= '<th>';
						$content .= 'Criação da conta';
				$content .= '</th>';			
			$content .= '</tr>';
		$content .= '</thead>';


		$content .= '<tbody>';
		foreach ($usuarios as $usuario) {
			$content .= '<tr>';
				$content .= '<td>';
					$content .= $usuario['Usuario']['email'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $usuario['Perfil']['name'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $usuario['Perfil']['apelido'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= CakeTime::format('d/m/Y', $usuario['Perfil']['data_nascimento']);
				$content .= '</td>';
				$content .= '<td>';
					$content .= $usuario['Perfil']['cidade'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= CakeTime::format('d/m/Y', $usuario['Usuario']['created']);
				$content .= '</td>';
			$content .= '</tr>';
		}
		$content .= '</tbody>';
		$content .= '</table>';


		$file = new File(WWW_ROOT . 'files/temp_xls/usuarios.xls', true, 0644);
		$file->write($content);
		return $this->redirect(array('action'=> 'usuarios', 'action'=> 'index', '?'=> array('downloadxls'=> 1)));
	}

	public function admin_status_ajax($id = null, $status = null) {
		$this->autoRender = false;
		if (!is_null($id) AND !is_null($status)) {
			$status = ($status == 0) ? 1 : 0;
			if ($this->Usuario->save(array('id'=> $id, 'ativo'=> $status))) {
				return true;

			} else {
				return false;	
			}
		} else {
			return false;
		}
	}

	public function admin_index() {

		if (!empty($this->request->query['downloadxls'])) {
			$this->response->file(
				WWW_ROOT . 'files/temp_xls/usuarios.xls',
					array('download' => true)
			);
		}

		$options = array();
		if (!empty($this->request->query['q'])) {
			$q = str_replace(' ', '%', $this->request->query['q']);
			$options['conditions'][] = array('Perfil.name LIKE'=> '%'.$q.'%');
		} else {
			$this->request->query['q'] = '';
		}
		$this->Usuario->recursive = 2;

		$options['order'] = array('Usuario.created'=> 'desc');
		$this->Paginator->settings = $options;
		$this->set('usuarios', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		$options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
		$this->set('usuario', $this->Usuario->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Usuario->create();
			if ($this->Usuario->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>usuario</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>usuario</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
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
		if (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Usuario->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>usuario</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O <strong>usuario</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
			$this->request->data = $this->Usuario->find('first', $options);
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
		$this->Usuario->id = $id;
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Usuario->delete()) {
			$this->Session->setFlash(__('O <strong>usuario</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-custom'));
		} else {
			$this->Session->setFlash(__('O <strong>usuario</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
