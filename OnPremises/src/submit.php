<?php
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'presentacion';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$nombre = trim($_POST['nombre'] ?? '');
$correo = trim($_POST['correo'] ?? '');

if ($nombre === '' || $correo === '') {
    header('Location: index.php?error=1');
    exit;
}

$stmt = $conn->prepare('INSERT INTO contactos (nombre, correo) VALUES (?, ?)');
$stmt->bind_param('ss', $nombre, $correo);

if ($stmt->execute()) {
    header('Location: index.php?ok=1&id=' . $conn->insert_id);
} else {
    header('Location: index.php?error=1');
}

$stmt->close();
$conn->close();
