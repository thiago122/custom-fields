<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_validation {

    public $data = [];

    public $ci; // objeto do codeigniter

    public function __construct()
    {

        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->ci->load->library('form_validation');
    }

    public function setConfigData($group){

        $this->ci->config->load('form_validation', TRUE);
        $this->data = $this->ci->config->item($group, 'form_validation');

        return $this;
    }

    public function remove($dataToRemove = []){

        $qtData = count($this->data);

        $indexToRemove = [];

        for ($i=0; $i < $qtData; $i++) {
            if(in_array($this->data[$i]['field'], $dataToRemove)){
                $remove[] = $i;
            }
        }

        foreach ($indexToRemove as $index) {
            array_splice($this->data, $index, 1);
        }

        return $this;
    }

    public function replace($dataToRemove = []){

        $replace_keys = array_keys($dataToRemove);
        $replace_values = array_values($dataToRemove);

        $qtData = count($this->data);
        for ($i=0; $i < $qtData; $i++) {
            $this->data[$i]['rules'] = str_replace($replace_keys, $replace_values, $this->data[$i]['rules']);
        }

        return $this;
    }

    public function validate( $data = [] ){

        $validation_array = $data;

        if(empty($validation_array)){

            $validation_array = empty($this->data)
                         ? $this->ci->input->post(null, true)
                         : $this->data;
        }

        $this->ci->form_validation->set_data($validation_array);

        if( $this->ci->form_validation->run() == FALSE ){
            return false;
        }

        return true;
    }

    // COMO USAR
    // RETORNA TRUE OU FALSE
    // $isValid = $this->custom_validation
    //   ->setConfigData('usuario_save')
    //   ->remove(['sexo','cpf'])
    //   ->replace(['name' => 'John','id_usuario' => '123456789'])
    //   ->validate();



}// FIM DA CLASSE

