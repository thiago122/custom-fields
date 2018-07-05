$(document).ready(function(){

	if( $('#map_canvas').length > 0 ){
 		loadScript();
	}

})

function loadScript() {
	map_canvas
	var script = document.createElement("script");
	script.type = "text/javascript";
	script.src = "https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDPj56QUKjvmNugkyU3G2145sC_YnGkYAE&sensor=false&callback=initializeMaps";
	document.body.appendChild(script);
}

function initBinds(){
	$('.pesquisa-endereco').click(pesquisaEnderecoMapa);
	// $('body').on('click','.btn-cep', pesquisaPorCep )

	//$('.select-cidade').change(getBairros)

	// if( start_lat != '0' && start_lng != '0'){
		//pesquisaEnderecoMapa();
	// }
}

function pesquisaPorCep(){
	var cep = $('.input-cep').val();
	respostaEndereco = getCep(cep);
	respostaEndereco.done(function(dadosEndereco){

		if(dadosEndereco !== 0){
			dadosEndereco;

	        dadosEndereco.cidade;
	        dadosEndereco.bairro;
	        dadosEndereco.cep;
	        dadosEndereco.uf;
	        $('.end-logradouro').val(dadosEndereco.endereco);
        	selectEstado( dadosEndereco.uf)
        	getCidadesBySigla(dadosEndereco.uf, dadosEndereco.cidade);
		}else{
			alert('Não encontramos o endereço')
		}

	})
}


function getCep(cep){

    if(typeof cep == "undefined"){
        console.log('CEP não foi informado.')
        return false;
    }

    return $.ajax({
        url: 'http://clareslab.com.br/ws/cep/json/'+ cep +'/',
        type: "POST",
        dataType: 'json'
    })
}

function pesquisaEnderecoMapa(){

		var estado 		= $('.select-estado option:selected').text();
		var cidade 		= $('.select-cidade option:selected').text();
		var bairro 		= $('.select-bairro option:selected').text();
		var logradouro  = $('.logradouro').val();
		var num    		= $('.numero').val();

		var endereco = logradouro +' '+ num+' '+bairro+ ' '+cidade+' '+estado;

		console.log(endereco)
		geocoder.geocode( { 'address': endereco}, function(results, status) {
		      if (status == google.maps.GeocoderStatus.OK) {

		        map.setCenter(results[0].geometry.location);
		        marker.setPosition(results[0].geometry.location);
				// alert(results[0].geometry.location.lat()+"--"+results[0].geometry.location.lng())
				updateMarkerPosition(marker.getPosition());
		      } else {
		        alert("Não foi possível localizar o endereço com as informções fornecidas");
		      }
	    });
}

function initializeMaps(){

		var start_lat = $('.campo_lat').val() || '-22.89608192';
		var start_lng = $('.campo_long').val() || '-43.12376404';

		//MAP
		var latlng = new google.maps.LatLng(start_lat,start_lng);
		var options = {
			  zoom: 8,
			  center: latlng,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("map_canvas"), options);

		if( $('#map_canvas').hasClass('mapa-editavel') ){

			var myLatlng = new google.maps.LatLng(start_lat,start_lng);
			marker = new google.maps.Marker({
				  map: map,
				  draggable: true,
				  position:myLatlng
			});

			 //GEOCODER
			geocoder = new google.maps.Geocoder();

			google.maps.event.addListener(marker, 'drag', function() {
				  updateMarkerPosition(marker.getPosition());
			});

			google.maps.event.addListener(marker, 'dragend', function() {
				updateMarkerPosition(marker.getPosition());
			});

			initBinds();
		}else{
			var myLatlng = new google.maps.LatLng(start_lat,start_lng);
			marker = new google.maps.Marker({
				  map: map,
				  position:myLatlng
			});
		}

  }// FIM INICIALIZE



function updateMarkerPosition(latLng) {

	lat_ = [
	latLng.lat()

	];
	long_ = [
	latLng.lng()
	];
	jQuery('.campo_lat').val(lat_)
	jQuery('.campo_long').val(long_)

}

