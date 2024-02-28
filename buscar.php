<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos de conexión a la base de datos PostgreSQL
    $servername = "ec2-52-54-200-216.compute-1.amazonaws.com";
    $username = "rzcndrfatvphqy"; // Cambiar por tu nombre de usuario
    $password = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0"; // Cambiar por tu contraseña
    $dbname = "d2em42nge4v4em";
    $port = "5432"; // Puerto por defecto de PostgreSQL

    // Cadena de conexión DSN para PostgreSQL
    $dsn = "pgsql:host=$servername;port=$port;dbname=$dbname;user=$username;password=$password";

    try {
        // Crear la conexión usando PDO
        $conn = new PDO($dsn);

        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recibir el nombre de la búsqueda y eliminar espacios
        $nombre_busqueda = str_replace(' ', '', $_POST['nombre']);

        // Preparar la consulta SQL para buscar registros que contengan el nombre (sin importar mayúsculas o minúsculas ni espacios)
        $sql = "SELECT * FROM datos WHERE REPLACE(LOWER(nombre), ' ', '') LIKE REPLACE(LOWER(?), ' ', '')";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, "%$nombre_busqueda%", PDO::PARAM_STR);
        $stmt->execute();

        // Mostrar resultados en una tabla si se encuentran registros
        if ($stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Estado</th><th>Ciudad/Municipio</th><th>Colonia</th><th>Calle</th><th>Nombre</th><th>Activo</th><th>Usuarios Activos</th></tr>";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["estado"]."</td><td>".$row["ciudad_municipio"]."</td><td>".$row["colonia"]."</td><td>".$row["calle"]."</td><td>".$row["nombre"]."</td><td>".$row["activo"]."</td><td>".$row["usuario_activos"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron resultados.";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>
