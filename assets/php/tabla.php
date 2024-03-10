<?php
// Recupera datos de Supabase
$supabaseUrl = getenv("REST_URL");
$supabaseKey = getenv("REST_PUBLIC_KEY");
$headers = array(
    'Content-Type: application/json',
    'apikey: ' . $supabaseKey,
    'Authorization: Bearer ' . $supabaseKey
);

// Realiza la solicitud HTTP a Supabase
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $supabaseUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

// Devuelve la respuesta al cliente (en formato JSON)
header('Content-Type: application/json');
echo $response;
?>
