<?php
session_start();

// Vérifie si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if (empty($username) || empty($email) || empty($phone) || empty($password)) {
        $_SESSION['error'] = "Tous les champs sont requis.";
        header("Location: ./index.php#registerModal");
        exit;
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: ./index.php#registerModal");
        exit;
    }

    $apiData = [
        'username' => $username,
        'email' => $email,
        'phone' => $phone,
        'password' => $password,
    ];

    $apiUrl = 'http://serreconnect.alwaysdata.net/AddUsers';
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $apiResponse = curl_exec($ch);

    if ($apiResponse === false) {
        $_SESSION['error'] = 'Erreur cURL : ' . curl_error($ch);
        curl_close($ch);
        header("Location: ./index.php#registerModal");
        exit;
    }

    curl_close($ch);
    $responseData = json_decode($apiResponse, true);

    if (isset($responseData['message']) && $responseData['message'] === "User entry created successfully") {
        $_SESSION['username'] = $username;
        $_SESSION['connected'] = true;
        $_SESSION['success'] = "Inscription réussie. Bienvenue " . $username . "!";
        header('Location: ./index.php');
        exit;
    } else {
        $_SESSION['error'] = isset($responseData['message']) ? $responseData['message'] : "Une erreur inconnue est survenue lors de l'inscription.";
        header("Location: ./index.php#registerModal");
        exit;
    }
} else {
    header("Location: ./index.php#registerModal");
    exit;
}
?>
