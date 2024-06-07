<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));

    // Conexión a la base de datos
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'test_db';

    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($db->connect_error) {
        die("Conexión fallida: " . $db->connect_error);
    }

    // Insertar imagen en la base de datos
    $insert = $db->query("INSERT INTO images (name, image) VALUES ('$name', '$imgContent')");

    if ($insert) {
        echo "Imagen subida exitosamente.";
    } else {
        echo "Falló la subida de la imagen, por favor intenta de nuevo.";
    }

    $db->close();
}
?>