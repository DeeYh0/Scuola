<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "car-pooling";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accetta'])) {
        $richiesta_id = $_POST['richiesta_id'];
        $query_accetta = "UPDATE Richieste SET is_accettata = TRUE WHERE id = $richiesta_id";

        if ($conn->query($query_accetta) === TRUE) {
            // Operazione di accettazione riuscita
            header("Location: ./dashboardAutisti/autista.php");
            exit();
        } else {
            echo "Errore durante l'accettazione della richiesta: " . $conn->error;
        }
    } elseif (isset($_POST['rifiuta'])) {
        $richiesta_id = $_POST['richiesta_id'];
        $query_rifiuta = "DELETE FROM Richieste WHERE id = $richiesta_id";

        if ($conn->query($query_rifiuta) === TRUE) {
            // Operazione di rifiuto riuscita
            header("Location: ./dashboardAutisti/autista.php");
            exit();
        } else {
            echo "Errore durante il rifiuto della richiesta: " . $conn->error;
        }
    } else {
        // Nessuna azione specificata
        header("Location: ./dashboardAutisti/autista.php");
        exit();
    }
} else {
    // Metodo di richiesta non valido
    header("Location: ./dashboardAutisti/autista.php");
    exit();
}
?>
