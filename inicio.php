<?php

$servidor = "ec2-52-54-200-216.compute-1.amazonaws.com";
$usuario = "rzcndrfatvphqy";
$clave = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0";
$baseDeDatos = "d2em42nge4v4em";
try{
    $enlace = pg_connect("pgsql:host= $servidor; dbname=$baseDeDatos user=$usuario password=$clave");
}catch(PDOException $e){
    die("Error de conexion: ". $e->getMessage());
}
if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL.";
    exit;
}

if (isset($_POST["registro"])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta para verificar si el correo ya existe
    $consultaCorreo = "SELECT correo FROM users WHERE correo='$correo'";
    //$resultado = mysqli_query($enlace, $consultaCorreo);
    $resultado = pg_query($enlace,$consultaCorreo);

    // Verificar si se encontraron resultados (correo ya existe)
    if (pg_num_rows($resultado) > 0) {
        echo "El correo electrónico ya está registrado. Por favor, utiliza otro correo.";
    } else {
        // El correo no existe, insertar los datos en la base de datos
        $insertarDatos = "INSERT INTO Login VALUES ('$nombre', '$correo', '$contraseña', '')";
        $ejecutarInsertar = pg_query($enlace, $insertarDatos);

        // Verificar si se pudo insertar correctamente
        if ($ejecutarInsertar) {
            // Redirigir a tabla.php si se insertó correctamente
            header("Location: tabla.php");
            exit(); // Terminar el script para evitar que se siga ejecutando código innecesario
        } else {
            echo "Error al registrar. Por favor, intenta nuevamente.";
        }
    }
}

?>
