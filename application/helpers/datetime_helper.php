<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * converte um date time para um date
	 *
	 * @param string
	 * @return	string
	 */
	function dateTimeToDateBr( $date_time ){
		return date('d/m/Y', strtotime( $date_time ));
	}

    /**
     * converte um date time para um date
     *
     * @param string
     * @return  string
     */
    function dateTimeToDate( $date_time ){
        return date('Y-m-d', strtotime( $date_time ));
    }

	/**
	 * converte um date time para um time
	 *
	 * @param string
	 * @return	string
	 */
	function dateTimeToTime( $date_time){
		return date('H:i', strtotime( $date_time ));
	}

	/**
	 * converte um dateTime para um dateTime no formato do Brasil
	 *
	 * @param string
	 * @return	string
	 */
	function dateTimeToBrDateTime( $date_time){
		return date('d/m/Y H:i:s', strtotime( $date_time ));
	}

	/**
	 * converte um dateTime no formato do Brasil para um dateTime
	 *
	 * @param string
	 * @return	string
	 */
	function dateTimeBrToDateTime( $date_time ){

		$str_date = str_replace('/', '-', $date_time);

		return date( 'Y-m-d H:i:s',  strtotime( $str_date ));
	}

	/**
	 * converte uma data do formato brasileiro 00/00/0000
	 * para o formato mysql 0000-00-00 para salvar no banco
	 *
	 * @param string ( data no formato brasileiro )
	 * @return	string (data no formato americado)
	 */

    function brDateToDate( $data ){
		return implode("-",array_reverse(explode("/",$data)));
	}

	/**
	 * converte uma data do formato mysql 0000-00-00 para o formato brasileiro 00/00/0000
	 *
	 * @param string ( data no formato brasileiro )
	 * @return	string (data no formato americado)
	 */

	function dateToBrDate( $data ){
		return implode("/",array_reverse(explode("-",$data)));
	}

	function expiredBrDate( $data ){
        $parts = explode('/', $data);

        $hoje = date("Y-m-d");

        $hoje = strtotime($hoje);
        $dataStrtotime = strtotime($parts[2] . '-' . $parts[1] . '-' . $parts[0]);

        if ($dataStrtotime < $hoje) {
            echo '<span style="color: red">'. $data .'</span>';
        }else{
            echo '<span style="color: green">'. $data .'</span>';
        }

	}

	function meses( $idMes  ){
		$idMes--;
        $meses = array(
        	'Janeiro',
        	'Fevereiro',
        	'Março',
        	'Abril',
        	'Maio',
        	'Junho',
        	'julho',
        	'Agosto',
        	'Setembro',
        	'Outubro',
        	'Novembro',
        	'Dezembro'
        	);
        return $meses[$idMes];
	}

    function idade($date){
        $date       = new DateTime( $date ); // data de nascimento
        $interval   = $date->diff( new DateTime() ); // data definida
        return $interval->format( '%Y Anos, %m Meses e %d Dias' ); // 110 Anos, 2 Meses e 2 Dias
    }


	function stringDate( $date  ){

        $_date = explode('-',$date);

        $diaSemana = [
            'Domingo',
            'Segunda-feira',
            'Terça-feira',
            'Quarta-feira',
            'Quinta-feira',
            'Sexta-feira',
            'Sabado'
        ];

        $diaSemana_int = date('w', strtotime($date));

        $diaSemana = $diaSemana[$diaSemana_int];

        $dia = $_date[2];
        $mes = meses($_date[1]);

        $string = $diaSemana . ', ' . $dia . ' de ' . $mes;

        return $string;
    }


	function stringDateSimple( $date  ){

        $_date = explode('-',$date);

        $dia = $_date[2];
        $mes = meses($_date[1]);

        $string = $dia . ' de ' . $mes . ' de ' . $_date[0];

        return $string;
    }