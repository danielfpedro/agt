<div class="breadcrumb breadcrumb-admin">
	<li>
		<?php echo "<?php echo \$this->Html->link('".ucfirst($pluralVar)."', array('action'=> 'index')) ?>\n"; ?>
	</li>
	<?php echo "<li class=\"active\">\n\t\t".$singularHumanName."\n\t</li>\n"; ?>
</div>

<div class="wrap-internal-page">
	<div class="row">
		<div class="col-md-12">
			<?php echo "<?php echo \$this->Form->create('{$modelClass}'); ?>\n"; ?>
				<?php
					foreach ($fields as $field) {
						if (strpos($action, 'add') !== false && $field == $primaryKey) {
							continue;
						} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
							echo "\n\t\t\t<div class=\"form-group\">\n\t\t\t\t<?php echo \$this->Form->input('{$field}', array('class'=> 'form-control')); ?>\n\t\t\t</div>";
						}
					}
					if (!empty($associations['hasAndBelongsToMany'])) {
						foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
							echo "\n\t\t\t<div class=\"form-group\">\n\t\t\t\t<?php echo \$this->Form->input('{$assocName}', array('class'=> 'form-control')); ?>\n\t\t\t</div>";
						}
					}
					echo "\n\t\t\t<div class=\"form-group\">\n\t\t\t\t<button type=\"submit\" class=\"btn btn-primary\">\n\t\t\t\t\t<span class=\"glyphicon glyphicon-ok\"></span> Salvar\n\t\t\t\t</button>\n\t\t\t</div>";
			?>
			<?php echo "\n\n\t\t\t<?php echo \$this->Form->end(); ?>\n"; ?>
		</div>
	</div>
</div>