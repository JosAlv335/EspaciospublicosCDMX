<?php
//Credenciales de acceso al servidor
$servidor = "ec2-52-54-200-216.compute-1.amazonaws.com";
$puerto = "5432";
$usuario = "rzcndrfatvphqy";
$clave = "1c11fd7412c615db1fa8bc7dd5d5353650f3383ca6f549ee6cf92514cf392ab0";
$baseDeDatos = "d2em42nge4v4em";
$cadenaConexion = "host=$servidor port=$puerto dbname=$baseDeDatos user=$usuario password=$clave";
$enlace = pg_connect($cadenaConexion);

//Detecta si hubo algun error
if (!$enlace) {
    die("Error al conectar: " . pg_last_error());
}

//Busca el correo si es que existe para un nuevo registro
if(isset($_POST["registro"])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta para verificar si el correo ya existe
    $consultaCorreo = "SELECT correo FROM users WHERE correo='$correo'";
    $resultado = pg_query($enlace, $consultaCorreo);

    // Verificar si se encontraron resultados (correo ya existe)
    if(pg_num_rows($resultado) > 0) {
        echo "El correo electrónico ya está registrado. Por favor, utiliza otro correo.";
    } else {
        // El correo no existe, insertar los datos en la base de datos
        $insertarDatos = "INSERT INTO users (nombre, correo, contraseña) VALUES ('$nombre', '$correo', '$contraseña')";
        $ejecutarInsertar = pg_query($enlace, $insertarDatos);

        // Verificar si se pudo insertar correctamente
        if($ejecutarInsertar) {
            // Redirigir a index.html si se insertó correctamente
            header("Location: index.html");
            exit(); // Terminar el script para evitar que se siga ejecutando código innecesario
        } else {
            echo "Error al registrar. Por favor, intenta nuevamente.";
        }
    }
}

if(isset($_POST["login"])){
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta para verificar si el correo y la contraseña coinciden
    $consultaUsuario = "SELECT * FROM users WHERE correo='$correo' AND contraseña='$contraseña'";
    $resultado = pg_query($enlace, $consultaUsuario);

    // Verificar si se encontró un usuario con el correo y contraseña proporcionados
    if(pg_num_rows($resultado) == 1) {
        // Redirigir a index.html si el inicio de sesión fue exitoso
        header("Location: index.html");
        exit(); // Terminar el script para evitar que se siga ejecutando código innecesario
    } else {
        echo "Correo electrónico o contraseña incorrectos. Por favor, intenta nuevamente.";
    }
}
?>
