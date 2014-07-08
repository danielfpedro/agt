<?php echo $this->Html->script('Site/facebook', array('inline'=> false)); ?>

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
						Cadastro de usuário
					</div><!-- section -->
				</div><!-- section-wraper -->

				<div class="wrap-form-contato">

					<div style="margin-bottom: 30px;">
						<?php echo $this->Session->flash(); ?>
					</div>
					
					<?php
						echo $this->Form->create(
							'Usuario',
							array(
								'novalidate'=> true,
								'inputDefaults'=> array('label'=> false))
						);
					?>

						<button type="button" id="btn-facebook" onclick="checkLoginState();" class="btn-facebook"></button>

						<div id="cont-facebook-img" style="<?php echo (!empty($this->request->data['Usuario']['facebook_id']))? '': 'display: none;';?>">
							<label>Foto do perfil</label>
							<img id="imagem-facebook" width="60" <?php echo (empty($this->request->data['Usuario']['facebook_id']))? '': 'src="https://graph.facebook.com/' .$this->request->data['Usuario']['facebook_id']. '/picture?type=normal"';?>>
						</div>

						<?php echo $this->Form->input('facebook_id', array('type'=> 'hidden','error'=> false)); ?>

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
						<div style="width: 45%;float: left">
							<label>Senha</label>
							<?php echo $this->Form->input('senha', array('type'=> 'password', 'error'=> false, 'maxlength'=> 10)); ?>
						</div>
						<div style="width: 50%;float: right">
							<label>Repetir senha</label>
							<?php echo $this->Form->input('repetir_senha', array('type'=> 'password', array('error'=> false))); ?>
						</div>
						<div style="width: 100%; clear: both; font-size: 13px; color: #666; margin-bottom: 10px;">
							Ao clicar em criar conta você estará concordando com os <?php echo $this->Html->link('Termos De Uso', array('controller'=> 'site', 'action'=> 'termos_de_uso'), array('target'=> '_blank')) ?>.
						</div>
						<button type="submit">Criar conta</button>
					<?php echo $this->Form->end() ?>
				</div><!-- wrap-form-contato -->

				<br class="clearer" />
			</div><!-- categorypanels -->
			<br class="clearer" />
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