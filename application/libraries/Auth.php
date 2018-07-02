<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	public $tabela;				// TABELA DO BANCO ONDE VAMOS REALIZAR O LOGIN
	public $campo_login;		// CAMPO DO BANCO ONDE FICA ARMAZENADO O LOGIN
	public $campo_id;			// CAMPO DO BANCO ONDE FICA ARMAZENADO O ID
	public $campo_senha;		// CAMPO DO BANCO ONDE FICA ARMAZENADO A SENHA
	public $campo_email;		// CAMPO DO BANCO ONDE FICA ARMAZENADO O EMAIL
	public $campo_nome;			// CAMPO DO BANCO ONDE FICA NOME DO USUARIO
	public $campo_hash;			// CAMPO DO BANCO ONDE FICA HASH DO USUARIO
	public $usuario;			// DADO VINDO DO FORMULÁRIO COM O  LOGIN
	public $senha;				// DADO VINDO DO FORMULÁRIO COM A SENHA
	public $erro;				// ARMZENA EM UM VETOR OS ERROS CASO EXISTAM
	public $nm_sessao;			// NOME DA SESSÃO QUE VAI ARMAZENAH OS DADOS
	public $dados_sessao;		// OS DADOS QUE VÃO SER COLOCADOS NA SESSÃO EM FORMA DE VETOR
	public $view_recuperar;		// A VIEW QUE VAI SER USADA COMO HTML DO EMAIL DE RECUPERAÇÃO DE SENHA
	public $email_envio;		// O ENDEREÇO DE EMAIL QUE VAI ENVIAR O EMAL.
	public $url_login;			// URL PARA ONDE O USUÁRIO VAI SER RECEBER NO EMAIL PARA FAZER O LOGIN COM A NOVA SENHA.

	public $ci; // objeto do codeigniter

	public function __construct()
	{

		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->ci->load->library('session');
	}

	// VERIFICA SE O USUÁRIO EXISTE
	function verifica_usuario()
 	{
		$this->ci->db->where($this->campo_login , $this->usuario);
		$this->ci->db->join('nivel', 'nivel.id_nivel = usuario.fk_nivel');
		$resultado = $this->ci->db->get( $this->tabela )->row();
		return $resultado;
 	}

	// VERIFICA SE O HASH EXISTE
	function verifica_hash($hash)
 	{
		$this->ci->db->where($this->tabela . '.' . $this->campo_hash , $hash);
		$resultado = $this->ci->db->get( $this->tabela )->row();
		return $resultado;
 	}

	// VERIFICA SE O USUÁRIO EXISTE
	function verifica_email()
 	{
		$this->ci->db->where($this->campo_email , $this->usuario);
		$this->ci->db->where('fk_status_usuario' , 1);
		$resultado = $this->ci->db->get( $this->tabela )->row();
		return $resultado;
 	}

	// EXECUTA A VERIFICAÇÃO
	public function logar(){

		$usuario = $this->verifica_usuario();
		count($usuario);

		//RERIFICA SE O USUÁRIO EXISTE
		if(count($usuario) == 1)
		{
			$campo_senha = $this->campo_senha;
			$senha_banco = $usuario-> $campo_senha;
			$senha_digitada = $this->senha;

			// VERIFICA SE A SENHA ENVIADA É IGUAL A SENHA QUE ESTÁ NO BANCO
			if($senha_banco == $senha_digitada)
			{
				return $usuario;
			}
			else
			{
				$this->erro =  "Senha errada.";
				return false;
			}
		}
		else
		{
			$this->erro = "Usuário não existe!";
			return false;

		}

	}

	public function sair()
	{

		$this->ci->load->library('session');
		$this->ci->session->unset_userdata('id_usuario');
		$this->ci->session->unset_userdata('nm_usuario');
		$this->ci->session->unset_userdata('email');
		$this->ci->session->unset_userdata('status');
		$this->ci->session->unset_userdata('nivel');

	}

	/**
	 * Envia um email para o usuário com um link para
	 * o formulário para recuperar a senha
	 * este link é baseado no hash do usuário no banco
	 * @param int id do usuario no banco
	 * @return boolean
	 */
	public function recuperar_senha($usuario)
	{
		$this->usuario = $usuario;
		$usuario = $this->verifica_email();

		if(count($usuario) == 1)
		{

			$my_email	= $this->campo_email;
			$my_hash	= $this->campo_hash;
			$my_nome	= $this->campo_nome;

			$data['email'] 	= $usuario-> $my_email;
			$data['hash'] 	= $usuario-> $my_hash;
			$data['nome'] 	= $usuario-> $my_nome;

			$htmlEmail = $this->ci->load->view($this->view_recuperar, $data, TRUE);

			$config['mailtype'] = 'html';
			$this->ci->load->library('email', $config);
			$this->ci->email->from( $this->email_envio );
			$this->ci->email->to( $data['email'] );
			$this->ci->email->subject("Recuperação de senha");
			$this->ci->email->message($htmlEmail);
			return $this->ci->email->send();
		}
		else
		{
			$this->erro = "Usuário não existe!";
			return false;
		}
	}


	// ATUALIZA A SENHA
	public function atualiza_senha($nova_senha,$id)
	{

		$data = array(
					$this->campo_senha => md5( $nova_senha ),
					$this->campo_hash => md5( $this->geraNum() )
					);


		$this->ci->db->where($this->campo_id,$id );
		$this->ci->db->update($this->tabela, $data);
	}

	/**
	* Função para gerar senhas aleatórias
	*
	* @author    Thiago Belem <contato@thiagobelem.net>
	*
	* @param integer $tamanho Tamanho da senha a ser gerada
	* @param boolean $maiusculas Se terá letras maiúsculas
	* @param boolean $numeros Se terá números
	* @param boolean $simbolos Se terá símbolos
	*
	* @return string A senha gerada
	*/
	function geraNum($tamanho = 8, $maiusculas = true, $numeros = true)
	{
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$retorno = '';
		$caracteres = '';

		$caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;

		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}

}// FIM DA CLASSE

