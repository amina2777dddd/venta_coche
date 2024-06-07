<!DOCTYPE html>
<html>
<head>
    <title>Subir Imagen</title>
</head>
<body>
    <form action="prueba.php" method="post" enctype="multipart/form-data">
        <label for="name">Nombre de la Imagen:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="image">Seleccionar Imagen:</label>
        <input type="file" name="image" id="image" required>
        <br>
        <input type="submit" name="submit" value="Subir Imagen">
    </form>
</body>
</html>