<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $baseDeDatos = "loginep";

    $enlace = mysqli_connect ($servidor, $usuario, $clave, $baseDeDatos);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="master.css">
    <title>Form login</title>
</head>

<body>
    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenido</h2>
                <p>Para unirte a nuestra comunidad Inicia
                    Sesión</p>
                <input type="button" value="Iniciar Sesión" id="sign-in">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Crear una Cuenta</h2>
                <!--<div class="icons">
                    <i class='bx bxl-google'></i>
                    <i class='bx bxl-github'></i>
                    <i class='bx bxl-linkedin-square'></i>
                </div>--> 
                <p>o usa tu e-mail para registrarte</p>
                <form action ="#" name ="loginep" method="post" class="form">
                    <label>
                        <i class='bx bx-user'></i>
                        <input type="text" name="nombre" placeholder="Nombre Completo">
                    </label>
                    <label>
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="correo" placeholder="Correo Electrónico">
                    </label>
                    <label>
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" name="contraseña" placeholder="Contraseña">
                    </label>
                    <input type="submit" name="registro">
                    <input type="reset">
                </form>
            </div>
        </div>
    </div>




    <div class="container-form login hide">
        <div class="information">
            <div class="info-childs">
                <h2>Regresaste de nuevo</h2>
                <p>Para unirte a nuestra comunidad Inicia
                    Sesión</p>
                <input type="button" value="Registrarse" id="sign-up">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>
                <div class="icons">
                    <i class='bx bxl-google'></i>
                    <i class='bx bxl-github'></i>
                    <i class='bx bxl-linkedin-square'></i>
                </div>
                <p>o iniciar sesión con una cuenta</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
                    <label>
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="correo" placeholder="Correo Electrónico">
                    </label>
                    <label>
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" name="contraseña" placeholder="Contraseña">
                    </label>
                    <input type="submit" name="login" value="Iniciar Sesión">
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

</body>

</html>

<?php

if(isset($_POST["registro"])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta para verificar si el correo ya existe
    $consultaCorreo = "SELECT correo FROM Login WHERE correo='$correo'";
    $resultado = mysqli_query($enlace, $consultaCorreo);

    // Verificar si se encontraron resultados (correo ya existe)
    if(mysqli_num_rows($resultado) > 0) {
        echo "El correo electrónico ya está registrado. Por favor, utiliza otro correo.";
    } else {
        // El correo no existe, insertar los datos en la base de datos
        $insertarDatos = "INSERT INTO Login VALUES ('$nombre', '$correo', '$contraseña', '')";
        $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);

        // Verificar si se pudo insertar correctamente
        if($ejecutarInsertar) {
            // Redirigir a tabla.php si se insertó correctamente
            header("Location: tabla.php");
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
    $consultaUsuario = "SELECT * FROM Login WHERE correo='$correo' AND contraseña='$contraseña'";
    $resultado = mysqli_query($enlace, $consultaUsuario);

    // Verificar si se encontró un usuario con el correo y contraseña proporcionados
    if(mysqli_num_rows($resultado) == 1) {
        // Redirigir a tabla.php si el usuario y contraseña coinciden
        header("Location: tabla.php");
        exit(); // Terminar el script para evitar que se siga ejecutando código innecesario
    } else {
        echo "Correo electrónico o contraseña incorrectos. Por favor, intenta nuevamente.";
    }
}
?>
