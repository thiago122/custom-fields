<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class validatorNivel extends MY_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function validateToSave(){

        $this->form_validation->set_rules('nm_nivel', 'Nível', 'required|trim');
        $this->form_validation->set_rules('recurso[]', 'Selecione os recursos do nível', 'required|trim');

        if( $this->form_validation->run() == FALSE ){
            return false;
        }

        return true;
    }


}
