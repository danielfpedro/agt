<?php if (!empty($banner2)): ?>
	<div class="unwrapped">
		<?php
			$img_url = 'Banners/' . $banner2['Anuncio']['imagem'];
			$options = array();
			if (!empty($banner2['Anuncio']['url'])) {
				$image = $this->Html->image($img_url, $options);
				echo $this->Html->link(
					$image,
					'http://' . $banner2['Anuncio']['url'],
					array(
						'target'=> $banner2['Anuncio']['target'], 
						'escape' => false
					)
				);
			} else {
				echo $this->Html->image($img_url, $options);
			}
		?>
	</div><!-- unwrapped -->
<?php endif ?>