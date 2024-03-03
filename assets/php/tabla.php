<?php
// Datos de conexión a la base de datos PostgreSQL
$servername = "ec2-52-54-200-216.compute-1.amazonaws.com";
$username = "rzcndrfatvphqy";
$password = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0";
$dbname = "d2em42nge4v4em";
$port = "5432";

// Crear cadena de conexión DSN para PostgreSQL
$dsn = "pgsql:host=$servername;port=$port;dbname=$dbname;user=$username;password=$password";

try {
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

    // Consulta SQL para obtener los datos
    $sql = "SELECT id, estado, ciudad_municipio, colonia, calle, nombre, activo, usuarios_activos FROM datos";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Ejecutar la sentencia
    $stmt->execute();

    // Establecer el modo de fetch a asociativo
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Verificar si hay filas (registros) devueltas
    if($stmt->rowCount() > 0) {
        echo '<table class=mainTable>';
        echo "<tr><th>ID</th><th>Estado</th><th>Ciudad/Municipio</th><th>Colonia</th><th>Calle</th><th>Nombre</th><th>Activo</th><th>Usuarios Activos</th></tr>";
        // Obtener los resultados y mostrar en la tabla
        foreach($stmt->fetchAll() as $row) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["estado"]."</td><td>".$row["ciudad_municipio"]."</td><td>".$row["colonia"]."</td><td>".$row["calle"]."</td><td>".$row["nombre"]."</td><td>".$row["activo"]."</td><td>".$row["usuarios_activos"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 resultados";
    }
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Cerrar la conexión
$conn = null;
?>
