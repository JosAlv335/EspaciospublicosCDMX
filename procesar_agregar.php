<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $servername = "ec2-52-54-200-216.compute-1.amazonaws.com";
    $username = "rzcndrfatvphqy"; // Cambia esto por tu nombre de usuario
    $password = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0"; // Cambia esto por tu contraseña
    $dbname = "d2em42nge4v4em";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Recuperar los datos del formulario
    $estado = $_POST['estado'];
    $ciudad_municipio = $_POST['ciudad_municipio'];
    $colonia = $_POST['colonia'];
    $calle = $_POST['calle'];
    $nombre = $_POST['nombre'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO datos (estado, ciudad_municipio, colonia, calle, nombre) VALUES ('$estado', '$ciudad_municipio', '$colonia', '$calle', '$nombre')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
