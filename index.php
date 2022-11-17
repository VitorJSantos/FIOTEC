<?php
session_start(); //Inicializar a sessão com PHP
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <?php
		//Imprimir a mensagem de sucesso no upload de dados do arquivo txt para o banco de dados com mysqli
		if(isset($_SESSION['msg'])){
			//Imprimir o valor da sessão
			echo $_SESSION['msg'];
			//Destruir a sessão com PHP
			unset($_SESSION['msg']);
		}
		?>
        <form method ="POST" action="basedados.php" enctype="multipart/form-data">
            <label> Escolha o arquivo para ser importado ao banco de dados:</label><br>
            <input type="file" name="arquivo"><br><br>	
            <input type = "submit" value="Enviar para o Banco de dados">
        </form>
    </body>
</html>
