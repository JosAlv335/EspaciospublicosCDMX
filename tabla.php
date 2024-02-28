<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto por tu nombre de usuario
$password = ""; // Cambia esto por tu contraseña
$dbname = "parques";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos
$sql = "SELECT id, estado, ciudad_municipio, colonia, calle, nombre, activo, usuario_activos FROM datos";
$result = $conn->query($sql);

// Mostrar los datos en la tabla
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Estado</th><th>Ciudad/Municipio</th><th>Colonia</th><th>Calle</th><th>Nombre</th><th>Activo</th><th>Usuarios Activos</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["estado"]."</td><td>".$row["ciudad_municipio"]."</td><td>".$row["colonia"]."</td><td>".$row["calle"]."</td><td>".$row["nombre"]."</td><td>".$row["activo"]."</td><td>".$row["usuario_activos"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
$conn->close();
?>
