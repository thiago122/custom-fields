<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imagem {


	var $ci;


	
	
	public function __construct()
	{
		$this->ci =& get_instance();
	}


	/**
	 * realiza o upload de mútiplos arquivos
	 * renomeando-os como url amigável 
	 *
	 * @access	public
	 * @param	array( nome do campo file no formato de vetor arquivo[] )
	 */


	public function multi_upload($campo, $config = NULL)
	{

		$this->ci->load->library('upload');
	 
		$number_of_files_uploaded = count($_FILES[$campo]['name']);

	 	
		// Faking upload calls to $_FILE
		for ($i = 0; $i < $number_of_files_uploaded; $i++) :
				$_FILES['userfile']['name']     = $_FILES[$campo]['name'][$i];
				$_FILES['userfile']['type']     = $_FILES[$campo]['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES[$campo]['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES[$campo]['error'][$i];
				$_FILES['userfile']['size']     = $_FILES[$campo]['size'][$i];
				  

				if(!$config)
				{
					$config = array(
					  'allowed_types'	=> 'jpg|jpeg|png|gif|png',
					  'max_size'		=> 10000,
					  'overwrite'		=> FALSE,
					  'upload_path'		=> './',
					);
				}
				
				$config['file_name'] = md5(uniqid(rand(), true));
				$config['overwrite'] = false;


				$this->ci->upload->initialize($config);
				
				if ( ! $this->ci->upload->do_upload()) :
				 $error[] = array('error' => $this->ci->upload->display_errors());
				
				  //$this->load->view('upload_form', $error);
				else :
				  $final_files_data[] = $this->ci->upload->data();
				  // Continue processing the uploaded data
				endif;
				
		endfor; 
		
		if(isset($final_files_data))
		{
			return $final_files_data;
		}
		else
		{
			return false;
		}
		$this->ci->upload->display_errors();
	}




	/**
	 * cria miniaturas das imagens baseado na classe snapshot
	 * utilizado por que o corte das imagens é mais preciso
	 * utilizar no momento do upload
	 *
	 * SE O PREFIXO NÃO FOR DETERMINADO ELE SUBSTITUI A IMAGEM ORIGINAL
	 *
	 * @access	public
	 * @param	array( dados do upload do arquivo )
	 * @param	int 
	 * @param	int
	 * @param	string
	 */


	public function thumb( $data_file , $width, $height, $prefix = NULL){
				//print_r($data_file);
				// exit()
					$this->ci->load->library('upload');
		
				   	$caminho 			= $data_file['file_path'];
				    $caminho_completo 	= $data_file['full_path'];
					$novo_nome 			= $prefix.$data_file['raw_name'];
				    $extencao 			= $data_file['file_ext'];
					
				$nome_miniatura = $caminho.$novo_nome.$extencao;
				
				$this->ci->load->library('snapshot');
				$this->ci->snapshot->ImageFile = $caminho_completo;
				$this->ci->snapshot->Width = $width;
				$this->ci->snapshot->Height =  $height;
				$this->ci->snapshot->Resize = true; 
				$this->ci->snapshot->ResizeScale = 100;
				$this->ci->snapshot->Position = 'topcenter';
				$this->ci->snapshot->Compression = 80;
				$this->ci->snapshot->SaveImageAs($nome_miniatura);
				
				return $novo_nome.$extencao;
	}

}// fim