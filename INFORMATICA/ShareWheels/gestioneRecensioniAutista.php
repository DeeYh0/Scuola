<?php
// Connessione al database e altre configurazioni
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

// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["invia_recensione"])) {
    // Ottieni i dati dal form
    $passeggero_email = $_POST['passeggero_email'];
    $autista_email = $_POST['autista_email']; // Aggiunto per ottenere l'email dell'autista
    $viaggio_id = $_POST['viaggio_id'];
    $voto = $_POST['voto'];
    $commento = $_POST['commento'];

    // Assumi che l'email dell'utente sia salvata in sessione e controlla il tipo di utente
    if (isset($_SESSION['email']) && isset($_SESSION['user_type'])) {
        $email_utente = $_SESSION['email'];
        $utente_tipo = $_SESSION['user_type'];

        // Verifica se l'utente è un autista o un passeggero
        if ($utente_tipo == 'autista') {
            // L'utente che sta inserendo la recensione è un autista, quindi inserisci la recensione al passeggero
            $query_inserimento_recensione = "INSERT INTO RecensioniPasseggeri (autista_email, passeggero_email, viaggio_id, voto, commento) VALUES ('$autista_email', '$passeggero_email', '$viaggio_id', '$voto', '$commento')";

            // Esegui la query di inserimento della recensione
            if ($conn->query($query_inserimento_recensione) === TRUE) {
                echo "Recensione inserita con successo!";

                /*
                // Rimuovi la richiesta di partecipazione al viaggio
                $query_rimuovi_partecipazione = "DELETE FROM Richieste WHERE passeggero_email = '$email_utente' AND viaggio_id = $viaggio_id";

                if ($conn->query($query_rimuovi_partecipazione) === TRUE) {
                    echo "Richiesta di partecipazione rimossa!";
                    // Puoi anche reindirizzare l'utente a una pagina di conferma o a un'altra pagina
                } else {
                    echo "Errore nella rimozione della richiesta di partecipazione: " . $conn->error;
                }*/
            } else {
                echo "Errore nell'inserimento della recensione: " . $conn->error;
            }
        } elseif ($utente_tipo == 'passeggero') {
            // L'utente che sta inserendo la recensione è un passeggero, quindi inserisci la recensione all'autista
            $query_inserimento_recensione = "INSERT INTO RecensioniAutisti (passeggero_email, autista_email, viaggio_id, voto, commento) VALUES ('$email_utente', '$autista_email', '$viaggio_id', '$voto', '$commento')";

            // Esegui la query di inserimento della recensione
            if ($conn->query($query_inserimento_recensione) === TRUE) {
                echo "Recensione inserita con successo!";

                /*
                // Rimuovi la richiesta di partecipazione al viaggio
                // Aggiorna la richiesta di partecipazione al viaggio come conclusa
                $query_aggiorna_conclusa = "UPDATE Richieste SET conclusa = TRUE WHERE passeggero_email = '$email_utente' AND viaggio_id = $viaggio_id";

                if ($conn->query($query_rimuovi_partecipazione) === TRUE) {
                    echo "Richiesta di partecipazione rimossa!";
                    // Puoi anche reindirizzare l'utente a una pagina di conferma o a un'altra pagina
                } else {
                    echo "Errore nella rimozione della richiesta di partecipazione: " . $conn->error;
                }*/
            } else {
                echo "Errore nell'inserimento della recensione: " . $conn->error;
            }
        } else {
            echo "Tipo utente non riconosciuto.";
            exit; // Esci dallo script
        }
    } else {
        echo "Sessione non valida. Effettua il login.";
    }
}
?>
