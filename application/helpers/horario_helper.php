<?php

function gerarHorarios($startTime, $endTime, $duracaoMinutos, $duracaoSegundos ){

    $horariosDisponiveis = [];

    while ( strtotime($startTime) <= strtotime($endTime) ) {
       $horariosDisponiveis[] = date("H:i:s", strtotime( "$startTime" ) );
       $startTime = date("H:i:s", strtotime( "$startTime +".$duracaoMinutos." minutes +".$duracaoSegundos." seconds")) ;
    }

    return $horariosDisponiveis;
}


function gerarHorariosIntervalados($startTime, $endTime, $duracaoMinutos, $duracaoSegundos ){

    $horariosDisponiveis = [];

    while ( strtotime($startTime) <= strtotime($endTime) ) {

        $inicioConsulta = date("H:i:s", strtotime( "$startTime" ) );
        $fimConsulta    = date("H:i:s", strtotime( "$startTime +".$duracaoMinutos." minutes +".$duracaoSegundos." seconds")) ;

        $startTime = $fimConsulta;

        $horariosDisponiveis[] = [
            'inicio' => $inicioConsulta,
            'fim'    => $fimConsulta
        ];
    }

    return $horariosDisponiveis;
}

