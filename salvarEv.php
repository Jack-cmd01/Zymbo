<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $database   = "zymbo_db";

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexão
    if ($conn->connect_error) {
        echo <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Erro de Conexão</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #FFF8E1, #C1A57B);
            font-family: 'Courier New', Courier, monospace;
            color: #3E2723;
        }
        .container {
            max-width: 500px;
            margin: 100px auto;
            background: #FFFBF0;
            border: 4px double #8D6E63;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            text-align: center;
            border-radius: 8px;
        }
        .message {
            font-size: 22px;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 0 #FFFFFF;
        }
        .error {
            background: #FFCDD2;
            border: 2px solid #C62828;
            color: #B71C1C;
        }
        .btn {
            display: inline-block;
            text-decoration: none;
            background: #8D6E63;
            color: #FFFFFF;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #795548;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message error">
            <strong>Erro na conexão:</strong> {$conn->connect_error}
        </div>
        <a href="javascript:history.back()" class="btn">Voltar</a>
    </div>
</body>
</html>
HTML;
        exit();
    }

    // Obter dados do formulário
    $tipoEvento   = $_POST['tipoEvento'];
    $modalidade   = $_POST['modalidade'];
    $valor        = $_POST['valor'];
    $localizacao  = $_POST['localizacao'];
    $horario      = $_POST['horario'];
    $data         = $_POST['data'];
    $descricao    = $_POST['descricao'];

    // Inserir no banco
    $sql = "INSERT INTO eventos (tipo_evento, modalidade, valor, localizacao, horario, data, descricao)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $tipoEvento, $modalidade, $valor, $localizacao, $horario, $data, $descricao);

    if ($stmt->execute()) {
        echo <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sucesso ao Cadastrar</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #E8F5E9, #A5D6A7);
            font-family: 'Courier New', Courier, monospace;
            color: #1B5E20;
        }
        .container {
            max-width: 500px;
            margin: 100px auto;
            background: #E8F5E9;
            border: 4px double #388E3C;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            text-align: center;
            border-radius: 8px;
        }
        .message {
            font-size: 22px;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 0 #FFFFFF;
        }
        .success {
            background: #C8E6C9;
            border: 2px solid #2E7D32;
            color: #1B5E20;
        }
        .btn {
            display: inline-block;
            text-decoration: none;
            background: #388E3C;
            color: #FFFFFF;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #2E7D32;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message success">
            Evento cadastrado com sucesso!
        </div>
        <a href="cadastroEv.html" class="btn">Cadastrar novo evento</a>
    </div>
</body>
</html>
HTML;
    } else {
        $erroInsercao = $stmt->error;
        echo <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Erro ao Cadastrar</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #FFF3E0, #D32F2F);
            font-family: 'Courier New', Courier, monospace;
            color: #B71C1C;
        }
        .container {
            max-width: 500px;
            margin: 100px auto;
            background: #FFEBEE;
            border: 4px double #C62828;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            text-align: center;
            border-radius: 8px;
        }
        .message {
            font-size: 22px;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 0 #FFFFFF;
        }
        .error {
            background: #FFCDD2;
            border: 2px solid #D32F2F;
            color: #C62828;
        }
        .btn {
            display: inline-block;
            text-decoration: none;
            background: #C62828;
            color: #FFFFFF;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #B71C1C;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message error">
            <strong>Erro ao cadastrar evento:</strong><br>
            {$erroInsercao}
        </div>
        <a href="seu_formulario.html" class="btn">Voltar ao formulário</a>
    </div>
</body>
</html>
HTML;
    }

    $stmt->close();
    $conn->close();
}
?>