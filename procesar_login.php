<?php

try {
    $enlace = new PDO($dsn);
    $enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar: " . $e->getMessage());
}

if (isset($_POST["login"])) {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta SQL para obtener el usuario por correo electrónico
    $consultaUsuario = "SELECT * FROM users WHERE correo = :correo";
    $stmt = $enlace->prepare($consultaUsuario);
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        // Usuario encontrado, verificar la contraseña
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Contraseña almacenada en la base de datos: " . $usuario['contraseña'] . "<br>";

        // Imprimir la longitud de ambas contraseñas para verificar si son iguales
        echo "Longitud de la contraseña almacenada: " . strlen($usuario['contraseña']) . "<br>";
        echo "Longitud de la contraseña proporcionada: " . strlen($contraseña) . "<br>";

        // Comparar contraseñas
        if (password_verify($contraseña, $usuario['contraseña'])) {
            // Contraseña correcta
            session_start();
            $_SESSION['usuario'] = $usuario['nombre']; // Guardar información del usuario en la sesión
            header("Location: tabla.html"); // Redirigir a la página de inicio
            exit();
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
