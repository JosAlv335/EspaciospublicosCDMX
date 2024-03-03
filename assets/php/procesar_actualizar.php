<?php
// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Credenciales de acceso a la base de datos
    $servername = "ec2-52-54-200-216.compute-1.amazonaws.com";
    $username = "rzcndrfatvphqy";
    $password = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0";
    $dbname = "d2em42nge4v4em";
    $port = "5432";

    // Cadena de conexión DSN para PostgreSQL
    $dsn = "pgsql:host=$servername;port=$port;dbname=$dbname;user=$username;password=$password";

    try {
        //Establecer conexión encriptada
        $db = parse_url(getenv("DATABASE_URL"));

        $conn = new PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));


        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recibir datos del formulario
        $id = $_POST['id'];
        $estado = $_POST['estado'];
        $ciudad_municipio = $_POST['ciudad_municipio'];
        $colonia = $_POST['colonia'];
        $calle = $_POST['calle'];
        $nombre = $_POST['nombre'];

        // Preparar la consulta SQL para actualizar usando sentencias preparadas
        $sql = "UPDATE datos SET estado=?, ciudad_municipio=?, colonia=?, calle=?, nombre=? WHERE id=?";

        // Preparar la sentencia
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros a la sentencia
        $stmt->bindParam(1, $estado);
        $stmt->bindParam(2, $ciudad_municipio);
        $stmt->bindParam(3, $colonia);
        $stmt->bindParam(4, $calle);
        $stmt->bindParam(5, $nombre);
        $stmt->bindParam(6, $id);

        // Ejecutar la sentencia
        $stmt->execute();

        echo "Registro actualizado correctamente";
    } catch(PDOException $e) {
        echo "Error al actualizar el registro: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>
