<div class="form-group">
	<?php echo $this->Form->input('name', array('label'=> 'Login', 'class'=> 'form-control')); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('fake_senha', array('label'=> 'Nova Senha', 'type'=> 'password', 'class'=> 'form-control', 'value'=> '')); ?>
	 <p class="help-block">Caso não queria alterar a senha deixe o campo em branco.</p>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-primary">
		<span class="glyphicon glyphicon-ok"></span> Salvar
	</button>
</div>	