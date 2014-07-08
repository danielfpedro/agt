<div class="breadcrumb breadcrumb-admin">
	<li class="active">
		Newsletter
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Session->flash(); ?>
		</div>
	</div>
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
						<?php echo $this->Paginator->sort('email'); ?>
					</th>
					<th style="width: 180px; text-align: center;">
						<?php echo $this->Paginator->sort('created', 'Data de cadastro'); ?>
					</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($divulgacoes)): ?>
					<?php foreach ($divulgacoes as $divulgacao): ?>						
						<tr>
							<td>
								<?php echo h($divulgacao['Divulgacao']['email']); ?>
							</td>
							<td style="text-align: center;">
								<em class="text-muted">
									<?php echo $this->Time->format('d/m/y', $divulgacao['Divulgacao']['created']); ?>
										às
									<?php echo $this->Time->format('h:i', $divulgacao['Divulgacao']['created']); ?>
								</em>
							</td>						
							<td class="text-center" style="width:90px;">
								<?php
									echo $this->Form->postLink(
										"<span class='glyphicon glyphicon-remove'></span>",
										array(
											'action' => 'delete',
											$divulgacao['Divulgacao']['id']),
										array(
											'class'=> 'btn btn-sm btn-danger tt',
											'title'=> 'Remover',
											'escape'=> false
										),
										__('Você tem certeza que deseja deletar este email?'
										, $divulgacao['Divulgacao']['id'])
									);
								?>
							</td>
						<tr>					
					<?php endforeach; ?>
				<?php else: ?>
					<td colspan="5">Nenhuma informação encontrada.</td>
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