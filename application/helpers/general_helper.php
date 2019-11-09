<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('hallatiposer'))
{
    function hallatiposer($tposrv) {
        SWITCH($tposrv){
            CASE "1":
                $nomsuc='Incidencia';
                break;
            CASE "2":
                $nomsuc='Peticion';
                break;
            CASE "3":
                $nomsuc='Problema';
                break; 
            CASE "4":
                $nomsuc='Cambios';
                break;
                default: 
                $nomsuc='Ninguno';
                break;
                 
        }
        return $nomsuc;
    }
}

if ( ! function_exists('mes_letra'))
{
    function mes_letra($mes) {
        SWITCH($mes){
            CASE "1":
                $mes='Enero';
                break;
            CASE "2":
                $mes='Febrero';
                break;
            CASE "3":
                $mes='Marzo';
                break; 
            CASE "4":
                $mes='Abril';
                break;
                CASE "5":
                $mes='Mayo';
                break;
            CASE "6":
                $mes='Junio';
                break;
            CASE "7":
                $mes='Julio';
                break; 
            CASE "8":
                $mes='Agosto';
                break;
                CASE "09":
                $mes='Setiembre';
                break;
            CASE "10":
                $mes='Octubre';
                break;
            CASE "11":
                $mes='Noviembre';
                break; 
            CASE "12":
                $mes='Diciembre';
                break;
                default: 
                $mes='No existe';
                break;
                 
        }
        return $mes;
    }
}

if ( ! function_exists('hourIsBetween'))
{
function hourIsBetween($from, $to, $input) {
    $dateFrom = DateTime::createFromFormat('!H:i:s', $from);
    $dateTo = DateTime::createFromFormat('!H:i:s', $to);
    $dateInput = DateTime::createFromFormat('!H:i:s', $input);
    if ($dateFrom > $dateTo) $dateTo->modify('+1 day');
    return ($dateFrom <= $dateInput && $dateInput <= $dateTo) || ($dateFrom <= $dateInput->modify('+1 day') && $dateInput <= $dateTo);
}
}
?>


