<?php
// server/login.php - API para autenticar usuários

// Habilitar log de erros
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../php_errors.log');
date_default_timezone_set('America/Sao_Paulo');

// Headers ANTES de qualquer output
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir configuração
require_once __DIR__ . '/config_sqlite.php';

// Verificar se é requisição POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Método não permitido. Use POST.'
    ]);
    exit;
}

// Pegar dados JSON do body
$dados = json_decode(file_get_contents('php://input'), true);

// Validar dados recebidos
if (!isset($dados['email']) || !isset($dados['senhaHash'])) {
    http_response_code(400);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Email e senha são obrigatórios.'
    ]);
    exit;
}

$email = trim($dados['email']);
$senhaHash = $dados['senhaHash'];

// Validações básicas
if (empty($email) || empty($senhaHash)) {
    http_response_code(400);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Email e senha não podem estar vazios.'
    ]);
    exit;
}

try {
    // Buscar usuário no banco
    $stmt = $conexao->prepare("SELECT id, nome, email FROM usuario WHERE email = :email AND senhahash = :senhahash");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senhahash', $senhaHash);
    $stmt->execute();
    
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        // Login bem-sucedido
        http_response_code(200);
        echo json_encode([
            'sucesso' => true,
            'mensagem' => 'Login realizado com sucesso!',
            'usuario' => [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email']
            ]
        ]);
        
        // Log no servidor
        error_log("✅ Login bem-sucedido: {$usuario['nome']} ({$usuario['email']})");
        
    } else {
        // Credenciais inválidas
        http_response_code(401);
        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'Email ou senha incorretos.'
        ]);
        
        // Log de tentativa falha
        error_log("❌ Tentativa de login falha para: $email");
    }
    
} catch(PDOException $e) {
    error_log("ERRO no login: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro no servidor',
        'erro_tecnico' => $e->getMessage()
    ]);
}
?>