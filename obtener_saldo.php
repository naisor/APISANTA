<?php
$servername = "bojp7d3fjozselwgiclc-mysql.services.clever-cloud.com"; // Cambiar si no es localhost
$username = "uqqduhwebgsszseg";
$password = "yZ5eOuMuI5BXHZ3wt4GK";
$dbname = "bojp7d3fjozselwgiclc";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el nombre del usuario desde la URL
$usuario = $_GET['usuario'];

// Consultar el saldo
$sql = "SELECT saldo FROM snaisor WHERE nombre = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($saldo);
$stmt->fetch();

$stmt->close();
$conn->close();

// Enviar el saldo en formato JSON
header('Content-Type: application/json');
echo json_encode(array('saldo' => $saldo));
?>
