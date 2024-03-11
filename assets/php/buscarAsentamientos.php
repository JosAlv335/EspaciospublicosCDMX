<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // URL de la API de Supabase
    $supabaseUrl = $_ENV["REST_URL"] . "/rest/v1/catalogo_Direcciones";
    // Clave pública de la API de Supabase
    $supabaseKey = getenv("REST_PUBLIC_KEY");

    // Recibir el nombre de la búsqueda y eliminar espacios
    $nombre_busqueda = isset($_GET["codigoPostal"]) ? $_GET["codigoPostal"] : "";

    // Configurar la solicitud HTTP a Supabase
    $url = $supabaseUrl . '?codigo_postal=like.' . urlencode($nombre_busqueda) . '*';
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json\r\n" . "apikey: $supabaseKey\r\n",
            'method' => 'GET'
        )
    );

    // Realizar la solicitud HTTP
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Verificar si la solicitud fue exitosa
    if ($response === FALSE) {
        echo "$supabaseUrl - URL";
        echo "$supabaseKey - Key";
        echo "$options - options";
        echo "Error al realizar la solicitud HTTP.";
    } else {
        // Decodificar la respuesta JSON
        $data = json_decode($response, true);
    
        // Inicializar los arrays para almacenar los datos
        $datos_estados = array();
        $datos_municipios = array();
        $datos_asentamientos = array();
    
        // Recorrer los datos recibidos y almacenarlos en los arrays correspondientes
        foreach ($data as $row) {
            // Almacena los estados
            $estado = $row['estado'];echo "<script>console.log('" . $estado . "'</script>";
            if (!in_array($estado, $datos_estados)) {
                $datos_estados[] = $estado;
            }
    
            // Almacena los municipios/delegaciones
            $municipio = $row['municipio'];
            if (!in_array($municipio, $datos_municipios)) {
                $datos_municipios[] = $municipio;
            }
    
            // Almacena los asentamientos
            $asentamiento = $row['asentamiento'];
            if (!in_array($asentamiento, $datos_asentamientos)) {
                $datos_asentamientos[] = $asentamiento;
            }
        }
    
        // Construir el array para la respuesta JSON
        $respuesta_json = array(
            'estados' => $datos_estados,
            'municipios' => $datos_municipios,
            'asentamientos' => $datos_asentamientos
        );
    
        // Convertir el array a formato JSON y devolverlo
        echo json_encode($respuesta_json);
    }

} else {
    echo "<h2>No matches found...</h2>";
}
?>
