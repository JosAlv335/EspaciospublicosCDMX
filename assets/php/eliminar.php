<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //Se obtiene el ID del registro a eliminar
    $idRegistroAEliminar = $_POST['id']; 
    $supabaseUrl = $_ENV["REST_URL"] . "/rest/v1/espacios_publicos?id=eq." . $idRegistroAEliminar;

    // Clave pública de la API de Supabase
    $supabaseKey = getenv("REST_PUBLIC_KEY");

    // Configurar la solicitud HTTP a Supabase para eliminar datos
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json\r\n" .
                        "apikey: $supabaseKey\r\n",
            'method' => 'DELETE',
        ),
    );

    // Realizar la solicitud HTTP
    $context = stream_context_create($options);
    $response = file_get_contents($supabaseUrl, false, $context);

    // Verificar si la solicitud fue exitosa
    if ($response === FALSE) {
        if (isset($http_response_header)) {
            echo "Headers de respuesta: \n";
            print_r($http_response_header);
        }
        echo "Error al realizar la solicitud HTTP.";
    } else {
        // La respuesta incluye los detalles de la operación de eliminación, la mostramos (o procesamos según sea necesario)
        echo $response;
    }
} else {
    echo "<h2>Método de solicitud no soportado.</h2>";
}
?>
