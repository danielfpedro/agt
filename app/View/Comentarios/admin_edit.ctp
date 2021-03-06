<div class="breadcrumb breadcrumb-admin">
	<li>
		<?php echo $this->Html->link('Comentarios', array('action'=> 'index')) ?>
	</li>
	<li class="active">
		Comentario
	</li>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Form->create('Comentario'); ?>
				
			<div class="form-group">
				<?php echo $this->Form->input('id', array('class'=> 'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('texto', array('class'=> 'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('usuario_id', array('class'=> 'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('estabelecimento_id', array('class'=> 'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('ativo', array('class'=> 'form-control')); ?>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">
					<span class="glyphicon glyphicon-ok"></span> Salvar
				</button>
			</div>			

			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>