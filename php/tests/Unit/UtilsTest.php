<?php
use PHPUnit\Framework\TestCase;

// Se tiver funções auxiliares, inclua aqui
// require_once __DIR__ . '/../../src/functions.php';

class UtilsTest extends TestCase
{
    public function testEmailValido()
    {
        $email = "teste@exemplo.com";
        $this->assertTrue(filter_var($email, FILTER_VALIDATE_EMAIL) !== false);
    }

    public function testSenhaForte()
    {
        $senha = "Senha123!";
        // Verifica se a senha tem pelo menos 8 caracteres e contém número
        $this->assertTrue(strlen($senha) >= 8 && preg_match('/\d/', $senha));
    }

    public function testSomaSimples()
    {
        $this->assertEquals(5, 2 + 3);
    }

    public function testStringContem()
    {
        $texto = "Olá mundo!";
        $this->assertStringContainsString("mundo", $texto);
    }
}

