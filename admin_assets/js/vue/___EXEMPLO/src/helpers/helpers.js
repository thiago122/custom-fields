
function mergeObjects(obj1,obj2){
    var obj3 = {};
    for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
    for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
    return obj3;
}

function brDateToDate (date) {
	console.log( date)
	if( date != "" ){
		return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
	}
}

function dateToBrDate (date) {
	if( date != "" ){
		return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
	}
}

function dateTimeToTime (date) {
	if( date != "" ){
		return moment(date).format('HH:mm:ss');
	}
}

function successLoading(data){
	bus.$emit('loadRemove');

	if( typeof data != "undefined" ){
		if( typeof data.msg != "undefined" ){
			bus.$emit('alert', data.msg, 'success');
		}
	}
    
}

function failLoading(data, textStatus, errorThrown){

	if(data.status == 401){
		console.log('>> EMIT MODAL LOGIN OPEN')
		bus.$emit('modal_login_open')
	}

	if(data.status == 403){
		// alert('sem acesso aos dados');
	}

	bus.$emit('loadRemove');

	if( typeof data != "undefined" ){
		if( typeof data.responseJSON != "undefined" ){
			if( typeof data.responseJSON.msg != "undefined" ){
				bus.$emit('alert_mult', data.responseJSON.msg, 'danger');
			}		
		}
	}
	
}

function mascarasDeFormularios(){

	$('body').on('keyup','.vdate', function(){
		$('.vdate').masked($(this).val());
	})

	$('body').on('keyup','.vcep', function(){
		$('.vcep').masked($(this).val());
	})

	$('body').on('keyup','.vphone', function(){
		$('.vphone').masked($(this).val());
	})

	$('body').on('keyup','.vcpf', function(){
		$('.vcpf').masked($(this).val());
	})

	$('body').on('keyup','.vcnpj', function(){
		$('.vcnpj').masked($(this).val());
	})

	$('body').on('keyup','.vrg', function(){
		$('.vrg').masked($(this).val());
	})

	$('body').on('keyup','.vmoney', function(){
		$('.vmoney').masked($(this).val());
	})

	$('body').on('keyup','.vnota', function(){
		$('.vnota').masked($(this).val());
	})

	$('.vtime').mask('00:00:00');
	$('.vdate').mask('00/00/0000');
	$('.vdatetime').mask('00/00/0000 00:00');
	$('.vcep').mask('00000-000', {reverse: true});
	$('.vphone').mask('(00) 0000-00000');
	$('.vcpf').mask('000.000.000-00', {reverse: true});
	$('.vcnpj').mask('00.000.000/0000-00', {reverse: true});
	$('.vrg').mask('99.999.999-9', {reverse: true});
	$('.vmoney').mask('000.000.000.000.000,00', {reverse: true})
	$('.vnota').mask('00.0', {reverse: true})
}

mascarasDeFormularios()