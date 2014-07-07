<div class="breadcrumb breadcrumb-admin">
	<li>
		<?php echo $this->Html->link('Subcategorias', array('action'=> 'index')) ?>
	</li>
	<li class="active">
		Subcategoria
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Session->flash(); ?>
		</div>
		<div class="col-md-12">
			<?php echo $this->Form->create('Subcategoria', array('novalidate'=> true)); ?>
				<?php echo $this->element('Subcategorias/form'); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>