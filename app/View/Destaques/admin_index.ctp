<div class="breadcrumb breadcrumb-admin">
	<li class="active">
		Carrossel
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php
			echo $this->Html->link(
				"Adicionar item ao carrossel",
				array('action'=> 'form'),
				array('class'=> 'btn btn-success btn-novo',
					'escape'=> false
				));
			?>
		</div>
	</div>
	
	<br>
	<br>

	<div class="table-responsive clearfix">
		<table class="table table-condensed table-hover table-striped table-admin">
			<thead>
				<tr>
					<th style="width: 100px; text-align: center;"></th>
					<th>
						<?php echo $this->Paginator->sort('titulo'); ?>
					</th>
					<th style="width: 190px; text-align: center;">
						<?php echo $this->Paginator->sort('link'); ?>
					</th>
					<th style="width: 260px;">
						<?php echo $this->Paginator->sort('estabelecimento_id'); ?>
					</th>
					<th style="width: 80px;text-align: center;">
						<?php echo $this->Paginator->sort('ordem'); ?>
					</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($destaques)): ?>
					<?php foreach ($destaques as $destaque): ?>						
						<tr>
							<td style="text-align: center;">
								<?php if (!empty($destaque['Destaque']['imagem_70x70'])): ?>
									<?php
										echo $this->Html->image(
										'Carrossel/' . $destaque['Destaque']['imagem_70x70'], array()); ?>
								<?php endif ?>
							</td>
							<td>
								<?php echo h($destaque['Destaque']['titulo']); ?>
							</td>
							<td style="text-align: center;">
								<?php if (!empty($destaque['Destaque']['link'])): ?>
									<p><?php echo h($destaque['Destaque']['link']); ?></p>
									<p class="text-muted">
										<?php if ($destaque['Destaque']['target'] == '_blank'): ?>
											Abre em uma nova janela
										<?php else: ?>
											Abre na mesma janela
										<?php endif ?>
									</p>
								<?php endif ?>
							</td>
							<td>
								<?php if (!empty($destaque['Estabelecimento']['name'])): ?>
									<?php echo $destaque['Estabelecimento']['name'] ?>
								<?php else: ?>
									<span class="text-muted">
										<?php echo 'nenhum estabelecimento atribuído.'; ?>
									</span>
								<?php endif ?>
							</td>
							<td style="text-align: center;">
								<span class="label label-primary">
									<?php echo h($destaque['Destaque']['ordem']); ?>	
								</span>
							</td>					
							<td class="text-center" style="width:90px;">
								<?php
									echo $this->Html->link(
										"<span class='glyphicon glyphicon-pencil'></span>",
										array(
											'action' => 'form',
											$destaque['Destaque']['id']),
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
											$destaque['Destaque']['id']),
										array(
											'class'=> 'btn btn-sm btn-danger tt',
											'title'=> 'Remover',
											'escape'=> false
										),
										__('Você tem certeza que deseja deletar # %s?'
										, $destaque['Destaque']['id'])
									);
								?>
							</td>
						<tr>					
					<?php endforeach; ?>
				<?php else: ?>
					<td colspan="6">Nenhuma informação encontrada.</td>
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