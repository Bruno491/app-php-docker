<?php
$host = 'db';
$dbname = 'app_db';
$user = 'user';
$pass = 'password';
$port = 3306; // interno do container MySQL

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
