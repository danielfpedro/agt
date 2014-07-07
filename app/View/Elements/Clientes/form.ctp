<?php echo $this->Html->script('Site/admin_clientes', array('inline'=> false)); ?>
<?php echo $this->Html->script('../lib/maskedinput-1.3.1/jquery.maskedinput.min', array('inline'=> false)); ?>

<div class="form-group">
	<?php echo $this->Form->input('razao_social',
		array('label'=> 'Razão Social', 'class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('name',
		array('label'=> '*Nome fantasia', 'class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('email',
		array('label'=> '*Email', 'class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('cnpj',
		array('class'=> 'form-control cnpj', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('telefone',
		array('label'=> '*Telefone', 'class'=> 'form-control telefone', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('telefone2',
		array('class'=> 'form-control telefone', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('celular',
		array('class'=> 'form-control telefone', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('endereco',
		array('label'=> '*Endereço','class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('bairro',
		array('label'=> '*Bairro','class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('cidade',
		array('label'=> '*Cidade', 'class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('estado_id',
		array('label'=> '*Estado', 'empty'=> 'Selecione:', 'class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-primary">
		<span class="glyphicon glyphicon-ok"></span> Salvar
	</button>
</div>	