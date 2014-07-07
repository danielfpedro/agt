<ul class="nav nav-custom" style="">
	<?php foreach ($items_menu as $item): ?>
		<li class="<?php echo ($this->params['controller'] == $item['url']['controller'])? 'active': ''; ?>">
			<?php
				echo $this->Html->link(
					"<span class='glyphicon glyphicon-" .$item['icon']. " icon-menu'></span>" . $item['label'],
					$item['url'],
					array('escape'=> false)
				)
			?>
		</li>
	<?php endforeach ?>
</ul>