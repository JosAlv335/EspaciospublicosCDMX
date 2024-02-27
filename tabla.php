<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parques y Espacios Públicos Deportivos</title>
    <link rel="stylesheet" href="tabla.css">
</head>
<body>
    <header>
        <h1>Parques</h1>
        <h2>Espacios Públicos Deportivos</h2>
    </header>
    <nav>
        <!-- Redirigir los botones a las páginas correspondientes -->
        <button onclick="window.location.href='buscar.php'">Buscar</button>
        <button onclick="window.location.href='actualizar.php'">Actualizar</button>
        <button onclick="window.location.href='agregar.php'">Agregar</button>
    </nav>
    <main>
        <?php
        // Conexión a la base de datos
        $servername = "ec2-52-54-200-216.compute-1.amazonaws.com";
        $username = "rzcndrfatvphqy";
        $password = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0";
        $dbname = "d2em42nge4v4em";

        // Crear conexión
        $conn = new PDO("pgsql:host= $servername; dbname=$dbname", "$username", "$password");

        // Verificar conexión
        $errorInfo = $conn->errorInfo();
        if ($errorInfo[0] !== PDO::ERR_NONE) {
            die("Error de conexión: " . $conn->errorCode());
        }

        // Consulta SQL para obtener los datos
        $consultaTabla = "SELECT id, estado, ciudad_municipio, colonia, calle, nombre, activo, usuario_activos FROM datos";
        $result = $conn->query($consultaTabla);

        // Mostrar los datos en la tabla
        // Intentar fetch los datos directamente
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Si hay al menos una fila, imprimir la cabecera de la tabla
            echo "<table>";
            echo "<tr><th>ID</th><th>Estado</th><th>Ciudad/Municipio</th><th>Colonia</th><th>Calle</th><th>Nombre</th><th>Activo</th><th>Usuarios Activos</th></tr>";

            // Imprimir la primera fila
            echo "<tr><td>".$row["id"]."</td><td>".$row["estado"]."</td><td>".$row["ciudad_municipio"]."</td><td>".$row["colonia"]."</td><td>".$row["calle"]."</td><td>".$row["nombre"]."</td><td>".$row["activo"]."</td><td>".$row["usuario_activos"]."</td></tr>";

            // Continuar imprimiendo el resto de filas
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["estado"]."</td><td>".$row["ciudad_municipio"]."</td><td>".$row["colonia"]."</td><td>".$row["calle"]."</td><td>".$row["nombre"]."</td><td>".$row["activo"]."</td><td>".$row["usuario_activos"]."</td></tr>";
            }
            echo "</table>";
        } else {
            // Si no hay filas, imprimir un mensaje
            echo "0 resultados";
        }
        $conn = null;
        ?>
    </main>
</body>
</html>
