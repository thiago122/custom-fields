var serviceAtendimento = {

    all: function(data){

        bus.$emit('loadAdd')
        var request = $.getJSON( base_url + '/admin/atendimento/Atendimento/',data);
        request.done(successLoading).fail(failLoading);
        return request;

    },

    atendimentosDia: function(data){

        bus.$emit('loadAdd')
        var request = $.getJSON( base_url + '/admin/atendimento/Atendimento/atendimentosDia',data);
        request.done(successLoading).fail(failLoading);
        return request;

    },

    atendimentosUsuario: function(data){

        bus.$emit('loadAdd')
        var request = $.getJSON( base_url + '/admin/atendimento/Atendimento/atendimentosUsuario',data);
        request.done(successLoading).fail(failLoading);
        return request;

    },

    update: function(data){
        bus.$emit('loadAdd')
        var request = $.post( base_url + '/admin/atendimento/Atendimento/update', data);
        request.done(successLoading).fail(failLoading);
        return request;
    },

    save: function(data){
        bus.$emit('loadAdd')
        var request = $.post( base_url + '/admin/atendimento/Atendimento/save', data);
        request.done(successLoading).fail(failLoading);
        return request;
    },

    alterarStatus: function(data){
        bus.$emit('loadAdd')
        var request = $.post( base_url + '/admin/atendimento/Atendimento/alterarStatus', data);
        request.done(successLoading).fail(failLoading);
        return request;
    },

    diasMes: function(data){
        bus.$emit('loadAdd')
        var request = $.get( base_url + '/admin/atendimento/Atendimento/diasMes', data);
        request.done(successLoading).fail(failLoading);
        return request;
    },

    config: function(){
        bus.$emit('loadAdd')
        var request = $.getJSON( base_url + '/admin/atendimento/Recepcao/dadosBasicos');
        request.done(successLoading).fail(failLoading);
        return request;
    }

}

// var serviceStatusAgendamento = {
//     all: function(){
//         bus.$emit('loadAdd')
//         var request = $.getJSON( base_url + '/admin/StatusAgendamento/');
//         request.done(successLoading).fail(failLoading);
//         return request;
//     }
// }
