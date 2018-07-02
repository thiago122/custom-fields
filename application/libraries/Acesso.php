<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Sistema de regras de acesso aos controllers/action do codeigniter
 * @author Thiago Sobrinho
 */

class Acesso
{

	private $ci;
	private $nivel_usuario;
	private $niveis;
	private $permissoes;

	function __construct(){

		$this->ci = & get_instance();
		$this->ci->load->library(array('session'));
		//$this->ci->load->config('acesso', TRUE);

	}

/*
|--------------------------------------------------------------------------
| Autenticação e persistência
|--------------------------------------------------------------------------
| array(
|		'id_usuario'=>'007',
|		'nm_usuario'=>'James Bond',
|		'email'=>'bond@superbond.com.br',
|		'nivel'=>'admin')
|--------------------------------------------------------------------------
*/

	/**
	 * Verifica se o usuário está logado
	 * @return bool
	 */
	public function is_logado(){

		if(!$this->get_id_usuario()){
			return false;
		}
		return true;
	}

	/**
	 * Verifica se o usuário está logado
	 * caso não esteja logado redireciona para o login com uma mensagem de erro
	 * @return void
	 */

	public function nao_logado(){
		if( ! $this->is_logado() ){
			$this->mensagem[] = array("type"=> 'danger',"message"=> 'É necessário estar logado para acessar!');
			$this->ci->session->set_flashdata('msg',$this->mensagem);
			redirect('login');
		}
	}


	/**
	 * Verifica se o usuário está logado
	 * verifica se o usuário é admin
	 * @return void
	 */
	public function nao_logado_super_admin(){

		$this->nao_logado();

		if( ! $this->is_super_admin() ){
			$this->mensagem[] = array("type"=> 'danger',"message"=> 'Você não tem acesso a esta área!');
			$this->ci->session->set_flashdata('msg',$this->mensagem);
			redirect('admin');
		}

	}


	/**
	 * Seta os dados do usuário na sessão
	 * @param array $dados
	 * @return void
	 */
	public function set_dados_usuario( $dados ){

		$dados_usuario = array(
                   'id_usuario'		=> $dados['id_usuario'],
                   'nm_usuario'		=> $dados['nm_usuario'],
                   'email'			=> $dados['email'],
                   'status'			=> $dados['status'],
                   'nivel'			=> $dados['nivel']
        );

		$this->ci->session->set_userdata($dados_usuario);
	}

    public function set_recursos_usuario($recursos){
        $this->ci->session->set_userdata('recursos',$recursos);
    }

    public function set_avatar_usuario(){
        $this->ci->load->database();
        $id_usuario = $this->get_id_usuario();
        $this->ci->db->where('id_usuario', $id_usuario);
        $usuario = $this->ci->db->get('usuario')->row();

        if( !empty($usuario->foto)){
            $avatar = base_url() . 'arquivo/usuario/grande_' . $usuario->foto;
        }else{
            $avatar = base_url() . 'admin_assets/img/perfil-default.png';
        }

        $this->ci->session->set_userdata('avatar', $avatar);
    }


/*
|--------------------------------------------------------------------------
| Obtenção de dados do usuário
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

	public function get_id_usuario(){
		return $this->ci->session->userdata('id_usuario');
	}

	public function get_nm_usuario(){
		return $this->ci->session->userdata('nm_usuario');
	}

	public function get_nivel_usuario(){
		return $this->ci->session->userdata('nivel');
	}

	public function is_super_admin(){

		$tipo_usuario = $this->ci->session->userdata('nivel');

		if( $tipo_usuario == 1){
			return true;
		}

		return false;
	}

    public function get_recursos_usuario(){
        return $this->ci->session->userdata('recursos');
    }

	public function get_avatar_usuario(){
		return $this->ci->session->userdata('avatar');
	}


	private function error_page(){
		echo "<h1>Acesso negado! </h1>";
		die();
	}


	/*
	|--------------------------------------------------------------------------
	| PERMISSÔES DE USUÁRIO
	|--------------------------------------------------------------------------
	|--------------------------------------------------------------------------
	*/

	public function verificar($pathRecurso){

		if(!$this->podeAcessar($pathRecurso)){

            if( $this->ci->input->is_ajax_request() ){
                $this->ci->output->set_status_header(401);
                $this->ci->output->set_content_type('application/json');
                $this->ci->output->set_header("Access-Control-Allow-Origin: *");
                $this->ci->output->set_output(json_encode([
                    'message' => 'Sem permissão para acessar!'
                ]));
                $this->ci->output->_display();

                die();
            }

			$this->error_page();
		}
	}

	public function verificarRecursoDoNivel($nivel, $action){

		$this->ci->db->select('recurso.id_recurso, recurso.action');
		$this->ci->db->join('recurso_nivel','recurso_nivel.fk_nivel = nivel.id_nivel');
		$this->ci->db->join('recurso','recurso_nivel.fk_recurso = recurso.id_recurso');
		$this->ci->db->where('nivel.id_nivel',$nivel);
		$this->ci->db->where('recurso.action',$action);
		$action = $this->ci->db->get('nivel')->row();

		if( !empty($action) ){
			return $action;
		}

		return false;
	}

	public function verificarRecurso($action){

		$this->ci->db->select('recurso.id_recurso, recurso.action');
		$this->ci->db->where('recurso.action',$action);
		$action = $this->ci->db->get('recurso')->row();

		if( !empty($action) ){
			return $action;
		}

		return false;
	}

	public function verificarPermissaoExtra($idRecurso){

		$idUsuario 	= $this->get_id_usuario();

		$this->ci->db->where('fk_usuario', $idUsuario);
		$this->ci->db->where('fk_recurso', $idRecurso);
		$recursoExtra = $this->ci->db->get('recursos_extras')->row();

		if(!$recursoExtra){
			return false;
		}else{
			if($recursoExtra->situacao == 1){
				return 1;
			}else{
				return 0;
			}
		}
	}

	public function verificarPermissaoRevogada($idRecurso){
		$permissaoExtra = $this->verificarPermissaoExtra($idRecurso);

		if( $permissaoExtra === 0 ){
			return true;
		}else{
			return false;
		}
	}

	public function verificarPermissaoConcedida($idRecurso){
		$permissaoExtra = $this->verificarPermissaoExtra($idRecurso);
		if( $permissaoExtra === 1 ){
			return true;
		}else{
			return false;
		}
	}

	public function autoVerificacao(){

		$dir 	= $this->ci->router->directory;
    	$class 	= $this->ci->router->class;
    	$method = $this->ci->router->method;

		$idNivelUsuario = $this->get_nivel_usuario();

    	$pathRecurso = $dir.$class.'/'.$method;

    	$resultadoVerificacao = $this->verificarRecursoDoNivel($idNivelUsuario, $pathRecurso);

    	if( $resultadoVerificacao){

			$idRecurso = $resultadoVerificacao->id_recurso;

    		if( $this->verificarPermissaoRevogada($idRecurso) ){
    			//echo "permissão revogada";
    			$this->error_page();
    		}

    	}else{
    		$recurso = $this->verificarRecurso($pathRecurso);
    		if(!$recurso){
    			$this->error_page();
    		}
    		$idRecurso = $recurso->id_recurso;

    		if( !$this->verificarPermissaoConcedida($idRecurso) ){
    			//echo "não tem permissao";
    			$this->error_page();
    		}
    	}

    	return $resultadoVerificacao;
	}

    public function podeAcessar($pathRecurso, $findOnDb = NULL){

        $pathRecurso = strtolower ( $pathRecurso );

        if( $findOnDb ){
            return $this->podeAcessarDB($pathRecurso);
        }

        return $this->podeAcessarSession($pathRecurso);

    }

    public function podeAcessarSession($pathRecurso){
        if( in_array($pathRecurso, $this->get_recursos_usuario()) ){
            return true;
        }
        return false;
    }

	public function podeAcessarDB($pathRecurso){

		$idNivelUsuario = $this->get_nivel_usuario();

    	$resultadoVerificacao = $this->verificarRecursoDoNivel($idNivelUsuario, $pathRecurso);

    	if( $resultadoVerificacao){

			$idRecurso = $resultadoVerificacao->id_recurso;

    		if( $this->verificarPermissaoRevogada($idRecurso) ){
    			return false;
    		}

    	}else{
    		$recurso = $this->verificarRecurso($pathRecurso);

    		if(!$recurso){
    			return false;
    		}
    		$idRecurso = $recurso->id_recurso;

    		if( !$this->verificarPermissaoConcedida($idRecurso) ){
    			//echo "não tem permissao";
    			return false;
    		}
    	}

    	return $resultadoVerificacao;
	}

}

/* End of file Acesso.php */
/* Location: ./application/libraries/Acesso.php */
