<?php
class TablaChiCuadrado{
    private static $matriz = array();
    private static $nivel_de_significancia = array();

    /*
     * Guardará los valores como números no como string
     */
    function __construct($ruta){
        $fila = 1;
        if (($gestor = fopen($ruta, "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                if($fila == 1){
                    self::$nivel_de_significancia = array_slice($datos,1);
                    $fila++;
                } else {
                    //$matriz['clave'] = 'valores'
                    self::$matriz[$datos[0]] = array_slice($datos,1);
                }
            }
            fclose($gestor);
        }
    }

    public function get($alfa, $grados){
        $indice = array_search($alfa, self::$nivel_de_significancia);
        return self::$matriz[$grados][$indice];
    }
}
/*
 * [Pruebas]
 * Ingresar TabaChicuadrado(nivel_de_significancia, grados_de_libertad);
 */
//$ruta = './tablas_csv/chicuadrado.csv';
//$tc = new TablaChiCuadrado($ruta);
//echo $tc->get(0.005,2).PHP_EOL;
?>
