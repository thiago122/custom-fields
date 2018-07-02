<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RequestPermissao extends MY_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function toSave(){

        $data = array(
            'nm_permissao'  => $this->input->post('nm_permissao'),
        );

        return $data;
    }

}
