<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "zymbo_db";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Processar formulário
if ($_POST) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha_user = $_POST['senha'];
    $acao = $_POST['acao'];
    
    if ($acao == 'editar') {
        $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nome, $email, $senha_user, $id);
        
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Usuário atualizado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao atualizar usuário: " . $conn->error . "</div>";
        }
        $stmt->close();
    } elseif ($acao == 'salvar') {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senha_user);
        
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Usuário salvo com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao salvar usuário: " . $conn->error . "</div>";
        }
        $stmt->close();
    }
}

// Buscar todos os usuários
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
$usuarios = $result->fetch_all(MYSQLI_ASSOC);

// Buscar dados do usuário específico para edição (se ID for passado)
$usuario_data = null;
if (isset($_GET['id'])) {
    $id_editar = $_GET['id'];
    foreach ($usuarios as $user) {
        if ($user['id'] == $id_editar) {
            $usuario_data = $user;
            break;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Configurações de Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="images/icon.png" type="image/png">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">Gerenciar Usuários</h2>
    
    <!-- Lista de todos os usuários -->
    <div class="card mb-4">
      <div class="card-header">
        <h5>Usuários Cadastrados</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($usuarios as $user): ?>
              <tr>
                <td><?php echo htmlspecialchars($user['nome']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                  <a href="config.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                  <a href="excluir.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" 
                     onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Formulário de edição/cadastro -->
    <div class="card mb-3">
      <div class="card-header">
        <h5><?php echo $usuario_data ? 'Editar Usuário' : 'Novo Usuário'; ?></h5>
      </div>
      <div class="card-body">
        <form method="POST" action="config.php" class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?php echo isset($usuario_data['nome']) ? htmlspecialchars($usuario_data['nome']) : ''; ?>">
          </div>
          <div class="col-md-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo isset($usuario_data['email']) ? htmlspecialchars($usuario_data['email']) : ''; ?>">
          </div>
          <div class="col-md-4">
            <label class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" value="<?php echo isset($usuario_data['senha']) ? htmlspecialchars($usuario_data['senha']) : ''; ?>">
          </div>
          <input type="hidden" name="id" value="<?php echo isset($usuario_data['id']) ? $usuario_data['id'] : '1'; ?>">

          <div class="col-12 mt-3">
            <?php if ($usuario_data): ?>
              <button type="submit" name="acao" value="editar" class="btn btn-primary">Atualizar</button>
              <a href="config.php" class="btn btn-secondary ms-2">Cancelar</a>
            <?php else: ?>
              <button type="submit" name="acao" value="salvar" class="btn btn-success">Salvar Novo</button>
            <?php endif; ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>