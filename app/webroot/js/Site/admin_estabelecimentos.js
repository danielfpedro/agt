$(function(){

	$('.data').mask('99/99/9999');
	$('.telefone').mask('(99) 99999999?9');
	$('.hora').mask('99:99');

	$('#EstabelecimentoTipoCadastro').change(function(){
		$('#cont-completo').fadeToggle();
	});

	$('input#chk-carrossel').click(function(){
		var url = webroot + '/estabelecimentos/setCarrossel';
		alert(url);
	});
});