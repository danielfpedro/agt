<?php
	if (!empty($AuthUser)) {
		//Debugger::dump($AuthUser);
	}
?>
<div id="top-menu-wrapper"> <!-- begin top menu -->
		<div id="top-menu">
			<div class="container mid">
				<div class="menu">
					<ul>
						<?php if (!$loggedIn): ?>
							<li>
								<?php echo $this->Html->link('Cadastre-se', array('controller' => 'site', 'action' => 'cadastro')); ?>
							</li>
							<li>
								<?php echo $this->Html->link('Login', array('controller' => 'site', 'action' => 'login')); ?>
							</li>							
						<?php else: ?>
							<li>
								<?php echo $this->Html->link('Meu dados', array('controller' => 'site', 'action' => 'meusDados')); ?>
							</li>
							<li>
								<?php echo $this->Html->link('Sair', array('controller' => 'site', 'action' => 'logout')); ?>
							</li>
						<?php endif ?>
					</ul>                            
				</div>

				<div id="newsletter" style="margin-left: 20px;">
					<div class="wrapper">
						<div class="inner">
							<!-- SEARCH -->  
							<form
								method="POST"
								id="newsletterForm"
								action="<?php echo $this->webroot . "site/newsletter_add"; ?>">
								<input
									type="email"
									placeholder="Cadastre o seu email e receba novidades"
									name="txt-newsletter"
									id="n"
									autocomplete="off" required/>    
							</form>
						</div>
		            </div>
				</div>

			</div>

			<div id="search" style="">
				<div class="wrapper">
					<div class="inner">
						<!-- SEARCH -->  
						<form method="get" id="searchform" action="<?php echo $this->webroot . "site/pesquisa"; ?>">
							<input
								value="<?php echo (!empty($this->request->query['q']))? $this->request->query['q'] : '';?>"
								type="text" placeholder="Pesquisar" name="q" id="s" autocomplete="off" />    
						</form>
					</div>
	            </div>
			</div>
            
			<!-- social links -->
			<div id="top-widget">			
				<div class="top-social" style="margin-left: 40px;!important;">
					<a href="https://facebook.com/agito.riosul" class="facebook" target="_blank" >&nbsp;</a>
				</div>
			</div>

			<br class="clearer" />
		</div>
	</div>
</div>