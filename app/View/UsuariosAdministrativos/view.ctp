<h1>hjhjkh</h1>
<div class="usuariosAdministrativos view">
<h2><?php echo __('Usuarios Administrativo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usuariosAdministrativo['UsuariosAdministrativo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($usuariosAdministrativo['UsuariosAdministrativo']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($usuariosAdministrativo['UsuariosAdministrativo']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($usuariosAdministrativo['UsuariosAdministrativo']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Login'); ?></dt>
		<dd>
			<?php echo h($usuariosAdministrativo['UsuariosAdministrativo']['login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Senha'); ?></dt>
		<dd>
			<?php echo h($usuariosAdministrativo['UsuariosAdministrativo']['senha']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Usuarios Administrativo'), array('action' => 'edit', $usuariosAdministrativo['UsuariosAdministrativo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Usuarios Administrativo'), array('action' => 'delete', $usuariosAdministrativo['UsuariosAdministrativo']['id']), null, __('Are you sure you want to delete # %s?', $usuariosAdministrativo['UsuariosAdministrativo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios Administrativos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuarios Administrativo'), array('action' => 'add')); ?> </li>
	</ul>
</div>
