<?php

	function option_dropdown($options, $md_keys = array(), $selected = NULL )
	{

		$arr  = ( json_decode( json_encode( $options ), true) );

		$form = '';

		foreach($arr as $item)
		{
			$key = (string) $item[$md_keys[0]];

			$val = (string) $item[$md_keys[1]];

			$sel = ( $key == $selected ) ? ' selected="selected"' : '';

		 	$form .= '<option value="'.$key.'"'.$sel.'>'.$val."</option>\n";

		}

		return $form;

	}

	function is_checked($value, $selected = array()){

		if( ! empty( $selected ) )
		{
			if( array_key_exists( $value, $selected ) )
			{
			return TRUE;
			}
		}
		return FALSE;

	}


	function checkbox( $name, $value, $single_array, $prop = ''){
		echo '<input '. $prop .' type="checkbox" name="'.$name.'" value="'. $value .'" '.set_checkbox( $name , $value, is_checked($value, $single_array)) . '/>';
	}

	function get_checkbox( $name, $value, $single_array){
		return '<input type="checkbox" name="'.$name.'" value="'. $value .'" '.set_checkbox( $name , $value, is_checked($value, $single_array)) . '/>';
	}

	// verifca se um campo está checado
	function checked( $field, $default_value, $value_to_comapre ){

		if( $default_value == $value_to_comapre ){
			return set_checkbox( $field, $default_value, true);
		}else{
			return set_checkbox( $field, $default_value);
		}

	}

	function booleanCheckbox($field, $trueValue, $value_to_comapre){
		echo '<input type="checkbox" name="'.$field.'" value="'. $trueValue .'" '. checked( $field, $trueValue, $value_to_comapre ) . '/>';
	}

	function booleanText($verdadeiro,$falso, $valor){

		if( $valor == 1 ){

			return $verdadeiro;

		}else{
			return $falso;
		}

	}



	function checkRadio( $field, $value, $value_to_comapre ){

		if( $value == $value_to_comapre ){
			return set_radio( $field, $value, true);
		}else{
			return set_radio( $field, $value);
		}

	}

	function booleanRadio($field, $trueValue, $value_to_comapre){

		echo '<input type="radio" name="'.$field.'" value="'. $trueValue .'" '. checkRadio( $field, $trueValue, $value_to_comapre ) . '/>';

	}

	function rest_validation_errors($prefix = '', $suffix = ''){

		if (FALSE === ($OBJ = & _get_validation_object())) {
			return '';
      	}

      	$erros = $OBJ->error_array($prefix, $suffix);

      	$return_erros = '';

      	foreach ($erros as $field => $text_erro) {

      		$return_erros  .= $text_erro ." \n ";
      	}

      	return $return_erros;

	}

	function validation_array($prefix = '', $suffix = ''){

		if (FALSE === ($OBJ = & _get_validation_object())) {
			return '';
      	}

      	$erros = $OBJ->error_array();

      	$return_erros = [];

      	foreach ($erros as $field => $text_erro) {

      		$return_erros[]  = $text_erro;
      	}

      	return $return_erros;

	}



    function nullToText($valor, $text){

        if( $valor === NULL ){
            return $text;
        }
        return $valor;
    }

	function notNull($valor){

		if( $valor === NULL ){

			return '';

		}

		return $valor;

	}

	function emptyToNull($valor = NULL){

		if( empty($valor) ){
			return NULL;
		}

		return $valor;

	}

	function notNullZero($valor){

		if( $valor === NULL ){
			return 0;
		}

		return $valor;

	}



// ----------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------

	function listArrayAsOption($values, $selected = null){

		foreach( $values as $val ){

			$opt = ' <option value="'. $val .'">'. $val .'</option>';

			if( $selected ){
				if( $val == $selected ){
					$opt = ' <option value="'. $val .'" selected="selected">'. $val .'</option>';
				}
			}
			echo $opt;
		}

		// return $valor;

	}


	// --------------------------------------------------------------------
	// PREÇO
	// --------------------------------------------------------------------
	/*
	* funções para conversão de preço
	*/

	function preco_para_decimal( $valor ){
		$valor = str_replace(".","",$valor);
		return str_replace(",",".",$valor );
	}
	function decial_para_preco( $valor ){
		return number_format($valor,2,",",".");
	}
