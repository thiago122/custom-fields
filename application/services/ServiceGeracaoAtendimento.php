<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ServiceGeracaoAtendimento extends MY_Service
{

    public function __construct(){
        //parent::__construct();

    }

    public function gerar($config = []){

        $this->load->model('horarios-disponiveis/RepositoryHorariosDisponiveis');

        $dia                = date('Y-m-d');
        $dataDeAgendamento  = date('Y-m-d', strtotime( $dia . ' + '. INTERVALO_GERACAO_ATENDIMENTOS .' days'));
        $numDiaDaSemana     = date('N', strtotime( $dia . ' + '. INTERVALO_GERACAO_ATENDIMENTOS .' days'));

        if( isset($config['dia']) ){

           $dataDeAgendamento = $config['dia'];
           $numDiaDaSemana    = date('N', strtotime( $dataDeAgendamento));
        }

        $idClinica          = null;
        $idProfissional     = null;
        $idEspecialidade    = null;

        if(isset( $config['clinica_id'] )){
            $idClinica = $config['clinica_id'];
        }

        if(isset( $config['profissional_id'] )){
            $idProfissional = $config['profissional_id'];
        }

        if(isset( $config['especialidade_id'] )){
            $idEspecialidade = $config['especialidade_id'];
        }

        // horários disponíveis do dia da semana
        $horariosDiponiveis = $this->RepositoryHorariosDisponiveis->getHorariosDisponiveisDia( $numDiaDaSemana, $idClinica, $idProfissional, $idEspecialidade  );

        $inseridos = 0;

        foreach ($horariosDiponiveis as $horarios) {

            $inicio_agendamento = date('Y-m-d H:i:s',strtotime($dataDeAgendamento . ' ' . $horarios->hora)) ;
            $fim_agendamento = date('Y-m-d H:i:s', strtotime('+'. DURACAO_CONSULTA_MINUTOS .' minutes +'. DURACAO_CONSULTA_SEGUNDOS .' seconds' , strtotime($inicio_agendamento)));

            $this->db->where('especialidade_id'     , $horarios->especialidade_id );
            $this->db->where('profissional_id'      , $horarios->profissional_id );
            $this->db->where('clinica_id'           , $horarios->clinica_id );
            $this->db->where('inicio_agendamento'   , $inicio_agendamento );
            $total = $this->db->count_all_results('atendimento');

            if($total == 0){

                $insert = [

                    'especialidade_id'      => $horarios->especialidade_id,
                    'profissional_id'       => $horarios->profissional_id,
                    'clinica_id'            => $horarios->clinica_id,
                    'status_atendimento_id' => 1,

                    'inicio_agendamento' => $inicio_agendamento,
                    'fim_agendamento' => $fim_agendamento,
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $this->db->insert('atendimento', $insert);

                $inseridos++;

            }

        }

        return $inseridos;

    }

}
