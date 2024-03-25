<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // URL de la API de Supabase para insertar en espacios_publicos
    $usersDataInsert = $_ENV["REST_URL"] . "/rest/v1/users";

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

    // Configurar la solicitud HTTP a Supabase para insertar datos
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json\r\n" .
                        "apikey: $supabaseKey\r\n" .
                        "Prefer: return=representation\r\n", // Header para que Supabase devuelva los datos de la fila insertada
            'method' => 'POST',
            'content' => $data_json, // Datos a insertar
        ),
    );

    // Realizar la solicitud HTTP
    $usersContext = stream_context_create($options);
    $usersresponse = file_get_contents($usersDataInsert, false, $usersContext);

    if ($usersresponse !== FALSE) {
        // La solicitud fue exitosa
        echo "Registro exitoso. Por favor inicie sesión.";
    } else {
        // La solicitud falló, mostrar mensaje de error
        echo "Error al registrar los datos del usuario.";
    }
} else {
    echo "<h2>Método de solicitud no soportado.</h2>";
}
?>
