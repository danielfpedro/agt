<div class="form-group">
	<?php echo $this->Form->input('imagem', array(
		'label'=> '*Imagem', 'type'=> 'file','class'=> 'form-control', 'error'=> false)); ?>
	<p class="help-block">A imagem deve conter no máximo 1MB e estar no Formato JPG ou PNG.</p>
</div>

<div class="form-group">
	<?php echo $this->Form->input('name', array('label'=> '*Nome', 'class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-primary">
		<span class="glyphicon glyphicon-ok"></span> Salvar
	</button>
</div>