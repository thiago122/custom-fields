<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelRecurso extends MY_model {

	public function __construct()
	{
		parent::__construct();
		$this->table 		= 'recurso';
		$this->primaryKey 	= 'id_recurso';
	}

    public function all(){
        return $this->db->get($this->table)->result();
    }

    public function find($id = null){
                $this->db->where($this->table.'.'.$this->primaryKey,  $id);
        return  $this->db->get( $this->table )->row();
    }

	public function relations(){
		$this->db->join('permissao','permissao.id_permissao = recurso.fk_permissao');
		return $this;
	}

	public function filtros(){
		return false;
	}

	public function filtroNivel(){
		return false;
	}

	public function destroy( $id ){

		$this->db->where('fk_recurso', $id);
		$this->db->delete('recurso_nivel');

		$this->db->where('fk_recurso', $id);
		$this->db->delete('recursos_extras');

		$this->db->where($this->primaryKey, $id);
		$this->db->delete( $this->table );
	}

	// --------------------------------------------------------------------
	// LISTAR
	// --------------------------------------------------------------------

	public function verificarRecursoPertenceNivel($idRecurso, $idNivel){
		$this->db->where('fk_nivel', $idNivel);
		$this->db->where('fk_recurso', $idRecurso);
		return $this->db->get('recurso_nivel')->row();
	}

	public function getRecursosDoNivel($idNivel){
		$this->db->where('fk_nivel', $idNivel);
		return $this->db->get('recurso_nivel')->result();
	}

	public function getRecursoExtraDoUsuario($idUsuario, $idRecurso){
		$this->db->where('fk_usuario', $idUsuario);
		$this->db->where('fk_recurso', $idRecurso);
		return $this->db->get('recursos_extras')->row();
	}

	public function adicionarRevogacaoDoRecurso($idUsuario, $idRecurso){
		$insert = array(
				'fk_usuario' => $idUsuario,
				'fk_recurso' => $idRecurso,
				'situacao'	 => 0
			);
		$this->db->where('fk_usuario', $idUsuario);
		$this->db->insert('recursos_extras', $insert);
	}
	public function removerRevogacaoDoRecurso($idUsuario, $idRecurso){
		$this->db->where('fk_usuario', $idUsuario);
		$this->db->where('fk_recurso', $idRecurso);
		$this->db->delete('recursos_extras');
	}

	public function adicionarConcecaoDoRecurso($idUsuario, $idRecurso){
		$insert = array(
				'fk_usuario' => $idUsuario,
				'fk_recurso' => $idRecurso,
				'situacao'	 => 1
			);
		$this->db->where('fk_usuario', $idUsuario);
		$this->db->insert('recursos_extras', $insert);
	}

	public function removerConcecaoDoRecurso($idUsuario, $idRecurso){
		$this->db->where('fk_usuario', $idUsuario);
		$this->db->where('fk_recurso', $idRecurso);
		$this->db->delete('recursos_extras');
	}

}// end class
