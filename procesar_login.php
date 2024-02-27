<?php
// Datos de conexión a la base de datos
$servidor = "ec2-52-54-200-216.compute-1.amazonaws.com";
$usuario = "rzcndrfatvphqy";
$clave = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0";
$baseDeDatos = "d2em42nge4v4em";

// Cadena de conexión
$dsn = "pgsql:host=$servidor;dbname=$baseDeDatos";

// Intentar establecer la conexión con la base de datos
try {
    $enlace = new PDO($dsn, $usuario, $clave);
    $enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar: " . $e->getMessage());
}

if (isset($_POST["login"])) {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta SQL para obtener el usuario por correo electrónico
    // Uso de consultas preparadas para evitar inyección SQL
    $consultaUsuario = $enlace->prepare("SELECT * FROM Login WHERE correo = :correo");
    $consultaUsuario->bindParam(':correo', $correo, PDO::PARAM_STR);
    $consultaUsuario->execute();

    if ($consultaUsuario->rowCount() > 0) {
        // Usuario encontrado, verificar la contraseña
        $usuario = $consultaUsuario->fetch(PDO::FETCH_ASSOC);
        echo "Contraseña almacenada en la base de datos: " . $usuario['contraseña'] . "<br>";

        // Comparar contraseñas
        if (password_verify($contraseña, $usuario['contraseña'])) {
            // Contraseña correcta
            session_start();
            $_SESSION['usuario'] = $usuario['nombre']; // Guardar información del usuario en la sesión
            header("Location: inicio.php"); // Redirigir a la página de inicio
            exit;
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta";
        }
    } else {
        // Usuario no encontrado
        echo "Correo electrónico no registrado";
    }
}
?>
