<?php
// teste.php - Diagnóstico completo do sistema
// Localização: php_sqlite/teste.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//Configurar horário para são paulo.
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔍 Diagnóstico do Sistema</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #0d6a86;
            padding-bottom: 10px;
        }
        h2 {
            color: #0d6a86;
            margin-top: 30px;
            border-left: 4px solid #0d6a86;
            padding-left: 10px;
        }
        .success {
            color: #28a745;
            padding: 10px;
            background: #d4edda;
            border-left: 4px solid #28a745;
            margin: 10px 0;
            border-radius: 4px;
        }
        .error {
            color: #dc3545;
            padding: 10px;
            background: #f8d7da;
            border-left: 4px solid #dc3545;
            margin: 10px 0;
            border-radius: 4px;
        }
        .warning {
            color: #856404;
            padding: 10px;
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            margin: 10px 0;
            border-radius: 4px;
        }
        .info {
            color: #004085;
            padding: 10px;
            background: #cce5ff;
            border-left: 4px solid #007bff;
            margin: 10px 0;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background: #0d6a86;
            color: white;
        }
        table tr:hover {
            background: #f5f5f5;
        }
        .status-ok { color: #28a745; font-weight: bold; }
        .status-fail { color: #dc3545; font-weight: bold; }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
        .next-steps {
            background: #e7f3ff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }
        .next-steps ol {
            margin-left: 20px;
        }
        .next-steps li {
            margin: 10px 0;
        }
        a {
            color: #0d6a86;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Diagnóstico do Sistema de Login</h1>
        <p><strong>Data/Hora:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
        <hr>

        <?php
        $erros = [];
        $avisos = [];
        $sucessos = [];

        // ========================================
        // 1. VERIFICAR PHP
        // ========================================
        echo "<h2>1️⃣ Verificação do PHP</h2>";
        
        $php_version = phpversion();
        echo "<div class='success'>✅ PHP está funcionando!</div>";
        echo "<div class='info'>Versão do PHP: <code>$php_version</code></div>";
        
        if (version_compare($php_version, '7.0', '>=')) {
            echo "<div class='success'>✅ Versão do PHP adequada (7.0+)</div>";
        } else {
            echo "<div class='warning'>⚠️ Versão do PHP antiga. Recomenda-se 7.0 ou superior.</div>";
            $avisos[] = "Versão do PHP antiga";
        }

        // ========================================
        // 2. VERIFICAR PDO E SQLITE
        // ========================================
        echo "<h2>2️⃣ Verificação do PDO e SQLite</h2>";
        
        if (class_exists('PDO')) {
            echo "<div class='success'>✅ PDO está disponível</div>";
            
            $drivers = PDO::getAvailableDrivers();
            echo "<div class='info'>Drivers PDO disponíveis: <code>" . implode(', ', $drivers) . "</code></div>";
            
            if (in_array('sqlite', $drivers)) {
                echo "<div class='success'>✅ SQLite está disponível e funcionando!</div>";
                $sucessos[] = "SQLite configurado";
            } else {
                echo "<div class='error'>❌ SQLite NÃO está disponível!</div>";
                echo "<div class='warning'><strong>SOLUÇÃO:</strong> Edite <code>C:\\xampp\\php\\php.ini</code><br>";
                echo "Procure por: <code>;extension=pdo_sqlite</code><br>";
                echo "Remova o <code>;</code> para ficar: <code>extension=pdo_sqlite</code><br>";
                echo "Reinicie o Apache no XAMPP</div>";
                $erros[] = "SQLite não habilitado";
            }
        } else {
            echo "<div class='error'>❌ PDO não está disponível</div>";
            $erros[] = "PDO não disponível";
        }

        // ========================================
        // 3. VERIFICAR ESTRUTURA DE PASTAS
        // ========================================
        echo "<h2>3️⃣ Verificação da Estrutura de Pastas</h2>";
        
        $estrutura = [
            'server' => ['config_sqlite.php', 'registro.php', 'login.php', 'ver-usuarios.php'],
            'pages' => ['index.html', 'pagina-login.html', 'dashboard.html'],
            'js' => ['main.js', 'login.js'],
            'css' => ['style.css'],
            'db' => []
        ];
        
        echo "<table>";
        echo "<tr><th>Pasta/Arquivo</th><th>Status</th><th>Caminho Completo</th></tr>";
        
        foreach ($estrutura as $pasta => $arquivos) {
            $caminho_pasta = __DIR__ . '/' . $pasta;
            
            if (is_dir($caminho_pasta)) {
                echo "<tr><td>📁 <strong>$pasta/</strong></td><td class='status-ok'>✅ Existe</td><td><code>$caminho_pasta</code></td></tr>";
                
                foreach ($arquivos as $arquivo) {
                    $caminho_arquivo = $caminho_pasta . '/' . $arquivo;
                    if (file_exists($caminho_arquivo)) {
                        $tamanho = filesize($caminho_arquivo);
                        echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;📄 $arquivo</td><td class='status-ok'>✅ Existe ($tamanho bytes)</td><td><code>$caminho_arquivo</code></td></tr>";
                    } else {
                        echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;📄 $arquivo</td><td class='status-fail'>❌ Não encontrado</td><td><code>$caminho_arquivo</code></td></tr>";
                        $erros[] = "Arquivo $pasta/$arquivo não encontrado";
                    }
                }
            } else {
                echo "<tr><td>📁 <strong>$pasta/</strong></td><td class='status-fail'>❌ Não existe</td><td><code>$caminho_pasta</code></td></tr>";
                $erros[] = "Pasta $pasta/ não existe";
            }
        }
        
        echo "</table>";

        // ========================================
        // 4. VERIFICAR PERMISSÕES
        // ========================================
        echo "<h2>4️⃣ Verificação de Permissões</h2>";
        
        $pastas_verificar = ['db', 'server'];
        
        foreach ($pastas_verificar as $pasta) {
            $caminho = __DIR__ . '/' . $pasta;
            if (is_dir($caminho)) {
                if (is_writable($caminho)) {
                    echo "<div class='success'>✅ Pasta <code>$pasta/</code> tem permissão de escrita</div>";
                } else {
                    echo "<div class='error'>❌ Pasta <code>$pasta/</code> NÃO tem permissão de escrita</div>";
                    $erros[] = "Sem permissão de escrita em $pasta/";
                }
            }
        }

        // ========================================
        // 5. TESTAR CONEXÃO COM BANCO
        // ========================================
        echo "<h2>5️⃣ Teste de Conexão com o Banco de Dados</h2>";
        
        if (in_array('sqlite', PDO::getAvailableDrivers() ?? [])) {
            try {
                $db_file = __DIR__ . '/db/hash.db';
                $db_dir = dirname($db_file);
                
                // Criar pasta db se não existir
                if (!is_dir($db_dir)) {
                    mkdir($db_dir, 0777, true);
                    echo "<div class='info'>ℹ️ Pasta <code>db/</code> foi criada</div>";
                }
                
                // Conectar ao banco
                $conexao = new PDO("sqlite:$db_file");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                echo "<div class='success'>✅ Conexão com SQLite estabelecida com sucesso!</div>";
                echo "<div class='info'>Arquivo do banco: <code>$db_file</code></div>";
                
                // Criar tabela
                $sql = "CREATE TABLE IF NOT EXISTS usuario (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nome TEXT NOT NULL,
                    email TEXT UNIQUE NOT NULL,
                    senhahash TEXT NOT NULL,
                    numero TEXT,
                    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
                )";
                
                $conexao->exec($sql);
                echo "<div class='success'>✅ Tabela 'usuario' criada/verificada com sucesso!</div>";
                
                // Verificar se o arquivo foi criado
                if (file_exists($db_file)) {
                    $tamanho = filesize($db_file);
                    echo "<div class='success'>✅ Arquivo hash.db criado! Tamanho: {$tamanho} bytes</div>";
                    $sucessos[] = "Banco de dados criado";
                    
                    // Contar registros
                    $stmt = $conexao->query("SELECT COUNT(*) as total FROM usuario");
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $total = $row['total'];
                    
                    if ($total > 0) {
                        echo "<div class='info'>ℹ️ Banco possui <strong>$total</strong> usuário(s) cadastrado(s)</div>";
                    } else {
                        echo "<div class='info'>ℹ️ Banco está vazio (0 usuários cadastrados)</div>";
                    }
                }
                
            } catch(PDOException $e) {
                echo "<div class='error'>❌ Erro ao conectar com SQLite: " . $e->getMessage() . "</div>";
                $erros[] = "Erro na conexão com SQLite: " . $e->getMessage();
            }
        }

        // ========================================
        // 6. VERIFICAR CONFIG DO SERVIDOR
        // ========================================
        echo "<h2>6️⃣ Informações do Servidor</h2>";
        
        echo "<table>";
        echo "<tr><th>Configuração</th><th>Valor</th></tr>";
        echo "<tr><td>Sistema Operacional</td><td><code>" . PHP_OS . "</code></td></tr>";
        echo "<tr><td>Servidor Web</td><td><code>" . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . "</code></td></tr>";
        echo "<tr><td>Diretório do projeto</td><td><code>" . __DIR__ . "</code></td></tr>";
        echo "<tr><td>Arquivo atual</td><td><code>" . __FILE__ . "</code></td></tr>";
        echo "<tr><td>URL de acesso</td><td><code>" . ($_SERVER['REQUEST_SCHEME'] ?? 'http') . "://" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $_SERVER['REQUEST_URI'] . "</code></td></tr>";
        echo "</table>";

        // ========================================
        // 7. RESUMO FINAL
        // ========================================
        echo "<h2>7️⃣ Resumo do Diagnóstico</h2>";
        
        $total_erros = count($erros);
        $total_avisos = count($avisos);
        $total_sucessos = count($sucessos);
        
        if ($total_erros == 0 && $total_avisos == 0) {
            echo "<div class='success' style='font-size: 1.2em;'>";
            echo "🎉 <strong>PARABÉNS! Sistema 100% operacional!</strong><br>";
            echo "Todos os componentes foram verificados e estão funcionando corretamente.";
            echo "</div>";
        } else {
            if ($total_erros > 0) {
                echo "<div class='error'>";
                echo "❌ <strong>$total_erros erro(s) encontrado(s):</strong><br><ul>";
                foreach ($erros as $erro) {
                    echo "<li>$erro</li>";
                }
                echo "</ul></div>";
            }
            
            if ($total_avisos > 0) {
                echo "<div class='warning'>";
                echo "⚠️ <strong>$total_avisos aviso(s):</strong><br><ul>";
                foreach ($avisos as $aviso) {
                    echo "<li>$aviso</li>";
                }
                echo "</ul></div>";
            }
        }

        // ========================================
        // 8. PRÓXIMOS PASSOS
        // ========================================
        echo "<div class='next-steps'>";
        echo "<h2>📝 Próximos Passos</h2>";
        
        if ($total_erros == 0) {
            echo "<ol>";
            echo "<li>✅ <strong>Sistema pronto!</strong> Acesse: <a href='pages/index.html'>Página de Registro</a></li>";
            echo "<li>✅ Teste também: <a href='pages/pagina-login.html'>Página de Login</a></li>";
            echo "<li>✅ Ver usuários cadastrados: <a href='server/ver-usuarios.php'>Ver Usuários (JSON)</a></li>";
            echo "<li>✅ Após cadastrar, acesse o <a href='pages/dashboard.html'>Dashboard</a></li>";
            echo "</ol>";
        } else {
            echo "<ol>";
            echo "<li>Corrija os erros listados acima</li>";
            echo "<li>Recarregue esta página para verificar novamente</li>";
            echo "<li>Se precisar de ajuda, verifique o arquivo <code>php_errors.log</code> na raiz do projeto</li>";
            echo "</ol>";
        }
        
        echo "</div>";
        ?>

        <hr style="margin-top: 40px;">
        <p style="text-align: center; color: #666;">
            <small>🔍 Diagnóstico gerado em <?php echo date('d/m/Y H:i:s'); ?> | 
            <a href="?refresh=<?php echo time(); ?>">🔄 Atualizar diagnóstico</a></small>
        </p>
    </div>
</body>
</html>