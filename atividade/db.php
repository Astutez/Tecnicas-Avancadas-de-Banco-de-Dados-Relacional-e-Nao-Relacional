<?php
// db.php — configuração de conexão com o banco de dados
// Adapte as credenciais conforme seu ambiente

define('DB_HOST', 'localhost');
define('DB_USER', 'ling2');
define('DB_PASS', '12345');
define('DB_NAME', 'faculdade');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            die('<div style="font-family:sans-serif;padding:2rem;color:#f87171;background:#1a0a0a;">
                  <strong>Erro de conexão:</strong> ' . htmlspecialchars($e->getMessage()) . '
                 </div>');
        }
    }
    return $pdo;
}

// Helpers
function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

function flash(string $key, string $msg): void {
    $_SESSION[$key] = $msg;
}

function getFlash(string $key): ?string {
    if (isset($_SESSION[$key])) {
        $msg = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $msg;
    }
    return null;
}
