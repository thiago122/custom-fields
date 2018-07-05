/*------------------------------------------ */
/* -------------------------------------------- */
/* -------------------------------------------- */

$(document).ready(function(){
	$('body').on('click','.sys-label-ckeck-dependente', toggleResponsavel);
	$('body').on('click','.btn-duplicate-item-prontuario', duplicateItemProntuario);
	$('body').on('click','.btn-remove-item-prontuario', removeItemProntuario);
	$('body').on('click','.btn-save-form-prontuario', saveFormProntuario);
	 makeIndexFormFields()
});


function saveFormProntuario(e){
	var el = $(this);
	el.text('Salvando...')
	el.val('Salvando...')
	e.preventDefault()

	var form = el.parents('form');
	var url = form.attr('action')


	var request = $.ajax({
		url: url,
		dataType: 'JSON',
		method: 'post',
		data: form.serialize()
	});

	request.done(function(response){
		console.log(response.form_id)
		$(form).find('.form_atendimento_id').val(response.form_id);
		el.text('Salvar')
		el.val('Salvar')
	})
	request.fail(function(response){
		el.text('Salvar')
		el.val('Salvar')
	})


}

function duplicateItemProntuario(){

	var clone = $(this).parents('form').find('.js-group-field').eq(0).clone()
	
	$(clone).find('input[type=text]').val('');
	$(clone).find('input[type=radio]').removeAttr('checked');
	$(clone).find('input[type=checkbox]').removeAttr('checked');
	$(clone).find('option').removeAttr('selected');	
	
	$(this).parents('form .documento-body').prepend(clone);
	makeIndexFormFields()
}

function removeItemProntuario(){
	var qt = $(this).parents('form').find('.js-group-field').length;
	if( qt > 1 ){
		$(this).parents('.js-group-field').remove();
	}
	makeIndexFormFields()
}


function makeIndexFormFields(){

	function _replace(str,indexToReplace){
		//https://stackoverflow.com/questions/13247864/javascript-replace-string-between-brackets-but-the-brackets-should-stay
		var rep = '['+indexToReplace+']';
		
		return str.replace(/\[(.*?)\]/, rep)
	}

	$('.js-form').each(function(){

		var itens = $(this).find('.js-group-field');

		itens.each(function(index){

			var fields = $(this).find('input, text, select');
			
			fields.each(function(){
				var name = $(this).attr('name');
				if( typeof name != 'undefined' ){
					var newName = _replace(name, index);
					$(this).attr('name', newName);
				}

			}); // fields

		}); // itens
		
	}); // form	
}

// -----------------------------------------------------------------------------

$(document).ready(function(){
	$(document).on('click','.startButton', iniciarAtendimento)
	$(document).on('click','.stopButton', encerrarAtendimento)
	$(document).on('click','.editButton', showPublicTabs)

	verificarStatus()
})


function verificarStatus(){
	hidePublicTabs();
	var dataSatus = $('.startButton').attr('data-status');

	if(dataSatus == 4){
		$('.startButton').show();
	}

	if(dataSatus == 5){
		$('.stopButton').show();
		showPublicTabs();
	}

	if( dataSatus > 5 ){
		$('.editButton').show();
		$('.startButton').hide();
		$('.stopButton').hide();
	}

}

function updateStatusBtn(status){
	console.log(status)
	$('.startButton').attr('data-status', status);
}

function iniciarAtendimento(){
	var id_atendimento = $(this).attr('data-id');
	
	var dados = {
		id_status_atendimento: 5,
		id_atendimento: id_atendimento
	}

	var request = $.post( base_url + '/admin/atendimento/Atendimento/alterarStatus', dados);
    request.done(function(response){
    	
    	updateStatusBtn(response.data.atendimento.id_status_atendimento)
		$('.startButton').hide();
		$('.stopButton').show();
		verificarStatus()
    });

}

function encerrarAtendimento(){
	var id_atendimento = $(this).attr('data-id');
	var dados = {
		id_status_atendimento: 6,
		id_atendimento: id_atendimento
	}

	var request = $.post( base_url + '/admin/atendimento/Atendimento/alterarStatus', dados);
    request.done(function(response){
    	
    	updateStatusBtn(response.data.atendimento.id_status_atendimento)
		$('.startButton').show();
		$('.stopButton').hide();
		verificarStatus()
    });

}


function showPublicTabs(){
	$('.public').show()
}
function hidePublicTabs(){
	$('.public').hide()
}



// var timer = new Timer();
// $('.startButton').click(function () {
// 	$('.startButton').hide();
// 	$('.stopButton').show();
//     timer.start();
// });

// $('.stopButton').click(function () {
// 	$('.startButton').show();
// 	$('.stopButton').hide();
//     timer.stop();
// });



// timer.addEventListener('secondsUpdated', function (e) {
//     $('#timer').html(timer.getTimeValues().toString());
// });
// timer