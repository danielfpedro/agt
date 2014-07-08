<?php
echo $this->Form->input('name', array('type'=> 'hidden'));
echo $this->Form->input('largura', array('type'=> 'hidden'));
echo $this->Form->input('altura', array('type'=> 'hidden'));
?>

<div class="form-group">
	<?php echo $this->Form->input('imagem', array(
		'label'=> '*Imagem', 'type'=> 'file','class'=> 'form-control', 'error'=> false)); ?>
	<p class="help-block">A imagem deve ter a largura de <strong><?php echo $largura ?> x <?php echo $altura; ?></strong> de altura, no máximo 1MB e estar no Formato JPG ou PNG.</p>
</div>

<?php echo $this->Form->label('url', 'Link') ?>
<div class="form-group">
	<div class="row">
		<div class="col-md-8">
			<?php echo $this->Form->input('url', array('label'=> false,'class'=> 'form-control')); ?>	
			<p class="help-block">Inserir link sem "http" e "www", exemplo: "google.com"</p>
		</div>
		<div class="col-md-4">
			<?php echo $this->Form->input(
				'target',
				array(
					'label'=> false,
					'class'=> 'form-control',
					'options'=> array(
						'_blank'=> 'Abrir link em uma nova janela',
						'_self'=> 'Abrir link na mesma janela',
					)
				)); ?>
		</div>
	</div>
</div>


<div class="form-group">
	<?php echo $this->Form->input('ativo', array(
		'label'=> 'Ativo', 'type'=> 'checkbox', 'error'=> false)); ?>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-primary">
		<span class="glyphicon glyphicon-ok"></span> Salvar
	</button>
</div>

<div>
	<?php echo $this->Html->image('Banners/' . $imagem, $options = array()); ?>
</div>