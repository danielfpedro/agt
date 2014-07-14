<?php echo $this->Html->script('Site/widget_estabelecimentos', array('inline'=> false)); ?>

<?php echo $this->Html->script('Site/perfil', array('inline'=> false)); ?>

<div id="page-wrapper"> <!-- everything below the top menu should be inside the page wrapper div -->
	<div id="logo-bar"> <!--begin the main header logo area-->
		<div id="logo-wrapper">
			<div id="logo"><!--logo and section header area-->
				<?php
					echo $this->Html->image(
						'logo_agito.png',
						array('url'=> '/', 'id'=> 'site-logo')
					);
				?>
			</div>
			
			<br class="clearer" />
			
			<div class="subtitle"></div>	
		</div>  
		
		<div id="ad-header">  <!--header ad--> 
			<a href="ad-top.png" alt="ad" /></a>        
		</div>
					
		<br class="clearer" />
	</div> <!--end the logo area -->
	
	<div id="content-wrapper-top">&nbsp;</div> <!--the top rounded edge of the main white content area-->
	
	<div id="content-wrapper"> <!--begin main white content wrapper-->
		
		<!-- MAIN MENU -->
		<?php echo $this->element('Site/main-menu'); ?>

		<br class="clearer" />
		<br />

		<div class="main-content-left">
			<div class="page-content review" style="margin-bottom: -20px;">
				<h1 class="title">
					<?php echo $estabelecimento['Estabelecimento']['name']; ?>
				</h1>
			</div>
			<hr>
			 <div class="content-panel"> 
				<div class="page-content review">                   
					<!-- Barrinha com o icone de comentarios -->

					<div class="overview" style="margin-top: -30px;">
					   <div class="left-panel">       
							<div class="article-image">
								
								<div
									class="section-wrapper review"
									style="margin-bottom: 5px; border:0;">
									<div class="comment-bubble" style="margin-right: -7x;">
										<a href="#" id="comentarios" style="background-color: #FFF;">
											<?php echo $comentarios_count; ?>
										</a>  
									</div>
									<div class="section" style="background-color: #FFF;">
										<div
											id="estrelas-readonly"
											style="margin-left: -10px;"
											data-score="<?php echo $estabelecimento['Estabelecimento']['rate']; ?>">
										</div>
									</div>        
								</div>

								<div id="nivo-wrap" style="height: 145px;position: relative;background-color: #000;">
									<?php $i = 0; ?>
									<?php foreach ($estabelecimento['Estabelecimento']['imagem_loop'] as $key => $value): ?>
										<?php
											$img_url = ''.
												'Estabelecimentos/'.
												$estabelecimento['Estabelecimento']['slug'] . '/' .
												$value['normal'];
										?>										
										<a
											id="foto-troca"
											data-rel="<?php echo $i; ?>"
											style="<?php echo ($i > 0)? 'display: none;': '';?>"
											href="<?php echo $this->webroot . 'img/Estabelecimentos/' . $estabelecimento['Estabelecimento']['slug'] .'/' .$value['zoom']; ?>" class="darken">
											<?php
												echo $this->Html->image($img_url, array('height'=> '145px', 'style'=> 'margin-bottom: -5px;'));
											?>
										</a>
										<?php $i++; ?>
									<?php endforeach ?>
									<?php if (count($estabelecimento['Estabelecimento']['imagem_loop']) > 1): ?>
										<?php $i = 0; ?>
										<div class="cont-bolinhas">
											<?php foreach ($estabelecimento['Estabelecimento']['imagem_loop'] as $key => $value): ?>
											
												<div class="bolinha" id="bolinha" data-rel="<?php echo $i; ?>"></div>
												<?php $i++; ?>
											<?php endforeach ?>
										</div>
									<?php endif ?>
								</div>
							</div>        
							<?php echo $estabelecimento['Estabelecimento']['descricao']; ?>
							<br class="clearer" />    	
					  	</div>										  
						<div class="right-panel">
							<div class="inner" style="margin-top: 25px;">
								<span class="metaName">Endereço</span>: 
								
								<span class="metaContent">
									<?php echo $estabelecimento['Estabelecimento']['endereco']; ?>
								</span>

								<div class="separator">&nbsp;</div>

								<span class="metaName">Telefone</span>: 
								
								<span class="metaContent">
									<?php echo $estabelecimento['Estabelecimento']['telefone']; ?>
								</span>
								
								<div class="separator">&nbsp;</div>

								<?php if (!empty($estabelecimento['Estabelecimento']['tipo_comida'])): ?>
									<span class="metaName">Tipo de comida</span>: 
									
									<span class="metaContent">
										<?php echo $estabelecimento['Estabelecimento']['tipo_comida']; ?>
									</span>
									<div class="separator">&nbsp;</div>
								<?php endif ?>

								<span class="metaName">Horário de funcionamento</span>: 
								
								<span class="metaContent">
									<?php echo $this->Time->format('H:i', $estabelecimento['Estabelecimento']['horario_funcionamento_inicial']); ?>
									<?php if (!empty($estabelecimento['Estabelecimento']['horario_funcionamento_final'])): ?>
										&nbsp;às&nbsp;
										<?php echo $this->Time->format('H:i', $estabelecimento['Estabelecimento']['horario_funcionamento_final']); ?>
									<?php endif ?>
								</span>
								
								<div class="separator">&nbsp;</div>

								<?php if ($estabelecimento['Estabelecimento']['tipo_cadastro'] == 2): ?>
									<?php if (!empty($estabelecimento['Estabelecimento']['site'])): ?>
										<span class="taxName">Site</span>: 
										
										<span class="metaContent">
											<a
												href="http://<?php echo $estabelecimento['Estabelecimento']['site']; ?>"
												target="_blank">
												<?php echo $estabelecimento['Estabelecimento']['site']; ?>
											</a>
										</span>

										<div class="separator">&nbsp;</div>
									<?php endif ?>
								<?php endif ?>

								<?php if ($estabelecimento['Estabelecimento']['tipo_cadastro'] == 2): ?>
									<?php if (!empty($estabelecimento['Cartao'])): ?>
										<span class="metaName">Cartões</span>: 
									
										<span class="metaContent">
											<?php foreach ($estabelecimento['Cartao'] as $key => $cartao): ?>
												<?php
													echo '&nbsp';
													echo $this->Html->image(
														'Cartoes/' . $cartao['imagem'], array('width'=> 30));
												?>
											<?php endforeach ?>
										</span>

										<div class="separator">&nbsp;</div>
									<?php endif ?>
								<?php endif ?>

								<?php if ($estabelecimento['Estabelecimento']['tipo_cadastro'] == 2): ?>
									<?php if (!empty($estabelecimento['Estabelecimento']['inaugurado']) OR !is_null($estabelecimento['Estabelecimento']['inaugurado'])): ?>
										<span class="metaName">Inaugurado</span>: 
									
										<span class="metaContent">
											<?php echo $this->Time->format('Y', $estabelecimento['Estabelecimento']['inaugurado']); ?>
										</span>
										<div class="separator">&nbsp;</div>
									<?php endif ?>
								<?php endif; ?>

								<?php if (!empty($estabelecimento['Subcategoria'])): ?>
									<span class="metaName">Categoria(s)</span>:
									<?php
										$subcategorias = array();
										foreach ($estabelecimento['Subcategoria'] as $key => $value) {
											$subcategorias[] = $value['name'];
										}

									?>
									<span class="metaContent">
										<?php echo $this->Text->toList($subcategorias, 'e'); ?>
									</span>
								<?php endif ?>
								
								<div class="separator">&nbsp;</div>
								
								<?php if ($estabelecimento['Estabelecimento']['tipo_cadastro'] == 2): ?>
									<span class="metaContent">
										<?php
											$icon_size = 24;
											if ($estabelecimento['Estabelecimento']['wifi']) {
												echo $this->Html->image(
													'icones_estabelecimentos/wifi.png',
													array('class'=> 'icon-perfil','width'=> $icon_size, 'title'=> 'Wifi')
												);
											}
											if ($estabelecimento['Estabelecimento']['ar_condicionado']) {
												echo '&nbsp';
												echo $this->Html->image(
													'icones_estabelecimentos/ar_condicionado.png',
													array('class'=> 'icon-perfil', 'width'=> $icon_size, 'title'=> 'Ar condicionado')
												);
											}
											if ($estabelecimento['Estabelecimento']['area_fumantes']) {
												echo '&nbsp';
												echo $this->Html->image(
													'icones_estabelecimentos/area_fumantes.png',
													array('class'=> 'icon-perfil','width'=> $icon_size, 'title'=> 'Área para fumantes')
												);
											}
											if ($estabelecimento['Estabelecimento']['estacionamento']) {
												echo '&nbsp';
												echo $this->Html->image(
													'icones_estabelecimentos/estacionamento.png',
													array('class'=> 'icon-perfil','width'=> $icon_size, 'title'=> 'Estacionamento')
												);
											}
											if ($estabelecimento['Estabelecimento']['faz_entrega']) {
												echo '&nbsp';
												echo $this->Html->image(
													'icones_estabelecimentos/faz_entrega.png',
													array('class'=> 'icon-perfil','width'=> $icon_size, 'title'=> 'Faz entrega')
												);
											}
											if ($estabelecimento['Estabelecimento']['faz_reserva']) {
												echo '&nbsp';
												echo $this->Html->image(
													'icones_estabelecimentos/faz_reserva.png',
													array('class'=> 'icon-perfil','width'=> $icon_size, 'title'=> 'Faz reserva')
												);
											}
											if ($estabelecimento['Estabelecimento']['ar_livre']) {
												echo '&nbsp';
												echo $this->Html->image(
													'icones_estabelecimentos/ar_livre.png',
													array('class'=> 'icon-perfil','width'=> $icon_size, 'title'=> 'Ar livre')
												);
											}
											if ($estabelecimento['Estabelecimento']['acesso_deficiente']) {
												echo '&nbsp';
												echo $this->Html->image(
													'icones_estabelecimentos/acesso_deficiente.png',
													array('class'=> 'icon-perfil','width'=> $icon_size, 'title'=> 'Acesso deficiente')
												);
											}
										?>
									</span>
									<div class="separator">&nbsp;</div>
								<?php endif ?>

							</div><!-- inner -->
						</div><!-- right panel -->
						<br class="clearer" />
					</div><!-- overview -->
					<br class="clearer" />

				</div><!-- page content -->
				<br class="clearer" />
			</div><!-- content-panel -->
			<br class="clearer" />

			<!-- Block de comentarios -->
			<?php echo $this->element('Site/comentarios'); ?>

		</div><!-- main-content-left -->

		<div class="sidebar">
			
			<?php echo $this->element('Site/banner1'); ?>

			<!-- Widget lateral dos estabelecimentos -->
			<?php echo $this->element('Site/widget_estabelecimentos'); ?>

			<?php echo $this->element('Site/banner2'); ?>

			<div class="unwrapped">
				<?php
					echo $this->element('Site/facebook_like_box');
				?>
			</div><!-- unwrapped -->

		</div><!-- sidebar -->
		<br class="clearer" />

	</div><!-- content-wrapper -->

	<?php echo $this->element('Site/footer'); ?>

</div> <!-- page wrapper -->