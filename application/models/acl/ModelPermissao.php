<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPermissao extends MY_model {

	public function __construct()
	{
		parent::__construct();
		$this->table 	  = 'permissao';
		$this->primaryKey = 'id_permissao';
	}

}// end class
