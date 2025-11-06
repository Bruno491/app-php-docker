<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: produtos/index.php");
        exit;
    } else {
        $error = "Usuário ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Sistema PHP</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    /* ======== LOGIN STYLING ======== */
    .login-container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 420px;
      padding: 40px;
      text-align: center;
      animation: fadeIn 0.5s ease;
    }

    .login-container h2 {
      color: #1e3c72;
      margin-bottom: 25px;
      font-weight: 700;
      font-size: 28px;
    }

    .login-container form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .login-container input {
      padding: 12px 15px;
      border-radius: 10px;
      border: 1px solid #ccc;
      outline: none;
      font-size: 15px;
      transition: 0.2s;
    }

    .login-container input:focus {
      border-color: #1e3c72;
      box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
    }

    .login-container button {
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

    .login-container button:hover {
      background: linear-gradient(135deg, #2a5298, #1e3c72);
      transform: translateY(-2px);
    }

    .login-container p {
      margin-top: 20px;
      font-size: 14px;
    }

    .error {
      background: #f8d7da;
      color: #842029;
      border: 1px solid #f5c2c7;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 10px;
    }

    .login-icon {
      font-size: 50px;
      color: #1e3c72;
      margin-bottom: 15px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-icon">🔐</div>
    <h2>Entrar no Sistema</h2>

    <?php if (!empty($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="username" placeholder="Usuário" required>
      <input type="password" name="password" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>

    <p>Não tem uma conta? <a href="register.php">Crie uma agora</a></p>
  </div>
</body>
</html>
