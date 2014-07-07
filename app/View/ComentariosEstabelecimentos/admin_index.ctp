<div class="breadcrumb breadcrumb-admin">
	<li class="active">
		ComentariosEstabelecimentos
	</li>
</div>

<div class="wrap-internal-page">
	<?php echo $this->Session->flash(); ?>	<div class="row">
		<div class="col-md-12">
			<?php
			echo $this->Html->link(
				"Novo comentarios estabelecimento",
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
					<th>
						<?php echo $this->Paginator->sort('id'); ?>
					</th>
					<th>
						<?php echo $this->Paginator->sort('estabelecimento_id'); ?>
					</th>
					<th>
						<?php echo $this->Paginator->sort('comentario_id'); ?>
					</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($comentariosEstabelecimentos)): ?>
					<?php foreach ($comentariosEstabelecimentos as $comentariosEstabelecimento): ?>						
						<tr>
							<td>
								<?php echo h($comentariosEstabelecimento['ComentariosEstabelecimento']['id']); ?>
							</td>
							<td>
								<?php
									echo $this->Html->link(
										$comentariosEstabelecimento['Estabelecimento']['name'],
										array(
											'controller' => 'estabelecimentos',
											'action' => 'view',
											$comentariosEstabelecimento['Estabelecimento']['id']
										));
									
								?>
							</td>
							<td>
								<?php
									echo $this->Html->link(
										$comentariosEstabelecimento['Comentario']['name'],
										array(
											'controller' => 'comentarios',
											'action' => 'view',
											$comentariosEstabelecimento['Comentario']['id']
										));
									
								?>
							</td>						
							<td class="text-center" style="width:90px;">
								<?php
									echo $this->Html->link(
										"<span class='glyphicon glyphicon-pencil'></span>",
										array(
											'action' => 'edit',
											$comentariosEstabelecimento['ComentariosEstabelecimento']['id']),
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
											$comentariosEstabelecimento['ComentariosEstabelecimento']['id']),
										array(
											'class'=> 'btn btn-sm btn-danger tt',
											'title'=> 'Remover',
											'escape'=> false
										),
										__('Você tem certeza que deseja deletar # %s?'
										, $comentariosEstabelecimento['ComentariosEstabelecimento']['id'])
									);
								?>
							</td>
						<tr>					
					<?php endforeach; ?>
				<?php else: ?>
					<td colspan="4">Nenhuma informação encontrada.</td>
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