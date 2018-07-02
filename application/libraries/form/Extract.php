<?php

class Extract {

    private $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function extract($campos){

        $dados = json_decode(json_encode( $campos ));

        $existentes = [];

        $extraido = [];

        foreach ($campos as $campo) {

            if( $campo->campo_type == 'checkbox_group' || $campo->campo_type == 'select' || $campo->campo_type == 'group_field'){
                $campo->campo_options = json_decode($campo->campo_options);

            }

            $formatado = [
                'name'      => $campo->campo_name,
                'label'     => $campo->campo_label,
                'type'      => $campo->campo_type,
                'value'     => $campo->campo_value,
                'options'   => $campo->campo_options,
                'response'  => []
            ];

            $response = [
                'name'  => $campo->resposta_name,
                'label' => $campo->resposta_label,
                'label' => $campo->resposta_label_question,
                'type'  => $campo->resposta_type,
                'value' => $campo->resposta_value,
                'index' => $campo->resposta_index,
            ];

            // se não foi adicionado
            // if( !in_array($campo->campo_name, $existentes) ){

            //     $existentes[] = $campo->campo_name;

            //     if( $campo->campo_type == 'checkbox_group' ){

            //         $formatado['response'][] = $response;

            //     }elseif ( $campo->campo_type == 'group_field' ){

            //         // se o agrupado  possui alguma resposta
            //         if( $campo->resposta_name != null ){

            //             $estrutura_response = $formatado['options']->{$response['name']} ;
            //             $estrutura_response->response = $response;
            //         }else{

            //         }

            //     }else{
            //         $formatado['response'] = $response;
            //     }


            //     if( $campo->campo_type == 'group_field' ){

            //         if( $campo->resposta_name != null ){
            //             $formatado['response'][$campo->resposta_index][$campo->resposta_name] = $estrutura_response;
            //             $extraido[$campo->campo_name] = $formatado;
            //         }else{
            //             $formatado['response'] = [];
            //             $extraido[$campo->campo_name] = $formatado;
            //         }

            //     }else{
            //         $extraido[$campo->campo_name] = $formatado;
            //     }



            // }else{

            //     if( $campo->campo_type == 'group_field' ){

            //         if( $campo->resposta_name != null ){
            //             $estrutura_response = $formatado['options']->{$response['name']} ;
            //             $estrutura_response->response = $response;

            //             $extraido[$campo->campo_name]['response'][$campo->resposta_index][$campo->resposta_name] = $estrutura_response;
            //         }

            //     }else{
            //         $extraido[$campo->campo_name]['response'][] = $response;
            //     }

            // }

            // =============================================================
            // =============================================================
            // =============================================================

            if( $campo->campo_type == 'checkbox_group' ){

                // se não foi adicionado
                if( !in_array($campo->campo_name, $existentes) ){

                    // adiciona
                    $existentes[] = $campo->campo_name;
                    $formatado['response'][] = $response;
                    $extraido[$campo->campo_name] = $formatado;
                    $extraido[$campo->campo_name]['response'][] = $response;

                }else{
                    $extraido[$campo->campo_name]['response'][] = $response;
                }

                // $extraido[$campo->campo_name] = $formatado;

            }else if( $campo->campo_type == 'group_field' ){

                // se não foi adicionado
                if( !in_array($campo->campo_name, $existentes) ){

                    // adiciona
                    $existentes[] = $campo->campo_name;

                    // se o agrupado  possui alguma resposta
                    if( $campo->resposta_name != null ){
                        $estrutura_response = $formatado['options']->{$response['name']} ;
                        $estrutura_response->response = $response;
                        $formatado['response'][$campo->resposta_index][$campo->resposta_name] = $estrutura_response;
                        $extraido[$campo->campo_name] = $formatado;
                    }else{
                        $formatado['response'] == $formatado['options'];
                        $extraido[$campo->campo_name] = $formatado;
                        // print_r( $extraido );
                    }


                }else{

                    if( $campo->resposta_name != null ){
                        $estrutura_response = $formatado['options']->{$response['name']} ;
                        $estrutura_response->response = $response;

                        $extraido[$campo->campo_name]['response'][$campo->resposta_index][$campo->resposta_name] = $estrutura_response;
                    }
                }

            }else{

                // se não foi adicionado
                if( !in_array($campo->campo_name, $existentes) ){
                    // adiciona
                    $existentes[] = $campo->campo_name;
                    $formatado['response'] = $response;
                    $extraido[$campo->campo_name] = $formatado;

                }else{

                }
            }

        }

        // die();

       // print_r( $extraido); die();

        return $extraido;

    }

    public function get($idFormAtendimento, $idFormulario){

        $this->ci->db->select('
            campo.name      as campo_name,
            campo.label     as campo_label,
            campo.type      as campo_type,
            campo.value     as campo_value,
            campo.options   as campo_options,

            resposta.name      as resposta_name,
            resposta.label     as resposta_label,
            resposta.label     as resposta_label_question,
            resposta.type      as resposta_type,
            resposta.value     as resposta_value,
            resposta.index     as resposta_index,
        ');

        if( $idFormAtendimento ){
            $this->ci->db->join('resposta','resposta.campo_id = campo.id_campo AND resposta.form_atendimento_id = ' . $idFormAtendimento,'LEFT');
        }else{
            $this->ci->db->join('resposta','resposta.campo_id = campo.id_campo AND resposta.form_atendimento_id IS NULL','LEFT');
        }


        $this->ci->db->join('form','form.id_form = campo.form_id');
        $this->ci->db->where('form.id_form', $idFormulario);


        $this->ci->db->order_by('campo_name','ASC');
        $this->ci->db->order_by('campo_name','DESC');

        $campos = $this->ci->db->get('campo')->result();;

        return $campos;

    }

    public function fields($idFormAtendimento = null, $idFormulario = null){
        $campos     = $this->get($idFormAtendimento, $idFormulario);

        $extraidos  = $this->extract( $campos );
        return $extraidos;
    }

    public function save($idForm, $idAtendimento, $idFormAtendimento = null , $post){

        // pega o modelo de formulário
        $this->ci->db->where('id_form', $idForm );
        $form = $this->ci->db->get('form')->row();

        // se não existe $idFormAtendimento
        // é necessário criar um novo
        if( !$idFormAtendimento ){

            $this->ci->db->insert('form_atendimento',[
                'atendimento_id' => $idAtendimento,
                'form_id'        => $idForm,
            ]);

            $idFormAtendimento = $this->ci->db->insert_id();

        }else{
            // deleta todos os campos previamente cadastrados
            // --> no final serão cadastrados novos campos
            $this->ci->db->where('form_atendimento_id', $idFormAtendimento);
            $this->ci->db->delete('resposta');
        }

        // pega os campos do form(Modelo)
        $this->ci->db->where('form_id', $form->id_form );
        $camposForm = $this->ci->db->get('campo')->result();

        $save = [];

        // para cada campo do formulário
        // verifica se o campo foi respondido
        // se foi preenchido cria-se um array para o insert
        foreach ($camposForm as $campo) {

            // se o campo foi preenchido
            if(isset($post[$campo->name] )){

                // se é uma array
                // Ex:. um checkbox de de múltipla escolha
                if( is_array($post[$campo->name]) ){

                    if( $campo->type == 'checkbox_group' ){

                        $index = 0;
                        foreach ($post[$campo->name] as $resposta) {

                            $option = $this->_findOption($campo->options, $resposta);

                            $temp = $this->_preenche($campo, $option->value , $option->label, $idFormAtendimento, $index);

                            $save[] = $temp;
                            $index++;
                        }

                    }

                    if( $campo->type == 'group_field' ){

                       $campo->options = json_decode($campo->options);

                        foreach ($campo->options as $subFieldName => $subField) {

                            $valoresCampo = $post[$campo->name][$subFieldName];

                            $index = 0;
                            foreach ($valoresCampo as $valorCampo) {

                                $subField->id_campo = $campo->id_campo;

                                $save[] = $this->_preenche($subField, $valorCampo , $subField->label, $idFormAtendimento, $index);
                                $index++;
                            }

                        }

                    }

                }else{

                    $value = trim($post[$campo->name]);

                    // se não estiver vasio
                    // formata o array para salvar
                    if( !empty($value) ){
                        $resposta = $post[$campo->name];
                        $labeResposta = $campo->label ;
                        $save[] = $this->_preenche($campo, $resposta, $labeResposta, $idFormAtendimento);
                    }

                }

            }

        }

       // var_dump($post);
       // var_dump($save);
       // print_r($save);


        // die();


        if ( empty($save) ){
            return false;
        }

        $this->ci->db->insert_batch('resposta', $save);



        return [
            'id_form_atendimento' => $idFormAtendimento,
            'save_data'           => $save
        ];

    }

    private function _preenche($campo, $resposta, $labeResposta, $formAtendimentoID, $index = 0){

       return [
            'campo_id'              => $campo->id_campo,
            'form_atendimento_id'   => $formAtendimentoID,
            'label_question'        => $campo->label,
            'label'                 => $labeResposta,
            'name'                  => $campo->name,
            'value'                 => $resposta,
            'type'                  => $campo->type,
            'index'                 => $index,
        ];

    }

    private function _findOption($options, $value){

        $options = json_decode($options);

        foreach ($options as $option) {
            if( $option->value == $value ){
                return $option;
            }
        }

        return false;
    }

}

