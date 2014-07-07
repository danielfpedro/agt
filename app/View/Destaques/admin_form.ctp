<div class="breadcrumb breadcrumb-admin">
	<li>
		<?php echo $this->Html->link('Carrossel', array('action'=> 'index')) ?>
	</li>
	<li class="active">
		Adicionar/editar item do carrossel
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Form->create('Destaque', array('type'=> 'file','novalidate'=> true)); ?>			
				<?php echo $this->element('Destaques/form') ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>