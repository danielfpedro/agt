<?php echo $this->Html->script('../lib/raty-2.5.2/lib/jquery.raty.min'); ?>
<?php echo $this->Html->script('Site/admin_comentarios', array('inline'=> false)); ?>

<div class="breadcrumb breadcrumb-admin">
	<li class="active">
		Comentários
	</li>
</div>

<div class="wrap-internal-page">
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
						echo $this->Form->input('estabelecimento', array(
							'value'=> $this->request->query['estabelecimento'],
							'empty'=> 'Todos os estabelecimentos',
							'name'=> 'estabelecimento',
							'label'=> false,
							'class'=>
							'form-control',
							'div'=> false));
						echo '&nbsp;';
						echo $this->Form->input('ativo', array(
							'options'=> array(1=> 'Somente os liberados', 2=> 'Somente os pendentes'),
							'value'=> $this->request->query['ativo'],
							'empty'=> 'Todos os comentários',
							'name'=> 'ativo',
							'label'=> false,
							'class'=> 'form-control',
							'div'=> false));
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
			<tbody>
				<?php if (!empty($comentarios)): ?>
					<?php foreach ($comentarios as $comentario): ?>						
						<tr>
							<td>
								<?php
									$usuario = $comentario['Usuario']['Perfil']['name'];

									$estabelecimento = $this->Html->link(
										$comentario['Estabelecimento']['name'],
										array(
											'controller' => 'site',
											'action' => 'perfil',
											$comentario['Estabelecimento']['slug'],
											'admin'=> false
										),
										array('target'=> '_blank')
									);
									$data = $this->Time->format('d/m/y h:i', $comentario['Comentario']['created']);
								?>
								<em class="text-muted">
									Comentário de "<?php echo $usuario; ?>" feito no perfil de "<?php echo $estabelecimento ?>" dia <?php echo $data; ?>
								</em>
								<div
									style="margin: 2px 0 10px 0;"
									id="estrelas-readonly"
									data-score="<?php echo $comentario['Comentario']['rate']; ?>">
								</div>
								<p>
									<?php echo h($comentario['Comentario']['texto']); ?>
								</p>
							</td>
							<td class="text-center" style="width: 80px;">
								<?php
									echo $this->Form->create('Comentario', array('inputDefaults'=> array('div'=> false)));
										echo $this->Form->input('ativo', array(
										'label'=> false,
										'type'=> 'checkbox',
										'data-status'=> $comentario['Comentario']['ativo'],
										'data-id'=> $comentario['Comentario']['id'],
										'checked'=> $comentario['Comentario']['ativo']));
									echo $this->Form->end();
								?>

							</td>						
							<td class="text-center" style="width: 80px;">
								<?php
									echo $this->Form->postLink(
										"<span class='glyphicon glyphicon-remove'></span>",
										array(
											'action' => 'delete',
											$comentario['Comentario']['id']),
										array(
											'class'=> 'btn btn-sm btn-danger tt',
											'title'=> 'Remover',
											'escape'=> false
										),
										__('Você tem certeza que deseja deletar # %s?'
										, $comentario['Comentario']['id'])
									);
								?>
							</td>
						<tr>					
					<?php endforeach; ?>
				<?php else: ?>
					<td colspan="8">Nenhuma informação encontrada.</td>
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