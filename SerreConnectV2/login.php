<?php

session_start();

// Vérifiez si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez l'email et le mot de passe depuis le formulaire de connexion
    $email = $_POST['email'];
    $password = $_POST['password'];

    // URL de l'API de connexion
    $apiUrl = 'http://serreconnect.alwaysdata.net/LoginUser';

    // Préparez les données à envoyer à l'API
    $postData = [
        'email' => $email,
        'password' => $password,
    ];

    // Initialisez cURL
    $ch = curl_init($apiUrl);

    // Configurez les options cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    // Exécutez la requête
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Fermez la session cURL
    curl_close($ch);

    // Vérifiez s'il y a des erreurs
    if ($response === false) {
        $_SESSION['error'] = 'Une erreur est survenue lors de la tentative de connexion.';
        header('Location: ./index.php#loginModal');
    } else {
        // Decodez la réponse JSON
        $responseData = json_decode($response, true);

        // Vérifiez le succès de la connexion
        if ($responseData['success']) {
            // Connexion réussie, initialisez la session
            $_SESSION['user_id'] = $responseData['user']['id'];
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $responseData['user']['username']; // Récupérez le nom d'utilisateur
            $_SESSION['connected'] = true;
            $_SESSION['success'] = "Connexion réussie! Bienvenue " . htmlspecialchars($responseData['user']['username']) . "!";
            header('Location: ./index.php');
        } else {
            // Connexion échouée, affichez le message d'erreur
            $_SESSION['error'] = $responseData['message'];
            header('Location: ./index.php#loginModal');
        }
    }
} else {
    // Si le formulaire n'est pas soumis, redirigez l'utilisateur vers la page de connexion
    header('Location: ./index.php#loginModal');
}

exit();
?>
