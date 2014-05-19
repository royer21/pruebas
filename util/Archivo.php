<?php

$archivo = file("ejemplo.txt"); 
$lineas = count($archivo); 
//$arreglo();


echo "El archivo  contiene ".$lineas." lineas";
echo "<br>";


for($i=0; $i < $lineas ; $i++) 
{ 
	echo $arreglo[$i]=$archivo[$i]; 
	echo "<br>";


}

print_r($archivo);
?>