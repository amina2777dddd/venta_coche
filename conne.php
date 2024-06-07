<?php
// Conexión a la base de datos
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'test_db';

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Conexión fallida: " . $db->connect_error);
}

// Recuperar la imagen de la base de datos
$result = $db->query("SELECT image FROM images WHERE id = 1");

if ($result->num_rows > 0) {
    $imgData = $result->fetch_assoc();
    header("Content-type: image/jpeg");
    echo $imgData['image'];
} else {
    echo "Imagen no encontrada.";
}

$db->close();
?>