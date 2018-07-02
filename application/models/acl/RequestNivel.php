<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RequestNivel extends MY_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function toSave(){

        $data = [
            'nm_nivel' => $this->input->post('nm_nivel'),
            'redirect_url' => $this->input->post('redirect_url')
        ];

        return $data;
    }

}
