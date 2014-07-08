<div class="breadcrumb breadcrumb-admin">
	<li>
		<?php echo $this->Html->link('Banners', array('action'=> 'index')) ?>
	</li>
	<li class="active">
		<?php echo $this->request->data['Anuncio']['name']; ?>
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Session->flash(); ?>
		</div>
		<div class="col-md-12">
			<?php echo $this->Form->create('Anuncio', array('type'=> 'file', 'novalidate'=> true)); ?>
				<?php echo $this->Form->input('id'); ?>
				<?php echo $this->element('Anuncios/form'); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>