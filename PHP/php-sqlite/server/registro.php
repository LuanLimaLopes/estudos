<?php
// registro.php - API para registrar novos usuários com SQLite

// Habilitar log de erros
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// Headers ANTES de qualquer output
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir configuração
$config_file = __DIR__ . '/config_sqlite.php';
if (!file_exists($config_file)) {
    http_response_code(500);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Arquivo de configuração não encontrado',
        'arquivo_procurado' => $config_file,
        'diretorio_atual' => __DIR__
    ]);
    exit;
}

require_once $config_file;

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
$json_input = file_get_contents('php://input');
$dados = json_decode($json_input, true);

// Log do que foi recebido
error_log("REGISTRO - Dados recebidos: " . $json_input);

// Validar dados recebidos
if (!isset($dados['usuario']) || !isset($dados['email']) || !isset($dados['senhaHash'])) {
    http_response_code(400);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Dados incompletos. Envie usuario, email e senhaHash.',
        'recebido' => array_keys($dados ?: [])
    ]);
    exit;
}

$usuario = trim($dados['usuario']);
$email = trim($dados['email']);
$senhaHash = $dados['senhaHash'];
$numero = isset($dados['numero']) ? trim($dados['numero']) : '';

// Validações básicas
if (empty($usuario) || empty($email) || empty($senhaHash)) {
    http_response_code(400);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Campos obrigatórios não podem estar vazios.'
    ]);
    exit;
}

// Validar formato do email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Email inválido.'
    ]);
    exit;
}

try {
    // Verificar se email já existe
    $stmt = $conexao->prepare("SELECT id FROM usuario WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->fetch()) {
        http_response_code(400);
        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'Este email já está cadastrado.'
        ]);
        exit;
    }
    
    // Inserir novo usuário
    $stmt = $conexao->prepare("INSERT INTO usuario (nome, email, senhahash, numero) VALUES (:nome, :email, :senhahash, :numero)");
    $stmt->bindParam(':nome', $usuario);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senhahash', $senhaHash);
    $stmt->bindParam(':numero', $numero);
    
    if ($stmt->execute()) {
        $id_usuario = $conexao->lastInsertId();
        
        http_response_code(201);
        echo json_encode([
            'sucesso' => true,
            'mensagem' => 'Usuário cadastrado com sucesso!',
            'idUsuario' => $id_usuario
        ]);
        
        // Log no servidor
        error_log("✅ Novo usuário cadastrado: $usuario (ID: $id_usuario)");
    }
    
} catch(PDOException $e) {
    error_log("ERRO no registro: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro ao cadastrar usuário',
        'erro_tecnico' => $e->getMessage()
    ]);
}
?>