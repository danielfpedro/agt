<!-- coloquei comentarios de wrap pq a hash deve ficar em portugues, se eu trocasse o 
comments ele perde o estilo pq o estilo estah no id -->
<div style="margin-top: 10px;">
	<?php echo $this->Session->Flash(); ?>	
</div>
<div id="comentarios">
		<div id="comments">
			<div id="respond">
			
				<h3 id="reply-title" style="font-size: 22px;">Deixe seu Comentário</h3>
					<?php
						echo $this->Form->create('Comentario',
							array('type'=> 'post')
						);
					?>
				
					<?php if (!empty($auth_custom)): ?>
				<p class="logged-in-as">
						Logado como <strong><?php echo $auth_custom['nome']; ?></strong>,
						<?php
							echo $this->Html->link('deseja sair?', array('controller' => 'site', 'action' => 'logout'));
						?>
					</p>
					<?php else: ?>
						Você precisa estar logado para comentar,
						<?php
						echo $this->Html->link('clique aqui', array('controller' => 'site', 'action' => 'login'));
						?>
						para fazer o login.
						<br class="clearer" />
					<?php endif ?>

					
					<div class="comment-form-comment">
						<div class="label">
							<div
								id="<?php echo (!empty($loggedIn)? 'set-estrelas': 'estrelas-readonly');?>"></div>
						</div>
						<div class="input-wrapper">
							<div class="shadow">
								<div class="icon">
									<?php
										echo $this->Form->text(
											'estabelecimento_id',
											array(
												'label'=> false,
												'type'=> 'hidden',
												'value'=> $estabelecimento['Estabelecimento']['id']
											)
										);
										echo $this->Form->textarea('comentario',
											array(
												'label'=> false,
												'value'=> '',
												'maxlength'=> 400,
												'required'=> true,
												'disabled'=> (!empty($loggedIn))? false : true
											)
										);
									?>
									<!-- <textarea id="comment" name="comment" rows="8" cols="50"></textarea> -->
								</div>
							</div>
						</div>
					</div>
					
					<br class="clearer" />
																
					<p class="form-submit">
						<button
							type="submit"
							class="btn-comentario"
							<?php echo (!empty($loggedIn))? '' : 'disabled'; ?>>Comentar</button>
					</p>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>

	<br>
	<hr>
	<br>

	<div id="cont-comentarios">
		<!-- Lista comentarios -->
		<?php if (!empty($comentarios)): ?>
			<input type="hidden" id="comentarios-page" value="1">

			<?php foreach ($comentarios as $comentario): ?>
				<div class="media-wrap">
					<div class="media-thumb">
						<?php
							echo $this->Html->image($comentario['Usuario']['Perfil']['imagem_final'], $options = array('width'=> 60, 'height'=> 60));
						?>
					</div>
					<div class="media-body" style="width: 560px;">
						<h4>
							<?php echo $comentario['Usuario']['Perfil']['apelido']; ?>
						</h4>
						<div
							id="estrelas-readonly"
							data-score="<?php echo $comentario['Comentario']['rate']; ?>">
						</div>
						<p>
							<?php echo $comentario['Comentario']['texto']; ?>
						</p>
					</div>
					<br style="clear: both;">
				</div>
			<?php endforeach ?>


			<?php if ($show_paginator): ?>
				<div id="comentarios-container-pagination"></div>

				<button
					type="button"
					class="btn"
					id="btn-mais-comentarios"
					data-estabelecimento-id="<?php echo $estabelecimento['Estabelecimento']['id']; ?>">Carregar mais</button>
			<?php endif ?>
			<br style="clear: both;">
			<br>
		<?php endif ?>
	</div>

</div>