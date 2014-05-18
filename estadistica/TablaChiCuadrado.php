<?php
class TablaChiCuadrado{
    private static $matriz = array();
    private static $nivel_de_significancia = array();

    /*
     * Guardará los valores como números no como string
     */
    private static function start(){
        $fila = 1;
        if (($gestor = fopen("tablas_csv/chicuadrado.csv", "r")) !== FALSE) {
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                if($fila == 1){
                    self::$nivel_de_significancia = array_slice($datos,1);
                    $fila++;
                } else {
                    self::$matriz[$datos[0]] = array_slice($datos,1);
                }
            }
               fclose($gestor);
        }
    }

    public static function get($alfa, $grados){
        self::start();
        $indice = array_search($alfa, self::$nivel_de_significancia);
        return self::$matriz[$grados][$indice];
    }
}
/*
 * [Pruebas]
 * Ingresar TabaChicuadrado(nivel_de_significancia, grados_de_libertad);
 */
echo TablaChiCuadrado::get(0.005,2).PHP_EOL;
echo TablaChiCuadrado::get(0.005,2).PHP_EOL;
echo TablaChiCuadrado::get(0.005,2).PHP_EOL;
?>
