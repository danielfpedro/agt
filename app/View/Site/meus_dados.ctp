<?php echo $this->Html->script('Site/widget_estabelecimentos', array('inline'=> false)); ?>
<?php echo $this->Html->script('Site/cadastro', array('inline'=> false)); ?>
<?php echo $this->Html->script('../lib/maskedinput-1.3.1/jquery.maskedinput.min', array('inline'=> false)); ?>

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
			<div id="categorypanels" class="post-loop">
				<div class="section-wrapper">
					<div class="section">
						Meus dados
					</div><!-- section -->
				</div><!-- section-wraper -->

				<div class="wrap-form-contato">

					<div style="margin-bottom: 35px;">
						<?php echo $this->Session->flash(); ?>
					</div>
					
					<?php
						echo $this->Form->create(
							'Usuario',
							array(
								'novalidate'=> true,
								'type'=> 'file',
								'inputDefaults'=> array('label'=> false))
						);
					?>
						<div style="margin-bottom: 5px;">
							<?php
								//$img_url = $this->Site->getAvatar($usuario);
								echo $this->Html->image($img_avatar, $options = array('width'=> 60, 'height'=> 60)); ?>
						</div>
						<?php echo $this->Form->input('Perfil.imagem', array('type'=> 'file', 'error'=> false)); ?>
						<div style="width: 100%; clear: both; font-size: 13px; color: #666; margin-top: -18px; margin-bottom: 20px;">
							A imagem deve estar no formato JPG ou PNG e não poder conter mais de 1MB.
						</div>

						<label>Nome</label>
						<?php echo $this->Form->input('Perfil.name', array('error'=> false)); ?>
						<div style="width: 45%;float: left">
							<label>Email</label>
							<?php echo $this->Form->input('email', array('error'=> false)); ?>
						</div>
						<div style="width: 50%;float: right">
							<label>Apelido</label>
							<?php echo $this->Form->input('Perfil.apelido', array('error'=> false)); ?>
						</div>
						<div style="width: 45%;float: left">
							<label>Data de nascimento</label>
							<?php echo $this->Form->input('Perfil.data_nascimento', array('type'=> 'text', 'class'=> 'data', 'error'=> false)); ?>
						</div>
						<div style="width: 50%;float: right">
							<label>Cidade</label>
							<?php echo $this->Form->input('Perfil.cidade', array('error'=> false)); ?>
						</div>

						<br style="clear: both;">
						<hr>
						<br>

						<label>Nova senha</label>
						<?php echo $this->Form->input('nova_senha', array('type'=> 'password', 'error'=> false)); ?>
						<label>Repetir senha</label>
						<?php echo $this->Form->input('repetir_senha', array('type'=> 'password', 'errror'=> false)); ?>
						<label>Senha atual</label>
						<?php echo $this->Form->input('senha', array('type'=> 'password', 'error'=> false)); ?>

						<button type="submit">Salvar alterações</button>
					<?php echo $this->Form->end() ?>
				</div><!-- wrap-form-contato -->

				<br class="clearer" />
			</div><!-- categorypanels -->
			<br class="clearer" />
		</div><!-- main-content-left -->

		<div class="sidebar">
			<div class="unwrapped">
				<?php
					echo $this->Html->image('banners/banner1.jpg', array('url'=>'#', 'width'=> '300px', 'height'=> '420px'));
				?>
			</div><!-- unwrapped -->

			<!-- Widget lateral dos estabelecimentos -->
			<?php echo $this->element('Site/widget_estabelecimentos'); ?>

			<div class="unwrapped">
				<?php
					echo $this->Html->image('banners/banner2.png', array('url'=>'#'));
				?>
			</div><!-- unwrapped -->
		</div><!-- sidebar -->
		<br class="clearer" />

	</div><!-- content-wrapper -->

	<?php echo $this->element('Site/footer'); ?>

</div> <!-- page wrapper -->