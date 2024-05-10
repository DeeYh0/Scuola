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

$email_autista = $_SESSION['email']; // Assumi che l'email dell'autista sia salvata in sessione

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $luogo_partenza = $_POST['luogo_partenza'];
    $luogo_destinazione = $_POST['luogo_destinazione'];
    $orario_partenza = $_POST['orario_partenza'];

    // Esegui le operazioni di validazione, se necessario

    // Inserisci il nuovo viaggio nel database
    $query_inserimento = "INSERT INTO Viaggi (autista_email, luogo_partenza, luogo_destinazione, orario_partenza, is_pubblicato) 
                    VALUES ('$email_autista', '$luogo_partenza', '$luogo_destinazione', '$orario_partenza', 1)";

    if ($conn->query($query_inserimento) === TRUE) {
        echo "Nuovo viaggio creato con successo!";
    } else {
        echo "Errore durante la creazione del viaggio: " . $conn->error;
    }

    // Aggiungi qui eventuali altre operazioni necessarie

    // Reindirizza alla dashboard dell'autista dopo l'inserimento
    header("Location: ./dashboardAutisti/autista.php");
    exit();
} else {
    // Se il form non è stato inviato correttamente, reindirizza alla dashboard dell'autista
    header("Location: ./dashboardAutisti/autista.php");
    exit();
}