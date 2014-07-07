<div class="breadcrumb breadcrumb-admin">
	<li>
		<?php echo $this->Html->link('Cartoes', array('action'=> 'index')) ?>
	</li>
	<li class="active">
		Cartao
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Session->flash(); ?>
		</div>
		<div class="col-md-12">
			<?php echo $this->Session->flash(); ?>
		</div>
		<div class="col-md-12">
			<?php echo $this->Form->create('Cartao', array('type'=> 'file', 'novalidate'=> true)); ?>
				<?php echo $this->element('Cartoes/form'); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>