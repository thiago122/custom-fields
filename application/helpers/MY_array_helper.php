<?php /**
	 * Produz um array simples ( chave => valor ) apartir de um array multdimensional
	 * normalmente o resultado vindo do banco
	 *
	 *
	 * @param array_multdimencional $array_completo
	 * @param string $campo_chave
	 * @param string $campo_valor
	 * @param string $primeiro_valor
	 * @return array_simples
	 */

	function single_array($options, $fields = array()){
		$vet = array();

		$options = (json_decode(json_encode($options), true));

		if( ! empty($options) ){
			foreach($options as $item){
				$vet[$item[$fields[0]]] = $item[$fields[1]];
			}
		}

		return $vet;
	}


	function array_column_(array $input, $columnKey, $indexKey = null) {

        $array = array();

        $input = json_decode(json_encode($input));

        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value->{$columnKey};
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value->{$indexKey})) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value->{$indexKey}] = $value->{$columnKey};
            }
        }
        return $array;
    }


?>
