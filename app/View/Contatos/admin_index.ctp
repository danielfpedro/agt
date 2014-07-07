<div class="breadcrumb breadcrumb-admin">
	<li class="active">
		Contatos
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
					<th style="width: 300px;">
						Informações
					</th>
					<th>
						<?php echo $this->Paginator->sort('texto'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($contatos)): ?>
					<?php foreach ($contatos as $contato): ?>						
						<tr>
							<td>
								<?php echo h($contato['Contato']['nome']); ?> (<?php echo h($contato['Contato']['email']); ?>)
								<br>
								<?php echo h($contato['Contato']['telefone']); ?>
								<br>
								<?php echo h($contato['Contato']['cidade']); ?>
								<br>
								<em class="text-muted">
									dia <?php echo $this->Time->format('d/m/y', $contato['Contato']['created']); ?> às
									<?php echo $this->Time->format('h:i', $contato['Contato']['created']); ?>
								</em>
							</td>
							<td>
								<?php echo h($contato['Contato']['texto']); ?>
							</td>				
						<tr>					
					<?php endforeach; ?>
				<?php else: ?>
					<td colspan="9">Nenhuma informação encontrada.</td>
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