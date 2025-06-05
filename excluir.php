<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "zymbo_db";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: config.php?msg=excluido");
        exit();
    } else {
        echo "Erro ao excluir usuário: " . $conn->error;
    }
    
    $stmt->close();
} else {
    echo "ID do usuário não fornecido!";
}

$conn->close();
?>