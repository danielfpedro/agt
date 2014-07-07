<?php echo $this->Html->script('Site/admin_destaques_form', array('inline'=> false)); ?>

<?php echo $this->Form->input('id'); ?>

<div class="form-group" style="<?php echo (empty($this->request->data['Destaque']['id']))? '' : 'display: none'; ?>">
	<label for="">Tipo</label>
	<select id="tipo" name="tipo" class="form-control">
		<option value="0" <?php echo (!empty($this->request->data['Destaque']['estabelecimento_id'])) ? 'selected' : ''; ?> >
			Estabelecimento
		</option>
		<option value="1" <?php echo (empty($this->request->data['Destaque']['estabelecimento_id'])) ? 'selected' : ''; ?> >
			Personalizado
		</option>
	</select>
	<hr>
</div>
	

<div id="container-estabelecimento" style="<?php echo (empty($this->request->data['Destaque']['estabelecimento_id'])) ? 'display: none': ''; ?>">
	<div class="form-group">
		<?php echo $this->Form->input('estabelecimento_id', array('class'=> 'form-control','empty'=> 'Selecione o estabelecimento:')); ?>
	</div>
</div>


<div
	id="container-personalizado"
	style="<?php echo (!empty($this->request->data['Destaque']['estabelecimento_id'])) ? 'display: none': ''; ?>">
	<div class="form-group">
		<?php echo $this->Form->input('imagem', array('class'=> 'form-control', 'type'=> 'file')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('titulo', array('class'=> 'form-control')); ?>
	</div>

	<label for="DestaqueLink">Link</label>
	<div class="form-group">
		<div class="row">
			<div class="col-md-8">
				<?php echo $this->Form->input('link', array('label'=> false,'class'=> 'form-control')); ?>	
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
</div>

<div class="form-group">
	<div class="row">
		<div class="col-md-1">
			<?php echo $this->Form->input('ordem', array('class'=> 'form-control','maxlength'=> 2)); ?>	
		</div>
	</div>
</div>

<div class="form-group">
	<button type="submit" class="btn btn-primary">
		<span class="glyphicon glyphicon-ok"></span> Salvar
	</button>
</div>