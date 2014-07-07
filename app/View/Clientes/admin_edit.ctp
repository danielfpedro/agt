<div class="breadcrumb breadcrumb-admin">
	<li>
		<?php echo $this->Html->link('Clientes', array('action'=> 'index')) ?>
	</li>
	<li class="active">
		Cliente
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Session->flash(); ?>	
		</div>
		<div class="col-md-12">
			<?php echo $this->Form->create('Cliente', array('novalidate'=> true)); ?>
				<?php echo $this->Form->input('id'); ?>
				<?php echo $this->element('Clientes/form'); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>