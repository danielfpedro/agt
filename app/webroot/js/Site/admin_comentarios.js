$(function(){

	$('div#estrelas-readonly').raty({
		score: function() {
			return $(this).attr('data-score');
		},		
		path: webroot + 'lib/raty-2.5.2/lib/img',
		readOnly: true,
	});

	$('input#ComentarioAtivo').click(function(){
		var id = $(this).attr('data-id');
		var status = $(this).attr('data-status');
		$.post(webroot + 'admin/comentarios/status_ajax/' + id + '/' + status, function(data){
			if (!data) {
				alert('Ocorreu um erro ao salvar a alteração do seu status');
				location.reload();
			};
		});
	});
});