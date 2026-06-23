<?php
// Connexion à la base
$servername = "localhost";
$username   = "root";       // adapte selon ton environnement
$password   = "";           // mot de passe MySQL
$dbname     = "sol";        // ta base

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupère les données du formulaire
$nom     = $_POST['nom'];
$prenom  = $_POST['prenom'];
$email   = $_POST['email'];
$pass    = $_POST['password'];

// ⚠️ Sécurité : hacher le mot de passe
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

// Prépare la requête
$stmt = $conn->prepare("INSERT INTO user (id, nom, prenom, email, password) VALUES (NULL, ?, ?, ?, ?)");
$stmt->bind_param("ssss", $nom, $prenom, $email, $hashedPassword);

// Exécute
if ($stmt->execute()) {
    echo "Utilisateur ajouté avec succès !";
} else {
    echo "Erreur: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
