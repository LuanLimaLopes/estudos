<?php
// teste.php - Arquivo para diagnosticar problemas

echo "<h1>🔍 Diagnóstico do Sistema</h1>";

// 1. Verificar se PHP está funcionando
echo "<h2>✅ PHP está funcionando!</h2>";
echo "<p>Versão do PHP: " . phpversion() . "</p>";

// 2. Verificar se PDO está disponível
echo "<h2>Verificando PDO:</h2>";
if (class_exists('PDO')) {
    echo "<p style='color: green;'>✅ PDO está disponível</p>";
    
    // Verificar drivers disponíveis
    $drivers = PDO::getAvailableDrivers();
    echo "<p>Drivers disponíveis: " . implode(', ', $drivers) . "</p>";
    
    if (in_array('sqlite', $drivers)) {
        echo "<p style='color: green;'>✅ SQLite está disponível!</p>";
    } else {
        echo "<p style='color: red;'>❌ SQLite NÃO está disponível!</p>";
        echo "<p><strong>SOLUÇÃO:</strong> Edite C:\\xampp\\php\\php.ini e remova o ; de: ;extension=pdo_sqlite</p>";
    }
} else {
    echo "<p style='color: red;'>❌ PDO não está disponível</p>";
}

// 3. Verificar se config_sqlite.php existe
echo "<h2>Verificando arquivos:</h2>";
$arquivos_necessarios = [
    'config_sqlite.php',
    'registro.php',
    'login.php',
    'index.html',
    'main.js'
];

foreach ($arquivos_necessarios as $arquivo) {
    if (file_exists($arquivo)) {
        echo "<p style='color: green;'>✅ $arquivo existe</p>";
    } else {
        echo "<p style='color: red;'>❌ $arquivo NÃO existe!</p>";
    }
}

// 4. Testar criação do banco
echo "<h2>Testando criação do banco:</h2>";
try {
    $db_file = 'hash.db';
    $conexao = new PDO("sqlite:$db_file");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✅ Conexão com SQLite OK!</p>";
    
    // Tentar criar tabela
    $sql = "CREATE TABLE IF NOT EXISTS usuario (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL,
        senhahash TEXT NOT NULL,
        numero TEXT,
        data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    
    $conexao->exec($sql);
    echo "<p style='color: green;'>✅ Tabela criada com sucesso!</p>";
    
    // Verificar se hash.db foi criado
    if (file_exists('hash.db')) {
        echo "<p style='color: green;'>✅ Arquivo hash.db foi criado!</p>";
        echo "<p>Tamanho: " . filesize('hash.db') . " bytes</p>";
    }
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>❌ Erro: " . $e->getMessage() . "</p>";
}

// 5. Verificar permissões da pasta
echo "<h2>Verificando permissões:</h2>";
if (is_writable('.')) {
    echo "<p style='color: green;'>✅ Pasta tem permissão de escrita</p>";
} else {
    echo "<p style='color: red;'>❌ Pasta NÃO tem permissão de escrita</p>";
}

// 6. Mostrar caminho atual
echo "<h2>Informações do diretório:</h2>";
echo "<p>Diretório atual: " . getcwd() . "</p>";
echo "<p>Caminho completo deste arquivo: " . __FILE__ . "</p>";

echo "<hr>";
echo "<h2>📝 Próximos passos:</h2>";
echo "<ol>";
echo "<li>Se viu algum ❌ vermelho acima, corrija-o primeiro</li>";
echo "<li>Se tudo estiver ✅ verde, teste acessar: <a href='registro.php'>registro.php</a></li>";
echo "<li>Depois teste o formulário em: <a href='index.html'>index.html</a></li>";
echo "</ol>";
?>