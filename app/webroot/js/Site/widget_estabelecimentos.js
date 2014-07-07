$(function(){
	var aba_active = 'ui-tab-selected';

	// Insere active para a primeira aba.
	$('#widget-abas li[rel=1]').addClass(aba_active);
	//Deixando soh o primeiro visivel
	$('.tabdiv[rel=1]').show();

	$('#widget-abas li a').click(function(){
		var number_atual = $(this).parent().attr('rel');
		$('#widget-abas li').removeClass(aba_active);
		$(this).parent().addClass(aba_active);

		$('.tabdiv').hide();		
		$('.tabdiv[rel='+number_atual+']').fadeIn();

		return false;
	});

	// $('#thumbnail').hover(function(){
	// 	$(this).find('img').css({'opacity': 0.4});
	// }, function(){
	// 	$(this).find('img').fadeIn();
	// });
});