<div class="breadcrumb breadcrumb-admin">
	<li class="active">
		Clientes
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
				"Novo cliente",
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
			<div class="col-md-10">
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
			<div class="col-md-2">
				<?php echo $this->Html->link(
					'Exportar para XLS',
					array('action'=> 'export_xls'),
					array('class'=> 'btn btn-info btn-block')) ?>
			</div>	
		</div>
	</div>

	<div class="table-responsive clearfix">
		<table class="table table-condensed table-hover table-striped table-admin">
			<thead>
				<tr>
					<th>
						<?php echo $this->Paginator->sort('name', 'Nome'); ?>
					</th>
					<th>
						CNPJ
					</th>
					<th>
						<?php echo $this->Paginator->sort('email'); ?>
					</th>
					<th>
						Telefone
					</th>
					<th>
						Endereço completo
					</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($clientes)): ?>
					<?php foreach ($clientes as $cliente): ?>						
						<tr>
							<td>
								<?php echo h($cliente['Cliente']['name']); ?>
								<?php if (!empty($cliente['Cliente']['razao_social'])): ?>
									<br>
									<em>
										<?php echo h($cliente['Cliente']['razao_social']); ?>
									</em>	
								<?php endif ?>
							</td>
							<td>
								<?php if (!empty($cliente['Cliente']['cnpj'])): ?>
									<?php echo h($cliente['Cliente']['cnpj']); ?>
								<?php else: ?>
									<?php echo '-'; ?>
								<?php endif ?>
							</td>
							<td>
								<?php echo h($cliente['Cliente']['email']); ?>
							</td>
							<td>
								<?php echo h($cliente['Cliente']['telefone']); ?>
							</td>
							<td>
								<?php echo h($cliente['Cliente']['endereco']); ?> , 
								<?php echo h($cliente['Cliente']['bairro']); ?> - 
								<?php echo h($cliente['Cliente']['cidade']); ?> / 
								<?php echo h($cliente['Estado']['sigla']); ?>
							</td>
							<td class="text-center" style="width:90px;">
								<?php
									echo $this->Html->link(
										"<span class='glyphicon glyphicon-pencil'></span>",
										array(
											'action' => 'edit',
											$cliente['Cliente']['id']),
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
											$cliente['Cliente']['id']),
										array(
											'class'=> 'btn btn-sm btn-danger tt',
											'title'=> 'Remover',
											'escape'=> false
										),
										__('Você tem certeza que deseja deletar este cliente?'
										, $cliente['Cliente']['id'])
									);
								?>
							</td>
						<tr>					
					<?php endforeach; ?>
				<?php else: ?>
					<td colspan="13">Nenhuma informação encontrada.</td>
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