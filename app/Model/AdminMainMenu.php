<?php
App::uses('AppModel', 'Model');
/**
 * Categoria Model
 *
 * @property Estabelecimento $Estabelecimento
 */
class AdminMainMenu extends AppModel {
	public $useTable = false;

	public function get() {
		return array(
			array(
				'label'=> 'Clientes',
				'url'=> array(
					'controller'=> 'clientes',
					'action'=> 'index'),
				'icon'=> 'list-alt'),			
			array(
				'label'=> 'Estabelecimentos',
				'url'=> array(
					'controller'=> 'estabelecimentos',
					'action'=> 'index'),
				'icon'=> 'stats'),
			array(
				'label'=> 'Carrossel',
				'url'=> array(
					'controller'=> 'destaques',
					'action'=> 'index'),
				'icon'=> 'th'),
			array(
				'label'=> 'Comentários',
				'url'=> array(
					'controller'=> 'comentarios',
					'action'=> 'index'),
				'icon'=> 'comment'),
			array(
				'label'=> 'Contatos',
				'url'=> array(
					'controller'=> 'contatos',
					'action'=> 'index'),
				'icon'=> 'envelope'),
			array(
				'label'=> 'Usuários',
				'url'=> array(
					'controller'=> 'usuarios',
					'action'=> 'index'),
				'icon'=> 'user'),			
			array(
				'label'=> 'Cartões',
				'url'=> array(
					'controller'=> 'cartoes',
					'action'=> 'index'),
				'icon'=> 'shopping-cart'),
			array(
				'label'=> 'Categorias',
				'url'=> array(
					'controller'=> 'categorias',
					'action'=> 'index'),
				'icon'=> 'th-list'),

			array(
				'label'=> 'Subcategorias',
				'url'=> array(
					'controller'=> 'subcategorias',
					'action'=> 'index'),
				'icon'=> 'align-left'),
			array(
				'label'=> 'Banners',
				'url'=> array(
					'controller'=> 'anuncios',
					'action'=> 'index'),
				'icon'=> 'picture'),
			array(
				'label'=> 'Newsletter',
				'url'=> array(
					'controller'=> 'divulgacoes',
					'action'=> 'index'),
				'icon'=> 'send'),
			);
	}

}
