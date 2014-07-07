<h1>hjhjkh</h1>
<div class="comentariosEstabelecimentos view">
<h2><?php echo __('Comentarios Estabelecimento'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($comentariosEstabelecimento['ComentariosEstabelecimento']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estabelecimento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($comentariosEstabelecimento['Estabelecimento']['name'], array('controller' => 'estabelecimentos', 'action' => 'view', $comentariosEstabelecimento['Estabelecimento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comentario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($comentariosEstabelecimento['Comentario']['name'], array('controller' => 'comentarios', 'action' => 'view', $comentariosEstabelecimento['Comentario']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Comentarios Estabelecimento'), array('action' => 'edit', $comentariosEstabelecimento['ComentariosEstabelecimento']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Comentarios Estabelecimento'), array('action' => 'delete', $comentariosEstabelecimento['ComentariosEstabelecimento']['id']), null, __('Are you sure you want to delete # %s?', $comentariosEstabelecimento['ComentariosEstabelecimento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Comentarios Estabelecimentos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comentarios Estabelecimento'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estabelecimentos'), array('controller' => 'estabelecimentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estabelecimento'), array('controller' => 'estabelecimentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comentarios'), array('controller' => 'comentarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comentario'), array('controller' => 'comentarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
