<div class="perfis view">
<h2><?php echo __('Perfil'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($perfil['Perfil']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($perfil['Perfil']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($perfil['Perfil']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($perfil['Perfil']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Avatar Squared'); ?></dt>
		<dd>
			<?php echo h($perfil['Perfil']['avatar_squared']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Perfil'), array('action' => 'edit', $perfil['Perfil']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Perfil'), array('action' => 'delete', $perfil['Perfil']['id']), null, __('Are you sure you want to delete # %s?', $perfil['Perfil']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Perfis'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Perfil'), array('action' => 'add')); ?> </li>
	</ul>
</div>
