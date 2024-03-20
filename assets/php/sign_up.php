<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // URL de la API de Supabase para insertar en espacios_publicos
    $supabaseUrl = "https://zrwtmvescjmkdenhdaqh.supabase.co" . "/rest/v1/users";

    // Clave pública de la API de Supabase
    $supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Inpyd3RtdmVzY2pta2RlbmhkYXFoIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MDk2MDA2ODEsImV4cCI6MjAyNTE3NjY4MX0.nWS7r3cCN_xhpTehJk71wQ19C7JsBuhF66MamPHpNWs";

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
    $context = stream_context_create($options);
    $response = @file_get_contents($supabaseUrl, false, $context);

    if ($response === FALSE) {
        if (isset($http_response_header)) {
            echo "Headers de respuesta: \n";
            print_r($http_response_header);
        }
        echo "Error al registrar el usuario, intente de nuevo más tarde.";
    } else {
        //echo $response;
        echo "Inserción exitosa";
    }
} else {
    echo "<h2>Método de solicitud no soportado.</h2>";
}
?>
