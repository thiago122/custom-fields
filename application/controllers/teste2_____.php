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

        $this->load->model('custom-fields/FormatterCustomField');

        $schema = $this->schema();
        $stored = $this->stored();

        $schema = $this->FormatterCustomField->organizeSchema( $schema );
        $schema = $this->FormatterCustomField->merge($schema, $stored);


        // $dados['schema'] = $this->merge();
        $dados['schema'] = $schema;

        $this->load->view('admin/form/teste2',$dados);
    }


    public function save(){

        $this->load->model('custom-fields/FormatterCustomField');
        $schema = $this->schema();
        $schema = $this->FormatterCustomField->organizeSchema( $schema );
        $insert = $this->FormatterCustomField->prepareToSave( $schema );
        print_r($insert);
    }

    public function _save(){

        $schema = $this->organizeSchema();
        // print_r($schema);
        // print_r( $this->input->post());
        $insert = [];

        foreach ($schema as $schemaField) {

            // se é um campo com subcampos
            if( isset($schemaField['fields']) ){

                // pega o nome do parent
                $groupName = $schemaField['structure']->name;

                // pega os grupos de respostas do parent
                $groupRespostas = $this->input->post($groupName);

                // para cada grupo de resposta
                $i = 0;
                foreach ($groupRespostas as $groupResposta){

                    // para cada subcampo do grupo
                    foreach ($schemaField['fields'] as $field){

                        $name    = $field['structure']->name; // pega o name do subcampo

                        // se a resposta existe
                        if( isset($groupResposta[$field['structure']->name]) ){
                            $values  = $groupResposta[$field['structure']->name]; // pega a resposta

                            // se o campo possui mais de uma resposta
                            // Ex: um checkbox cor[]: cor[]: preto, cor:[] branco
                            // insere cada um com um indice dinâmico
                            if( is_array($values) ){

                                $j = 0;
                                foreach ($values as $value) {

                                    $insert[] = [
                                        'name'    => $name,
                                        'value'   => $value,
                                        'index'   => $j,
                                        'parent'  => $groupName
                                    ];

                                    $j++;
                                }

                            }else{

                                // se o campo possui não mais de uma resposta
                                // seu indice é 0
                                $insert[] = [
                                    'name'      => $name,
                                    'value'     => $values,
                                    'index'     => 0,
                                    'parent'    => $groupName
                                ];

                            }

                        }


                    }
                    $i++;
                }

            }else{
                // se não é um campo com subcampos

                $name = $schemaField['structure']->name;
                $values = $this->input->post($name);

                // se o campo possui mais de uma resposta
                // Ex: um checkbox cor[]: cor[]: preto, cor:[] branco
                // insere cada um com um indice dinâmico
                if(is_array($values)){

                    $i = 0;
                    foreach ($values as $value) {

                        $insert[] = [
                            'name'    => $name,
                            'value'   => $value,
                            'index' => $i,
                            'parent' => null
                        ];

                        $i++;
                    }

                }else{
                    // se o campo possui não mais de uma resposta
                    // seu indice é 0
                    $insert[] = [
                        'name'      => $name,
                        'value'     => $values,
                        'index'     => 0,
                        'parent'    => null
                    ];
                }

            }

        }

        // echo "--------------------";

        print_r($insert);

    }

}
