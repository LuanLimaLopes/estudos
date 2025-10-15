<?php
// ver_usuarios.php - Ver todos os usuários cadastrados (para debug)

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once 'config_sqlite.php';

try {
    // Buscar todos os usuários (sem mostrar a senha!)
    $stmt = $conexao->query("SELECT id, nome, email, numero, data_cadastro FROM usuario ORDER BY id DESC");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    http_response_code(200);
    echo json_encode([
        'sucesso' => true,
        'total' => count($usuarios),
        'usuarios' => $usuarios
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro ao buscar usuários: ' . $e->getMessage()
    ]);
}
?>