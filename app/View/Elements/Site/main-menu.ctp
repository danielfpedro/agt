<div id="main-menu-wrapper" style="margin-left:55px"> <!-- begin main menu --> 

	<div id="main-menu" style="float:none">
	
		<a href="#" class="left-cap">&nbsp;</a>
		
		<ul>
			<li>
				<?php echo $this->Html->image(
					'home2.png',
					array('url'=> array('action'=> 'home'), 'style'=> 'border-left: none;')); ?>
			</li>
			<li>
				<?php
					echo $this->Html->image(
						'bares.png',
						array('url'=> array('controller'=> 'site', 'action'=> 'estabelecimentos', 'bares'))
					);
				?>
			</li>
			<li>
				<?php
					echo $this->Html->image(
						'baladas.png',
						array('url'=> array(
							'controller'=> 'site',
							'action'=> 'estabelecimentos',
							'baladas'), 'width'=> '110')
					);
				?>
			</li>
			<li>
				<?php
					echo $this->Html->image(
						'restaurantes.png',
						array('url'=> array('controller'=> 'site', 'action'=> 'estabelecimentos', 'restaurantes'))
					);
				?>
			</li>
			<li>
				<?php
					echo $this->Html->image(
						'contato.png',
						array('url'=> array('controller'=> 'site', 'action'=> 'contato'))
					);
				?>
			</li>
		</ul>  
						  
		<div class="right-cap">&nbsp;</div>		
	</div>
	
	<br class="clearer" />
</div> <!-- end main menu -->