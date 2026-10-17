<?php
header('Content-Type: application/json; charset=utf-8');

function respond($ok, $extra = [])
{
    echo json_encode(array_merge(['ok' => $ok], $extra));
    exit;
}

$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'presentacion';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    respond(false, ['message' => 'Error de conexión con la base de datos.']);
}

$nombre = trim($_POST['nombre'] ?? '');
$correo = trim($_POST['correo'] ?? '');

if ($nombre === '' || $correo === '') {
    respond(false, ['message' => 'Nombre y correo son obligatorios.']);
}

$stmt = $conn->prepare('INSERT INTO contactos (nombre, correo) VALUES (?, ?)');
$stmt->bind_param('ss', $nombre, $correo);

if ($stmt->execute()) {
    respond(true, ['id' => $conn->insert_id]);
}

$stmt->close();
$conn->close();

respond(false, ['message' => 'No se pudo guardar el registro.']);
