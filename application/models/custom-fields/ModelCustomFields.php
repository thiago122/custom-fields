<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelCustomFields extends CI_model {

    public function __construct()
    {
        parent::__construct();
    }

    // pega todos os campos do formulário
    function getSchema( $idProntuario ){
        return $this->db->where('prontuario_id', $idProntuario)
                        ->get('campos_prontuario')->result();
    }

    function getRespostas( $idAtendimento, $idProntuario ){
        return $this->db->where('atendimento_id', $idAtendimento)
                        ->where('prontuario_id', $idProntuario)
                        ->order_by('parent', 'ASC')
                        ->order_by('index', 'ASC')
                        ->get('resposta')->result();
    }

    function getCompiledData( $idAtendimento, $idProntuario ){

        $campos     = $this->getSchema($idProntuario);
        $respostas  = $this->getRespostas($idAtendimento, $idProntuario);

        $schema = $this->FormatterCustomField->organizeSchema( $campos );
        $schema = $this->FormatterCustomField->merge($schema, $respostas);

        return $schema;
    }

    function save($idAtendimento, $idProntuario){

        $schema = $this->getSchema( $idProntuario );
        $schema = $this->FormatterCustomField->organizeSchema( $schema );
        $insert = $this->FormatterCustomField->prepareToSave( $schema, $idAtendimento, $idProntuario);

        $this->db->where('atendimento_id', $idAtendimento);
        $this->db->where('prontuario_id', $idProntuario);
        $this->db->delete('resposta');

        $this->db->insert_batch('resposta', $insert);

        return $insert;
    }

}// end class


/*


INSERT INTO `resposta` (`id_resposta`, `campo_id`, `form_atendimento_id`, `name`, `value`, `index`, `parent`, `atendimento_id`, `prontuario_id`) VALUES
(3, 0, 50, 'procedimento', 'exame de sangue', 0, 'repeater_procedimento', 0, 0),
(4, 0, 50, 'quantidade', '15', 1, 'repeater_procedimento', 0, 0),
(5, 0, 50, 'procedimento', 'exame de urina', 1, 'repeater_procedimento', 0, 0),
(6, 0, 50, 'uso_continuo', 'Sim', 0, 'repeater_procedimento', 0, 0);



 */
