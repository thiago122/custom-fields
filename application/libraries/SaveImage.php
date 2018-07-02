<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SaveImage {

	private $ci;

	public $imgField;
	public $imgFolder;
	public $cropSize = array();

	public $typeFilesUpload = '*';

	public function __construct(){
		$this->ci = & get_instance();
		$this->ci->load->database();
	}

	public function setCropSize($sizePrefix, $width, $height){
		$this->cropSize[] = array(
			'sizePrefix' => $sizePrefix,
			'width' 	 => $width,
			'height' 	 => $height,
			);
	}

	public function save(){

		if(!$this->sendImage()){
			return false;
		}

		$this->persistImage();
		$this->generateThumbSize();
		return true;
	}

	public function sendImage(){

		$config['upload']['upload_path'] = $this->imgFolder;
		$config['upload']['campo'] = $this->imgField;
		$config['max_size'] = '1000000';
		$config['max_width']  = '1024000';
		$config['max_height']  = '768000';
		$config['upload']['allowed_types'] = $this->typeFilesUpload;
	    $config['upload']['file_name'] = md5(uniqid(rand(), true));
		$config['upload']['overwrite'] = false;

		$this->ci->load->library('upload');
		$this->ci->upload->initialize($config['upload'] );

		if ( ! $this->ci->upload->do_upload($config['upload']['campo'])){
			$this->error = $this->ci->upload->display_errors();
			return false;
		}

		$this->uploadData = $this->ci->upload->data();
		return true;
	}

	public function persistImage(){

		// verifica se já existe no banco
		$db = explode('.',$this->dbString);

		$tabela 		= $db[0];
		$chave_primaria = $db[1];
		$campo_imagem 	= $db[2];
		$id 			= $db[3];

					 $this->ci->db->where($chave_primaria, $id);
		$resultado = $this->ci->db->get( $tabela )->row();

		if( $resultado ){

			$arquivo_existe = $this->arquivo_existe(  $resultado->$campo_imagem, $this->imgFolder);

			if($arquivo_existe){
				$this->excluir_arquivo(  $resultado->$campo_imagem, $this->imgFolder);

				// exclui as imagens com prefixo
				if(isset( $this->cropSize)){
					$prefixo = $this->cropSize;
					if(count($prefixo) > 0 ){
						foreach($prefixo as $prefixo){

							$this->excluir_arquivo(  $prefixo['sizePrefix'].$resultado->$campo_imagem, $this->imgFolder);

						}
					}
				}
			}
		}

		$this->ci->db->where($chave_primaria, $id);
		$this->ci->db->update( $tabela, array($campo_imagem => $this->uploadData['file_name'] ) );

	}

	public function generateThumbSize(){

		if(isset( $this->cropSize)){
			$cortes = $this->cropSize;
			if(count($cortes) > 0 ){
				foreach($cortes as $corte){
					$width   = $corte['width'];
					$height  = $corte['height'];
					$prefixo = $corte['sizePrefix'];

					$caminho 			= $this->uploadData['file_path'];
					$caminho_completo 	= $this->uploadData['full_path'];
					$novo_nome 			= $prefixo.$this->uploadData['raw_name'];
					$extencao 			= $this->uploadData['file_ext'];

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

					$nome_para_gravar_no_banco = $novo_nome.$extencao;
				}
			}
		}
	}

	/**
	 * Verifica se um arquivo existe e exclui se existir
	 * @access	public
	 * @param	string( nome do arquivo )
	 * @return	string( pasta do arquivo )
	 */
	public function excluir_arquivo( $arquivo, $pasta){
		$arquivo = trim($arquivo);
		if(!empty( $arquivo )){
			$filename = $pasta.'/'.$arquivo;
			if ( file_exists($filename )) {
				unlink( $filename );
			}
		}
	}

	/**
	 * Verifica se um arquivo existe
	 * @access	public
	 * @param	string( nome do arquivo )
	 * @return	string( pasta do arquivo )
	 */
	public function arquivo_existe( $arquivo, $pasta){
		$arquivo = trim($arquivo);
		if(!empty($arquivo)){
			$filename = $pasta.'/'.$arquivo;
			if (file_exists( $filename)) {
				return true;
			}
		}
	}

} // fim crud
