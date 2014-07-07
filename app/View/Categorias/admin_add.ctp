<div class="breadcrumb breadcrumb-admin">
	<li>
		<?php echo $this->Html->link('Categorias', array('action'=> 'index')) ?>
	</li>
	<li class="active">
		Categoria
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Session->flash(); ?>
		</div>
		<div class="col-md-12">
			<?php echo $this->Form->create('Categoria', array('type'=> 'file', 'novalidate'=> true)); ?>
				<?php echo $this->element('Categorias/form'); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>