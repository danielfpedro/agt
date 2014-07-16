<?php
session_start();
App::uses('AppController', 'Controller');

App::uses('WideImage', 'Lib/WideImage/lib');

// App::build(array('Vendor' => array(APP . 'Vendor' . DS . 'Facebook' . DS . 'src' . DS . 'Facebook')));
// App::uses('FacebookSession', 'Vendor');

// require_once APP . 'Vendor' . DS . 'Facebook' . DS . 'autoload.php';
// use Facebook\FacebookSession;
// use Facebook\FacebookRedirectLoginHelper;
// use Facebook\FacebookRequestException;
// use Facebook\FacebookRequest;
// use Facebook\GraphUser;

App::uses('Folder', 'Utility');
/**
 * Site Controller
 *
 */
class SiteController extends AppController {

	public $layout = 'Site/default';


	public $components = array(
		'Auth'=> array(
			'loginAction' => array(
	            'controller' => 'site',
	            'action' => 'login',
        	),
        	'loginRedirect'=> array(
        		'controller' => 'site',
	            'action' => 'home',
        	),
        	'logoutRedirect'=> array(
        		'controller' => 'site',
	            'action' => 'home',
        	),
			'authenticate'=> array(
				'Form'=> array(
					'userModel'=> 'Usuario',
					'fields'=> array(
						'username'=> 'email',
						'password'=> 'senha'
					),
					'scope' => array('ativo' => 1)
				)
			)
		),
		'Paginator', 'Session', 'DataUtil');


	public function newsletter_add() {
		$email = $this->request->data['email'];
		if (!empty($email)) {
			$this->loadModel('Divulgacao');
			$options['conditions'] = array('Divulgacao.email'=> $email);
			$count = $this->Divulgacao->find('count', $options);
			if ($count == 0) {
				$this->Divulgacao->create();
				if ($this->Divulgacao->save(array('email'=> $email))) {
					echo 'Email salvo com sucesso, você está apto a receber nossas novidades.';
				} else {;
					echo 'Email inválido.';
				}
			} else {
				echo 'O seu email já constava no nosso banco de dados e está apto para receber nossas novidades.';
			}
		} else {
			echo 'Email não informado.';
		}

		$this->autoRender = false;
	}

	public function _getBanners() {
		$this->loadModel('Anuncio');
		$this->Anuncio->recursive = -1;
		$options = array();

		$options['conditions'] = array('Anuncio.ativo'=> 1, 'Anuncio.id'=> 1);
		$banner1 = $this->Anuncio->find('first', $options);

		$options['conditions'] = array('Anuncio.ativo'=> 1, 'Anuncio.id'=> 2);
		$banner2 = $this->Anuncio->find('first', $options);

		$options['conditions'] = array('Anuncio.ativo'=> 1, 'Anuncio.id'=> 3);
		$banner3 = $this->Anuncio->find('first', $options);

		$this->set(compact('banner1'));
		$this->set(compact('banner2'));
		$this->set(compact('banner3'));
	}

	public function beforeFilter() {
		parent::beforeFilter();
		//$this->_checkLogin();
		$this->Auth->allow();
		$this->Auth->deny(array('meusDados'));

		$this->set('loggedIn', $this->Auth->loggedIn());
		$this->set('AuthUser', $this->Auth->user());

		$banners = $this->_getBanners();
	}

	public function _checkLogin(){
		$flag = $this->Cookie->read('Auth');
		if (!empty($flag)) {
			$auth_custom = array(
				'id'=> $this->Cookie->read('Auth.Usuario_id'),
				'nome'=> $this->Cookie->read('Auth.nome'),
				'email'=> $this->Cookie->read('Auth.email'),
				'apelido'=> $this->Cookie->read('Auth.apelido'),
				'perfil_id'=> $this->Cookie->read('Auth.perfil_id'),
				'imagem'=> $this->Cookie->read('Auth.imagem')
			);

			$this->auth_custom = $auth_custom;
			//Debugger::dump($auth_custom);

			$this->set(compact('auth_custom'));
		}
	}
	

	public function home() {
		$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
		$this->set(compact('widget_estabelecimentos'));

		$this->loadModel('Estabelecimento');
		$this->Estabelecimento->recursive = -1;
		$options = array();

		$options['fields'] = array(
			'Estabelecimento.id',
			'Estabelecimento.name', 'Estabelecimento.imagem_300x170',
			'Estabelecimento.slug', 'Estabelecimento.rate', 'Estabelecimento.descricao',
		);

		$query = $this->Estabelecimento->CategoriasEstabelecimento->find(
			'all',
			array(
				'recursive'=> -1,
				'fields'=> array('CategoriasEstabelecimento.estabelecimento_id'),
				'conditions'=> array(
					'CategoriasEstabelecimento.categoria_id'=> 1
				),
				'order'=> 'rand()',
				'limit'=> 1
			)
		);
		$idsBoate = $this->_acertaIds($query);

		$options['conditions'] = array('Estabelecimento.id'=> $idsBoate);
		$options['order'] = 'rand()';

		// Debugger::dump($options);
		// exit();
		$boate = $this->Estabelecimento->find('first', $options);

		$query = $this->Estabelecimento->CategoriasEstabelecimento->find(
			'all',
			array(
				'recursive'=> -1,
				'fields'=> array('CategoriasEstabelecimento.estabelecimento_id'),
				'conditions'=> array(
					'CategoriasEstabelecimento.categoria_id'=> 2,
					'CategoriasEstabelecimento.estabelecimento_id !='=> $idsBoate
				),
				'order'=> 'rand()',
				'limit'=> 1
			)
		);
		$idsRestaurante = $this->_acertaIds($query);

		$options['conditions'] = array('Estabelecimento.id'=> $idsRestaurante);
		$restaurante = $this->Estabelecimento->find('first', $options);

		$query = $this->Estabelecimento->CategoriasEstabelecimento->find(
			'all',
			array(
				'recursive'=> -1,
				'fields'=> array('CategoriasEstabelecimento.estabelecimento_id'),
				'conditions'=> array(
					'CategoriasEstabelecimento.categoria_id'=> 3,
					'CategoriasEstabelecimento.estabelecimento_id !='=> $idsRestaurante,
					'CategoriasEstabelecimento.estabelecimento_id !='=> $idsBoate
				),
				'order'=> 'rand()',
				'limit'=> 1
			)
		);

		$idsBar = $this->_acertaIds($query);

		$options['conditions'] = array('Estabelecimento.id'=> $idsBar);
		$bar = $this->Estabelecimento->find('first', $options);



		$options = array();
		$this->loadModel('Destaque');
		$this->Destaque->recursive = -1;

		$options['contain'] = array('Estabelecimento');
		
		$options['fields'] = array(
			'Destaque.estabelecimento_id',
			'Destaque.titulo',
			'Destaque.link',
			'Destaque.target',
			'Destaque.imagem_540x390',
			'Destaque.imagem_70x70',
			'Estabelecimento.id',
			'Estabelecimento.name',
			'Estabelecimento.slug',
			'Estabelecimento.imagem_540x390',
			'Estabelecimento.imagem_70x70',
		);
		$options['limit'] = 5;
		$options['order'] = array('Destaque.ordem'=> 'asc');
		$options['limit'] = 5;
		
		$query_carrossel = $this->Destaque->find('all', $options);

		$carrossel = array();
		$i = 0;
		foreach ($query_carrossel as $key => $value) {
			$carrossel[$i]['estabelecimento_id'] = $value['Destaque']['estabelecimento_id'];
			// Personalizado
			if (empty($value['Destaque']['estabelecimento_id'])) {
				$carrossel[$i]['titulo'] = $value['Destaque']['titulo'];
				$carrossel[$i]['imagem'] = 'Carrossel/' . $value['Destaque']['imagem_540x390'];
				$carrossel[$i]['link'] = (empty($value['Destaque']['link']) ? null : 'http://' . $value['Destaque']['link']);
			$carrossel[$i]['target'] = $value['Destaque']['target'];
			} else {
				$carrossel[$i]['titulo'] = $value['Estabelecimento']['name'];
				$carrossel[$i]['imagem'] = 'Estabelecimentos/' . $value['Estabelecimento']['slug'] . '/' . $value['Estabelecimento']['imagem_540x390'];
				$carrossel[$i]['link'] = array('controller'=> 'site', 'action'=> 'perfil', $value['Estabelecimento']['slug']);
			$carrossel[$i]['target'] = '_self';
			}
			$i++;
		}

		// Debugger::dump($carrossel);
		// exit();
		$boate['Categoria'] = array('name'=> 'Baladas');
		$destaques[0] = $boate;
		$restaurante['Categoria'] = array('name'=> 'Restaurantes');
		$destaques[1] = $restaurante;
		$bar['Categoria'] = array('name'=> 'Bares');
		$destaques[2] = $bar;

		$title_for_layout = $this->site_name;

		$this->set(compact('carrossel','destaques', 'title_for_layout'));
	}

	public $paginate = array(
		'Estabelecimento'=> array(
			'limit'=> 10,
			'fields'=> array(
				'Estabelecimento.id',
				'Estabelecimento.name',
				'Estabelecimento.descricao',
				'Estabelecimento.slug',
				'Estabelecimento.rate',
				'Estabelecimento.imagem',
			),
			'contain'=> 'Comentario'
			)
	);

	public function preview(){
		$this->layout = 'Site/preview';

		$title_for_layout = $this->site_name;

		$this->set(compact('title_for_layout'));

	}

	public function _acertaIds($array) {
		$retorno = array();
		foreach ($array as $key => $value) {
			$retorno[] = $value['CategoriasEstabelecimento']['estabelecimento_id'];
		}
		return $retorno;
	}

	public function _getWidgetEstabelecimentos(){
		// 1 Baladas, 2 - Restaurante, 3 - Bar
		$this->loadModel('Estabelecimento');
		$this->Estabelecimento->CategoriasEstabelecimento->recursive = 3;
		$query = $this->Estabelecimento->CategoriasEstabelecimento->find(
			'all',
			array(
				'fields'=> array('CategoriasEstabelecimento.estabelecimento_id'),
				'recursive'=> -1,
				'conditions'=> array('CategoriasEstabelecimento.categoria_id'=> 1),
			)
		);

		$idsBoate = $this->_acertaIds($query);
		$query = $this->Estabelecimento->CategoriasEstabelecimento->find(
			'all',
			array(
				'fields'=> array('CategoriasEstabelecimento.estabelecimento_id'),
				'recursive'=> -1,
				'conditions'=> array('CategoriasEstabelecimento.categoria_id'=> 2)));

		$idsRestaurante = $this->_acertaIds($query);
		$query = $this->Estabelecimento->CategoriasEstabelecimento->find(
			'all',
			array(
				'fields'=> array('CategoriasEstabelecimento.estabelecimento_id'),
				'recursive'=> -1,
				'conditions'=> array('CategoriasEstabelecimento.categoria_id'=> 3)));
		$idsBar = $this->_acertaIds($query);

		$this->Estabelecimento->recursive = -1;
		
		$options = array();

		$estabelecimentos = array();

		$restaurantes = array();
		$bares = array();
		$baladas = array();
		$recentes = array();

		$options['contain'] = array('Categoria'=> array('imagem'));
		$options['limit'] = 5;

		// $options['conditions'] = array(
		// 	'Estabelecimento.ativo'=> 1 ,
		// 	'Estabelecimento.id'=> $idsRestaurante);

		// $restaurantes = $this->Estabelecimento->find('all', $options);
		$restaurantes = $this->Estabelecimento->getWidget($idsRestaurante);

		//$options['conditions'] = array('Estabelecimento.ativo'=> 1, 'Estabelecimento.id'=> $idsBoate);
		//$baladas = $this->Estabelecimento->find('all', $options);

		$baladas = $this->Estabelecimento->getWidget($idsBoate);

		//$options['conditions'] = array('Estabelecimento.ativo'=> 1, 'Estabelecimento.id'=> $idsBar);
		//$bares = $this->Estabelecimento->find('all', $options);
		$bares = $this->Estabelecimento->getWidget($idsBar);

		// $options['conditions'] = array('Estabelecimento.ativo'=> 1);
		// $options['order'] = array('Estabelecimento.created'=> 'desc');
		// $recentes = $this->Estabelecimento->find('all', $options);
		$recentes = $this->Estabelecimento->find('all',
			array(
				'fields'=> array(
					'name',
					'rate',
					'slug',
					'imagem_70x70',
					'cidade'
				),
				'contain'=> 'Categoria',
				'conditions'=> array(
					'Estabelecimento.ativo'=> 1,
				),
				'limit'=> 5,
				'order'=> array('Estabelecimento.created'=> 'desc')
			)
		);

		$options_categoria = array();
		$options_categoria['fields'] = array('Categoria.imagem');
		$options_categoria['recursive'] = -1;

		$options_categoria['conditions'] = array('Categoria.id'=> 2);
		$row = $this->Estabelecimento->Categoria->find('first', $options_categoria);
		if (!empty($restaurantes)) {
			$i = 0;
			foreach ($restaurantes as $key => $value) {
				$restaurantes[$i]['Categoria']['imagem'] = $row['Categoria']['imagem'];
				$i++;
			}
		}
		$estabelecimentos['restaurantes'] = $restaurantes;

		$options_categoria['conditions'] = array('Categoria.id'=> 3);
		$row = $this->Estabelecimento->Categoria->find('first', $options_categoria);

		// Debugger::dump($bares);
		// exit();
		if (!empty($bares)) {
			$i = 0;
			foreach ($bares as $key => $value) {
				$bares[$i]['Categoria']['imagem'] = $row['Categoria']['imagem'];
				$i++;
			}
		}

		$estabelecimentos['bares'] = $bares;


		$options_categoria['conditions'] = array('Categoria.id'=> 1);
		$row = $this->Estabelecimento->Categoria->find('first', $options_categoria);
		if (!empty($baladas)) {
			$i = 0;
			foreach ($baladas as $key => $value) {
				$baladas[$i]['Categoria']['imagem'] = $row['Categoria']['imagem'];
				$i++;
			}
		}
		$estabelecimentos['baladas'] = $baladas;

		if (!empty($recentes)) {
			$i = 0;
			foreach ($recentes as $key => $value) {
				$recentes[$i]['Categoria']['imagem'] = $value['Categoria'][0]['imagem'];
				$recentes[$i][0]['rate'] = $value['Estabelecimento']['rate'];
				$i++;
			}
		}
		// Debugger::dump($recentes);
		// exit();

		$estabelecimentos['recentes'] = $recentes;

		return $estabelecimentos;
	}

	public function mais_comentarios() {
		$this->loadModel('Comentario');

		$estabelecimento = $this->request->data['estabelecimento'];
		$page = $this->request->data['page'];
		$limit = $this->Comentario->perfil_limit;

		$offset = $page * $limit;
		$comentarios = $this->Comentario->get($estabelecimento, $limit, $offset);
		$comentarios = json_encode($comentarios);
		echo $comentarios;

		$this->autoRender = false;
	}

	public function perfil($slug = null) {
		$this->loadModel('Comentario');

		$this->loadModel('Estabelecimento');
		$this->Estabelecimento->recursive = 2;

		$estabelecimento = $this->Estabelecimento->find(
			'first',
			array('conditions'=> array('ativo'=> 1,'Estabelecimento.slug'=> $slug))
		);
		if (empty($estabelecimento)) {
			throw new NotFoundException('Este estabelecimento não existe.');
		} else {
			$estabelecimento['Estabelecimento']['imagem_loop'][0]['normal'] = $estabelecimento['Estabelecimento']['imagem_300x170'];
			$estabelecimento['Estabelecimento']['imagem_loop'][0]['zoom'] = $estabelecimento['Estabelecimento']['imagem_800x600'];

			$i = 1;
			if (!empty($estabelecimento['Estabelecimento']['imagem2_300x170'])) {
				$estabelecimento['Estabelecimento']['imagem_loop'][$i]['normal'] = $estabelecimento['Estabelecimento']['imagem2_300x170'];
				$estabelecimento['Estabelecimento']['imagem_loop'][$i]['zoom'] = $estabelecimento['Estabelecimento']['imagem2_800x600'];
				$i++;
			}
			if (!empty($estabelecimento['Estabelecimento']['imagem3_300x170'])) {
				$estabelecimento['Estabelecimento']['imagem_loop'][$i]['normal'] = $estabelecimento['Estabelecimento']['imagem3_300x170'];
				$estabelecimento['Estabelecimento']['imagem_loop'][$i]['zoom'] = $estabelecimento['Estabelecimento']['imagem3_800x600'];
			}
		}

		//Debugger::dump($estabelecimento);

		if ($this->request->is('post')) {

			if ($this->Auth->loggedIn()) {
				$this->request->data['Comentario']['usuario_id'] = $this->Auth->user('id');
				$this->request->data['Comentario']['texto'] = $this->request->data['Comentario']['comentario'];
				
				$this->Comentario->create();
				if ($this->Comentario->save($this->request->data)) {
					$this->Session->setFlash(__('Aguarde, seu comentário vai ser avalido.'), 'default', array('class'=> 'alert alert-success'));
				} else {
					$this->Session->setFlash(__('O <strong>comentario</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
				}
			} else {
				$this->Session->setFlash(__('Você precisa estar logado para fazer um comentário.'), 'default', array('class'=> 'alert alert-danger'));
			}
			return $this->redirect($this->referer());
		}
		

		$this->loadModel('Comentario');
		$comentarios = $this->Comentario->get($estabelecimento['Estabelecimento']['id'], 5);

		$comentarios_count = $this->Comentario->find('count',
			array(
				'conditions'=> array(
					'Comentario.ativo'=> 1,
					'Comentario.estabelecimento_id'=> $estabelecimento['Estabelecimento']['id'])));

		$show_paginator = ($comentarios_count > $this->Comentario->perfil_limit)? true : false;

		if (!empty($estabelecimento)) {
			$title_for_layout = $estabelecimento['Estabelecimento']['name'] .' - ' . $this->site_name;

			$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
			$this->set(compact(
				'loop_images',
				'show_paginator',
				'title_for_layout',
				'estabelecimento', 'widget_estabelecimentos', 'comentarios', 'comentarios_count'));

			//Debugger::dump($estabelecimento['Comentario'][0]['Usuario']['Perfil']);
		} else {
			throw new NotFoundException('Este estabelecimento não existe.');
		}
	}

	public function pesquisa(){
		$this->loadModel('Estabelecimento');
		$title_for_layout = 'Pesquisa - ' . $this->site_name;

		$this->Paginator->settings = $this->paginate;

		$options['fields'] = array(
			'Estabelecimento.name', 'Estabelecimento.imagem_300x170', 'Estabelecimento.descricao', 
			'Estabelecimento.slug','Estabelecimento.rate'
		);
		$options['contain'] = array(
			'Comentario'=> array(
				'conditions'=> array('Comentario.ativo'=> 1),
				'fields'=> array('Comentario.id'))
		);
		$options['conditions'][] = array(
				'Estabelecimento.ativo'=> 1,
		);
		if (!empty($this->request->query['q'])) {
			$q = $this->request->query['q'];
			$titulo = 'Resultado da pesquisa para "' .$q. '"';

			$options['conditions'][] = array('Estabelecimento.name LIKE '=> '%'.$q.'%');
		} else {
			throw new NotFoundException('Pesquisa não informada.');
		}
		// Debugger::dump($options);
		// exit();
		$this->Paginator->settings = $options;

    	$estabelecimentos = $this->Paginator->paginate('Estabelecimento');
		$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
		//Debugger::dump($estabelecimentos);
		$this->set(compact('estabelecimentos','widget_estabelecimentos','titulo', 'title_for_layout'));

		$this->render('estabelecimentos');
	}

	public function termos_de_uso(){
		$title_for_layout = 'Termos de uso - ' . $this->site_name;
		$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
		$this->set(compact('widget_estabelecimentos', 'title_for_layout'));
	}

	public function estabelecimentos($categoria = null){
		$title_for_layout = ucfirst($categoria) .' - ' . $this->site_name;

		$titulo = $categoria;

		$this->loadModel('Estabelecimento');
		$this->Estabelecimento->recursive = -1;
		$this->Estabelecimento->Categoria->recursive = -1;
		$categoria_row = $this
			->Estabelecimento
			->Categoria
			->find('first',
				array(
					'fields'=> array(
						'Categoria.id'
					),
					'conditions'=> array(
						'Categoria.slug'=> $categoria
					)
				)
			);
		if (!empty($categoria_row)) {

			$query = $this->Estabelecimento->CategoriasEstabelecimento->find(
				'all',
				array(
					'recursive'=> -1,
					'fields'=> 'CategoriasEstabelecimento.estabelecimento_id',
					'conditions'=> array(
						'CategoriasEstabelecimento.categoria_id'=> $categoria_row['Categoria']['id']
					)
				)
			);
			$ids = array();
			if (!empty($query)) {
				foreach ($query as $key => $value) {
					$ids[] = $value['CategoriasEstabelecimento']['estabelecimento_id'];
				}
			}


			$options = array(
				'order'=> array('Estabelecimento.name'=> 'asc'),
				'fields'=> array(
					'Estabelecimento.name', 'Estabelecimento.imagem_300x170', 'Estabelecimento.descricao', 
					'Estabelecimento.slug','Estabelecimento.rate'
				),
				'contain'=> array(
					'Comentario'=> array(
						'conditions'=> array('Comentario.ativo'=> 1),
						'fields'=> array('Comentario.id'))
				),
			);

			$options['conditions'][] = array(
					'Estabelecimento.ativo'=> 1,
			);
			$options['conditions'][] = array(
				'Estabelecimento.id'=> $ids
			);
			if (!empty($this->request->query['q'])) {
				$q = $this->request->query['q'];
				$titulo = 'Resultado da pesquisa para "' .$q. '"';

				$options['conditions'][] = array('Estabelecimento.name LIKE '=> '%'.$q.'%');
			}

			$this->Paginator->settings = $this->paginate;
			$this->Paginator->settings = $options;

	    	$estabelecimentos = $this->Paginator->paginate('Estabelecimento');
			$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
			//Debugger::dump($estabelecimentos);
			$this->set(compact('estabelecimentos','widget_estabelecimentos','titulo', 'title_for_layout'));
		} else {
			throw new NotFoundException('Esta categoria não existe não existe.');
		}
	}

	public function contato(){
		$title_for_layout = 'Contato - ' . $this->site_name;

		if ($this->request->is('post')) {
			$this->loadModel('Contato');
			$this->Contato->create();
			if ($this->Contato->save($this->request->data, array('validation'=> 'only'))) {
				$this->Session->setFlash(__('Mensagem enviada com sucesso.'), 'default', array('class'=> 'alert alert-success'));
				return $this->redirect($this->referer());
			} else {
				$errors = array();
				foreach ($this->Contato->validationErrors as $key => $value) {
					if (!empty($value)) {
						foreach ($value as $item) {
							$errors[] = $item;
						}
					}
				}
				$this->Session->setFlash(join('<br>', $errors), 'default', array('class'=> 'alert alert-danger'));
			}
		} else {
			$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
			$this->set(compact('widget_estabelecimentos'));
		}
		$this->set(compact('title_for_layout'));
	}

	public function _validationErrorsToList($errors) {
		$retorno = array();
		foreach ($errors as $key => $value) {
			if (!empty($value)) {
				foreach ($value as $item) {
					$retorno[] = $item;
				}
			}
		}
		return $retorno;
	}

	public function _validationUsuarioErrorsToList($errors) {
		$retorno = '';
		$retorno .= (!empty($errors['Perfil']['imagem'])) ? join('<br>', $errors['Perfil']['imagem']) . '<br>': '';
		$retorno .= (!empty($errors['Perfil']['name'])) ? join('<br>', $errors['Perfil']['name']) . '<br>': '';
		$retorno .= (!empty($errors['email'])) ? join('<br>', $errors['email']) . '<br>': '';
		$retorno .= (!empty($errors['Perfil']['apelido'])) ? join('<br>', $errors['Perfil']['apelido']) . '<br>': '';
		$retorno .= (!empty($errors['Perfil']['data_nascimento'])) ? join('<br>', $errors['Perfil']['data_nascimento']) . '<br>': '';
		$retorno .= (!empty($errors['Perfil']['cidade'])) ? join('<br>', $errors['Perfil']['cidade']) . '<br>': '';
		$retorno .= (!empty($errors['senha'])) ? join('<br>', $errors['senha']) . '<br>': '';
		return $retorno;
	}

	public function cadastro(){
		$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
		$title_for_layout = 'Cadastro de usuário - ' . $this->site_name;
		
		$this->set(compact('widget_estabelecimentos','title_for_layout'));

		if ($this->request->is('post')) {
			$this->loadModel('Usuario');
			$this->Usuario->recursive = -1;

			// $this->Usuario->create();
			$senha = $this->request->data['Usuario']['senha'];

			if ($this->Usuario->saveAll($this->request->data)) {
				$this->Session->setFlash('Cadastro <strong>realizado</strong> com sucesso!', 'default', array('class'=> 'alert alert-success'));
				$this->Auth->login(array(
					'id'=> $this->Usuario->id,
					'Perfil'=> array(
						'id'=> $this->Usuario->Perfil->id,
						'name'=> $this->request->data['Perfil']['name']
					)));
				return $this->redirect(array('action'=> 'home'));
			} else {
				$errors_usuario = $this->Usuario->validationErrors;
				$errors_perfil = array();
				if (!empty($errors_usuario['Perfil'])) {
					$errors_perfil = $errors_usuario['Perfil'];
					unset($errors_usuario['Perfil']);
				}
				
				$errors_usuario = $this->_validationErrorsToList($errors_usuario);
				$errors_perfil = $this->_validationErrorsToList($errors_perfil);
				$errors = array_merge($errors_usuario, $errors_perfil);
				
				$this->Session->setFlash(join('<br>', $errors), 'default', array('class'=> 'alert alert-danger'));
			}


			//Valida se email já existe;
			// $options = array();
			// $options['fields'] = array('Usuario.email');
			// $options['conditions'] = array('Usuario.email'=> $this->request->data['Usuario']['email']);
			// $Usuario = $this->Usuario->find('first', $options);
			// if (!empty($Usuario)) {
			// 	if ($Usuario['Usuario']['email'] == $this->request->data['Usuario']['email']) {
			// 		$erro = 1;
			// 		$erro_desc[] = 'O email que você informou já está cadastrado';
			// 	}
			// }

			// Valida data de nascimento
			// $data_fake = $this->DataUtil->setPadrao($this->request->data['Perfil']['data_nascimento']);
			// if (!strtotime($data_fake)) {
			// 	$erro = 1;
			// 	$erro_desc[] = 'A data de nascimento não foi informada corretamente';
			// }
			//Valida repetição de senha
			// if ($this->request->data['Usuario']['repetir_senha'] != $this->request->data['Usuario']['senha']) {
			// 	$erro = 1;
			// 	$erro_desc[] = 'Você não repetiu a senha corretamente';
			// }

			// if ($erro == 0) {
			// 	$this->request->data['Perfil']['data_nascimento'] = $data_fake;

			// 	$this->request->data['Usuario']['token_ativacao'] = String::uuid();
				
			// 	$email = $this->request->data['Usuario']['email'];
			// 	$senha = $this->request->data['Usuario']['senha'];

			// 	$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
			// 	$this->request->data['Usuario']['senha'] = $passwordHasher->hash(
			// 		$this->request->data['Usuario']['senha']
			// 	);
			// 	$this->Usuario->create();
			// 	if ($this->Usuario->save($this->request->data)) {
			// 		if (!empty($this->request->data)) {
			// 			$this->request->data['Perfil']['Usuario_id'] = $this->Usuario->id;
			// 			if ($this->Usuario->Perfil->save($this->request->data)) {
			// 				//Debugger::dump($senha);
			// 				if($this->_logar($email, $senha)){
			// 					$this->Session->setFlash(__('Cadastro feito com sucesso.'), 'default', array('class'=> 'alert alert-success'));
			// 					$this->redirect(array('controller'=> 'site', 'action'=> 'home'));
			// 				} else {
			// 					$this->Session->setFlash(__('Ocorreu um erro ao logar.'), 'default', array('class'=> 'alert alert-danger'));
			// 					$this->redirect(array('controller'=> 'site', 'action'=> 'home'));
			// 				}
			// 			} else {
			// 				$this->Session->setFlash(__('O <strong>cadastro</strong> não pode ser salva. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			// 			};
			// 		}
			// 	} else {
			// 		$this->Session->setFlash(__('O <strong>Usuario</strong> não pode ser salvo. Por favor, tente novamente.'), 'default', array('class'=> 'alert alert-danger'));
			// 	}
			// } else {

			// 	$this->Session->setFlash(join('<br>', $erro_desc), 'default', array('class'=> 'alert alert-danger'));
			// }
		}
	}

	public function _uploadUsuarioImage($image_array) {
		if ($this->request->data['Perfil']['imagem']['error'] == 0) {
			$image = WideImage::load($image_array['tmp_name']);
			$pasta_salvar = new Folder(WWW_ROOT . 'img' . DS . 'Usuarios/' . $this->auth_custom['id'], true, 0755);
	
			$image
				->resize(60, 60, 'outside')
				->crop('center', 'center', 60, 60)
				->saveToFile($pasta_salvar->path . DS . $image_array['name'], 85);
		}
	}

	public function meusDados() {
		$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
		$this->set(compact('widget_estabelecimentos'));
		
		$this->loadModel('Usuario');

		if ($this->request->is(array('post', 'put'))) {
			//unset($this->request->data['Perfil']['imagem']);

			$this->request->data['Usuario']['id'] = $this->Auth->user('id');
			$this->request->data['Perfil']['usuario_id'] = $this->Auth->user('id');

			$this->request->data['Perfil']['id'] = $this->Auth->user('Perfil.id');

			if ($this->Usuario->saveAll($this->request->data)) {
				$this->Session->setFlash('Alteraçao realizada com sucesso.', 'default', array('class'=> 'alert alert-success'));
				$this->Auth->login(array(
					'id'=> $this->Usuario->id,
					'Perfil'=> array(
						'name'=> $this->request->data['Perfil']['name'],
						'id'=> $this->request->data['Perfil']['id']
					)));
				return $this->redirect($this->referer());
			} else {
				$errors_usuario = $this->Usuario->validationErrors;
				$errors_perfil = array();
				if (!empty($errors_usuario['Perfil'])) {
					$errors_perfil = $errors_usuario['Perfil'];
					unset($errors_usuario['Perfil']);
				}
				
				$errors_usuario = $this->_validationErrorsToList($errors_usuario);
				$errors_perfil = $this->_validationErrorsToList($errors_perfil);
				$errors = array_merge($errors_usuario, $errors_perfil);

				$this->Session->setFlash(join('<br>', $errors), 'default', array('class'=> 'alert alert-danger'));	
			}
		}


		$options = array();
		$this->Usuario->recursive = -1;
		$options['contain'] = array('Perfil'=> array(
			'fields'=> array(
				'id',
				'name','apelido', 'data_nascimento', 'cidade', 'imagem'
			)
		));
		$this->Usuario->virtualFields['data_nascimento_formatada'] = $this->Usuario->Perfil->virtualFields['data_nascimento_formatada'];
		$options['fields'] = array(
			'email', 'facebook_id',
			'data_nascimento_formatada'
		);
		$options['conditions'] = array('Usuario.id'=> $this->Auth->user('id'));

		$usuario = $this->Usuario->find('first', $options);

		$this->request->data = $usuario;
		$this->request->data['Perfil']['data_nascimento'] = $usuario['Usuario']['data_nascimento_formatada'];

		if (!empty($usuario['Perfil']['imagem'])) {
			$img_avatar = 'Usuarios/' . $this->Auth->user('id') . '/' . $usuario['Perfil']['imagem'];
		}elseif (!empty($usuario['Usuario']['facebook_id'])) {
			$img_avatar = 'https://graph.facebook.com/' . $usuario['Usuario']['facebook_id'] . '/picture?type=normal';
		} else {
			$img_avatar = 'Usuarios/default_avatar.png';
		}
			
		$this->set(compact('img_avatar'));
		
		// Debugger::dump($this->Auth->user('email'));
		// exit();

		// if ($this->request->is(array('post', 'put'))) {
		// 	$this->request->data['Usuario']['email_antigo'] = $this->Auth->user['email'];
		// 	$this->request->data['Perfil']['apelido_antigo'] = $this->Auth->user['apelido'];

		// 	$image_array = $this->request->data['Perfil']['imagem'];
		// 	if ($this->Usuario->saveAll($this->request->data, array('validate'=> 'only'))) {
		// 		if ($this->Usuario->saveAll($this->request->data, array('validate'=> false))) {
					
		// 			$this->_uploadUsuarioImage($image_array);
		// 			if ($this->request->data['Perfil']['imagem']['error'] == 0) {
		// 				$this->request->data['Perfil']['imagem'] = $this->request->data['Perfil']['imagem']['name'];
		// 			} else {
		// 				unset($this->request->data['Perfil']['imagem']);
		// 			}
		// 			$this->_loginSession($this->request->data);
		// 			$this->Session->setFlash('As suas alterações foram realizadas com sucesso.', 'default', array('class'=> 'alert alert-success'));
		// 			return $this->redirect($this->referer());
		// 		}
		// 	} else {
		// 		// Debugger::dump($this->Usuario->validationErrors);
		// 		// exit();
		// 		$errors = $this->_validationUsuarioErrorsToList($this->Usuario->validationErrors);
		// 		$this->Session->setFlash($errors, 'default', array('class'=> 'alert alert-danger'));
		// 	}
		// } 
		// $options['contain'] = array('Perfil');
		// $options['fields'] = array(
		// 	'Usuario.id',
		// 	'Usuario.email',
		// 	'Usuario.facebook_id',
		// 	'Perfil.name',
		// 	'Perfil.data_nascimento',
		// 	'Perfil.apelido',
		// 	'Perfil.cidade',
		// 	'Perfil.imagem',
		// );
		// $options['conditions'] = array('Usuario.id'=> $this->auth_custom['id']);

		// $Usuario = $this->Usuario->find('first', $options);
		// $this->request->data = $Usuario;
		// $this->request->data['Perfil']['data_nascimento'] = $this->DataUtil->reverse($Usuario['Perfil']['data_nascimento']);

		// $this->request->data['Usuario']['senha'] = '';
		// $this->set(compact('Usuario'));
			
			// 	$options = array();
			// 	$erro = 0;
			// 	$erro_desc = array();			
				
			// 	$this->Usuario->recursive = -1;

			// 	$options['fields'] = array('Usuario.email');
			// 	$options['conditions'] = array(
			// 		'Usuario.email'=> $this->request->data['Usuario']['email'],
			// 		'Usuario.email !='=> $this->auth_email
			// 	);
			// 	$Usuario = $this->Usuario->find('all', $options);
			// 	//Debugger::dump($options);

			// 	if (!empty($Usuario)) {
			// 		$erro = 1;
			// 		$erro_desc[] = 'O email que você informou já está me uso por outro usuário';
			// 	}

			// 	if ($this->request->data['Perfil']['imagem']['error'] == 4) {
			// 		unset($this->request->data['Perfil']['imagem']);
			// 	} else {
			// 		$image_array = $this->request->data['Perfil']['imagem'];
			// 		if ($image_array['error'] == 0) {
			// 			if ($image_array['type'] != 'image/jpeg' AND $image_array['type'] != 'image/png') {
			// 				$erro_desc[] = 'A imagem deve estar no formato JPG ou PNG.';
			// 				$erro = 1;
			// 			}
			// 			if ($image_array['size'] > 1000000) {
			// 				$erro_desc[] = 'A imagem não pode ser maior que 1MB.';
			// 				$erro = 1;
			// 			}
			// 		} elseif ($image_array['error'] == 2) {
			// 			$erro_desc[] = 'O arquivo ultrapassou o limite do servidor';
			// 			$erro = 1;
			// 		} else {
			// 			$erro_desc[] = 'Ocorreu um erro no upload da sua imagem';
			// 			$erro = 1;
			// 		}

			// 		if ($erro == 0) {
			// 			$this->request->data['Perfil']['imagem'] = $this->request->data['Perfil']['imagem']['name'];
			// 		}
			// 	}
			// 	if (!empty($this->request->data['Usuario']['nova_senha'])) {
			// 		if ($this->request->data['Usuario']['nova_senha'] != $this->request->data['Usuario']['repetir_senha']) {
			// 			$erro_desc[] = 'Você não repetiu a nova senha corretamente.';
			// 			$erro = 1;
			// 		} else {
			// 			if (!empty($this->request->data['Usuario']['senha_fake'])) {
			// 				$senha = $this->Usuario->find('first',
			// 					array(
			// 						'fields'=> array('Usuario.senha'),
			// 						'conditions'=> array(
			// 							'Usuario.id'=> $this->auth_Usuario_id
			// 					)));

			// 				$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
			// 				$senha_fake = $passwordHasher->hash(
			// 					$this->request->data['Usuario']['senha_fake']);

			// 				if ($senha['Usuario']['senha'] != $senha_fake) {
			// 					$erro_desc[] = 'Você não informou a sua senha atual corretamente.';
			// 					$erro = 1;
			// 				} else {
			// 					$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
			// 					$nova_senha = $passwordHasher->hash(
			// 						$this->request->data['Usuario']['nova_senha']);

			// 					$this->request->data['Usuario']['senha'] = $nova_senha;
			// 				}
			// 			} else {
			// 				$erro_desc[] = 'Para fazer a alteração da senha você deve informar a sua senha atual.';
			// 				$erro = 1;
			// 			}
			// 		}

			// 	}
			// 	$data_fake = $this->DataUtil->setPadrao($this->request->data['Perfil']['data_nascimento']);
			// 	if (!strtotime($data_fake)) {
			// 		$erro_desc[] = 'A data de nascimento não foi informada corretamente.';
			// 		$erro = 1;
			// 	}
			// 	if ($erro == 0) {
			// 		$this->request->data['Perfil']['data_nascimento'] = $data_fake;
			// 		$this->request->data['Usuario']['id'] = $this->auth_Usuario_id;
			// 		// Debugger::dump($this->request->data);
			// 		// exit();
			// 		if ($this->Usuario->save($this->request->data)) {
			// 			$this->request->data['Perfil']['id'] = $this->auth_perfil_id;
			// 			$this->request->data['Perfil']['Usuario_id'] = $this->auth_Usuario_id;
			// 			//Debugger::dump($this->request->data['Perfil']);
			// 			if ($this->Usuario->Perfil->save($this->request->data['Perfil'])) {
							
			// 				$this->Cookie->write('Auth.nome', $this->request->data['Perfil']['name']);
			// 				if (isset($this->request->data['Perfil']['imagem'])) {
			// 					$this->Cookie->write('Auth.imagem', $this->request->data['Perfil']['imagem']);
								
			// 					$image = WideImage::load($image_array['tmp_name']);
			// 					$pasta_salvar = new Folder(WWW_ROOT . 'img' . DS . 'Usuarios/' . $this->auth_Usuario_id, true, 0755);
						
			// 					$image
			// 						->resize(60, 60, 'outside')
			// 						->crop('center', 'center', 60, 60)
			// 						->saveToFile($pasta_salvar->path . DS . $image_array['name'], 85);
			// 				}

			// 				$this->Session->setFlash(__('Os seus dados foram salvos corretamente.'), 'default', array('class'=> 'alert alert-success'));
			// 				return $this->redirect($this->referer());
			// 			}
			// 		} else {
			// 			$this->request->data['Usuario']['senha'] = '';
			// 			$this->request->data['Usuario']['nova_senha'] = '';
			// 			$this->request->data['Usuario']['repetir_senha'] = '';
			// 			$this->Session->setFlash(__('Ocorreu um erro ao salvar os seus dados.'), 'default', array('class'=> 'alert alert-danger'));
			// 		}
			// 	} else {
			// 		$this->Session->setFlash(join('<br>', $erro_desc), 'default', array('class'=> 'alert alert-danger'));
			// 	}
			// } else {
			// 	$Usuario = $this->Usuario->find('first', array('conditions'=> array('Usuario.id'=> $this->auth_Usuario_id)));
			
			// 	$this->request->data = $Usuario;

			// 	$this->request->data['Perfil']['data_nascimento'] = $this->DataUtil->reverse($this->request->data['Perfil']['data_nascimento']);

			// 	$this->request->data['Usuario']['senha'] = '';

			// 	$this->set(compact('Usuario'));
			// }


		$title_for_layout = 'Meus dados - ' . $this->site_name;
		$this->set(compact('title_for_layout'));
	}

	public function _logar($login = null, $senha = null) {
		if (is_null($login) OR is_null($senha)) {
			return false;
		}
		$this->loadModel('Usuario');
		$this->Usuario->recursive = 1;
		
		$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
		
		$senha = $passwordHasher->hash(
			$senha);
		
		$Usuario = $this->Usuario->find('first',
			array(
				'conditions'=> array(
					'Usuario.email'=> $login,
					'Usuario.senha'=> $senha
				)
			)
		);

		if (!empty($Usuario)) {
			$this->_loginSession($Usuario);
			$this->_checkLogin();
			return true;
		} else {
			return false;	
		}
	}

	public function _loginSession($Usuario){
		$this->Cookie->write('Auth.flag', true);
		$this->Cookie->write('Auth.Usuario_id', $Usuario['Usuario']['id']);
		$this->Cookie->write('Auth.nome', $Usuario['Perfil']['name']);
		$this->Cookie->write('Auth.apelido', $Usuario['Perfil']['apelido']);
		$this->Cookie->write('Auth.email', $Usuario['Usuario']['email']);
		$this->Cookie->write('Auth.perfil_id', $Usuario['Perfil']['id']);
		if (!empty($Usuario['Perfil']['imagem'])) {
			$this->Cookie->write('Auth.imagem', $Usuario['Perfil']['imagem']);
		}
		
	}

	public function _logarFacebook($email = null, $id = null){
		// $this->loadModel('Usuario');
		// $usuario = $this->Usuario->find(
		// 	'first',
		// 	array(
		// 		'Usuario.facebook_id'=> $id,
		// 		'Usuario.email'=> $email
		// 	)
		// );

		// if (!empty($usuario)) {
		// 	return true;
		// } else {
		// 	return false;
		// }

	}

	public function facebook_retorno() {
		// FacebookSession::setDefaultApplication('515451498581874', '70d953834a6ea69e31dbf4443b52ba14');
		// $redirect_url = 'http://localhost/agito_v2/site/facebook_retorno';
		// $helper = new FacebookRedirectLoginHelper($redirect_url);

		// try {
		// $session = $helper->getSessionFromRedirect();
		// } catch(FacebookRequestException $ex) {
		// // When Facebook returns an error
		// 	echo 'Facebook retorna erro';
		// } catch(\Exception $ex) {
		// // When validation fails or other local issues
		// 	echo 'local issue';
		// }
		// if (!empty($session)) {
		// 	// Logged in
		// 	try {
		// 		$user_profile = (new FacebookRequest(
		// 			$session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
				
		// 		$email = $user_profile->getEmail();
		// 		$id = $user_profile->getId();
		// 		$this->_logarFacebook($email, $id);

		// 	} catch(FacebookRequestException $e) {
		// 		echo "Exception occured, code: " . $e->getCode();
		// 		echo " with message: " . $e->getMessage();
		// 	}   
		// }

		// $this->autoRender = false;
	}

	public function login(){
		// FacebookSession::setDefaultApplication('515451498581874', '70d953834a6ea69e31dbf4443b52ba14');

		// $redirect_url = 'http://localhost/agito_v2/site/facebook_retorno';

		// $helper = new FacebookRedirectLoginHelper($redirect_url);
		// $loginUrl = $helper->getLoginUrl();
		// $this->set('loginRedirect', $loginUrl);

		$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
		$this->set(compact('widget_estabelecimentos'));

		$title_for_layout = 'Entrar - ' . $this->site_name;
		$this->set(compact('title_for_layout'));

		if ($this->request->is(array('post'))) {
			if($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(
					__('A combinação login/senha está incorreta.'),
					'default',
					array('class'=> 'alert alert-danger'));
			}
			// if($this->_logar($this->request->data['Usuario']['email'], $this->request->data['Usuario']['senha'])) {
			// 	return $this->redirect(array('controller'=> 'site', 'action'=> 'home'));
			// } else {
			// 	$this->request->data['Usuario']['senha'] = '';
			// 	$this->Session->setFlash(
			// 		__('A combinação login/senha está incorreta.'),
			// 		'default',
			// 		array('class'=> 'alert alert-danger'));
			// }
		}
	}
	public function logout(){
		return $this->redirect($this->Auth->logout());
	}

	public function resetaSenha(){
		$email = $this->request->query['email'];
		$token = $this->request->query['token'];

		if (empty($email) OR empty($token)) {
			throw new NotFoundException('Url inválida.');
		}

		$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
		$this->set(compact('widget_estabelecimentos'));

		$title_for_layout = 'Resetar Senha - ' . $this->site_name;
		$this->set(compact('title_for_layout'));

		if ($this->request->is('post')) {
			$nova_senha = $this->request->data['Usuario']['nova_senha_resetada'];
			$repetir_nova_senha = $this->request->data['Usuario']['repetir_nova_senha_resetada'];

			if (empty($nova_senha) OR $nova_senha != $repetir_nova_senha){
				$this->Session->setFlash('Você não confirmou a senha corretamente.', 'default', array('class'=> 'alert alert-danger'));
			} elseif (strlen($nova_senha) < 6 OR strlen($nova_senha) > 10) {
				$this->Session->setFlash('A senha deve conter no mínimo 6 e no máximo 10 caracteres.', 'default', array('class'=> 'alert alert-danger'));
			} else {
				$this->loadModel('Usuario');
				$this->Usuario->recursive = -1;
				$options['conditions'] = array('Usuario.email'=> $email, 'Usuario.token_senha'=> $token);

				$usuario = $this->Usuario->find('first', $options);

				if (empty($usuario)) {
					$this->Session->setFlash('A combinação do email/token da url é inválida.', 'default', array('class'=> 'alert alert-danger'));
				} else {
					$id = $usuario['Usuario']['id'];
					if ($this->Usuario->save(array('id'=> $id, 'senha'=> $nova_senha, 'token_senha'=> null))) {
						$this->Session->setFlash('A sua senha foi alterada com sucesso.', 'default', array('class'=> 'alert alert-success'));
						return $this->redirect(array('controller'=> 'site', 'action'=> 'home'));
					} else {
						$this->Session->setFlash('Ocorreu um erro ao tentar alterar a senha.', 'default', array('class'=> 'alert alert-danger'));
					}
				}
			}
			return $this->redirect(array(
				'controller'=> 'site',
				'action'=> 'resetaSenha',
				'?'=> array('email'=> $email, 'token'=> $token)
				)
			);
		}
	}

	public function requisitaSenha(){
		$widget_estabelecimentos = $this->_getWidgetEstabelecimentos();
		$this->set(compact('widget_estabelecimentos'));

		$title_for_layout = 'Requisição de senha - ' . $this->site_name;
		$this->set(compact('title_for_layout'));

		if ($this->request->is('post')) {
			$this->loadModel('Usuario');
			$this->Usuario->recursive = -1;

			$email = $this->request->data['Usuario']['email'];

			$options['fields'] = array('id');
			$options['conditions'] = array('Usuario.email'=> $email);
			$usuario = $this->Usuario->find('first', $options);

			if (!empty($usuario)) {
				$token = md5(date("Y-m-d H:i:s") . rand(1,10000));
				if ($this->Usuario->save(array('id'=> $usuario['Usuario']['id'], 'token_senha'=> $token))) {
					$this->Session->setFlash('As informações para resetar a senha foram enviadas para o email '.$email.'.', 'default', array('class'=> 'alert alert-success'));
					return $this->redirect(array('controller'=> 'site', 'action'=> 'home'));
				}
			} else {
				$this->Session->setFlash('Não existe nenhum usuário cadastrado com este email.', 'default', array('class'=> 'alert alert-danger'));
			}
		}
	}
}
