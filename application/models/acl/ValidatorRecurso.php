<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class validatorRecurso extends MY_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function validateToSave(){

        $this->form_validation->set_rules('fk_permissao', 'Permissão', 'required|trim');
        $this->form_validation->set_rules('nm_recurso', 'Nome do recurso', 'required|trim');
        $this->form_validation->set_rules('action', 'Action', 'required|trim');

        if( $this->form_validation->run() == FALSE ){
            return false;
        }

        return true;
    }


}
