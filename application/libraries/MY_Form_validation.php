<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {

        protected $CI;

    function __construct($rules = array())
    {
        parent::__construct($rules);
                // reference to the CodeIgniter super object
                $this->CI =& get_instance();
    }

    public function is_unique_update($str, $field){

      if (substr_count($field, '.') == 3){

        $vals = explode('.', $field);
        $table = $vals[0];
        $field_search = $vals[1];
        $field_id = $vals[2];
        $id_val = $vals[3];

        $this->CI->form_validation->set_message('is_unique_update', 'Existe outro %s com este valor.');

        $query = $this->CI->db->limit(1)
                      ->where($field_search,$str)
                      ->where_not_in($field_id, $id_val)
                      ->get($table);
        return $query->num_rows() === 0;
      }
      return false;
    }


   /**
     *
     * valid_cpf
     *
     * Verifica CPF é válido
     * @access  public
     * @param string
     * @return  bool
     */
    function valid_cpf($cpf)
    {
        $CI =& get_instance();

        $CI->form_validation->set_message('valid_cpf', 'O %s informado não é válido.');

        $cpf = preg_replace('/[^0-9]/','',$cpf);

        if(strlen($cpf) != 11 || preg_match('/^([0-9])\1+$/', $cpf))
        {
            return false;
        }

        // 9 primeiros digitos do cpf
        $digit = substr($cpf, 0, 9);

        // calculo dos 2 digitos verificadores
        for($j=10; $j <= 11; $j++)
        {
            $sum = 0;
            for($i=0; $i< $j-1; $i++)
            {
                $sum += ($j-$i) * ((int) $digit[$i]);
            }

            $summod11 = $sum % 11;
            $digit[$j-1] = $summod11 < 2 ? 0 : 11 - $summod11;
        }

        return $digit[9] == ((int)$cpf[9]) && $digit[10] == ((int)$cpf[10]);
    }

    /**
     *
     * valid_CNPJ
     *
     * Verifica CNPJ é válido
     * @access  public
     * @param string
     * @return  bool
     */
    function valid_cnpj($cnpj)
    {
        $CI =& get_instance();

        $CI->form_validation->set_message('valid_cnpj', 'O %s informado não é válido.');

        $cnpj = str_pad(str_replace(array('.','-','/'),'',$cnpj),14,'0',STR_PAD_LEFT);
        if (strlen($cnpj) != 14){
          return false;
        }else{
          for($t = 12; $t < 14; $t++){
            for($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++){
              $d += $cnpj{$c} * $p;
              $p  = ($p < 3) ? 9 : --$p;
            }
            $d = ((10 * $d) % 11) % 10;
            if($cnpj{$c} != $d){
              return false;
            }
          }
          return true;
        }
    }

    function valid_cep($cep){

        $CI =& get_instance();
        $CI->form_validation->set_message('valid_cep', 'O CEP do campo {field} está incorreto.');

        if(!preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $cep)) {
            return false;
        }
        return true;
    }

    // valida no formato 00/00/000
    function valid_date( $data ){

        $CI =& get_instance();
        $CI->form_validation->set_message('valid_date', 'A data do campo {field} está incorreta.');
        if(!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data)) {
            return false;
        }
        return true;
    }

    function is_today_or_greater($data){

        $parts = explode('/', $data);

        $CI =& get_instance();
        $CI->form_validation->set_message('is_today_or_greater', 'A data do campo {field} deve ser maior ou igual ao data atual.');

        $hoje = date("Y-m-d");

        $hoje = strtotime($hoje);
        $data = strtotime($parts[2] . '-' . $parts[1] . '-' . $parts[0]);

        if ($data >= $hoje) {
             return true;
        }
        return false;
    }


    function valid_tel( $tel ){

        $CI =& get_instance();
        $CI->form_validation->set_message('valid_tel', 'A telefone do campo {field} está incorreto.');

        $exp_regular = '/^\([0-9]{2}\) [0-9]{4}-[0-9]{4,5}$/';
        if(!preg_match($exp_regular, $tel)) {
            return false;
        }
        return true;
    }

    public function remove_rules($dataToRemove = []){

        if( empty($this->_field_data) || empty($dataToRemove) ){
          return $this;
        }

        foreach ($this->_field_data as $field => $rules) {
            if(in_array($field, $dataToRemove)){
                unset($this->_field_data[$field]);
            }
        }

        return $this;
    }

}
