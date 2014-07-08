$(function(){
	$('input#chk-ativo').click(function(){
		if (confirm("Você realmente deseja o status deste usuário?")) {;
			var id = $(this).attr('data-id');
			var status = $(this).attr('data-status');
			$.post(webroot + 'admin/usuarios/status_ajax/' + id + '/' + status, function(data){
				if (!data) {
					alert('Ocorreu um erro ao salvar a alteração do seu status');
					location.reload();
				};
			});
		} else {
			return false;
		}
	});
});