<?php

function query_string( $_interrogacao = '' ){
	return $_interrogacao.$_SERVER['QUERY_STRING'];
}


function order_param($param_var, $default_value, $param){

die( 'My url helper die' );

    if( isset($_GET[$param_var]) ){
        //var_dump( $_GET[$param_var] );
        if( $_GET[$param_var] == $param ){
            return $string_param = '?'. $param_var . '=' . $default_value;
        }else{
            return $string_param = '?'. $param_var . '=' . $param;
        }

    }else{
        return $string_param = '?'. $param_var . '=' . $default_value;
    }

}
