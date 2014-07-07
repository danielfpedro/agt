<div class="row">
	<div class="col-md-4">
	</div>
	<div class="col-md-4" style="margin-top: 100px;">
		<div class="well">
			<?php echo $this->Form->create(); ?>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('label'=> 'login','class'=> 'form-control input-lg')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('senha', array('type'=> 'password','class'=> 'form-control input-lg')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Session->flash(); ?>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block">Entrar</button>
				</div>

			<div class="form-group">
				<?php echo $this->Form->end(); ?>	
			</div>
		</div>
	</div>
	<div class="col-md-4">
	</div>
</div>