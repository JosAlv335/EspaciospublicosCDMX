<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // URL de la API de Supabase
    $supabaseUrl = "https://zrwtmvescjmkdenhdaqh.supabase.co" . "/rest/v1/spacios_publicos";
    // Clave pública de la API de Supabase
    $supabaseKey = getenv("REST_PUBLIC_KEY");

    // Recibir el nombre de la búsqueda y eliminar espacios
    $nombre_busqueda = isset($_GET["nombre"]) ? $_GET["nombre"] : "";

    // Configurar la solicitud HTTP a Supabase
    $url = $supabaseUrl . '?nombre=ilike.' . urlencode($nombre_busqueda) . '*';
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
        echo "$supabaseURL - URL";
        echo "$supabaseKey - Key";
        echo "$options - options";
        echo "Error al realizar la solicitud HTTP.";
    } else {
        // Decodificar la respuesta JSON
        $data = json_decode($response, true);

        // Mostrar resultados en una tabla si se encuentran registros
        if (!empty($data)) {
            echo "<table>";
            echo "<tr>";
            foreach ($data[0] as $key => $value) {
                echo "<th>$key</th>"; // Mostrar el nombre de la columna como encabezado
            }
            echo "</tr>";
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>"; // Mostrar el valor de la celda
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron resultados.";
        }
    }
} else {
    echo "<h2>No matches found...</h2>";
}
?>
