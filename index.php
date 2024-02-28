<?php
/*
Credenciales de acceso al servidor
*/
$servidor = "ec2-52-54-200-216.compute-1.amazonaws.com"; // Ajusta a tu servidor
$puerto = "5432";
$baseDeDatos = "d2em42nge4v4em"; // Ajusta al nombre de tu base de datos
$usuario = "rzcndrfatvphqy"; // Ajusta a tu usuario
$clave = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0"; // Ajusta a tu contraseña
$dsn = "pgsql:host=$servidor;port=$puerto;dbname=$baseDeDatos;user=$usuario;password=$clave";

//Intento de conexión al servidor
try {
    $enlace = new PDO($dsn);
    $enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar: " . $e->getMessage());
}

//Consulta el correo al registrarse
if (isset($_POST["registro"])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta para verificar si el correo ya existe
    $consultaCorreo = "SELECT correo FROM Login WHERE correo=:correo";
    $stmt = $enlace->prepare($consultaCorreo);
    $stmt->execute(['correo' => $correo]);

    if ($stmt->rowCount() > 0) {
        echo "El correo electrónico ya está registrado. Por favor, utiliza otro correo.";
    } else {
        // El correo no existe, insertar los datos en la base de datos
        $insertarDatos = "INSERT INTO Login (nombre, correo, contraseña) VALUES (:nombre, :correo, :contraseña)";
        $stmt = $enlace->prepare($insertarDatos);
        $resultado = $stmt->execute(['nombre' => $nombre, 'correo' => $correo, 'contraseña' => $contraseña]);

        if ($resultado) {
            header("Location: tabla.php");
            exit();
        } else {
            echo "Error al registrar. Por favor, intenta nuevamente.";
        }
    }
}

if (isset($_POST["login"])) {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta para verificar si el correo y la contraseña coinciden
    $consultaUsuario = "SELECT * FROM Login WHERE correo=:correo AND contraseña=:contraseña";
    $stmt = $enlace->prepare($consultaUsuario);
    $stmt->execute(['correo' => $correo, 'contraseña' => $contraseña]);

    if ($stmt->rowCount() == 1) {
        header("Location: tabla.html");
        exit();
    } else {
        echo "Correo electrónico o contraseña incorrectos. Por favor, intenta nuevamente.";
    }
}
?>
