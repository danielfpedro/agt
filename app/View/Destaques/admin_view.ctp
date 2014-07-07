<h1>hjhjkh</h1>
<div class="destaques view">
<h2><?php echo __('Destaque'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($destaque['Destaque']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($destaque['Destaque']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($destaque['Destaque']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($destaque['Destaque']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estabelecimento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($destaque['Estabelecimento']['name'], array('controller' => 'estabelecimentos', 'action' => 'view', $destaque['Estabelecimento']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Destaque'), array('action' => 'edit', $destaque['Destaque']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Destaque'), array('action' => 'delete', $destaque['Destaque']['id']), null, __('Are you sure you want to delete # %s?', $destaque['Destaque']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Destaques'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destaque'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estabelecimentos'), array('controller' => 'estabelecimentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estabelecimento'), array('controller' => 'estabelecimentos', 'action' => 'add')); ?> </li>
	</ul>
</div>
