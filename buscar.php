<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $servername = "ec2-52-54-200-216.compute-1.amazonaws.com";
    $username = "rzcndrfatvphqy"; // Cambiar por tu nombre de usuario
    $password = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0"; // Cambiar por tu contraseña
    $dbname = "d2em42nge4v4em";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Recibir el nombre de la búsqueda y eliminar espacios
    $nombre_busqueda = str_replace(' ', '', $_POST['nombre']);

    // Preparar la consulta SQL para buscar registros que contengan el nombre (sin importar mayúsculas o minúsculas ni espacios)
    $sql = "SELECT * FROM datos WHERE REPLACE(LOWER(nombre), ' ', '') LIKE REPLACE(LOWER('%$nombre_busqueda%'), ' ', '')";
    $result = $conn->query($sql);

    // Mostrar resultados en una tabla si se encuentran registros
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Estado</th><th>Ciudad/Municipio</th><th>Colonia</th><th>Calle</th><th>Nombre</th><th>Activo</th><th>Usuarios Activos</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["estado"]."</td><td>".$row["ciudad_municipio"]."</td><td>".$row["colonia"]."</td><td>".$row["calle"]."</td><td>".$row["nombre"]."</td><td>".$row["activo"]."</td><td>".$row["usuario_activos"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados.";
    }

    // Cerrar conexión
    $conn->close();
}
?>
