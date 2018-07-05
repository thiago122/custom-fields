// Retorna as cidades do estado
function getCidadesEstado(idEstado){
    return $.getJSON(base_url + 'admin/municipio/municipiosEstado/'+idEstado)
}

// seta as cidades do estado no endereço
function  listarCidadeEndereco(){

    var idEstado = $(this).val();
    var request = getCidadesEstado(idEstado);

    request.done(function(data){
        setOptionsCidade(data, '.cidade_endereco');
        $('.bairro_endereco').val('');
    });
}

// seta as cidades da estado para a naturalidade
function  listarCidadeNaturalidade(){

    var idEstado = $(this).val();
    var request = getCidadesEstado(idEstado);

    request.done(function(data){
        setOptionsCidade(data, '.cidade_naturalidade');
    });
}

// gera a tag option para os selects da cidade
function setOptionsCidade(data, seletor){

    var html = '';
    html += '<option value="">Selecione</option>';
    data.forEach(function(item){
        html += '<option value="'+ item.id_municipio +'">';
        html +=  item.nm_municipio ;
        html += '</option>';
    });

    $(seletor).html(html);
}




$('.estado').on('change',listarCidadeEndereco);
$('.naturalidade').on('change',listarCidadeNaturalidade);
