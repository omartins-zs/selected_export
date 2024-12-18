<?php
// Defina as credenciais de acesso ao banco de dados
$host = 'localhost';  // Servidor de banco de dados
$dbname = 'selected_export';  // Nome do banco de dados
$username = 'root';  // Usuário do banco de dados
$password = '';  // Senha do banco de dados (vazio no caso do usuário root)

// Conexão com o banco de dados usando PDO
try {
    // Cria a instância PDO para conexão
    $bd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Define o modo de erro do PDO para exceção
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Opcional: Definir o charset para UTF-8 para evitar problemas com caracteres especiais
    $bd->exec("SET NAMES 'utf8'");
    
} catch (PDOException $e) {
    // Caso haja erro na conexão, exibe a mensagem de erro
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
