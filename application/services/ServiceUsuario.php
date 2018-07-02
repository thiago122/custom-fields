<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ServiceUsuario extends MY_Service
{

    public function __construct(){
        //parent::__construct();
        $this->load->library(['form_validation','breadcrumbs','mensagem','acesso','pagination']);
        $this->load->helper(['url','form','config','array','documents','datetime','common']);
    }

    public function store(){

        // validar endereço
        if( !$this->ValidatorEndereco->validate() ){
            throw new Exception( $this->_erroValidacao() );
        }

        // Validar usuário
        if( !$this->ValidatorUsuario->toSaveUsuario() ){
            throw new Exception( $this->_erroValidacao() );
        }

        // Formata o usuario para salvar
        $usuarioFormatado  = $this->RequestUsuario->toSaveUsuario();

        // salva os dados do usuário
        $idUsuario = $this->RepositoryUsuario->save( $usuarioFormatado );

        // Formata o endereco para salvar
        $enderecoFormatado = $this->RequestEndereco->endereco();
        $enderecoFormatado['usuario_id'] = $idUsuario;

        // pega o endereço do usuário porque está em tabela separada
        $enderecoUsuario = $this->ModelEnderecoUsuario->where('usuario_id', $idUsuario)->first();

        // cria o endereço
        $this->ModelEnderecoUsuario->save( $enderecoFormatado );

        return json_encode([
            'message'   => 'Salvo com sucesso',
            'data'      => [
                'id' => $idUsuario
            ]
        ]);

    }

    public function storePaciente(){

        // Paciente é dependente
        if( $this->input->post('is_dependente') ){

            // Validar usuário
            if( !$this->ValidatorUsuario->toSavePacienteDependente() ){
                throw new Exception( $this->_erroValidacao() );
            }

        }else{

            // validar endereço
            if( !$this->ValidatorEndereco->validate() ){
                throw new Exception( $this->_erroValidacao() );
            }

            // Validar usuário
            if( !$this->ValidatorUsuario->toSavePaciente() ){
                throw new Exception( $this->_erroValidacao() );
            }

        }

        // Formata o usuario para salvar
        $usuarioFormatado  = $this->RequestUsuario->toSavePaciente();

        // salva os dados do usuário
        $idUsuario = $this->RepositoryUsuario->save( $usuarioFormatado );

        // Formata o endereco para salvar
        $enderecoFormatado = $this->RequestEndereco->endereco();
        $enderecoFormatado['usuario_id'] = $idUsuario;

        // cria o endereço
        $this->ModelEnderecoUsuario->save( $enderecoFormatado );

        return json_encode([
            'message'   => 'Salvo com sucesso',
            'data'      => [
                'id' => $idUsuario
            ]
        ]);

    }


    public function storeProfissional(){

        // validar endereço
        // if( !$this->ValidatorEndereco->validate() ){
        //     throw new Exception( $this->_erroValidacao() );
        // }

        // Validar usuário
        if( !$this->ValidatorUsuario->toSaveProfissional() ){
            throw new Exception( $this->_erroValidacao() );
        }

        // Validar dados do médico
        if( !$this->ValidatorProfissional->toSave() ){
            throw new Exception( $this->_erroValidacao() );
        }

        // Formata o usuario para salvar
        $usuarioFormatado  = $this->RequestUsuario->toSaveProfissional();

        // salva os dados do usuário
        $idUsuario = $this->RepositoryUsuario->save( $usuarioFormatado );

        // Formata o endereco para salvar
        $enderecoFormatado = $this->RequestEndereco->endereco();
        $enderecoFormatado['usuario_id'] = $idUsuario;

        // cria o endereço
        $this->ModelEnderecoUsuario->save( $enderecoFormatado );

        // Formata os dados do médico
        $profissionalFormatado  = $this->RequestProfissional->toSave($idUsuario);

        $this->RepositoryProfissional->save($profissionalFormatado);

        return json_encode([
            'message'   => 'Salvo com sucesso',
            'data'      => [
                'id' => $idUsuario
            ]
        ]);

    }

    public function update($idUsuario = null){

        // Procura o usuário
        if( !$idUsuario ){
            throw new Exception($this->_erroNaoEncontrado());
        }

        if( !$this->verificarEdicaoSuperAdmin($idUsuario) ){
            throw new Exception($this->_erroNaoPodeEditar());
        }

        // validar endereço
        if( !$this->ValidatorEndereco->validate() ){
            throw new Exception($this->_erroValidacao());
        }

        // Validar usuário
        if( !$this->ValidatorUsuario->toUpdateUsuario($idUsuario) ){
            throw new Exception($this->_erroValidacao());
        }

        // Formata o usuario para salvar
        $usuarioFormatado  = $this->RequestUsuario->toUpdate($idUsuario);

        // salva os dados do usuário
        $this->RepositoryUsuario->save( $usuarioFormatado, $idUsuario );

        // Formata o endereco para salvar
        $enderecoFormatado = $this->RequestEndereco->endereco();
        $enderecoFormatado['usuario_id'] = $idUsuario;

        // pega o endereço do usuário porque está em tabela separada
        $enderecoUsuario = $this->ModelEnderecoUsuario->where('usuario_id', $idUsuario)->first();

        // se não existir cria
        if(!$enderecoUsuario){
            // cria
            $this->ModelEnderecoUsuario->save( $enderecoFormatado );
        }else{
            // atualiza
            $this->ModelEnderecoUsuario->save( $enderecoFormatado, $enderecoUsuario->id_endereco );
        }

        return json_encode([
            'message'   => 'Salvo com sucesso',
            'data'      => [
                'id' => $idUsuario
            ]
        ]);
    }

    public function updatePaciente($idUsuario = null){

        // Procura o usuário
        if( !$idUsuario ){
            throw new Exception($this->_erroNaoEncontrado());
        }

        if( !$this->verificarEdicaoSuperAdmin($idUsuario) ){
            throw new Exception($this->_erroNaoPodeEditar());
        }

        // Paciente é dependente
        if( $this->input->post('is_dependente') ){

            // Validar usuário
            if( !$this->ValidatorUsuario->toUpdatePacienteDependente($idUsuario) ){
                throw new Exception($this->_erroValidacao());
            }

        }else{
            // validar endereço
            if( !$this->ValidatorEndereco->validate() ){
                throw new Exception($this->_erroValidacao());
            }

            // Validar usuário
            if( !$this->ValidatorUsuario->toUpdatePaciente($idUsuario) ){
                throw new Exception($this->_erroValidacao());
            }

        }

        // Formata o usuario para salvar
        $usuarioFormatado  = $this->RequestUsuario->toUpdatePaciente($idUsuario);

        // salva os dados do usuário
        $this->RepositoryUsuario->save( $usuarioFormatado, $idUsuario );

        // Formata o endereco para salvar
        $enderecoFormatado = $this->RequestEndereco->endereco();
        $enderecoFormatado['usuario_id'] = $idUsuario;

        // pega o endereço do usuário porque está em tabela separada
        $enderecoUsuario = $this->ModelEnderecoUsuario->where('usuario_id', $idUsuario)->first();

        // se não existir cria
        if(!$enderecoUsuario){
            // cria
            $this->ModelEnderecoUsuario->save( $enderecoFormatado );
        }else{
            // atualiza
            $this->ModelEnderecoUsuario->save( $enderecoFormatado, $enderecoUsuario->id_endereco );
        }

        return json_encode([
            'message'   => 'Salvo com sucesso',
            'data'      => [
                'id' => $idUsuario
            ]
        ]);
    }


    public function updateProfissional($idUsuario = null){

        $this->load->model([
            'profissional/RequestProfissional',
            'profissional/RepositoryProfissional',
            'profissional/ValidatorProfissional'
        ]);

        // Procura o usuário
        if( !$idUsuario ){
            throw new Exception($this->_erroNaoEncontrado());
        }

        if( !$this->verificarEdicaoSuperAdmin($idUsuario) ){
            throw new Exception($this->_erroNaoPodeEditar());
        }

        // validar endereço
        // if( !$this->ValidatorEndereco->validate() ){
        //     throw new Exception($this->_erroValidacao());
        // }

        // Validar o usuário do médico
        if( !$this->ValidatorUsuario->toUpdateProfissional($idUsuario) ){
            throw new Exception($this->_erroValidacao());
        }

        // Validar o médico
        if( !$this->ValidatorProfissional->toUpdate($idUsuario) ){
            throw new Exception($this->_erroValidacao());
        }

        // Formata o usuario para salvar
        $usuarioFormatado  = $this->RequestUsuario->toUpdateProfissional($idUsuario);

        // salva os dados do usuário
        $this->RepositoryUsuario->save( $usuarioFormatado, $idUsuario );

        // Formata o endereco para salvar
        $enderecoFormatado = $this->RequestEndereco->endereco();
        $enderecoFormatado['usuario_id'] = $idUsuario;

        // pega o endereço do usuário porque está em tabela separada
        $enderecoUsuario = $this->ModelEnderecoUsuario->where('usuario_id', $idUsuario)->first();

        // Formata os dados do médico
        $profissionalFormatado  = $this->RequestProfissional->toUpdate();

        $profissional = $this->RepositoryProfissional->where('usuario_id', $idUsuario)->first();

        $this->RepositoryProfissional->save($profissionalFormatado, $profissional->id_profissional);

        // se não existir cria
        if(!$enderecoUsuario){
            // cria
            $this->ModelEnderecoUsuario->save( $enderecoFormatado );
        }else{
            // atualiza
            $this->ModelEnderecoUsuario->save( $enderecoFormatado, $enderecoUsuario->id_endereco );
        }

        return json_encode([
            'message'   => 'Salvo com sucesso',
            'data'      => [
                'id' => $idUsuario
            ]
        ]);
    }


    public function delete( $idUsuario = null ){

        // Procura o usuário
        if( !$idUsuario ){
            throw new Exception($this->_erroNaoEncontrado());
        }

        if( !$this->verificarEdicaoSuperAdmin($idUsuario) ){
            throw new Exception($this->_erroNaoPodeEditar());
        }

        $usuario = $this->RepositoryUsuario->find($idUsuario);

        if( !$usuario ){
            throw new Exception($this->_erroNaoEncontrado());
        }

        $this->load->library('SaveImage');

        // exclui a imagem 1
        $this->saveimage->excluir_arquivo( $usuario->foto, './arquivo/usuario');
        $this->saveimage->excluir_arquivo( 'mini_' . $usuario->foto, './arquivo/usuario');
        $this->saveimage->excluir_arquivo( 'media_' . $usuario->foto, './arquivo/usuario');
        $this->saveimage->excluir_arquivo( 'grande_' . $usuario->foto, './arquivo/usuario');

        $this->RepositoryUsuario->excluir( $idUsuario);

        return json_encode([
            'message'   => 'Ecluido com sucesso',
            'data'      => [
                'id' => $idUsuario
            ]
        ]);

    }


    // verifica se o usuário a ser alterado é o desenvolvedor
    // e se o usuário que está editando pode fazer isto( somente o desenvolvedor )
    public function verificarEdicaoSuperAdmin($idUsuario){

        if( $idUsuario == 1 && ( $this->acesso->get_id_usuario() != 1 )){
            return false;
        }

        return true;

    }

    private function _erroValidacao(){
        return json_encode([
            'message'   => validation_array(),
            'error'     => true,
            'code'      => 422
        ]);
    }

    private function _erroNaoEncontrado(){
        return json_encode([
            'message'   => 'Não encontrado',
            'error'     => true,
            'code'      => 422
        ]);
    }

    private function _erroNaoPodeEditar(){
        return json_encode([
                'message'   => 'Este usuário não pode ser editado',
                'error'     => true,
                'code'      => 422
        ]);
    }



}
