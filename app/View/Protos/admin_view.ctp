<h1>hjhjkh</h1>
<div class="protos view">
<h2><?php echo __('Proto'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($proto['Proto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($proto['Proto']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($proto['Proto']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($proto['Proto']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Proto'), array('action' => 'edit', $proto['Proto']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Proto'), array('action' => 'delete', $proto['Proto']['id']), null, __('Are you sure you want to delete # %s?', $proto['Proto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Protos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proto'), array('action' => 'add')); ?> </li>
	</ul>
</div>
