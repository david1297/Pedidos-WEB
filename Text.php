<?php //Ejemplo aprenderaprogramar.com
$filecontent="Aqui va el mensaje de texto ... ";
$downloadfile="nombre.txt";
 
header("Content-disposition: attachment; filename=$downloadfile");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".strlen($filecontent));
header("Pragma: no-cache");
header("Expires: 0");
 
echo $filecontent;

?>