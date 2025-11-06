<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: ../login.php"); exit; }
require '../config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch();

if (!$produto) {
    echo "<p>Produto não encontrado.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $preco = floatval($_POST['preco']);
    $descricao = trim($_POST['descricao']);

    if ($nome && $preco) {
        $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, descricao = ? WHERE id = ?");
        $stmt->execute([$nome, $preco, $descricao, $id]);
        header("Location: index.php");
        exit;
    } else {
        $erro = "Preencha todos os campos obrigatórios.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Produto</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .form-container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 600px;
      padding: 40px;
      animation: fadeIn 0.5s ease;
    }

    .form-container h2 {
      color: #1e3c72;
      font-size: 26px;
      margin-bottom: 20px;
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input, textarea {
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 15px;
      outline: none;
      transition: 0.2s;
    }

    input:focus, textarea:focus {
      border-color: #1e3c72;
      box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
    }

    button {
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      color: white;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: linear-gradient(135deg, #2a5298, #1e3c72);
      transform: translateY(-2px);
    }

    .error {
      background: #f8d7da;
      color: #842029;
      border: 1px solid #f5c2c7;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 10px;
      text-align: center;
    }

    .nav {
      text-align: center;
      margin-top: 20px;
    }

    .nav a {
      color: #1e3c72;
      text-decoration: none;
      font-weight: 600;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>✏️ Editar Produto</h2>

    <?php if (!empty($erro)): ?>
      <div class="error"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
      <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required>
      <textarea name="descricao" rows="4"><?= htmlspecialchars($produto['descricao']) ?></textarea>
      <button type="submit">Salvar Alterações</button>
    </form>

    <div class="nav">
      <a href="index.php">⬅ Voltar</a>
    </div>
  </div>
</body>
</html>
