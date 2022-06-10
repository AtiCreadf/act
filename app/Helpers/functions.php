<?php

    function dataBr($data){
        return date('d/m/Y', strtotime($data));
    }

    function dataHoraBr($data){
        return date('d/m/Y H:i:s', strtotime($data));
    }

    function dataHoraBrResumido($data){
        return date('d/m/y H:i', strtotime($data));
    }

    function valorInterface($valor){
        return number_format($valor, 2, ',', '.');
    }
