<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: ../login.php"); exit; }
require '../config.php';

// Busca os produtos
$stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
$produtos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gerenciar Produtos</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    /* === ESTILIZAÇÃO ESPECÍFICA DA TELA DE PRODUTOS === */
    .produtos-container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 900px;
      padding: 40px;
      animation: fadeIn 0.5s ease;
    }

    .produtos-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 25px;
    }

    .produtos-header h2 {
      color: #1e3c72;
      font-size: 26px;
      margin: 0;
    }

    .produtos-header a {
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      color: #fff;
      padding: 10px 18px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }

    .produtos-header a:hover {
      background: linear-gradient(135deg, #2a5298, #1e3c72);
      transform: translateY(-2px);
    }

    .table-responsive {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      border-radius: 10px;
      overflow: hidden;
    }

    th {
      background-color: #1e3c72;
      color: #fff;
      text-align: left;
      padding: 12px;
    }

    td {
      padding: 12px;
      border-bottom: 1px solid #eee;
    }

    tr:nth-child(even) {
      background-color: #f8f9fa;
    }

    tr:hover {
      background-color: #eef4ff;
    }

    .actions {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .action-btn {
      display: inline-block;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      text-decoration: none;
      text-align: center;
      transition: 0.2s;
    }

    .edit {
      background: #ffc107;
      color: #000;
    }

    .edit:hover {
      background: #e0a800;
    }

    .delete {
      background: #dc3545;
      color: #fff;
    }

    .delete:hover {
      background: #c82333;
    }

    .nav {
      text-align: center;
      margin-top: 30px;
    }

    .nav a {
      color: #1e3c72;
      text-decoration: none;
      font-weight: 600;
      margin: 0 10px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* === RESPONSIVIDADE === */
    @media (max-width: 600px) {
      .produtos-header {
        flex-direction: column;
        align-items: flex-start;
      }

      th, td {
        font-size: 14px;
      }

      .produtos-container {
        padding: 25px;
      }

      .actions {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="produtos-container">
    <div class="produtos-header">
      <h2>🛒 Gerenciar Produtos</h2>
      <a href="create.php">➕ Novo Produto</a>
    </div>

    <div class="table-responsive">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço (R$)</th>
            <th>Descrição</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($produtos) > 0): ?>
            <?php foreach ($produtos as $p): ?>
              <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nome']) ?></td>
                <td><?= number_format($p['preco'], 2, ',', '.') ?></td>
                <td><?= htmlspecialchars($p['descricao']) ?></td>
                <td class="actions">
                  <a href="edit.php?id=<?= $p['id'] ?>" class="action-btn edit">✏️ Editar</a>
                  <a href="delete.php?id=<?= $p['id'] ?>" class="action-btn delete" onclick="return confirm('Tem certeza que deseja excluir este produto?')">🗑️ Excluir</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" style="text-align:center; color:#777;">Nenhum produto cadastrado.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="nav">
      <a href="../index.php">🏠 Início</a> |
      <a href="../logout.php">🚪 Sair</a>
    </div>
  </div>
</body>
</html>
