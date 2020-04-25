<?php

$strings_to_replace = ["2aaa'3'bbb'4'", "832klaf'4'kfrio'448'f",
"WEFKL'94384'KDk''ljserwe'4'", "93'487'kjhm'34'jsd", "io3uy'23''48'd'JK'OQ3"];
foreach ($strings_to_replace as $str) {
  echo "$str =>" . preg_replace_callback("/'(?<digit>\d+)'/",
   function($param) {return "'". $param['digit']*2 . "'";},
   $str) . '<br>';
}
