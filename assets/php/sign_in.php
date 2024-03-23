<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // URL de la API de Supabase para insertar en espacios_publicos
    $supabaseUrl = $_ENV["REST_URL"] . "/auth/v1/token";

    // Clave pública de la API de Supabase
    $supabaseKey = getenv("REST_PUBLIC_KEY");

    // Recoger los datos enviados desde el formulario
    $datos = [
        "nombre" => $_POST["nombre"] ?? "",
        "apellido1" => $_POST["apellido1"] ?? "",
        "apellido2" => $_POST["apellido2"] ?? "",
        "correo" => $_POST["correo"] ?? "",
        "contrasena" => $_POST["password"] ?? ""
    ];

    // Convertir los datos a JSON
    $data_json = json_encode($datos);

    $curl = curl_init($supabaseUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
        'email'=> $_POST['email'],
        'password'=> $_POST['password'],
        'grant_type' => 'password'
    ]));

    //Realizar la solicitud y decodificar la respuesta

    $response = curl_exec($curl);
    $responseData = json_decode($response,true);

    if(isset($responseData["access_token"])){

        //Inicio de sesión exitoso
        $accessToken = $responseData["access_token"];

        if(isset($accessToken)){

            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            //Almacenar el token en una variable de sesión:
            $_SESSION['user_token'] = $accessToken;

            //Redirigir a la página principal
            header("Location: /paginas/tabla.html");
            exit;
        }

    }else{
        echo "Inicio de sesión erróneo";
    }

} else {
    echo "<h2>Método de solicitud no soportado.</h2>";
}
?>
