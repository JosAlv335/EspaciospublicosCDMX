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
        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];
        $municipio_delegacion = $_POST['municipio_delegacion'];
        $asentamiento = $_POST['asentamiento'];
        $calle = $_POST['calle'];
        $entre_calles = $_POST['entCalles'];
        $num_ext = $_POST['numExt'];
        $num_int = $_POST['numInt'];
        $codigo_postal = $_POST['codigo_postal'];
        $horario_inicio = $_POST['horario-inicio'];
        $horario_fin = $_POST['horario-fin'];
        $tipo_espacio = $_POST['horario-espacio'];

        // Preparar la consulta SQL para actualizar usando sentencias preparadas
        $sql = "UPDATE datos SET nombre=?, estado=?, municipio_delegacion=?, asentamiento=?, calle=?, entre_calles=?, num_ext=?, num_int=?, codigo_postal=?, horario_inicio=?, horario_fin=?, tipo_espacio=? WHERE id=?";

        // Preparar la sentencia
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros a la sentencia
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $estado);
        $stmt->bindParam(3, $municipio_delegacion);
        $stmt->bindParam(4, $asentamiento);
        $stmt->bindParam(5, $calle);
        $stmt->bindParam(6, $entre_calles);
        $stmt->bindParam(7, $num_ext);
        $stmt->bindParam(8, $num_int);
        $stmt->bindParam(9, $codigo_postal);
        $stmt->bindParam(10, $horario_inicio);
        $stmt->bindParam(11, $horario_fin);
        $stmt->bindParam(12, $tipo_espacio);
        $stmt->bindParam(13, $id);

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
