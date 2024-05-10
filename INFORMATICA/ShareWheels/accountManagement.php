
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se l'utente ha effettuato l'accesso
    if(isset($_SESSION['user_type'])) {
        // Eliminazione dell'account
        if(isset($_POST['delete_account'])) {
            $email = $_SESSION['email']; // Ottieni l'email dell'utente loggato

            if ($_SESSION['user_type'] === 'autista') {
                $email = $_SESSION['email']; // Ottieni l'email dell'autista loggato
            
                // Elimina i viaggi associati all'autista
                $sql_delete_trips = "DELETE FROM viaggi WHERE autista_email = '$email'";
                if ($conn->query($sql_delete_trips) === TRUE) {
                    // Ora puoi eliminare l'autista
                    $sql_delete_driver = "DELETE FROM autisti WHERE email = '$email'";
                    if ($conn->query($sql_delete_driver) === TRUE) {
                        // Account eliminato con successo, distruggi la sessione
                        session_destroy();
                        header("Location: ./login/login.html"); // Reindirizza l'utente alla pagina di login
                        exit();
                    } else {
                        echo "Errore nell'eliminazione dell'account autista: " . $conn->error;
                    }
                } else {
                    echo "Errore nell'eliminazione dei viaggi: " . $conn->error;
                }
            }
        }



        if ($_SESSION['user_type'] === 'passeggero') {
            $email = $_SESSION['email']; // Ottieni l'email del passeggero loggato
        
            // Elimina le recensioni correlate nella tabella recensionipasseggeri
            $sql_delete_reviews = "DELETE FROM recensioniautisti WHERE passeggero_email = '$email'";
            if ($conn->query($sql_delete_reviews) === TRUE) {
                // Elimina le richieste di viaggio associate al passeggero
                $sql_delete_requests = "DELETE FROM richieste WHERE passeggero_email = '$email'";
                if ($conn->query($sql_delete_requests) === TRUE) {
                    // Ora puoi eliminare il passeggero
                    $sql_delete_passenger = "DELETE FROM passeggeri WHERE email = '$email'";
                    if ($conn->query($sql_delete_passenger) === TRUE) {
                        // Account eliminato con successo, distruggi la sessione
                        session_destroy();
                        header("Location: ./login/login.html"); // Reindirizza l'utente alla pagina di login
                        exit();
                    } else {
                        echo "Errore nell'eliminazione dell'account passeggero: " . $conn->error;
                    }
                } else {
                    echo "Errore nell'eliminazione delle richieste di viaggio: " . $conn->error;
                }
            } else {
                echo "Errore nell'eliminazione delle recensioni: " . $conn->error;
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
