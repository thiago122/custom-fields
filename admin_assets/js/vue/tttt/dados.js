

var data = {

    // tiposEspecialidade: [],
    // clinicas: [],
    // horariosClinica: [],
    // statusAtendimento: [],
    // dataAtual: '',

    idClinicaSelecionada:'',
    idTipoEspecialidade: '',

    _atendimentos: [],
    profissionaisClinica: [],
    especialidadesClinica: [],

    // dias do mes com consulta
    diasMes: [],

    // busca por usuario
    urlBuscaUsuario: base_url + 'admin/atendimento/Recepcao/buscaUsuario',

    // GRADE
    _grade: [],

    exibindoStatusAtendimento: false,
    exibirCalendario: false,

    pesquisa: {
        indexEspecialidade: '',
        idEspecialidade: '',
        idProfissional: '',
        mes: '',
        ano: '',
    },

    resultadoPesquisa: [],

    // atendimento
    // _atendimento: {
    //     modo_edicao: false,
    //     especialidades: [],
    //     agendante: {
    //         nm_usuario: '',
    //         cpf:        '',
    //         rg:         '',
    //         fixo:       '',
    //         celular:    '',
    //     },

    //     data: '',
    //     inicio: '',
    //     fim: '',

    //     id_atendimento: '',
    //     id_atendimento_retorno: '',

    //     nm_profissional: '',

    //     id_especialidade: '',
    //     nm_especialidade: '',

    //     id_profissional: '',

    //     id_status_atendimento: '',
    //     nm_status_atendimento: '',
    //     class_css: '',
    //     exadecimal_cor: '',

    //     id_usuario_agendante: '',

    //     inicio_atendimento: '',
    //     fim_atendimento: '',

    //     inicio_espera: '',
    //     fim_espera: '',

    //     agendado_em: '',

    //     inicio_agendamento: '',
    //     fim_agendamento: '',

    //     obs_atendimento: '',
    //     duracao: '',

    // },

    // interface

    widthCaledarioAtendimento: 0,
    widthColuna: 120,
}
