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

		$field = $schemaData[$name];
		$structure = $field['structure'];

		$attr = attr($attr);

		switch ($structure->type) {
			case 'text':
				return fieldText($field, $structure, $name, $attr);
				break;
			case 'checkbox_group':
				return fieldCheckboxGroup($field, $structure, $name, $attr);
				break;
			case 'checkbox':
				return fieldCheckbox($field, $structure, $name, $attr);
				break;

			default:
				# code...
				break;
		}

	}

	function fieldText($field, $structure, $name, $attr){

		if( isset($field['resposta']) ){
			$value = $field['resposta'][0]->value;
		}else{
			$value = $structure->value;
		}

		return '<input type="text" '. $attr .'  value="'. $value .'" name="'. $structure->name .'">';

	}

	function fieldCheckboxGroup($field, $structure, $name, $attr){

		$choices_ = explode(';', $structure->choices);

		$choices = [];

		foreach ($choices_ as $choice_) {
			$choice_ = explode(':', $choice_);
			$choices[] = [
				'value' => trim($choice_[0]),
				'label' => trim($choice_[1]) 
			];
		}

		$respostas = [];

		foreach ($field['resposta'] as $resposta) {
			$respostas[] = trim($resposta->value);
		}

		$html = '';
		foreach ($choices as $choice) {
		$checked = in_array($choice['value'], $respostas)? ' checked="checked" ' : '';		
			
			$html .= '	<div class="checkbox">';
			$html .= '		<label>';
			$html .= '			<input type="checkbox" name="'. $structure->name .'" value="'.$choice['value'].'" '. $checked .' >' .$choice['label'];
			$html .= '		</label>';
			$html .= '	</div>';
		}
		
		return $html;
	}

	function fieldCheckbox($field, $structure, $name, $attr){

		$checked = '';

		if( isset($field['resposta']) ){
			if( $field['resposta'][0]->value == $structure->value ){
				$checked = ' checked="checked" ';
			}
		}

		$html = '';
		
		$html .= '	<div class="checkbox">';
		$html .= '		<label>';
		$html .= '			<input type="checkbox" name="'. $structure->name .'" value="'. $structure->value .'" '. $checked .' >' . $structure->label;
		$html .= '		</label>';
		$html .= '	</div>';

		return $html;
		
		return '';
	}

	function hasReponses($schemaData, $name){
		
		if( !isset($schemaData[$name]) ){
			return false;
		}

		if( !isset($schemaData[$name]['respostas']) ){
			return false;
		}

		return $schemaData[$name]['respostas'];

	}


?>
