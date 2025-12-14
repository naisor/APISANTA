<?php
$servername = "bojp7d3fjozselwgiclc-mysql.services.clever-cloud.com"; // Cambiar si no es localhost este es Clever Cloud
$username = "uqqduhwebgsszseg";
$password = "yZ5eOuMuI5BXHZ3wt4GK";
$dbname = "bojp7d3fjozselwgiclc";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los usuarios con saldo mayor a 0
$sql = "SELECT nombre FROM snaisor WHERE saldo >= 0";
$result = $conn->query($sql);

$usuarios = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $usuarios[] = $row['nombre'];
    }
}

$conn->close();

// Enviar el resultado en formato JSON
header('Content-Type: application/json');
echo json_encode($usuarios);
?>
