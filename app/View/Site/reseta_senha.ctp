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
						Resetando senha do email <?php echo $this->request->query['email']; ?>
					</div><!-- section -->
				</div><!-- section-wraper -->
				<div style="margin-top: 10px;">
					<?php echo $this->Session->Flash(); ?>	
				</div>
				<div>
					<?php echo $this->Session->Flash(); ?>	
				</div>
				<div class="wrap-form-contato">
					<?php
						echo $this->Form->create(
							'Usuario',
							array(
								'inputDefaults'=> array('label'=> false))
						);
					?>
						<label>Nova senha</label>
						<?php echo $this->Form->input('nova_senha_resetada', array(
							'type'=> 'password',
							'maxlength'=> 10,
							'label'=> false, 'autofocus'=> true)); ?>
						<label>Repetir nova senha</label>
						<?php echo $this->Form->input('repetir_nova_senha_resetada', array(
							'type'=> 'password',
							'maxlength'=> 10,
							'label'=> false)); ?>

						<button type="submit">Resetar senha</button>

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