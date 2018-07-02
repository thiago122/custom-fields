<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class FormTag {

    public  $attrs = [];
    public  $groupField = null;

    public  function attr($atributos){
        $this->attrs = $atributos;
        return $this;
    }

    public  function groupField($group){
        $this->groupField = $group;
        return $this;
    }

	public function _attr($atributos = []){

        $html = '';
        foreach ($atributos as $key => $value) {
            $html .= ' ' . $key .'="'. $value .'" ';
        }

        return $html;
    }

   	protected function _openTag($tag, $value = null, $atributos = [], $close = null){
   		$value = ( $value ? 'value="' . $value .'"': '' );
   		$close = ( $close ? '/': '' );
   		return $html = '<' . $tag .' ' . $this->_attr( $atributos ) . '  ' . $value . ' ' . $close . '>';
   	}

   	protected function _closeTag($tag){
   		return $html = '</'.$tag.'>';
   	}

    public function reset(){
        $this->attrs = [];
        $this->groupField = '';
        return $this;
    }

    protected function _makeSingle($default){

    	$default = json_decode(json_encode( $default ));

		$array = array();

        foreach ($default as $value) {
        	if( is_object($value) ){
        		$array[] = $value->value;
        	}else{
        		$array[] = $value;
        	}
        }

        return $array;
    }

}


class Builder extends FormTag{

	private $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
	}

    private function makeName($name){

        if( $this->groupField ){
            $this->attrs['name'] = $this->groupField.'['.$name.']['.']';
        }else{
            $this->attrs['name'] = $name;
        }

        return $this;
    }


    public  function select( $dados, $default = [] ){

        $dados      = json_decode(json_encode( $dados ));
        $default    = json_decode(json_encode( $default ));

        if( count((array)$default) > 0 ){

            $optionValues = array_column_($dados->options, 'value');

            if( ! in_array($default->value, $optionValues) ){
                $dados->options[] = $default;
            }
        }

		// $this->attrs['name'] = $dados->name;
        $this->makeName($dados->name);


        $placeholder = false;


        if( isset($this->attrs['placeholder']) ){
            $placeholder = $this->attrs['placeholder'];
            unset( $this->attrs['placeholder'] );
        }


        $html = $this->_openTag('select', null, $this->attrs );

        if( $placeholder ){

            $html .= $this->_openTag('option', " ");
            $html .= $placeholder;
            $html .= $this->_closeTag('option');
        }

        foreach ($dados->options as $options) {

            $selected = '';

            $attr = [];

            if( isset( $default->value ) ){
                $attr = ($options->value == $default->value ) ? ['selected' => 'selected'] : [] ;
            }

            $html .= $this->_openTag('option', $options->value, $attr);
            $html .= $options->label;
            $html .= $this->_closeTag('option');

        }

        $html .= $this->_closeTag('select');

        return $html;
    }

    public function checkBox($dados, $default = []){
 		$dados      = json_decode(json_encode( $dados ));

 		$default = $this->_makeSingle( $default );

        $this->makeName($dados->name);
        $attr = $this->attrs;
        $attr['type'] = 'checkbox';
        $this->makeName($dados->name);

        if( in_array($dados->value, $default)){
        	$attr['checked'] = 'checked';
        }

        $html = $this->_openTag('input', $dados->value, $attr);
        $html .= $dados->label;

        return $html;
    }

    public function checkBoxGroup($dados, $default = []){

        $dados = json_decode(json_encode( $dados ));

		$html = '';

        foreach ($dados->options as $option) {

        	$option->name = $dados->name.'[]';

        	$html .= $this->_openTag('div', null, ['class'=>'checkbox'] );
        	$html .= $this->_openTag('label');
            $selected = '';
            $html .= $this->checkbox($option, $default);
        	$html .= $this->_closeTag('label');
			$html .= $this->_closeTag('div');
        }

        $this->reset();
        return $html;
    }


    public function text($dados, $default = []){

 		$dados    = json_decode(json_encode( $dados ));
 		$default  = json_decode(json_encode( $default ));

        $this->makeName($dados->name);
 		$attr = $this->attrs;
        $attr['type'] = 'text';


        $value = '';
        if( isset($dados->value)){
        	$value = $dados->value;
        }

        if( isset($default->value)){
        	$attr['value'] = $default->value;
        }

        $html = $this->_openTag('input', $value, $attr);

        return $html;
    }


    public function textarea($dados, $default = []){

        $dados    = json_decode(json_encode( $dados ));
        $default  = json_decode(json_encode( $default ));

        $this->makeName($dados->name);
        $attr = $this->attrs;
        
        $value = '';
        if( isset($default->value) ){
            $value = $default->value;
        }
    
        $html = $this->_openTag('textarea', null, $attr);
        $html .= $value;
        $html .= $this->_closeTag('textarea');

        return $html;
    }


    // function groupField($dados, $default = []){

    //     $dados = json_decode(json_encode( $dados ));

    //     $html = '';

    //     foreach ($dados->response as $response) {

    //         $html .= $this->_openTag('div', null, ['class'=>'form-group'] );

    //         foreach ($response as $field) {



    //             print_r($field->response->name);
    //             print_r($field->interface->cols);


    //             // $html .= $this->_openTag('div', null, ['class'=>'col-md-'.$field->ui->cols] );


    //             if( $field->type == 'text' ){
    //                 $html .= $this->attr(['class' => 'form-control'])->text($field, $field->response);
    //             }

    //             if( $field->type == 'select' ){
    //                 $html .= $this->attr(['class' => 'form-control'])->select($field, $field->response);
    //             }

    //             // $html .= $this->_closeTag('div');

    //         }

    //         $html .= $this->_closeTag('div');

    //     }

    //     return $html;
    // }

    // private function makeCol( $col ){

    // }

}

