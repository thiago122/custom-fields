<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class validatorPermissao extends MY_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function validateToSave(){

        $this->form_validation->set_rules('nm_permissao', 'Permissão', 'required|trim');

        if( $this->form_validation->run() == FALSE ){
            return false;
        }

        return true;
    }


}
