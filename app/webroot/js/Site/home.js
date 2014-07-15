$(function(){
	$('#newsletterForm').submit(function(){
		alert('ds');
		var email = $('#n').val();
		var url = $(this).attr('action');

		$('#n').attr({'disabled': true}).val('Aguarde, salvando email...');
			
		$.post(url, {email: email}, function(data){
			alert(data);
			$('#n').attr({'disabled': false, 'placeholder': 'Cadastre o seu email e receba novidades'}).val('').focus();
		});
		return false;
	});
});