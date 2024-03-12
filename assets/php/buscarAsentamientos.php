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
    
        // Obtener los estados, municipios y asentamientos
        foreach ($data as $row) {
            $estado = $row['Estado'];
            $municipio = $row['Municipio'];
            $asentamiento = $row['Asentamiento'];
    
            if (!in_array($estado, $datos_estados)) {
                $datos_estados[] = $estado;
            }
    
            if (!in_array($municipio, $datos_municipios)) {
                $datos_municipios[] = $municipio;
            }
    
            if (!in_array($asentamiento, $datos_asentamientos)) {
                $datos_asentamientos[] = $asentamiento;
            }
        }
    
        // Generar las opciones para los campos de selección
        $options_estados = '';
        foreach ($datos_estados as $estado) {
            $options_estados .= '<option value="' . htmlspecialchars($estado) . '">' . htmlspecialchars($estado) . '</option>';
        }
    
        $options_municipios = '';
        foreach ($datos_municipios as $municipio) {
            $options_municipios .= '<option value="' . htmlspecialchars($municipio) . '">' . htmlspecialchars($municipio) . '</option>';
        }
    
        $options_asentamientos = '';
        foreach ($datos_asentamientos as $asentamiento) {
            $options_asentamientos .= '<option value="' . htmlspecialchars($asentamiento) . '">' . htmlspecialchars($asentamiento) . '</option>';
        }
    
        // Devolver las opciones como un objeto JSON
        $opciones = array(
            'estados' => $options_estados,
            'municipios' => $options_municipios,
            'asentamientos' => $options_asentamientos
        );
    
        echo json_encode($opciones);
    }

} else {
    echo "<h2>No matches found...</h2>";
}
?>
