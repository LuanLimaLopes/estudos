<?php
// config_sqlite.php - Configuração com SQLite

// Habilitar exibição de erros (REMOVER EM PRODUÇÃO!)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Não mostrar erros no output
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// Nome do arquivo do banco de dados
$db_file = __DIR__ . '../db/hash.db';

try {
    // Verificar se o diretório tem permissão de escrita
    if (!is_writable(__DIR__)) {
        throw new Exception('Diretório não tem permissão de escrita');
    }
    
    // Criar/conectar ao banco SQLite
    $conexao = new PDO("sqlite:$db_file");
    
    // Configurar modo de erro
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Habilitar chaves estrangeiras
    $conexao->exec('PRAGMA foreign_keys = ON;');
    
    // Criar tabela se não existir
    $sql = "CREATE TABLE IF NOT EXISTS usuario (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL,
        senhahash TEXT NOT NULL,
        numero TEXT,
        data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    
    $conexao->exec($sql);
    
} catch(Exception $e) {
    // Log do erro
    error_log("ERRO config_sqlite.php: " . $e->getMessage());
    
    // Retornar erro em JSON
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(500);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro na configuração do banco de dados',
        'erro_tecnico' => $e->getMessage(),
        'arquivo' => basename(__FILE__)
    ]);
    exit;
}
?>