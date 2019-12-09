<?php
//Array de elemento
$myArray = array(0, 5, 2, 12, 300);
//Iterando item por item do Array $myArray
for ($i = 0; $i < count($myArray); $i++) {
  print_r ('Item indice: ' . $i . ', Valor: ' . $myArray[$i] . PHP_EOL. '<br>');
  sleep(2);
}
?>
