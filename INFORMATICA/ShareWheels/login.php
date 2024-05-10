<?php
session_start(); // Avvia la sessione

// Connessione al database
$servername = "localhost";
$username = "admin"; // Inserisci il tuo nome utente del database
$password = "admin"; // Inserisci la tua password del database
$dbname = "car-pooling"; // Inserisci il nome del tuo database

echo "<body style='background: #7a1de2; color: white; padding: 30px; border-radius: 10px; text-align: center; font-size: 18px;'>";


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
    $nome = $row['nome']; // Ottieni il nome del passeggero
    echo "<span style='color: white; font-size: 30px; font-weight: bold'>Benvenuto, $nome! <br> Stai per essere reindirizzato alla tua dashboard...</span>";
    echo "<script>setTimeout(function() { window.location.href = 'dashboardPasseggeri/passeggero.php'; }, 3000);</script>";
} elseif ($result_autista->num_rows > 0) {
    // Utente trovato come autista
    $row = $result_autista->fetch_assoc();
    $_SESSION['user_type'] = 'autista';
    $_SESSION['email'] = $row['email']; 
    $nome = $row['nome']; // Ottieni il nome dell'autista
    echo "<span style='color: white; font-size: 30px; font-weight: bold'>Benvenuto, $nome! <br> Stai per essere reindirizzato alla tua dashboard...</span>";
    echo "<script>setTimeout(function() { window.location.href = 'dashboardAutisti/autista.php'; }, 3000);</script>";
} else {
    // Utente non trovato o password errata
    echo "<span style='color: red; font-size: 30px; font-weight: bold'>Email o password non valide.</span>";
}

$conn->close();
?>
