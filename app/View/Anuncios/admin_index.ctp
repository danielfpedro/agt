<div class="breadcrumb breadcrumb-admin">
	<li class="active">
		Banners
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Session->flash(); ?>
		</div>
	</div>

	<div class="table-responsive clearfix">
		<table class="table table-condensed table-hover table-striped table-admin">
			<thead>
				<tr>
					<th>
						Banner
					</th>
					<th style="text-align: center;">Link</th>
					<th style="text-align: center;">Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($anuncios)): ?>
					<?php foreach ($anuncios as $anuncio): ?>						
						<tr>
							<td>
								<?php echo h($anuncio['Anuncio']['name']); ?>
							</td>
							<td style="text-align: center;">
								<?php if (!empty($anuncio['Anuncio']['url'])): ?>
									<p><?php echo h($anuncio['Anuncio']['url']); ?></p>
									<p class="text-muted">
										<?php if ($anuncio['Anuncio']['target'] == '_blank'): ?>
											Abre em uma nova janela
										<?php else: ?>
											Abre na mesma janela
										<?php endif ?>
									</p>
								<?php else: ?>
									<em class="text-muted">-</em>
								<?php endif ?>
							</td>
							<td style="text-align: center;">
								<?php
									echo ($anuncio['Anuncio']['ativo']) ?
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
											$anuncio['Anuncio']['id']),
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
											$anuncio['Anuncio']['id']),
										array(
											'class'=> 'btn btn-sm btn-danger tt',
											'title'=> 'Remover',
											'escape'=> false
										),
										__('Você tem certeza que deseja deletar # %s?'
										, $anuncio['Anuncio']['id'])
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