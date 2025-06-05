<?php
$conn = new mysqli("localhost", "root", "", "zymbo_db");

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexao: " . $conn->connect_error);
}

// Pega os dados do formulário
$email = $_POST['email'];
$senha = md5($_POST['senha']); // cuidado: só para fins didáticos

// Consulta
$sql = "SELECT nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($sql);

echo '<!DOCTYPE HTML>';
echo '<html lang="pt-br">';
echo '<head>';
echo '    <title>Login Efetuado com Sucesso!</title>';
echo '    <meta charset="utf-8">';
echo '    <meta name="viewport" content="width=device-width, initial-scale=1">';
echo '    <style>';
echo '        body {';
echo '            font-family: sans-serif;';
echo '            background-color: #ffed8a; /* Um amarelo alegre */';
echo '            display: flex;';
echo '            justify-content: center;';
echo '            align-items: center;';
echo '            height: 100vh;';
echo '            margin: 0;';
echo '            animation: backgroundChange 5s infinite alternate; /* Animação sutil de fundo */';
echo '        }';
echo '        @keyframes backgroundChange {';
echo '            from {background-color: #ffed8a;}';
echo '            to {background-color: #fffacd;} /* Um amarelo mais claro */';
echo '        }';
echo '        .container {';
echo '            background-color: white;';
echo '            padding: 30px;';
echo '            border-radius: 10px;';
echo '            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Sombra mais pronunciada */';
echo '            width: 80%;';
echo '            max-width: 500px;';
echo '            text-align: center;';
echo '            animation: containerFadeIn 1s ease-out;';
echo '        }';
echo '        @keyframes containerFadeIn {';
echo '            from {opacity: 0; transform: translateY(-20px);}';
echo '            to {opacity: 1; transform: translateY(0);}';
echo '        }';
echo '        .mensagem-sucesso {';
echo '            color: #3a3a3a;';
echo '            font-size: 24px;';
echo '            font-weight: bold;';
echo '            padding: 20px;';
echo '            background-color: #fff;';
echo '            border: 2px solid #ffcc00;';
echo '            border-radius: 10px;';
echo '            margin-bottom: 20px;';
echo '            animation: messageSlideIn 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;';
echo '        }';
echo '        @keyframes messageSlideIn {';
echo '            0% {transform: translateY(50px); opacity: 0;}';
echo '            100% {transform: translateY(0); opacity: 1;}';
echo '        }';
echo '        .nome-destaque {';
echo '            color: #ff6f61; /* Uma cor vibrante */';
echo '            font-style: italic;';
echo '        }';
echo '        .emoji {';
echo '            font-size: 30px;';
echo '            margin-left: 5px;';
echo '        }';
echo '        .voltar-link {';
echo '            display: inline-block;';
echo '            padding: 10px 20px;';
echo '            background-color: #007bff;';
echo '            color: white;';
echo '            text-decoration: none;';
echo '            border-radius: 5px;';
echo '            margin-top: 20px;';
echo '            transition: background-color 0.3s ease;';
echo '        }';
echo '        .voltar-link:hover {';
echo '            background-color: #0056b3;';
echo '        }';
echo '        .erro-link {';
echo '            display: inline-block;';
echo '            padding: 10px 20px;';
echo '            background-color: #dc3545;';
echo '            color: white;';
echo '            text-decoration: none;';
echo '            border-radius: 5px;';
echo '            margin-top: 20px;';
echo '            transition: background-color 0.3s ease;';
echo '        }';
echo '        .erro-link:hover {';
echo '            background-color: #c82333;';
echo '        }';
echo '        .mensagem-erro {';
echo '            color: #721c24;';
echo '            background-color: #f8d7da;';
echo '            border-color: #f5c6cb;';
echo '            padding: 10px;';
echo '            border-radius: 5px;';
echo '            margin-bottom: 10px;';
echo '        }';
echo '    </style>';
echo '</head>';
echo '<body>';
echo '    <div class="container">';

// Verifica se encontrou
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nome = $row['nome'];
    echo '        <div class="mensagem-sucesso">';
    echo '            🎉 Olá, <span class="nome-destaque">' . htmlspecialchars($nome) . '</span>! ';
    echo '            Bem vindo de volta! <span class="emoji">🚀</span>';
    echo '        </div>';
    echo '        <a href="index.html" class="voltar-link">Ir para a Página Inicial</a>';
} else {
    echo '        <div class="mensagem-erro">Email ou senha inválidos.</div>';
    echo '        <a href="login.html" class="erro-link">Tentar Novamente</a>';
}

echo '    </div>';
echo '</body>';
echo '</html>';

$conn->close();
?>