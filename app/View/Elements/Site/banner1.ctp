<?php if (!empty($banner1)): ?>
	<div class="unwrapped">
		<?php
			$img_url = 'Banners/' . $banner1['Anuncio']['imagem'];
			$options = array();
			$options['width'] = '300px';
			$options['height'] = '420px';
			if (!empty($banner1['Anuncio']['url'])) {
				$image = $this->Html->image($img_url, $options);
				echo $this->Html->link(
					$image,
					'http://' . $banner1['Anuncio']['url'],
					array(
						'target'=> $banner1['Anuncio']['target'], 
						'escape' => false
					)
				);
			} else {
				echo $this->Html->image($img_url, $options);
			}
		?>
	</div><!-- unwrapped -->
<?php endif ?>