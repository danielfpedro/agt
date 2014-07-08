<h1>hjhjkh</h1>
<div class="emailsDivulgacoes view">
<h2><?php echo __('Emails Divulgacao'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($emailsDivulgacao['EmailsDivulgacao']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($emailsDivulgacao['EmailsDivulgacao']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($emailsDivulgacao['EmailsDivulgacao']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($emailsDivulgacao['EmailsDivulgacao']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Emails Divulgacao'), array('action' => 'edit', $emailsDivulgacao['EmailsDivulgacao']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Emails Divulgacao'), array('action' => 'delete', $emailsDivulgacao['EmailsDivulgacao']['id']), null, __('Are you sure you want to delete # %s?', $emailsDivulgacao['EmailsDivulgacao']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Emails Divulgacoes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emails Divulgacao'), array('action' => 'add')); ?> </li>
	</ul>
</div>
