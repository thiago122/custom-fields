<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teste2 extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('acf');
       
    }

    public function index(){
        $schema = $this->schema(); 
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


    public function merge(){
        $stored = $this->stored();
        $schema = $this->organizeSchema();

        foreach ($stored as $s) {

            // o campo não faz parte de algum grupo
            if( $s->parent == null ){
                $schema[$s->name]['resposta'][] = $s;
            }else{
                $structure = $schema[$s->parent]['fields'][$s->name]['structure'];
                $schema[$s->parent]['respostas'][$s->index][$s->name]['structure'] = $structure;
                $schema[$s->parent]['respostas'][$s->index][$s->name]['resposta'][] = $s;
            }
        }

        return $schema;       

    }

   

    public function organizeSchema(){

        $schema = $this->schema();

        $mixed = [];

        foreach ($schema as $field) {

            // o campo não é um subcampo
            if($field->parent == null){

                // se o campos não existe no vetor principal
                if( !isset($mixed[$field->name]) ){
                    $mixed[$field->name] = ['structure' => $field];
                }else{
                    $mixed[$field->name]['structure'] = $field;
                }

            }else{

                // se o "Parent" do subcampo existe
                if( isset($mixed[$field->parent]) ){
                   
                    $mixed[$field->parent]['fields'][$field->name] = [
                        'structure' => $field
                    ];

                }else{
                    
                    $mixed[$field->parent] = [ 'structure' => [] ];

                    $mixed[$field->parent]['fields'][$field->name] = [
                        'structure' => $field
                    ];
                }
            }
        }

        return $mixed;       

    }


    public function showForm(){
        $dados['schema'] = $this->merge();

        $GLOBALS['schema'] = $dados['schema'];
        $this->load->view('admin/form/teste2',$dados);
    }

}