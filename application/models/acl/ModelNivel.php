<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelNivel extends MY_model {

	public function __construct()
	{
		parent::__construct();
		$this->table 	  = 'nivel';
		$this->primaryKey = 'id_nivel';

        $this->belongs_to_many['recursos'] = ['ModelRecurso', 'recurso_nivel', 'fk_nivel', 'fk_recurso'];

	}

	public function destroy( $id ){
		$this->db->where('fk_nivel', $id);
		$this->db->delete( 'recurso_nivel' );

		$this->db->where($this->primaryKey, $id);
		$this->db->delete( $this->table );
	}

	// --------------------------------------------------------------------
	//
	// --------------------------------------------------------------------

    public function recursosNivel($idNivel){
    	return $this->db->where('fk_nivel', $idNivel)
    					->get('recurso_nivel')->result();
    }

    public function saveRecursosNivel($idNivel){
        $this->attach('recursos', $idNivel, $this->input->post('recurso'));
    }

}// end class
