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

// Leer el cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

// Obtener los datos enviados
$usuario = isset($data['usuario']) ? $data['usuario'] : null;
$monto = isset($data['monto']) ? floatval($data['monto']) : null; // Asegúrate de convertir a float

// Obtener el saldo actual
$sql = "SELECT saldo FROM snaisor WHERE nombre = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($saldo);
$stmt->fetch();
$stmt->close();

// Verificar si el saldo es suficiente
if ($saldo >= $monto && $monto !== null) {
    $nuevoSaldo = $saldo - $monto;

    // Actualizar el saldo
    $sql = "UPDATE snaisor SET saldo = ? WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $nuevoSaldo, $usuario); // Cambiado a "ds" para manejar decimal
    $stmt->execute();
    $stmt->close();

    $respuesta = array('exito' => true, 'nuevoSaldo' => number_format($nuevoSaldo, 2, '.', '')); // Formatear nuevo saldo
} else {
    $respuesta = array('exito' => false, 'mensaje' => 'Saldo insuficiente');
}

$conn->close();

// Enviar la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($respuesta);
?>
