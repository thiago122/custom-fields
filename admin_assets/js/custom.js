$(document).ready(function(){
    confirm_delete();
    mascarasDeFormularios();

	autocompleteSys();
	initDatePicker();
	initEditor();

});



function confirm_delete(){
	// botão delete
	$('#confirm-delete').on('show.bs.modal', function(e) {
	    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
	});
}

function mensagem(mensagem, tipo){

    $.notify(
        {
            message: mensagem
        },
        {
            type: tipo,
            z_index: 9999
        }
    );

}

/* -------------------------------------------- */
/* máscaras de formulário                       */
/* -------------------------------------------- */

function mascarasDeFormularios(){

	$('.vdate').mask('00/00/0000');
	$('.vcep').mask('00000-000', {reverse: true});
	$('.vtel').mask('(00) 0000-00000');
	$('.vcpf').mask('000.000.000-00', {reverse: true});
	$('.vcnpj').mask('00.000.000/0000-00', {reverse: true});
	$('.vrg').mask('00.000.000-0', {reverse: true});
	$('.vmoney').mask('000.000.000.000.000,00', {reverse: true})
	$('.vnota').mask('00.0', {reverse: true})
	$('.vtime').mask('00:00', {reverse: true})

}

/* -------------------------------------------- */
/* DATE PICKER                   */
/* -------------------------------------------- */

function initDatePicker(){

	if($('.datepicker').length > 0){
	    //Date picker
	    $('.datepicker').datepicker({
	      autoclose: true,
	      format: "dd/mm/yyyy"
	    });
	}
}


/* -------------------------------------------- */
/* EDITOR                   */
/* -------------------------------------------- */

function initEditor(){

	if($('.sys-htm5-editor').length > 0){
	    $('.sys-htm5-editor').wysihtml5({
	    	"image": false,
	    })
	}
}

/* -------------------------------------------- */
/* AUTOCOMPLETE                                 */
/* -------------------------------------------- */

var autocompleteSys = function(){

	function initAutocompleteFields(seletor, url){

		// console.log(seletor)
		var configBasico = {
			cache: false,
			ajax: {
				url: url,
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
							q: params.term, // search term
							page: params.page
					};
				},

				processResults: function (data, params) {
					params.page = params.page || 1;
					return {
						results: data,
						pagination: {
							more: (params.page * 30) < data.total_count
						}
					};
				},
			},

			escapeMarkup: function (markup) {
				return markup;
			},
			language: {
				noResults: function(){
					return 'Nenhum resultado!' ;
				}
			},

			minimumInputLength: 1,
			templateResult: formatRepo,
			templateSelection: formatRepoSelection
		}

		var el = $(seletor);

		// verifica se é o autocomplete possui um inicializador
		// que nada mais é que uma classe que será adicionada ao link
		// adicionar +  que será exibido quando
		// não houver opções para o serem selecionadas
		//
		// O atributo data-inicializador="classe" é obrigatoria para que seja
		// exibido o adicionar +  quando não houver opções para o serem selecionadas
		if( typeof el.attr('data-inicializador') !== 'undefined'){
			var classe = el.attr('data-inicializador')
			configBasico.language.noResults = function(x){
				return ' <a href="#" class="'+ classe +' ">Adicionar + </a> ' ;
			}
			configBasico.templateResult = formatRepoTrailer;
		}

	  	el.select2(configBasico);
	}

	function formatRepoTrailer (repo) {
		if (repo.loading) return repo.text;
			var markup = '';
			markup += '<div>' + repo.nome + '</div>';
    	return markup;
	}

	function formatRepo (repo) {
		if (repo.loading) return repo.text;
    	return '<div>' + repo.nome + '</div>';
	}

	function formatRepoSelection (repo) {
		return repo.nome || repo.text;
	}

	function init(){

		$( ".autocomplete" ).each(function( index ) {
			var id  = $(this).attr('id');
			var url = $( this ).attr('data-url');

			if( typeof id == 'undefined' ){
				var id 	= 'autocomplete-' + index;
				$( this ).attr('id','autocomplete-'+index );
			}

			initAutocompleteFields( '#' + id , url );

		});
	}

	init();
};

function toggleResponsavel(){


	if ( $('.sys-label-ckeck-dependente input[type=checkbox]').is(':checked') ) {
		$('.sys-find-dependente').slideDown(200, function(){
			autocompleteSys()
		});
	}else{
		$('.sys-find-dependente').slideUp(200, function(){
			autocompleteSys()
		});
	}
}


/* -------------------------------------------- */
/* -------------------------------------------- */
/* -------------------------------------------- */

$(document).ready(function(){
	$('body').on('click','.sys-label-ckeck-dependente', toggleResponsavel);
	toggleResponsavel();

});


