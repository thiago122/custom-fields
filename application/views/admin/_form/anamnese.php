<?php

    function _select( $dados, $atributos = [], $default = [] ){

        $dados      = json_decode(json_encode( $dados ));
        $atributos  = json_decode(json_encode( $atributos ));
        $default    = json_decode(json_encode( $default ));

        if( count($default) > 0 ){

            $optionValues = array_column_($dados->options, 'value');

            if( ! in_array($default->value, $optionValues) ){

                $dados->options[] = $default;

            }

        }

        $html = '<select name="'. $dados->name .'" ' ._attr($atributos). '>';

        foreach ($dados->options as $options) {

            $selected = ($options->value == $default->value ) ? ' selected ' : '' ;

            $html .= '<option value="'. $options->value .'" '.  $selected  .'>' . $options->label . '</option>';

        }

        $html .= '</select>';

        return $html;
    }


    function inputValue($key, $dados){

        $dados = json_decode(json_encode( $dados ));

        if( !isset($dados->{$key}) ){
            return false;
        }

        return $dados->{$key};
    }



// https://stackoverflow.com/questions/125268/chaining-static-methods-in-php

class Builder
{
    public static $currentValue;
    public static $attrs = [];
    public static $attrs_comp = '';

    public function reset(){
        self::$currentValue = null;
        self::$attrs = [];
        self::$attrs_comp = '';
    }

    public function teste(){
        return $this;
    }




    function attr($atributos = []){

        $html = '';
        foreach ($atributos as $key => $value) {

            $html .= ' ' . $key .'="'. $value .'" ';
        }

        self::$attrs_comp = $html;

        return $this;
    }

    function select( $dados, $atributos = [], $default = [] ){

        $dados      = json_decode(json_encode( $dados ));
        $default    = json_decode(json_encode( $default ));

        if( count($default) > 0 ){

            $optionValues = array_column_($dados->options, 'value');

            if( ! in_array($default->value, $optionValues) ){

                $dados->options[] = $default;

            }

        }

        $html = '<select name="'. $dados->name .'" ' .self::$attrs_comp. '>';

        foreach ($dados->options as $options) {

            $selected = '';

            if( isset( $default->value ) ){
                $selected = ($options->value == $default->value ) ? ' selected ' : '' ;
            }

            $html .= '<option value="'. $options->value .'" '.  $selected  .'>' . $options->label . '</option>';

        }

        $html .= '</select>';

        return $html;
    }


}

class TestClass extends Builder
{
    // public static $currentValue;

    private static $_instance = null;

    public static function getInstance ()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function add($value) {
        self::$currentValue = self::$currentValue + $value;
        return $this;
    }

    public function result() {
        $val = self::$currentValue;
        self::reset();
        return $val;
    }



}

echo TestClass::getInstance()->result();

echo '<br>';

echo TestClass::getInstance()->select($select);







die()

?>

<?php $this->load->view('admin/partes/header.php'); ?>

<div class="content-wrapper">
    <section class="content">


    <form action="<?php echo base_url('admin/Form/save') ?>" method="POST">

        <div class="form-group">
            <label><?php echo inputValue('label', $select) ?></label>
            <?php echo _select( $select, ['class' => 'form-control'], $salvo ) ?>
        </div>


        <input class="btn" type="submit">



    </form>

















    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this->load->view('admin/partes/footer') ?>
