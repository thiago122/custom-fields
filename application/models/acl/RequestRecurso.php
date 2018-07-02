<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RequestRecurso extends MY_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function toSave(){

        $data = array(
            'fk_permissao'  => $this->input->post('fk_permissao'),
            'nm_recurso'    => $this->input->post('nm_recurso'),
            'action'        => $this->input->post('action'),
        );

        return $data;
    }

}
