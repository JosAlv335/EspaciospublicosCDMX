<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Credenciales de Acceso a la base de datos
    $servername = "ec2-52-54-200-216.compute-1.amazonaws.com";
    $username = "rzcndrfatvphqy"; 
    $password = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0"; 
    $dbname = "d2em42nge4v4em";
    $port = "5432";

    // Crear cadena de conexión DSN para PostgreSQL
    $dsn = "pgsql:host=$servername;port=$port;dbname=$dbname;user=$username;password=$password";

    try {
        // Crear la conexión usando PDO
        $conn = new PDO($dsn);

        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recuperar los datos del formulario
        $estado = $_POST['estado'];
        $ciudad_municipio = $_POST['ciudad_municipio'];
        $colonia = $_POST['colonia'];
        $calle = $_POST['calle'];
        $nombre = $_POST['nombre'];

        // Preparar la consulta SQL usando sentencias preparadas
        $sql = "INSERT INTO datos (estado, ciudad_municipio, colonia, calle, nombre) VALUES (?, ?, ?, ?, ?)";

        // Preparar la sentencia
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(1, $estado);
        $stmt->bindParam(2, $ciudad_municipio);
        $stmt->bindParam(3, $colonia);
        $stmt->bindParam(4, $calle);
        $stmt->bindParam(5, $nombre);

        // Ejecutar la sentencia
        $stmt->execute();

        echo "Registro agregado exitosamente";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>
