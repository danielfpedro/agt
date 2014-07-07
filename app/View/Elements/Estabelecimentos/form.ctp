<?php echo $this->Html->script('Site/admin_estabelecimentos', array('inline'=> false)); ?>
<?php echo $this->Html->script('../lib/maskedinput-1.3.1/jquery.maskedinput.min', array('inline'=> false)); ?>

<div class="form-group">
	<?php echo $this->Form->input('Categoria',
		array('label'=> '*Categoria','class'=> 'form-control', 'error'=> false)); ?>
	<p class="help-block">Você deve selecionar ao menos uma categoria.</p>
</div>
<div class="form-group">
	<?php echo $this->Form->input('cliente_id', array(
		'label'=> '*Cliente', 'class'=> 'form-control', 'empty'=> 'Selecione:', 'error'=> false)); ?>
</div>

<?php echo $this->Form->Label('imagem', '*Imagem principal'); ?>
<div class="row">
	<?php if (!empty($this->request->data['Estabelecimento']['imagem_70x70'])): ?>
		<div class="col-md-2">
			<div class="form-group">
				<?php
					echo $this->Html->image('Estabelecimentos/' .
						$this->request->data['Estabelecimento']['slug'] . '/' .
						$this->request->data['Estabelecimento']['imagem_300x170'],
						$options = array('width'=> '100%'));
				?>
			</div>
		</div>
	<?php endif ?>
	<div class="col-md-6">
		<div class="form-group">
			<?php echo $this->Form->input('imagem', array(
				'label'=> false,
				'type'=> 'file',
				'class'=> 'form-control',
				'accept'=> 'image/*',
				'error'=> false)); ?>
			<p class="help-block">A imagem deve conter no máximo 1MB e estar no Formato JPG ou PNG.</p>
		</div>	
	</div>
</div>

<div class="form-group">
	<?php echo $this->Form->input('name', array(
		'label'=> '*Nome', 'class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php
		echo $this->Form->input('descricao', array(
			'type'=> 'textarea',
			'label'=> '*Descrição',
			'class'=> 'form-control',
			'maxlength'=> 300,
			'error'=> false
			)
		);
	?>
	<p class="help-block">A descrição deve conter no máximo 300 caracteres.</p>
</div>
<div class="form-group">
	<?php echo $this->Form->input('endereco', array(
		'label'=> '*Endereço', 'class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="form-group">
	<?php echo $this->Form->input('cidade', array(
		'label'=> '*Cidade','class'=> 'form-control', 'error'=> false)); ?>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			<?php echo $this->Form->input('telefone',
				array(
					'label'=> '*Telefone', 'class'=> 'form-control telefone', 'error'=> false)); ?>
		</div>
	</div>
</div>


<?php echo $this->Form->Label('Estabelecimento.horario_funcionamento_inicial', '*Horário de funcionamento'); ?>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			<?php echo $this->Form->input('horario_funcionamento_inicial',
				array(
					'label'=> false,
					'type'=> 'text',
					'placeholder'=> 'De',
					'class'=> 'form-control hora', 'error'=> false)); ?>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?php echo $this->Form->input('horario_funcionamento_final',
				array(
					'label'=> false,
					'type'=> 'text',
					'placeholder'=> 'Até',
					'class'=> 'form-control hora', 'error'=> false)); ?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<?php echo $this->Form->input('tipo_comida', array(
				'label'=> 'Tipo de comida', 'class'=> 'form-control', 'error'=> false)); ?>
		</div>
	</div>
</div>

<div class="form-group">
	<?php echo $this->Form->input('Subcategoria', array(
		'class'=> 'form-control', 'error'=> false)); ?>
</div>

<div class="form-group">
	<?php
		echo $this->Form->input('tipo_cadastro',
			array(
				'error'=> false,
				'label'=> 'Tipo de cadastro', 'options'=> array(1=> 'Simples', 2=> 'Completo'),'class'=> 'form-control')); ?>
</div>

<div id="cont-completo" style="<?php echo (isset($this->request->data['Estabelecimento']['tipo_cadastro']) == true AND $this->request->data['Estabelecimento']['tipo_cadastro'] == 2)? '': 'display: none;';?>">
	
	<hr>

	<?php echo $this->Form->Label('imagem2', '*Imagem extra 1'); ?>
	<div class="row">
		<?php if (!empty($this->request->data['Estabelecimento']['imagem2_300x170'])): ?>
			<div class="col-md-2">
				<div class="form-group">
					<?php
						echo $this->Html->image('Estabelecimentos/' .
							$this->request->data['Estabelecimento']['slug'] . '/' .
							$this->request->data['Estabelecimento']['imagem2_300x170'],
							$options = array('width'=> '100%'));
					?>
				</div>
			</div>
		<?php endif ?>
		<div class="col-md-6">
			<div class="form-group">
				<?php echo $this->Form->input('imagem2', array(
					'label'=> false,
					'type'=> 'file',
					'class'=> 'form-control',
					'accept'=> 'image/*',
					'error'=> false)); ?>
				<p class="help-block">A imagem deve conter no máximo 1MB e estar no Formato JPG ou PNG.</p>
			</div>	
		</div>
	</div>
	<?php echo $this->Form->Label('imagem3', '*Imagem extra 2'); ?>
	<div class="row">
		<?php if (!empty($this->request->data['Estabelecimento']['imagem3_300x170'])): ?>
			<div class="col-md-2">
				<div class="form-group">
					<?php
						echo $this->Html->image('Estabelecimentos/' .
							$this->request->data['Estabelecimento']['slug'] . '/' .
							$this->request->data['Estabelecimento']['imagem3_300x170'],
							$options = array('width'=> '100%'));
					?>
				</div>
			</div>
		<?php endif ?>
		<div class="col-md-6">
			<div class="form-group">
				<?php echo $this->Form->input('imagem3', array(
					'label'=> false,
					'type'=> 'file',
					'class'=> 'form-control',
					'accept'=> 'image/*',
					'error'=> false)); ?>
				<p class="help-block">A imagem deve conter no máximo 1MB e estar no Formato JPG ou PNG.</p>
			</div>	
		</div>
	</div>
	<hr>
	<div class="form-group">
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->input('site', array('class'=> 'form-control')); ?>	
			</div>
		</div>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('area_fumantes', array('type'=> 'checkbox')); ?>
		<?php echo $this->Form->input('ar_livre', array('type'=> 'checkbox')); ?>
		<?php echo $this->Form->input('ar_condicionado', array('type'=> 'checkbox')); ?>
		<?php echo $this->Form->input('faz_reserva', array('type'=> 'checkbox')); ?>
		<?php echo $this->Form->input('estacionamento', array('type'=> 'checkbox')); ?>
		<?php echo $this->Form->input('faz_entrega', array('type'=> 'checkbox')); ?>
		<?php echo $this->Form->input('wifi', array('type'=> 'checkbox')); ?>				
		<?php echo $this->Form->input('acesso_deficiente', array('type'=> 'checkbox')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('Cartao', array(
			'class'=> 'form-control', 'label'=> 'Cartões', 'error'=> false)); ?>
	</div>

	<div class="form-group">
		<?php echo $this->Form->label('inaugurado', 'Data de inauguração'); ?>
		<br style="clear: both;">
		<div style="float: left; margin-right: 4px;">
			<?php echo $this->Form->day('inaugurado', array(
				'class'=> 'form-control', 'empty'=> 'Dia:')); ?>	
		</div>
		<div style="float: left; margin-right: 4px;">
			<?php echo $this->Form->month('inaugurado', array(
				'class'=> 'form-control', 'empty'=> 'Mês:')); ?>	
		</div>
		<div style="float: left; margin-right: 4px;">
			<?php echo $this->Form->year('inaugurado', date('Y') - 120, date('Y'), array(
				'class'=> 'form-control', 'empty'=> 'Ano:')); ?>
		</div>
	</div>

	<hr style="clear: both;">
</div>

<div class="form-group">
	<?php echo $this->Form->input('ativo', array('type'=> 'checkbox')); ?>
</div>

<div class="form-group" style="margin: 40px 0 60px 0;">
	<button type="submit" class="btn btn-primary">
		<span class="glyphicon glyphicon-ok"></span> Salvar
	</button>
</div>