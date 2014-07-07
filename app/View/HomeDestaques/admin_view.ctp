<h1>hjhjkh</h1>
<div class="homeDestaques view">
<h2><?php echo __('Home Destaque'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($homeDestaque['HomeDestaque']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Titulo'); ?></dt>
		<dd>
			<?php echo h($homeDestaque['HomeDestaque']['titulo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descricao'); ?></dt>
		<dd>
			<?php echo h($homeDestaque['HomeDestaque']['descricao']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($homeDestaque['HomeDestaque']['link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Target'); ?></dt>
		<dd>
			<?php echo h($homeDestaque['HomeDestaque']['target']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Imagem'); ?></dt>
		<dd>
			<?php echo h($homeDestaque['HomeDestaque']['imagem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($homeDestaque['HomeDestaque']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($homeDestaque['HomeDestaque']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Home Destaque'), array('action' => 'edit', $homeDestaque['HomeDestaque']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Home Destaque'), array('action' => 'delete', $homeDestaque['HomeDestaque']['id']), null, __('Are you sure you want to delete # %s?', $homeDestaque['HomeDestaque']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Home Destaques'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Home Destaque'), array('action' => 'add')); ?> </li>
	</ul>
</div>
