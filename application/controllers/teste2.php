<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teste2 extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('acf');
    }

    public function index(){
        $schema = $this->showForm();
    }

    public function schema(){

        $fields = [
            [
                'name'    => 'observacoes',
                'label'   => 'Observações',
                'type'    => 'textarea',
                'value'   => '',
                'parent'  => ''
            ],
            [
                'name'    => 'marca_carro',
                'label'   => 'Marca do carro',
                'type'    => 'text',
                'value'   => '',
                'parent'  => ''
            ],

            [
                'name'    => 'possui_ar_condicionado',
                'label'   => 'Prossui ar condicionado',
                'type'    => 'checkbox',
                'value'   => 'Sim',
                'parent'  => ''
            ],

            [
                'name'    => 'cor_carro',
                'label'   => 'Cor do carro',
                'type'    => 'checkbox_group',
                'value'   => '',
                'choices' => 'preto: Cor Preta;branco: Cor Branca;verde: Cor verde',
                'parent'  => ''
            ],

            [
                'name'    => 'nome_dono',
                'label'   => 'Nome',
                'type'    => 'text',
                'value'   => '',
                'parent'  => 'historico_propriedade'
            ],

            [
                'name'    => 'historico_propriedade',
                'label'   => 'Histórico de donos',
                'type'    => 'repeater',
                'value'   => '',
                'choices' => '',
                'parent'  => ''
            ],

                [
                    'name'    => 'periodo',
                    'label'   => 'Preriodo',
                    'type'    => 'text',
                    'value'   => '',
                    'parent'  => 'historico_propriedade'
                ],
                [
                    'name'    => 'tipo_acidente',
                    'label'   => 'Tipo de acidente',
                    'type'    => 'checkbox_group',
                    'value'   => 'nunhum',
                    'choices' => 'nunhum: Nenhum;leve:Leve; grave: Grave Branca;gravissimo: Gravissimo',
                    'parent'  => 'historico_propriedade'
                ],
        ];

        return json_decode(json_encode($fields));
    }

    public function stored(){

        $fields = [

            [ 'name'    => 'observacoes',   'value'   => 'Sim', 'index' => 1, 'parent' => null ],
            [ 'name'    => 'possui_ar_condicionado',   'value'   => 'Sim', 'index' => 1, 'parent' => null ],

            [ 'name'    => 'marca_carro',   'value'   => 'Honda civic', 'index' => 1, 'parent' => null ],
            [ 'name'    => 'cor_carro',     'value'   => 'preto',       'index' => 1, 'parent' => null ],
            [ 'name'    => 'cor_carro',     'value'   => 'branco',      'index' => 2, 'parent' => null],

            // REPEATER
            // -------------------------------
            ['name'=> 'nome_dono',    'value'=> 'thiago',           'index'=> 1,    'parent' => 'historico_propriedade'],
            ['name'=> 'periodo',      'value'=> '2000 - 2005',      'index'=> 1,    'parent' => 'historico_propriedade'],
            ['name'=> 'tipo_acidente','value'=> 'grave',            'index'=> 1,    'parent' => 'historico_propriedade'],
            ['name'=> 'tipo_acidente','value'=> 'gravissimo',       'index'=> 1,    'parent' => 'historico_propriedade'],

            // REPEATER
            // -------------------------------
            ['name'=> 'nome_dono',    'value'=> 'joão',             'index'=> 2,    'parent' => 'historico_propriedade'],
            ['name'=> 'periodo',      'value'=> '2006 - 2010',      'index'=> 2,    'parent' => 'historico_propriedade'],
            ['name'=> 'tipo_acidente','value'=> 'leve',             'index'=> 2,    'parent' => 'historico_propriedade'],
            ['name'=> 'tipo_acidente','value'=> 'gravissimosss',    'index'=> 2,    'parent' => 'historico_propriedade'],

        ];

        // return json_decode(json_encode([]));
        return json_decode(json_encode($fields));

    }

    public function showFormPrescricao(){

        $this->load->model('custom-fields/FormatterCustomField');
        $this->load->model('custom-fields/ModelCustomFields');

        // $campos     = $this->ModelCustomFields->getSchema(4);

        // $respostas  = $this->db->order_by('parent', 'ASC')
        //                        ->order_by('index', 'ASC')
        //                        ->get('resposta')->result();
        // $schema = $campos;
        // $stored = $respostas;
        // $schema = $this->FormatterCustomField->organizeSchema( $schema );
        // $schema = $this->FormatterCustomField->merge($schema, $stored);
        // $dados['schema'] = $schema;


        $dados['schema'] = $this->ModelCustomFields->getCompiledData(3175, 4);

        $this->load->view('admin/form/prescricao',$dados);
    }


    public function showForm(){

        $this->load->model('custom-fields/FormatterCustomField');

        $schema = $this->schema();
        $stored = $this->stored();

        $schema = $this->FormatterCustomField->organizeSchema( $schema );
        $schema = $this->FormatterCustomField->merge($schema, $stored);

        $dados['schema'] = $schema;

        $this->load->view('admin/form/teste2',$dados);
    }


    public function save(){

        $this->load->model('custom-fields/FormatterCustomField');
        $this->load->model('custom-fields/ModelCustomFields');

        // $schema = $this->ModelCustomFields->getSchema( 4 );
        // $schema = $this->FormatterCustomField->organizeSchema( $schema );
        // $insert = $this->FormatterCustomField->prepareToSave( $schema, 3175, 4);

        $insert = $this->ModelCustomFields->save( 3175, 4);
        print_r($insert);
    }

    public function _save(){

        $this->load->model('custom-fields/FormatterCustomField');
        $schema = $this->schema();
        $schema = $this->FormatterCustomField->organizeSchema( $schema );
        $insert = $this->FormatterCustomField->prepareToSave( $schema );
        print_r($insert);
    }



}
