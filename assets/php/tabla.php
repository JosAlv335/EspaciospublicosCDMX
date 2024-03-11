<?php
// Variables de entorno con las credenciales de Supabase
$supabaseUrl = getenv("REST_URL");
$supabaseKey = getenv("REST_PUBLIC_KEY");

// URL de la tabla en Supabase
$urlTabla = "{$supabaseUrl}/rest/v1/espacios_publicos";

// Configurar las cabeceras de la solicitud HTTP
$headers = array(
    'Content-Type: application/json',
    'apikey: ' . $supabaseKey,
    'Authorization: Bearer ' . $supabaseKey
);

// Inicializar cURL
$ch = curl_init();

// Configurar la solicitud cURL
curl_setopt($ch, CURLOPT_URL, $urlTabla);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Ejecutar la solicitud cURL
$response = curl_exec($ch);

// Cerrar cURL
curl_close($ch);

// Devolver la respuesta al cliente (en formato JSON)
header('Content-Type: application/json');
echo $response;
?>
