<?php if (!empty($banner3)): ?>
	<div id="homepage-widgets"> <!--Container do Banner horizontal do final -->
		<div class="widget"><!--Banner horizontal do final -->
			<div class="textwidget">
				<p>
					<?php if (!empty($banner3['Anuncio']['url'])): ?>
						<?php
							$image = $this->Html->image(
								'Banners/'. $banner3['Anuncio']['imagem']);
							echo $this->Html->link($image,
								'http://' . $banner3['Anuncio']['url'],
								array(
									'target'=> $banner3['Anuncio']['target'],
									'escape'=> false
									)
								);
							?>
					<?php else: ?>
						<?php echo $this->Html->image(
							'Banners/'. $banner3['Anuncio']['imagem']); ?>
					<?php endif ?>
				</p>
			</div>
		</div><!--Banner horizontal do final -->
	</div> <!--Container do Banner horizontal do final -->
<?php endif ?>