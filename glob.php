<?php

define("DS", DIRECTORY_SEPARATOR);

$pattern = dirname(__FILE__) . DS . "Mensagens" . DS . "*.txt";

header("Content-Type: text/html; charset=iso-8859-1");

foreach (glob($pattern) as $file) {
    echo "<hr/>";
    echo "<b>Arquivo: {$file}</b>";
    echo "<hr/>";

    echo file_get_contents($file);
}

?>
