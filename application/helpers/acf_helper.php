<?php 


	function attr($attr = []){
		if( empty($attr) ){
			return '';
		}

		$html = '';
		foreach ($attr as $key => $value) {
			$html .= ' ' . $key . '="' . $value . '" ';
		}

		return $html;

	}

	function field($schemaData, $name, $attr = []){


// print_r($schemaData);

		$field = $schemaData->{$name};
		$structure = $field->structure;

		if( isset($field->resposta) ){
			$value = $field->resposta->{'1'}->value;
		}else{
			$value = $structure->value;
		}

		$attr = attr($attr);
		return '<input type="text" '. $attr .'  value="'. $value .'" name="'. $structure->name .'">';
	}

	function hasReponses($schemaData, $name){
		
		if( !isset($schemaData->{$name}) ){
			return false;
		}

		if( !isset($schemaData->{$name}->respostas) ){
			return false;
		}

		return $schemaData->{$name}->respostas;

	}


?>
