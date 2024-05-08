<?php
// Connessione al database
$servername = "localhost";
$username = "admin"; // Inserisci il tuo nome utente del database
$password = "admin"; // Inserisci la tua password del database
$dbname = "car-pooling"; // Inserisci il nome del tuo database

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

session_start();
if (isset($_SESSION['email'])) {
    $email_passeggero = $_SESSION['email'];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $viaggio_id = $_POST['viaggio_id'];

        // Verifica se il passeggero ha già fatto una richiesta per questo viaggio
        $check_query = "SELECT * FROM Richieste WHERE viaggio_id='$viaggio_id' AND passeggero_email='$email_passeggero'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            echo "Hai già inviato una richiesta per questo viaggio.";
        } else {
            // Inserisci la richiesta nel database
            $insert_query = "INSERT INTO Richieste (viaggio_id, passeggero_email) VALUES ('$viaggio_id', '$email_passeggero')";
            if ($conn->query($insert_query) === TRUE) {
                echo "Richiesta di partecipazione inviata con successo.";
            } else {
                echo "Errore durante l'invio della richiesta: " . $conn->error;
            }
        }
    }
} else {
    echo "Utente non autenticato.";
}


$conn->close();
?>
