$(function(){
	$('#tipo').change(function(){
		if ($(this).val() == 0) {
			$('#container-personalizado').fadeOut(function(){
				$('#container-estabelecimento').fadeIn();	
			});
		} else {
			$('#container-estabelecimento').fadeOut(function(){
				$('#container-personalizado').fadeIn();
			});
		};
	});

	$('#DestaqueAdminFormForm').submit(function(){
		if ($('#tipo').val() == 0 && $('#DestaqueEstabelecimentoId').val() == '') {
			alert('Você deve informar o estabelecimento!');
			$('#DestaqueEstabelecimentoId').focus();
			return false
		}

		if ($('#tipo').val() == 1) {
			if ($('#DestaqueId').val() == '' && $('#DestaqueImagem').val() == '') {
				alert('Você não adicionou uma imagem!');
				$('#DestaqueImagem').focus();
				return false;
			};
			if ($('#DestaqueTitulo').val() == '') {
				alert('Você não informou o título!');
				$('#DestaqueTitulo').focus();
				return false;
			};
		};
		if ($('#DestaqueOrdem').val() == '') {
			alert('Você não informou a ordem!');
			$('#DestaqueOrdem').focus();
			return false;
		};
		return true;
	});

});