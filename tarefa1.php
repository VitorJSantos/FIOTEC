<!DOCTYPE html>
<html>
<body>

<?php
//abrindo apenas 1 arquivo
$file = fopen("Prevenção a Fraudes Corporativas - Técnicas Eficazes.txt","r") or die("Impossível ler o arquivo");
while(! feof($file)){
    $linha = fgets($file);
    echo $linha. "<br>";
}
fclose($file);
?>

</body>
</html>
