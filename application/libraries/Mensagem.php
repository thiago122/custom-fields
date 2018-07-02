<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mensagem {


	/**
	 * Codeingiter Library Mensagem
	 *
	 * @author		Thiago Sobrinho
 	 * @version 	0.1
 	 *
 	 * Esta lib tem o intuito de facilitar o trabalho com mensagens do sistema
 	 * para serem exibidas para o usuário na view
 	 *
 	 * Esta lib adiciona as mensagens em um array e este array é adicionado
 	 * no session->flash_data(); do Codeigniter.
 	 * posteriormente
 	 *
 	 * No controller
 	 * $this->mensagem->adiciona('class_css','Texto da mensagem','controller/action');
 	 *
 	 * Na view
 	 * $this->mensagem->exibir('tag');
 	 *
	 */

	/*

	CSS para 'class_css = danger'

	.alert{ clear:both;padding: 5px 20px;margin-bottom:10px;font-size:13px; }
	.alert.alert-danger{ background-color: #FFCDD2; }

	*/


	private $mensagem 	= array();		// ARMAZENA AS MENSAGENS
	var $ci;


	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('session');
	}


	/**
	 * adiciona mensagens a o vetor mensagem
	 * @param string $type           			tipo de mensagem que será usado para a css class
	 * @param string $message          			mensagem para se armazenada no vetor
	 * @param string $redireciona [opcional]    controller/action para redirecionamento
	*/

	public function adicionar($type = "menssagem", $message = "", $redireciona = false)
	{
		$this->mensagem[] = array("type"=> $type,"message"=> $message);

		if($redireciona){

			$this->ci->session->set_flashdata('msg',$this->mensagem);
			redirect($redireciona);

		}else{
			$this->ci->session->set_flashdata('msg',$this->mensagem);
		}
	}

	/**
	 * exibe a as mensagens do sistema na view
	 *
	 * @param string (tag que será usada para exibir as mensagens na view)
	 * @return	string
	 */
	public function exibir( $tag = "div" )
	{

		$msgs = $this->ci->session->flashdata('msg');


		if($msgs)
		{

		foreach( $msgs as $msg)
			{
				echo "<".$tag." class=\"alert alert-".$msg['type']."\">".$msg['message']."</".$tag.">\n";
			}
		}

		$this->ci->session->unset_userdata('msg');

	}

	/**

	 * Exibe a mensagens de validação e do sistema
	 * @param string (tag que será usada para exibir as mensagens na view)
	 * @return	string
	 */
	public function exibirAgrupadas( $tag = "div" )
	{

		$msgs = $this->ci->session->flashdata('msg');

		$aux = [];
		$mensagensAgrupadas = [];

		$validationsMessages = validation_array();

		if($validationsMessages){
			foreach( $validationsMessages as $msg)
			{
				$aux[] = 'danger';
				$mensagensAgrupadas['danger'][] = $msg;
			}
		}

		if($msgs)
		{
			foreach( $msgs as $msg)
			{

				if(in_array($msg['type'], $aux)){

					if(!in_array($msg['message'], $mensagensAgrupadas[$msg['type']])){
						$mensagensAgrupadas[$msg['type']][] = $msg['message'];
					}

				}else{

					$aux[] = $msg['type'];

					if(!in_array($msg['message'], $mensagensAgrupadas[$msg['type']])){
						$mensagensAgrupadas[$msg['type']][] = $msg['message'];
					}

				}

			}

			foreach ($mensagensAgrupadas as $msgKey => $msgValues) {

				echo '<div class="alert alert-'.$msgKey.'">';
					echo '<ul>';
					foreach($msgValues as $message){
						echo '<li>'.$message.'</li>';
					}
					echo '</ul>';
				echo '</div>';

			}
		}

		$this->ci->session->unset_userdata('msg');

	}


	/**

	 * Exibe a mensagens de validação e do sistema
	 * @param string (tag que será usada para exibir as mensagens na view)
	 * @return	string
	 */
	public function exibirTodas()
	{

		$msgs = $this->ci->session->flashdata('msg');

		$aux = [];
		$mensagensAgrupadas = [];

		$validationsMessages = [];

		$OBJ = & _get_validation_object();

		$validations = $OBJ->error_array();

		if( !empty( $validations )){

			$aux[] = 'danger';
			foreach( $validations as $keyvalidation => $messagevalidation ){
				$mensagensAgrupadas['danger'][] = $messagevalidation;
			}

		}

		if( $msgs )
		{
			foreach( $msgs as $msg)
			{

				if(in_array($msg['type'], $aux)){

					// if(!in_array($msg['message'], $mensagensAgrupadas[$msg['type']])){
						$mensagensAgrupadas[$msg['type']][] = $msg['message'];
					// }

				}else{

					$aux[] = $msg['type'];
					$mensagensAgrupadas[$msg['type']][] = $msg['message'];

				}

			}

		}

		foreach ($mensagensAgrupadas as $msgKey => $msgValues) {

			echo '<div class="alert alert-'.$msgKey.'">';
				echo '<ul>';
				foreach($msgValues as $message){
					echo '<li>'.$message.'</li>';
				}
				echo '</ul>';
			echo '</div>';

		}

		$this->ci->session->unset_userdata('msg');

	}



	// fluent interface

	public function success($message = "")
	{
		$this->adicionar('success', $message );
		return $this;
	}

	// fluent interface
	public function danger($message = "")
	{
		$this->adicionar('danger', $message );
		return $this;
	}

	public function warning($message = "")
	{
		$this->adicionar('warning', $message );
		return $this;
	}

	// fluent interface
	public function redirect($to)

	{
		redirect($to);
		return $this;
	}

}







/* End of file Mensagem.php */
/* Location: ./application/libraries/Mensagem.php */
