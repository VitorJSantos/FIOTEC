<!DOCTYPE html>
<html>
<body>

<?php

// cria conexão com a base de dados
$conn = new PDO('sqlite:emails.db');

// cria tabela de emails
$conn->exec('CREATE TABLE IF NOT EXISTS emails
             (nome_arquivo TEXT PRIMARY KEY,
              remetente TEXT,
              destinatario TEXT,
              data_hora TEXT,
              conteudo TEXT)');

// itera sobre arquivos de texto na pasta especificada
$pasta = './emails/';
foreach (glob($pasta . '*.txt') as $caminho_arquivo) {
    // abre arquivo e extrai informações
    $nome_arquivo = basename($caminho_arquivo);
    $conteudo = file_get_contents($caminho_arquivo);
    $remetente = preg_match('/From:\s+(.*)/i', $conteudo, $matches) ? $matches[1] : '';
    $destinatario = preg_match('/To:\s+(.*)/i', $conteudo, $matches) ? $matches[1] : '';
    $data_hora = preg_match('/Date:\s+(.*)/i', $conteudo, $matches) ? $matches[1] : '';
    
    // verifica se arquivo já foi armazenado
    $stmt = $conn->prepare('SELECT * FROM emails WHERE nome_arquivo=?');
    $stmt->execute(array($nome_arquivo));
    if ($stmt->fetch()) {
        continue;
    }
    
    // insere informações na tabela de emails
    $stmt = $conn->prepare('INSERT INTO emails VALUES (?,?,?,?,?)');
    $stmt->execute(array($nome_arquivo, $remetente, $destinatario, $data_hora, $conteudo));
}

// fecha conexão com a base de dados
$conn = null;

?>


</body>
</html>
