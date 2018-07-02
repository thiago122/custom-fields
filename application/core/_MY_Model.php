<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public $table = '';
    public $id = '';
    public $has_one = [];
    public $has_many = [];
    public $belongs_to = [];

    public $order_col_fields = [];
    public $order_by_parm = 'order_by';
    public $order_col_param = 'order';

    private $redirectOnNotFound = '';
    private $flashMessageOnNotFound = '';


    public function __construct()
    {
        parent::__construct();
    }

    public function getMany($relationName, $id){

        $relationsData = $this->RepositoryUsuario->has_many[$relationName];

        if( empty($relationsData) ){
            return [];
        }

        $model = $relationsData[0];
        $pivot = $relationsData[1];
        $pivotLeftFk = $relationsData[3];
        $fk = $relationsData[2];

        $modelName = explode('/', $model);
        $modelName = end($modelName);
        $this->load->model($model);

        $tableLeft = $this->{$modelName}->table;
        $idLeft = $this->{$modelName}->id;

        $this->db->where($pivot .'.'.$fk , $id );
        $this->db->join($pivot, $pivot .'.'.$pivotLeftFk . ' = ' .   $tableLeft .'.'. $idLeft);
        return $this->db->get( $tableLeft )->result();

    }

    public function attach($relationName, $idLocalValue, $pivotLeftFkValue, $deleteNotFounded = true){

        if( !is_array($pivotLeftFkValue) ){
            $temp = $pivotLeftFkValue;
            $pivotLeftFkValue = [];
            $pivotLeftFkValue[] = $temp;
        }

        $relationsData = $this->RepositoryUsuario->has_many[$relationName];

        if( empty($relationsData) ){
            return false;
        }

        $model = $relationsData[0];
        $pivot = $relationsData[1];
        $pivotLeftFk = $relationsData[3];
        $fk = $relationsData[2];

        $updated  = [];
        $inserted = [];
        $existing = [];

        $result = $this->db->where($fk, $idLocalValue)->get($pivot)->result();

        foreach( $result as $r ){
            // print_r($r);
            $existing[] = $r->{$pivotLeftFk};
        }

        foreach($pivotLeftFkValue as $key => $val){

            // se o valor for um array
            if( is_array( $val )){

                if( ! in_array($key, $existing) )
                {
                    $insert = [
                        $pivotLeftFk => $key,
                        $fk          => $idLocalValue
                    ];

                    foreach($val as $field => $value){
                        $insert[$field] = $value;
                    }

                    $this->db->insert($pivot, $insert );
                    $inserted[] = $key;
                }
                else
                {

                    $insert = [
                        $pivotLeftFk => $key,
                        $fk          => $idLocalValue
                    ];

                    foreach($val as $field => $value){
                        $insert[$field] = $value;
                    }

                    $this->db->where($pivotLeftFk, $key);
                    $this->db->where($fk, $idLocalValue);
                    $this->db->update($pivot, $insert );
                    $updated[] = $key;

                }

            }
            else
            {

                if( ! in_array($val, $existing) )
                {
                    $insert = [
                        $pivotLeftFk => $val,
                        $fk          => $idLocalValue
                    ];

                    $this->db->insert($pivot, $insert );
                    $inserted[] = $val;
                }else{
                    $updated[] = $val;
                }

            }

        }

        $toDelete = array_diff( $existing, array_merge($updated, $inserted) ) ;

        if( ! empty($toDelete) && $deleteNotFounded ){
            $this->db->where($fk, $idLocalValue)
                     ->where_in($pivotLeftFk, $toDelete)
                     ->delete($pivot);
        }

        // echo "existe ";
        // print_r($existing);

        // echo "update ";
        // print_r($updated);

        // echo "inserido ";
        // print_r($inserted);

        // echo "excluir ";
        // print_r($toDelete);


    }


    public function orderCol(){

        $orderPossibilities  = ['asc','desc'];

        $order_by = $this->input->get($this->order_by_parm, true);

        $order = $this->input->get($this->order_col_param, true);

        if( in_array( $order_by, $this->order_col_fields) && in_array($order, $orderPossibilities) ){
            $this->db->order_by( $order_by,$order );
        }

        return $this;

    }

    public function all()
    {
        return $this->db->get($this->table)->result();
    }

    public function find($id = null)
    {
        $result = $this->db->where($this->table.'.'.$this->id,  $id)
                           ->get( $this->table )->row();

        if( $result ){
            return $result;
        }

        if( $this->flashMessageOnNotFound ){
            $this->session->set_flashdata('msg', [[ 'type' => 'warning', 'message' => $this->flashMessageOnNotFound]]);
        }

        if( $this->redirectOnNotFound ){
            redirect($this->redirectOnNotFound);
        }

    }

    public function redirectNotFound($redirect)
    {
        $this->redirectOnNotFound = $redirect;
        return $this;
    }

    public function messageNotFound($message)
    {
        $this->flashMessageOnNotFound = $message;
        return $this;
    }

    public function where($clausula, $valor)
    {
        $this->db->where($clausula, $valor);
        return $this;
    }

    public function like($clausula, $valor)
    {
        $this->db->like($clausula, $valor);
        return $this;
    }

    public function order($field, $valor)
    {
        $this->db->order_by($field, $valor);
        return $this;
    }

    public function fields($fields)
    {
        $this->db->select($fields);
        return $this;
    }

    public function count($table = null)
    {
        if($table){
            return $this->db->count_all_results( $table );
            return false;
        }
        return $this->db->count_all_results( $this->table );
    }

    public function limit( $limit = null, $offset = null )
    {
        if($limit){
            $this->db->limit($limit, $offset);
        }
        return $this;
    }

    public function join($relationName, $direction = NULL){
        $relation = $this->belongs_to[$relationName];

        $relationTable  = $relation[0];
        $relationKey    = $relation[1];
        $localKey       = $relation[2];

        if( $direction ){
            $this->db->join($relationTable, $relationTable . '.' . $relationKey .' = '. $this->table . '.' . $localKey, $direction);
            return $this;
        }

        $this->db->join($relationTable, $relationTable . '.' . $relationKey .' = '. $this->table . '.' . $localKey);


        return $this;

    }

     public function joinMany($relations){

        $relations = explode('|', $relations);

        foreach ($relations as $relation) {
            $this->join($relation);
        }

        return $this;
    }

    /**
     * Grava os dados na tabela.
     * @param $dados. Array que contém os campos a serem inseridos
     * @param Se for passado o $id via parâmetro, então atualizo o registro em vez de inseri-lo.
     * @return boolean
     * Modificado:: http://www.dicascodeigniter.com.br/mini-crud-com-codeigniter-3-e-bootstrap/
     */
    public function store($dados = null, $id = null)
    {
        if ($dados) {
            if ($id) {
                $this->db->where($this->id, $id);
                if ($this->db->update($this->table, $dados)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if ($this->db->insert($this->table, $dados)) {
                    return $this->db->insert_id();
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * Description
     * @param type $table
     * @param type $find_field
     * @param type $find_value
     * @param type $insert_field
     * @param type $array_values
     * @return type
     */
     // storeManyToMany('curso_usuario', 'fk_usuario',  'fk_curso', 29, get('curso') );
    public function storeManyToMany( $fkTable, $fkKey, $localKey, $localKeyValue,  $array_values ){


        // $collection = array('111', '112', '113', '114');
        // foreach ( $inputs as $input )
        // {
        //     if ( ! in_array($input, $collection) ){
        //     //do insert here
        //     }
        // }


        $this->db->delete( $fkTable,  array( $fkKey  => $localKeyValue));
        if( $array_values ){

            $insert = array();
            foreach ($array_values as $array_val){
                if(!empty($array_val)){
                    $insert[] = array(  $fkKey => $localKeyValue, $localKey => $array_val);
                }
            }
            $this->db->insert_batch(  $fkTable, $insert);
        }
    }

    /**
     * Description
     * @param type $table
     * @param type $find_field
     * @param type $find_value
     * @param type $insert_field
     * @param type $array_values
     * @return type
     */
     // save_many_to_many('curso_usuario', 'fk_usuario', 29, 'fk_curso', get('curso') );
    public function save_many_to_many( $table, $find_field, $find_value, $insert_field, $array_values ){

        $this->db->delete( $table,  array( $find_field  => $find_value));
        if( $array_values ){

            $insert = array();
            foreach ($array_values as $array_val){
                if(!empty($array_val)){
                    $insert[] = array(  $find_field => $find_value, $insert_field => $array_val);
                }
            }
            $this->db->insert_batch( $table, $insert);
        }
    }

    /**
     * Exclui da tabela tendo como base o id
     * @param id do registro
     * Crédito:: http://www.dicascodeigniter.com.br/mini-crud-com-codeigniter-3-e-bootstrap/
     */
    public function delete( $id = NULL )
    {
        if($id){
            $this->db->where($this->id, $id);
            $this->db->delete( $this->table );
            if($this->db->affected_rows() > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    /* -------------------------------------------- */
    /* DEPRECIADO */
    /* -------------------------------------------- */
    public function one($id = null)
    {
        if( !$id ){
            return false;
        }

        $this->db->where($this->id, $id);
        $a = $this->db->get( $this->table )->row();
        return $a;

    }

    public function get($id = null)
    {
        if( $id ){
            $this->db->where($this->id, $id);
            $a = $this->db->get( $this->table )->result();
            return $a;
        }

        $a = $this->db->get( $this->table )->result();
        return $a;

    }

    public function getFrom($table, $id = null)
    {
        return $this->db->get( $table )->result();
    }




}// end class
