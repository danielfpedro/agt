<div class="widget-wrapper" style="margin-top:45px">
	<div class="widget">
		<div id="tabbed-reviews" class="complex-list">
			
			<ul id="widget-abas" class="tabnav">
				<li class="" rel="1">
					<a href="#" style="font-size: 14px;">Restaurantes</a>
				</li>
				<li rel="2">
					<a href="#" style="font-size: 14px;">Bares</a>
				</li>
				<li rel="3">
					<a href="#" style="font-size: 14px;">Baladas</a>
				</li>
				<li rel="4">
					<a href="#" style="font-size: 14px;">Recentes</a>
				</li>
			</ul>

			<br class="clearer" />

			<div class="tabdiv-wrapper" id="aba-contents">

				<?php
					$items = array('restaurantes', 'bares', 'baladas', 'recentes');
					$i = 1;
				?>
				<?php foreach ($items as $value): ?>
					<div id="tab-content" class="tabdiv" rel="<?php echo $i; ?>"><!-- Restaurantes -->
						<ul>
							<?php if (!empty($widget_estabelecimentos[$value])): ?>
								<?php foreach ($widget_estabelecimentos[$value] as $item): ?>
									<?php
										$perfil_url = array(
											'controller'=> 'site',
											'action'=> 'perfil',
											$item['Estabelecimento']['slug']
										);
										$perfil_img = ''.
											'Estabelecimentos/' .
											$item['Estabelecimento']['slug'] . '/' .
											$item['Estabelecimento']['imagem_70x70'];

										$categoria_img = 'Categorias/' . $item['Categoria']['imagem'];
									?>
									<li>
										<div class="icon" style="background-color:#cf6925">
											<?php
												echo $this->Html->image(
													$categoria_img,
													array('url'=> $perfil_url)
												);
											?>
										</div>
										<div class="floatleft" id="thumbnail">
											<?php
												echo $this->Html->link(
													$this->Html->image($perfil_img),
													$perfil_url,
													array('escape'=> false, 'class'=> 'thumbnail small')
												);
											?>	 
										</div>
										<div class="floatleft">
											<?php
												echo $this->Html->link(
													'<strong>'.$item['Estabelecimento']['name'].'</strong>',
													$perfil_url,
													array('escape'=> false, 'class'=> 'post-title'));
											?>
											<br>
											<div id="estrelas-readonly" data-score="<?php echo $item[0]['rate_media']; ?>"></div>
											<?php echo $item['Estabelecimento']['cidade']; ?>
										</div>
										<br class="clearer" /> 
									</li>
								<?php endforeach ?>
							<?php else: ?>
								<li>
									<div class="floatleft">
										Nenhuma informação encontrada
									</div>
									<br class="clearer" /> 
								</li>
							<?php endif ?>
							<li class="last">&nbsp;</li>
						</ul>
					</div>
					<?php $i++; ?>
				<?php endforeach ?>

			</div>
		</div>
	</div>
</div>