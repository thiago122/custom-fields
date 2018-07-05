<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FormatterCustomField extends MY_model {

    public function __construct()
    {
        parent::__construct();
        $this->table      = 'nivel';
        $this->primaryKey = 'id_nivel';
    }

    /**
        Junta as respostas armezenasdas com a estrutura organizada
     */
    public function merge( $schema = [], $stored = []){

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

    /*
        organiza a estrutura dos campos para que seja possível
        exibir no formulário
     */
    public function organizeSchema($schema = []){

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

    /** organiza o array para salvar */
    public function prepareToSave($organizedSchema = [], $idAtendimento, $idProntuario){

        $schema = $organizedSchema;
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
                                        'name'           => $name,
                                        'value'          => $value,
                                        'index'          => $j,
                                        'parent'         => $groupName,
                                        'atendimento_id' => $idAtendimento,
                                        'prontuario_id'  => $idProntuario,
                                    ];

                                    $j++;
                                }

                            }else{

                                // se o campo possui não mais de uma resposta
                                // seu indice é 0
                                $insert[] = [
                                    'name'           => $name,
                                    'value'          => $values,
                                    'index'          => $i,
                                    'parent'         => $groupName,
                                    'atendimento_id' => $idAtendimento,
                                    'prontuario_id'  => $idProntuario,
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
                            'name'           => $name,
                            'value'          => $value,
                            'index'          => $i,
                            'parent'         => null,
                            'atendimento_id' => $idAtendimento,
                            'prontuario_id'  => $idProntuario,
                        ];

                        $i++;
                    }

                }else{
                    // se o campo possui não mais de uma resposta
                    // seu indice é 0
                    $insert[] = [
                        'name'           => $name,
                        'value'          => $values,
                        'index'          => 0,
                        'parent'         => null,
                        'atendimento_id' => $idAtendimento,
                        'prontuario_id'  => $idProntuario,
                    ];
                }

            }

        }

        return $insert;

    }

}// end class
