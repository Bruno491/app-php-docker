<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // usuário duplicado
            $error = "Este nome de usuário já está em uso.";
        } else {
            $error = "Erro ao registrar: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Registrar - Sistema PHP</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    /* ======== REGISTER STYLING ======== */
    .register-container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 450px;
      padding: 40px;
      text-align: center;
      animation: fadeIn 0.5s ease;
    }

    .register-container h2 {
      color: #1e3c72;
      margin-bottom: 25px;
      font-weight: 700;
      font-size: 28px;
    }

    .register-container form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .register-container input {
      padding: 12px 15px;
      border-radius: 10px;
      border: 1px solid #ccc;
      outline: none;
      font-size: 15px;
      transition: 0.2s;
    }

    .register-container input:focus {
      border-color: #1e3c72;
      box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
    }

    .register-container button {
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

    .register-container button:hover {
      background: linear-gradient(135deg, #2a5298, #1e3c72);
      transform: translateY(-2px);
    }

    .register-container p {
      margin-top: 20px;
      font-size: 14px;
    }

    .register-icon {
      font-size: 50px;
      color: #1e3c72;
      margin-bottom: 15px;
    }

    .error {
      background: #f8d7da;
      color: #842029;
      border: 1px solid #f5c2c7;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 10px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="register-container">
    <div class="register-icon">📝</div>
    <h2>Criar Conta</h2>

    <?php if (!empty($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="username" placeholder="Nome de usuário" required>
      <input type="password" name="password" placeholder="Senha" required>
      <button type="submit">Registrar</button>
    </form>

    <p>Já tem conta? <a href="login.php">Fazer login</a></p>
  </div>
</body>
</html>
