$(function(){

	var foto_atual = 0;

	$('#nivo-wrap a').each(function(){
		console.log('Oi');
	});

	$('div#bolinha').click(function(){
		var num = $(this).attr('data-rel');
		trocaFoto(num);
	});

	function trocaFoto (novo) {
		$('a#foto-troca[data-rel="'+foto_atual+'"]').fadeOut(function(){
			$('a#foto-troca[data-rel="'+novo+'"]').fadeIn(function(){
				foto_atual = novo;
			});
		});
	}

	$('a#comentarios').click(function(){
		$('html, body').animate({
			scrollTop: $("#cont-comentarios").offset().top
		}, 2000);
		return false;
	});

	$('#btn-mais-comentarios').click(function(){
		var defaul_text = $(this).text();
		var loading_text = 'Carregando comentários';
		var final_text = 'Não há mais comentários para carregar';

		var $page = $('#comentarios-page');
		var page = $page.val();

		$this = $(this);

		var estabelecimento = $(this).attr('data-estabelecimento-id');

		$this.text(loading_text);

		$this.attr({disabled: true});

		$.post(webroot + 'site/mais_comentarios', {estabelecimento: estabelecimento, page: page}, function(data){
			page++;
			$page.val(page);
			//console.log(data);
			var comentarios = $.parseJSON(data);
			//console.log(comentarios);
			var total = comentarios.length;
			// console.log(total);

			if (total > 0) {
				var i = 0;
				$.each(comentarios, function(key, value){

					var media_wrap = $('<div/>').addClass('media-wrap');
					var media_thumb = $('<div/>').addClass('media-thumb');
					var thumb = $('<img/>').attr({src: value.Usuario.Perfil.imagem_final, width: 60});

					var media_body = $('<div/>').addClass('media-body').css({width: '560px'});
						var h4 = $('<h4/>').text(value.Usuario.Perfil.apelido);
						var estrelas = $('<div/>').attr({'id': 'estrela' + i, 'data-score': value.Comentario.rate});
						var p = $('<p/>').text(value.Comentario.texto);

					var br_clear = $('<br />').css({clear: 'both'});

					$('#comentarios-container-pagination').append(media_wrap.append(media_thumb.append(thumb)).append(media_body.append(h4).append(estrelas).append(p)).append(br_clear));

					$this.text(defaul_text).attr({disabled: false});

					$('div#estrela' + i).raty({
						score: function() {
							return $(this).attr('data-score');
						},		
						path: webroot + 'lib/raty-2.5.2/lib/img',
						readOnly: true,
					});

					i++;
				});
			} else {
				$this.text(final_text);
			};
		});
	});
});