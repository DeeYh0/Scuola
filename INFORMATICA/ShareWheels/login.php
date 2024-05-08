<?php
session_start(); // Avvia la sessione

// Connessione al database
$servername = "localhost";
$username = "admin"; // Inserisci il tuo nome utente del database
$password = "admin"; // Inserisci la tua password del database
$dbname = "car-pooling"; // Inserisci il nome del tuo database

$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Ottieni le variabili dalla richiesta POST
$email = $_POST['email'];
$password = $_POST['password'];

// Query per controllare se l'utente esiste come passeggero
$sql_passeggero = "SELECT * FROM Passeggeri WHERE email = '$email' AND password = '$password'";
$result_passeggero = $conn->query($sql_passeggero);

// Query per controllare se l'utente esiste come autista
$sql_autista = "SELECT * FROM Autisti WHERE email = '$email' AND password = '$password'";
$result_autista = $conn->query($sql_autista);

if ($result_passeggero->num_rows > 0) {
    // Utente trovato come passeggero
    $row = $result_passeggero->fetch_assoc();
    $_SESSION['user_type'] = 'passeggero';
    $_SESSION['email'] = $row['email'];
    echo "Benvenuto, sei un passeggero!";
    // Esegui il reindirizzamento per il passeggero
} elseif ($result_autista->num_rows > 0) {
    // Utente trovato come autista
    $row = $result_autista->fetch_assoc();
    $_SESSION['user_type'] = 'autista';
    $_SESSION['email'] = $row['email']; 
    echo "Benvenuto, sei un autista!";
    // Esegui il reindirizzamento per l'autista
} else {
    // Utente non trovato o password errata
    echo "Email o password non valide.";
}

$conn->close();
