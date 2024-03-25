<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // URL de la API de Supabase para insertar en espacios_publicos
    $supabaseUrl = $_ENV["REST_URL"] . "/auth/v1/token?grant_type=password";

    // Clave pública de la API de Supabase
    $supabaseKey = getenv("REST_PUBLIC_KEY");

    $curl = curl_init($supabaseUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
        'email'=> $_POST['correo'],
        'password'=> $_POST['password'],
    ]));

    //Realizar la solicitud y decodificar la respuesta

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($httpCode === 200) {
        // La solicitud fue exitosa, procede a decodificar la respuesta JSON
        $responseData = json_decode($response,true);

        if(isset($responseData["access_token"])){

            //Inicio de sesión exitoso
            $accessToken = $responseData["access_token"];

            if(isset($accessToken)){

                if(session_status() === PHP_SESSION_NONE){
                    session_start();
                }

                if (isset($_SESSION['user_token'])) {
                    // El usuario tiene un token de sesión válido, mostrar contenido sensible
                    header("Location: /paginas/tabla.html");
                } else {
                    // El usuario no tiene un token de sesión válido, redirigir al inicio de sesión
                    header("Location: /index.html");
                    exit;
                }
            }

        }else{
            echo "Error: No se recibió un token de acceso en la respuesta.";
        }

    } else {
        // Manejar el error de solicitud HTTP
        echo "Error en la solicitud HTTP: " . $httpCode;
        echo "Error CURL: " . curl_error($curl);
    }

    

} else {
    echo "<h2>Método de solicitud no soportado.</h2>";
}
?>
