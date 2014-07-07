<div class="breadcrumb breadcrumb-admin">
	<li>
		<?php echo $this->Html->link('Estabelecimentos', array('action'=> 'index')) ?>
	</li>
	<li class="active">
		Estabelecimento
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Session->flash(); ?>
		</div>
		<div class="col-md-12">
			<?php echo $this->Form->create('Estabelecimento', array('type'=> 'file', 'novalidate'=> true)); ?>
				<?php echo $this->element('Estabelecimentos/form') ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>