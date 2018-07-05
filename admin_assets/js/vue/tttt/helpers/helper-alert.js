/* HELPERS PARA O LOADING */

function successLoading(data){
    bus.$emit('loadRemove');

    if( typeof data != "undefined" ){
        if( typeof data.message != "undefined" ){
            bus.$emit('alert', data.message, 'success');
        }
    }

}

function failLoading(data, textStatus, errorThrown){

    bus.$emit('loadRemove');

    if( typeof data != "undefined" ){
        if( typeof data.responseJSON != "undefined" ){
            if( typeof data.responseJSON.message != "undefined" ){
                bus.$emit('alert_mult', data.responseJSON.message, 'danger');
            }
        }
    }

}
