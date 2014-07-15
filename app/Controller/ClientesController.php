<?php
App::uses('AppController', 'Controller');

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * Clientes Controller
 *
 * @property Cliente $Cliente
 * @property PaginatorComponent $Paginator
 */
class ClientesController extends AppController {

public $layout = 'BootstrapAdmin.default';	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


	public function admin_export_xls() {
		$this->Cliente->recursive = -1;
		$options = array();
		$options['contain'] = array('Estado'=> array('fields'=> 'sigla'));
		$options['fields'] = array(
			'razao_social',
			'name',
			'email',
			'cnpj',
			'telefone',
			'telefone2',
			'celular',
			'endereco',
			'cidade');
		$clientes = $this->Cliente->find('all', $options);

		$content = '<table>';

		$content .= '<thead>';
			$content .= '<tr>';
				$content .= '<th>';
					$content .= 'Razao Social';
				$content .= '</th>';
				$content .= '<th>';
					$content .= 'Nome fantasia';
				$content .= '</th>';
				$content .= '<th>';
					$content .= 'Email';
				$content .= '</th>';
				$content .= '<th>';
					$content .= 'CNPJ';
				$content .= '</th>';
				$content .= '<th>';
					$content .= 'Telefone';
				$content .= '</th>';
				$content .= '<th>';
						$content .= 'Telefone 2';
				$content .= '</th>';
				$content .= '<th>';
						$content .= 'Celular';
				$content .= '</th>';
				$content .= '<th>';
						$content .= 'Endereco';
				$content .= '</th>';
				$content .= '<th>';
						$content .= 'Cidade';
				$content .= '</th>';
				$content .= '<th>';
						$content .= 'Estado';
				$content .= '</th>';
			$content .= '</tr>';
		$content .= '</thead>';


		$content .= '<tbody>';
		foreach ($clientes as $cliente) {
			$content .= '<tr>';
				$content .= '<td>';
					$content .= $cliente['Cliente']['razao_social'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $cliente['Cliente']['name'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $cliente['Cliente']['email'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $cliente['Cliente']['cnpj'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $cliente['Cliente']['telefone'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $cliente['Cliente']['telefone2'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $cliente['Cliente']['celular'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $cliente['Cliente']['endereco'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $cliente['Cliente']['cidade'];
				$content .= '</td>';
				$content .= '<td>';
					$content .= $cliente['Estado']['sigla'];
				$content .= '</td>';
			$content .= '</tr>';
		}
		$content .= '</tbody>';
		$content .= '</table>';


		$file = new File(WWW_ROOT . 'files/temp_xls/clientes.xls', true, 0644);
		$file->write($content);
		return $this->redirect(array('action'=> 'clientes', 'action'=> 'index', '?'=> array('downloadxls'=> 1)));
	}

	public function admin_index() {
		if (!empty($this->request->query['downloadxls'])) {
			$this->response->file(
				WWW_ROOT . 'files/temp_xls/clientes.xls',
					array('download' => true)
			);
		}

		$options = array();
		if (!empty($this->request->query['q'])) {
			$q = str_replace(' ', '%', $this->request->query['q']);
			$options['conditions'][] = array('or'=> array(array('Cliente.email LIKE'=> '%'.$q.'%'), array('Cliente.name LIKE'=> '%'.$q.'%')));
		} else {
			$this->request->query['q'] = '';
		}
		$this->Cliente->recursive = 0;

		$options['order'] = array('Cliente.created DESC');
		$this->Paginator->settings = $options;
		$this->set('clientes', $this->Paginator->paginate());
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>cliente</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash($this->Cliente->validationErrorMessage(), 'default', array('class'=> 'alert alert-danger'));
			}
		}

		$query = $this->Cliente->Estado->find('all');
		$estados = array();
		foreach ($query as $key => $row) {
			$estados[$row['Estado']['id']] = $row['Estado']['descricao'] .' ('.$row['Estado']['sigla'].')';
		}
		$estabelecimentos = $this->Cliente->Estabelecimento->find('list');
		$this->set(compact('estabelecimentos', 'estados'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Cliente->exists($id)) {
			throw new NotFoundException(__('Invalid cliente'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('O <strong>cliente</strong> foi salvo com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash($this->Cliente->validationErrorMessage(), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Cliente.' . $this->Cliente->primaryKey => $id));
			$this->request->data = $this->Cliente->find('first', $options);
		}

		$query = $this->Cliente->Estado->find('all');
		$estados = array();
		foreach ($query as $key => $row) {
			$estados[$row['Estado']['id']] = $row['Estado']['descricao'] .' ('.$row['Estado']['sigla'].')';
		}

		$estabelecimentos = $this->Cliente->Estabelecimento->find('list');
		$this->set(compact('estabelecimentos', 'estados'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Cliente->id = $id;
		if (!$this->Cliente->exists()) {
			throw new NotFoundException(__('Invalid cliente'));
		}
		$this->request->onlyAllow('post', 'delete');

		$count = $this->Cliente->Estabelecimento->find('count',
			array(
				'conditions'=> array(
					'Estabelecimento.cliente_id'=> $id
				)
			)
		);
		if ($count == 0){
			if ($this->Cliente->delete()) {
			$this->Session->setFlash(__('O <strong>cliente</strong> foi deletado com sucesso.'), 'default', array('class'=> 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('O <strong>cliente</strong> não pode ser deletado, por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
		}
		} else {
			$this->Session->setFlash(__('O <strong>cliente</strong> não pode ser deletado pois ele pertece a uma estabelecimento.'), 'default', array('class'=> 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
