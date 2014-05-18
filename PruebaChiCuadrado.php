<?php 
require('./estadistica/TablaChiCuadrado.php');

/**
 * Class
 * @author Ronny Polloqueri Anco
 */
class PruebaChiCuadrado
{
    private static $ruta = './estadistica/tablas_csv/chicuadrado.csv';
    private static $tc = null;
    private static $valores = array();

    public function __construct()
    {
        self::$tc = new TablaChiCuadrado(self::$ruta);
        print self::$tc->get(1,1);
    }
}
// Pruebas
$pc = new PruebaChiCuadrado();


?>
