<?php 
require('./estadistica/TablaChiCuadrado.php');

/**
 * Class
 * @author Ronny Polloqueri Anco
 */
class PruebaChiCuadrado
{
    private static $ruta    = './estadistica/tablas_csv/chicuadrado.csv';
    private static $tc      = null;
    private $datos          = array();
    private $rango_superior = array();
    private $rango_inferior = array();
    private $fo             = array();
    private $fe             = -1;
    private $cuadrados      = array();
    private $sum_fo         = -1;
    private $sum_cuadrados  = -1;

    public function get_fe(){
        return $this->fe;
    }
    public function get_fo(){
        return $this->fo;
    }
    public function get_datos(){
        return $this->datos;
    }

    public function get_rango_inferior(){
        return $this->rango_inferior;
    }
    
    public function get_rango_superior(){
        return $this->rango_superior;
    }

    public function get_cuadrados(){
        return $this->cuadrados;
    }

    public function get_suma_de_cuadrados(){
        return $this->sum_cuadrados;
    }

    public function __construct($datos)
    {
        self::$tc    = new TablaChiCuadrado(self::$ruta);
        $this->datos = $datos;
        $this->n     = count($this->datos);
        echo "n: ".$this->n.PHP_EOL;
        $this->m     = floor(sqrt($this->n));
        
        echo "m: ".$this->m.PHP_EOL;

        $this->fe    = floor($this->n / $this->m);
        echo "fe: ".$this->fe.PHP_EOL;
        $this->start();
    }

    private function start(){
        $paso = round( 1 / $this->fe,2);  
        
        echo "paso: ".$paso.PHP_EOL;

        for($i = 0 ; $i < $this->fe; $i++){
            if( $i == 0 ){
                $this->rango_inferior[] = 0;
            } else {
                $this->rango_inferior[] = $this->rango_superior[$i-1];
            } 
            $this->rango_superior[] = $this->rango_inferior[$i] + $paso;
        }
        $this->rango_superior[$i-1] = 1;
        $this->iniciar_paloteo();
    }

    private function iniciar_paloteo(){
        $this->sum_cuadrados = 0;
        $this->sum_fo        = 0;
        for($i = 0 ; $i < $this->fe; $i++){
            if ($i != $this->fe){
                $this->fo[] = $this->contar_en_el_rango($this->rango_inferior[$i], $this->rango_superior[$i], ">");
            } else {
                $this->fo[] = $this->contar_en_el_rango($this->rango_inferior[$i], $this->rango_superior[$i], "]");
            }
            $this->cuadrados[]    = pow($this->fe - $this->fo[$i] , 2) / $this->fe;
            $this->sum_cuadrados += $this->cuadrados[$i];
            $this->sum_fo        += $this->fo[$i];
        }
    }

    private function contar_en_el_rango($rango_inferior, $rango_superior, $llave_derecha){
        $contador = 0;
        foreach($this->datos as $dato){
            if( $llave_derecha == "]" ){
                if($rango_inferior <= $dato & $dato <= $rango_superior){
                    $contador++;
                }
            } else if( $llave_derecha == ">" ) {
                if($rango_inferior <= $dato & $dato < $rango_superior){
                    $contador++;
                }
            }
        }
        return $contador;
    }
}
// Pruebas
require('./util/Archivo.php');
$ruta = '/home/ronny/archivos/libro/100numeros.txt';
$valores = Archivo::get_valores($ruta);
$pc = new PruebaChiCuadrado($valores);

echo "Datos:".PHP_EOL;
print_r($pc->get_datos());  

echo "Rango Inferior:".PHP_EOL;
print_r($pc->get_rango_inferior());  

echo "Rango Superior:".PHP_EOL;
print_r($pc->get_rango_superior());  

echo "Array Fo:".PHP_EOL;
print_r($pc->get_fo());  

echo "Fe:".PHP_EOL;
echo $pc->get_fe().PHP_EOL;  

echo "Cuadrados:".PHP_EOL;
print_r($pc->get_cuadrados());  

echo "Suma de cuadrados:".PHP_EOL;
echo $pc->get_suma_de_cuadrados();  

?>
