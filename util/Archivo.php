<?php
class Archivo{
   
    public static function get_valores($ruta){
        $archivo = file($ruta); 
        $arreglo = array();
        for($i=0; $i < count($archivo) ; $i++) 
        { 
            echo $arreglo[$i]=$archivo[$i]; 
        }
        return $arreglo;
    }
}
// Pruebas
//$ruta = '/ruta_a_un_archivo/archivo.txt';
//print_r(Archivo::get_valores($ruta));
?>
