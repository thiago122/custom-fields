<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	
/**
 * Codeigniter Library Breadcrumb
 *
 * Esta classe tem o objetivo auxiliar no desenvolvimento de sistemas web
 * concentrando aqui a funções mais usadas em um sistema
 *
 * @author	Thiago Sobrinho
 * @version  0.1
 */

class Breadcrumbs {

	public $breadcrumbs = array();	// ARMAZENA OS BREADCRUMBS
	private $ci;
	
	public function __construct()
	{
		$this->ci =& get_instance();
	}

	/**
	 * adiciona itens no vetor de breadcrumbs para ser usado
	 * na interface
	 * deve ser usado em conjunto com o helper breadcrumbs
	 *
	 * @param string (url)
	 * @param string (texto que vai ser usado o link da url)
	*/

	public function add( $href, $name )
	{

		$this->breadcrumbs[] = array($href,$name);
		return $this;
	}

	/**
	 * exibe o breadcrumb na view
	 *
	 * @param string ( tag que será usada para exibir os itens do breadcrumb )
	 * @param string ( separador do breacrumb )
	 * @return	string
	 */
	function exibe( $tag = 'li', $separador = null ){

		$bread = $this->breadcrumbs ;
		$html  = '';

		$total = count( $bread );
		$i = 1;	

		foreach( $bread as $breadcrumb ):

			if($total != $i)
			{
				$html .= '<'.$tag.'><a href="'.base_url().$breadcrumb[0].'">'.$breadcrumb[1].'</a><span class="divider">'.$separador.'</span></'.$tag.'>';
			}
			else
			{
				$html .= '<'.$tag.' class="ative">'.$breadcrumb[1].'</'.$tag.'>';
			}
			$i++;
		endforeach;
		return $html;
	}

}