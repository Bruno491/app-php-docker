<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Bem-vindo</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <h1>🌐 Aplicação PHP + Docker</h1>

    <?php if (isset($_SESSION['user'])): ?>
      <div class="alert">
        Olá, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>! Que bom ter você de volta.
      </div>
      <div class="nav">
        <a href="produtos/index.php">🛒 Gerenciar Produtos</a> |
        <a href="logout.php">🚪 Sair</a>
      </div>
    <?php else: ?>
      <p style="text-align:center;">Bem-vindo! Faça login ou registre-se para continuar:</p>
      <div class="nav">
        <a href="login.php">🔑 Login</a> |
        <a href="register.php">📝 Registrar</a>
      </div>
    <?php endif; ?>

    <footer>© <?= date('Y') ?> - Sistema em PHP com Docker</footer>
  </div>
</body>
</html>
