<?php
session_start();//Inicializar a sessão com PHP

//Incluir a conexao com BD
include_once("conecta.php");

//Receber os dados do formulário
$arquivo_tmp = $_FILES['arquivo']['tmp_name'];

//ler todo o arquivo para um array
$dados = file($arquivo_tmp);

//Ler os dados do array
foreach($dados as $linha){
	//Retirar os espaços em branco no inicio e no final da string
	//$linha = trim($linha);
	//Colocar em um array cada item separado pela virgula na string
	//$valor = explode(',', $linha);
	
	//Recuperar o valor do array indicando qual posição do array requerido e atribuindo para um variável
	$nomeArquivo = $valor[0];
	$remetente = $valor[1];
	$destinatario = $valor[2];
	$dataeHora = $valor[3];
    $conteudo = $valor[4];
	
	//Criar a QUERY com PHP para inserir os dados no banco de dados
	$result_dados = "INSERT INTO basededados (nome_do_arquivo, remetente, destinatario, data_hora, conteudo) VALUES ('$nomeArquivo', '$remetente', '$destinatario', '$dataeHora', '$conteudo')";
	
    $consulta_dados = "SELECT * from basedados WHERE nome_do_arquivo =". $nomeArquivo;
    if ($consulta_dados == TRUE ){
        $_SESSION['msg'] = "<p style = 'color: red;'> O Arquivo já foi inserido na base de dados";
        // echo"<script language='javascript' type='text/javascript'>alert('O Arquivo já foi inserido no banco de dados')";</script>
    }

    
	//Executar a QUERY para inserir os registros no banco de dados com MySQLi
	$resultado_dados = mysqli_query($conexao, $result_dados);	
}
//Criar a variável global com a mensagem de sucesso
$_SESSION['msg'] = "<p style='color: green;'>Carregado os dados com sucesso!</p>";
//Redirecionar o usuário com PHP para a página index.php
header("Location: index.php");