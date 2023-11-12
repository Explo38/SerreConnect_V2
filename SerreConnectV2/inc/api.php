<?php
$url = "http://serreconnect.alwaysdata.net";

// Initialisation de cURL
$ch = curl_init();

// Configuration des options de cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Exécution de la session cURL
$response = curl_exec($ch);

// Fermeture de la session cURL
curl_close($ch);

// Vous pouvez maintenant traiter la réponse de l'API
$data = json_decode($response, true);
?>
