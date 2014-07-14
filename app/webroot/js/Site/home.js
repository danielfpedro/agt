$(function(){
	$('#newsletterForm').submit(function(){
		var email = $('#n').val();
		var url = $(this).attr('action');
		console.log(email);
		console.log(url);
		$('#n').attr({'disabled': true}).val('Aguarde, salvando email...');
		$.post(url, {email: email}, function(data){
			alert(data);
			$('#n').attr({'disabled': false, 'placeholder': 'Cadastre o seu email e receba novidades'}).val('').focus();
		});
		return false;
	});
});