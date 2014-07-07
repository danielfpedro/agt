<?php echo $this->Html->script('Site/admin_estabelecimentos_index', array('inline'=> false)); ?>
<div class="breadcrumb breadcrumb-admin">
	<li class="active">
		Estabelecimentos
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Session->flash(); ?>
		</div>
		<div class="col-md-12">
			<?php
			echo $this->Html->link(
				"Novo estabelecimento",
				array('action'=> 'add'),
				array('class'=> 'btn btn-success btn-novo',
					'escape'=> false
				));
			?>
		</div>
	</div>
	
	<br>
	<div class="well well-sm">
		<div class="row clearfix">
			<div class="col-md-12">
				<form method="GET" class="form-inline">
					<input
						type="text"
						class="form-control txt-search"
						placeholder="Pesquisar"
						name="q"
						value="<?php echo $this->request->query['q']; ?>">
					<?php
						echo '&nbsp;';
						echo $this->Form->input('categoria', array(
							'value'=> $this->request->query['categoria'],
							'empty'=> 'Todos as categorias',
							'name'=> 'categoria',
							'label'=> false,
							'class'=>
							'form-control',
							'div'=> false));
						echo '&nbsp;';
					?>
					<button class="btn btn-default hidden-xs">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</form>
			</div>
		</div>
	</div>

	<div class="table-responsive clearfix">
		<table class="table table-condensed table-hover table-striped table-admin">
			<thead>
				<tr>
					<th style="width: 170px;"></th>
					<th style="width: 200px;">
						<?php echo $this->Paginator->sort('name', 'Nome'); ?>
					</th>
					<th style="width: 100px;">
						Subcategorias
					</th>	
					<th style="width: 80px;" class="text-center">
						<?php echo $this->Paginator->sort('tipo_cadastro', 'Tipo'); ?>
					</th>
					<th style="width: 80px;" class="text-center">
						<?php echo $this->Paginator->sort('ativo', 'Status'); ?>
					</th>		
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($estabelecimentos)): ?>
					<?php foreach ($estabelecimentos as $estabelecimento): ?>						
						<tr>
							<td style="text-align: center;">
								<?php
									$img_url = 'Estabelecimentos/' .
										$estabelecimento['Estabelecimento']['slug'] . '/' .
										$estabelecimento['Estabelecimento']['imagem_300x170'];
									echo $this->Html->image($img_url, $options = array('width'=> '160')); ?>
							</td>
							<td>
								<?php
									echo $this->Html->link(
										$estabelecimento['Estabelecimento']['name'],
										array(
											'admin'=> false,
											'controller' => 'site',
											'action' => 'perfil',
											$estabelecimento['Estabelecimento']['slug']
										),
										array('target'=> '_blank')
									);
									echo ' // ' . $estabelecimento['Estabelecimento']['cidade'];
								?>
								<p>
									<?php
										$categorias = array();
										foreach ($estabelecimento['Categoria'] as $key => $value) {
											$categorias[] = $value['name'];
										}
										foreach ($categorias as $key => $value) {
											echo __('<span class="label label-primary">%s</span> ', $value);
										}
									?>
								</p>
								<p>
									<?php echo $this->Text->truncate($estabelecimento['Estabelecimento']['descricao'], 100); ?>
								</p>
							</td>			
							<td>
								<?php
									if (!empty($estabelecimento['Subcategoria'])) {
										$subcategorias = array();
										foreach ($estabelecimento['Subcategoria'] as $key => $value) {
											$subcategorias[] = $value['name'];
										}
										foreach ($subcategorias as $key => $value) {
											echo __('<span class="label label-primary">%s</span> ', $value);
										}
									} else {
										echo '<em class="text-muted">Nenhuma subcategoria informada.</em>';
									}
								?>
							</td>
							<td class="text-center">
								<?php echo ($estabelecimento['Estabelecimento']['tipo_cadastro'] == 1) ?
									'<span class="label label-info">Simples</span>' :
									'<span class="label label-primary">Completo</span>';
								?>
							</td>
							<td class="text-center">
								<?php echo ($estabelecimento['Estabelecimento']['ativo']) ?
									'<span class="label label-success">Ativo</span>':
									'<span class="label label-danger">Inativo</span>';
								?>
							</td>
							<td class="text-center" style="width:90px;">
								<?php
									echo $this->Html->link(
										"<span class='glyphicon glyphicon-pencil'></span>",
										array(
											'action' => 'edit',
											$estabelecimento['Estabelecimento']['id']),
										array(
											'class'=> 'btn btn-sm btn-primary tt',
											'title'=> 'Editar',
											'escape'=> false
										)
									);
									echo "&nbsp;";
									echo $this->Form->postLink(
										"<span class='glyphicon glyphicon-remove'></span>",
										array(
											'action' => 'delete',
											$estabelecimento['Estabelecimento']['id']),
										array(
											'class'=> 'btn btn-sm btn-danger tt',
											'title'=> 'Remover',
											'escape'=> false
										),
										__('Você tem certeza que deseja deletar # %s?'
										, $estabelecimento['Estabelecimento']['id'])
									);
								?>
							</td>
						<tr>					
					<?php endforeach; ?>
				<?php else: ?>
					<td colspan="27">Nenhuma informação encontrada.</td>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	
	<br>

	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-8">
			<?php
				echo $this->Paginator->counter(
					array(
						'format'=> 'Página {:page}/{:pages} de {:count} registro(s)'
					));
			?>	
		</div>
		<div class="col-md-6 col-sm-6 col-xs-4 text-right">
			<?php echo $this->element('BootstrapAdmin.paginator_numbers'); ?>
		</div>
	</div>
</div>