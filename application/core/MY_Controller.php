<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $segment;
    public $limit;
    public $controllerPath;
    public function __construct()
    {
        parent::__construct();
    }

    public function basePagination($total){

        $this->load->library('pagination');
        $this->pagination->setTotal($total)
                         ->setUriSegment($this->segment)
                         ->setPerPage($this->limit)
                         ->setBaseUrl( $this->controllerPath );

        return $this->pagination->createLinks();

    }

    // https://pt.wikipedia.org/wiki/Lista_de_c%C3%B3digos_de_estado_HTTP

    public function json($arrayValues = array()){
        $this->output->set_content_type('application/json');
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_output(json_encode($arrayValues));
        $this->output->_display();
        exit;
    }

    public function status($status){
        $this->output->set_status_header($status);
        return $this;
    }

    public function statusOk(){
        $this->status(200);
        return $this;
    }

    public function statusNaoEncontrado(){
        $this->status(404);
        return $this;
    }

    public function statusErro(){
        $this->status(500);
        return $this;
    }

    public function statusErroValidacao(){
        $this->status(412);
        return $this;
    }

    public function statusErroNaoAutorizado(){
        $this->status(401);
        return $this;
    }

    public function restAutorization($pathRecurso, $mensagem = ['Não autorizado.'] ){

        if( !$this->acesso->podeAcessar($pathRecurso, TRUE)){
            $this->statusErroNaoAutorizado()->json(['msg' => $mensagem ]);
        }

    }

    public function serviceSetErrorToView($data){

        $data = json_decode($data);

        foreach ($data->message as $error) {
            $this->mensagem->adicionar('danger', $error);
        }

    }

    public function serviceResponseObject($data){
        return json_decode($data);
    }

}
