$(function(){
	$('input#chk-carrossel').click(function(){
		var url = webroot + 'estabelecimentos/setCarrossel';
		var id = $(this).attr('data-id');
		var value = ($(this).is(':checked'))? 1: 0;
		$.post(url + '/' + id + '/' + value, {}, function(retorno){
			if (!retorno) {
				alert('Ocorreu um erro ao salvar o carrosel');
			};
		});
	});
});