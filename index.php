<?php
//Intento de conexión al servidor
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
