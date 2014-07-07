<div class="perfis form">
<?php echo $this->Form->create('Perfil'); ?>
	<fieldset>
		<legend><?php echo __('Add Perfil'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('avatar_squared');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Perfis'), array('action' => 'index')); ?></li>
	</ul>
</div>
