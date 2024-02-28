<?php
// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root"; // Cambiar por tu nombre de usuario
    $password = ""; // Cambiar por tu contraseña
    $dbname = "parques";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Recibir datos del formulario
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    $ciudad_municipio = $_POST['ciudad_municipio'];
    $colonia = $_POST['colonia'];
    $calle = $_POST['calle'];
    $nombre = $_POST['nombre'];

    // Preparar la consulta SQL para actualizar
    $sql = "UPDATE datos 
            SET estado='$estado', ciudad_municipio='$ciudad_municipio', colonia='$colonia', calle='$calle', nombre='$nombre'
            WHERE id='$id'";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado correctamente";
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>
