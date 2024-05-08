<?php
session_start(); // Avvia la sessione

// Connessione al database
$servername = "localhost";
$username = "root"; // Inserisci il tuo nome utente del database
$password = "admin"; // Inserisci la tua password del database
$dbname = "car-pooling"; // Inserisci il nome del tuo database

$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se l'utente ha effettuato l'accesso
    if(isset($_SESSION['user_type'])) {
        // Eliminazione dell'account
        if(isset($_POST['delete_account'])) {
            $email = $_SESSION['email']; // Ottieni l'email dell'utente loggato

            if($_SESSION['user_type'] === 'autista') {
                $sql_delete = "DELETE FROM Autisti WHERE email = '$email'";
            } elseif ($_SESSION['user_type'] === 'passeggero') {
                $sql_delete = "DELETE FROM Passeggeri WHERE email = '$email'";
            }
            
            if ($conn->query($sql_delete) === TRUE) {
                // Account eliminato con successo, distruggi la sessione
                session_destroy();
                header("Location: ./login/login.html"); // Reindirizza l'utente alla pagina di login
                exit();
            } else {
                echo "Errore nell'eliminazione dell'account: " . $conn->error;
            }
        }
        
        // Logout
        if(isset($_POST['logout'])) {
            // Distruggi la sessione
            session_destroy();
            header("Location: ./login/login.html"); // Reindirizza l'utente alla pagina di login
            exit();
        }
    } else {
        // Se l'utente non ha effettuato l'accesso, reindirizzalo alla pagina di login
        header("Location: ./login/login.html");
        exit(); // Assicura che lo script termini qui
    }
}
$conn->close();
?>
