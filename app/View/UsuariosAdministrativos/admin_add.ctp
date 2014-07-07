<div class="breadcrumb breadcrumb-admin">
	<li>
		<?php echo $this->Html->link('Usuários', array('action'=> 'index')) ?>
	</li>
	<li class="active">
		Adicionar usuários
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Form->create('UsuariosAdministrativo'); ?>
				<?php echo $this->element('UsuariosAdministrativos/form'); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>