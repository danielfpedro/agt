<div class="breadcrumb breadcrumb-admin">
	<li class="active">
		<?php echo ucfirst($pluralVar)."\n"; ?>
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo "<?php
			echo \$this->Html->link(
				\"Novo ".strtolower($singularHumanName)."\",
				array('action'=> 'add'),
				array('class'=> 'btn btn-success btn-novo',
					'escape'=> false
				));
			?>\n";
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
						value="<?php echo "<?php echo \$this->request->query['q']; ?>"?>">
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
				<?php 
					echo "<tr>\n";
					foreach ($fields as $field) {
						echo "\t\t\t\t\t<th>\n\t\t\t\t\t\t<?php echo \$this->Paginator->sort('{$field}'); ?>\n\t\t\t\t\t</th>\n";
					}
					echo "\t\t\t\t\t<th></th>\n";
					echo "\t\t\t\t</tr>\n";
				?>
			</thead>
			<tbody>
				<?php echo "<?php if (!empty(\${$pluralVar})): ?>\n"; ?>
					<?php echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>"; ?>
						<?php
							echo "\n\t\t\t\t\t\t<tr>";
							foreach ($fields as $field) {
								$isKey = false;
								if (!empty($associations['belongsTo'])) {
									foreach ($associations['belongsTo'] as $alias => $details) {
										if ($field === $details['foreignKey']) {
											$isKey = true;
							echo "
							<td>
								<?php
									echo \$this->Html->link(
										\${$singularVar}['{$alias}']['{$details['displayField']}'],
										array(
											'controller' => '{$details['controller']}',
											'action' => 'view',
											\${$singularVar}['{$alias}']['{$details['primaryKey']}']
										));
									
								?>
							</td>";
											break;
										}
									}
								}
								if ($isKey !== true) {
									echo "\n\t\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t\t\t\t\t</td>";
								}
							}
						?>
						<?php
						echo "
							<td class=\"text-center\" style=\"width:90px;\">
								<?php
									echo \$this->Html->link(
										\"<span class='glyphicon glyphicon-pencil'></span>\",
										array(
											'action' => 'edit',
											\${$singularVar}['{$modelClass}']['{$primaryKey}']),
										array(
											'class'=> 'btn btn-sm btn-primary tt',
											'title'=> 'Editar',
											'escape'=> false
										)
									);
									echo \"&nbsp;\";
									echo \$this->Form->postLink(
										\"<span class='glyphicon glyphicon-remove'></span>\",
										array(
											'action' => 'delete',
											\${$singularVar}['{$modelClass}']['{$primaryKey}']),
										array(
											'class'=> 'btn btn-sm btn-danger tt',
											'title'=> 'Remover',
											'escape'=> false
										),
										__('Você tem certeza que deseja deletar # %s?'
										, \${$singularVar}['{$modelClass}']['{$primaryKey}'])
									);
								?>
							</td>";
						echo "\n\t\t\t\t\t\t<tr>";
						?>
					<?php echo "\n\t\t\t\t\t<?php endforeach; ?>\n"; ?>
				<?php echo "<?php else: ?>\n"; ?>
					<td colspan="<?php echo count($fields) + 1; ?>">Nenhuma informação encontrada.</td>
				<?php echo "<?php endif; ?>\n"; ?>
			</tbody>
		</table>
	</div>
	
	<br>

	<div class="row">
		<?php echo "<div class=\"col-md-6 col-sm-6 col-xs-8\">
			<?php
				echo \$this->Paginator->counter(
					array(
						'format'=> 'Página {:page}/{:pages} de {:count} registro(s)'
					));
			?>";
		?>	
		</div>
		<div class="col-md-6 col-sm-6 col-xs-4 text-right">
			<?php echo "<?php echo \$this->element('BootstrapAdmin.paginator_numbers'); ?>\n"; ?>
		</div>
	</div>
</div>