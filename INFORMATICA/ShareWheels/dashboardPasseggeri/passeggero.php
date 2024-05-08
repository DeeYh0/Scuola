<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Passeggero</title>
</head>
<body>

<!-- Pulsanti per il logout e per eliminare l'account -->
<form action="../accountManagement.php" method="post">
    <input type="submit" name="logout" value="Logout">
    <input type="submit" name="delete_account" value="Elimina Account">
</form>

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
    $email = $_SESSION['email'];

    // Query per ottenere i dati del passeggero
    $query = "SELECT codice_fiscale, nome, cognome, email, numero_telefono FROM Passeggeri WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $codice_fiscale = $row["codice_fiscale"];
        $nome = $row["nome"];
        $cognome = $row["cognome"];
        $email = $row["email"];
        $numero_telefono = $row["numero_telefono"];

        // Mostra i dati di ricerca
        echo "<h1>Ciao $nome, benvenuto nella tua dashboard!</h1>";
        echo "<p>Codice Fiscale: $codice_fiscale</p>";
        echo "<p>Nome: $nome</p>";
        echo "<p>Cognome: $cognome</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Numero di telefono: $numero_telefono</p>";

        // Calcola la media dei voti delle recensioni del passeggero
        $query_media_voto = "SELECT AVG(voto) AS media_voto FROM RecensioniPasseggeri WHERE passeggero_email='$email'";
        $result_media_voto = $conn->query($query_media_voto);

        if ($result_media_voto->num_rows > 0) {
            $row_media_voto = $result_media_voto->fetch_assoc();
            $media_voto = $row_media_voto["media_voto"];
            if ($media_voto !== null) {
                $media_voto_rounded = round($media_voto, 1);
                echo "<p>Media Voto: $media_voto_rounded stelle</p>";
            } else {
                echo "<p>Non ci sono recensioni per questo passeggero.</p>";
            }
        } else {
            echo "<p>Errore nel calcolo della media dei voti.</p>";
        }
    } else {
        echo "Nessun risultato trovato per l'email $email.";
    }
} else {
    echo "Utente non autenticato.";
}

$sta_partecipando = false;

// Controllo delle richieste inviate dall'utente (assumendo che $conn sia la connessione al database)
// Controllo delle richieste inviate dall'utente
$query_richieste_utente = "SELECT viaggio_id FROM Richieste WHERE passeggero_email='$email' AND conclusa = FALSE";
$result_richieste_utente = $conn->query($query_richieste_utente);

$richieste_utente = [];
if ($result_richieste_utente->num_rows > 0) {
    while ($row_richiesta = $result_richieste_utente->fetch_assoc()) {
        $richieste_utente[] = $row_richiesta['viaggio_id'];
    }

    // Verifica se il passeggero sta già partecipando a un viaggio attivo
    if (!empty($richieste_utente)) {
        $sta_partecipando = true;
    } else {
        $sta_partecipando = false;
    }
}


// Esegui la query per ottenere i viaggi disponibili
$query_viaggi = "SELECT v.id, v.luogo_partenza, v.luogo_destinazione, v.orario_partenza, a.nome AS nome_autista, AVG(r.voto) AS media_voto
FROM Viaggi v
INNER JOIN Autisti a ON v.autista_email = a.email
LEFT JOIN RecensioniAutisti r ON a.email = r.autista_email
WHERE v.is_pubblicato = TRUE
GROUP BY v.id";
$result_viaggi = $conn->query($query_viaggi);

// Mostra la barra di ricerca per i viaggi
echo "<input type='text' id='inputSearch' placeholder='Cerca viaggio...' onkeyup='searchViaggi()'>";
echo "<button onclick='searchViaggi()'>Cerca</button>";

// Mostra il messaggio se non ci sono viaggi corrispondenti alla ricerca
echo "<p id='noResultsMessage' style='display:none;'>Nessun viaggio trovato.</p>";

// Controlla se l'utente ha partecipato a un viaggio che è stato concluso
$query_check_viaggio_concluso = "SELECT vi.id FROM Viaggi vi 
    INNER JOIN Richieste r ON vi.id = r.viaggio_id 
    WHERE r.passeggero_email = '$email' AND vi.concluso = TRUE";
$result_check_viaggio_concluso = $conn->query($query_check_viaggio_concluso);

$row = $result_viaggi->fetch_assoc();
$viaggio_id = $row["id"];

// Esegui la query per ottenere l'email dell'autista
$query_email_autista = "SELECT autista_email FROM Viaggi WHERE id = '$viaggio_id'";
$result_email_autista = $conn->query($query_email_autista);





// Esegui la query per ottenere i viaggi conclusi a cui il passeggero ha partecipato
$query_viaggi_conclusi = "SELECT v.id, v.luogo_partenza, v.luogo_destinazione, v.orario_partenza, a.nome AS nome_autista
    FROM Viaggi v
    INNER JOIN Autisti a ON v.autista_email = a.email
    INNER JOIN Richieste r ON v.id = r.viaggio_id
    WHERE v.is_pubblicato = TRUE AND v.concluso = TRUE AND r.passeggero_email = '$email'";
$result_viaggi_conclusi = $conn->query($query_viaggi_conclusi);

// Mostra i viaggi conclusi
if ($result_viaggi_conclusi->num_rows > 0) {
    echo "<div>";
    echo "<h2>Viaggi Conclusi</h2>";

    while ($row = $result_viaggi_conclusi->fetch_assoc()) {
        $viaggio_id_concluso = $row["id"];

        $luogo_partenza = $row["luogo_partenza"];
        $luogo_destinazione = $row["luogo_destinazione"];
        $orario_partenza = $row["orario_partenza"];
        $nome_autista = $row["nome_autista"];

        echo "<div>";
        echo "<p>Luogo Partenza: $luogo_partenza</p>";
        echo "<p>Luogo Destinazione: $luogo_destinazione</p>";
        echo "<p>Orario Partenza: $orario_partenza</p>";
        echo "<p>Autista: $nome_autista</p>";

        /*
        // Esegui la query per ottenere le recensioni associate al viaggio
        $viaggio_id = $row['id'];
        $query_recensioni_viaggio = "SELECT p.nome AS nome_passeggero, r.voto, r.commento
            FROM RecensioniAutisti r
            INNER JOIN Passeggeri p ON r.passeggero_email = p.email
            WHERE r.viaggio_id = '$viaggio_id'";
        $result_recensioni_viaggio = $conn->query($query_recensioni_viaggio);

        if ($result_recensioni_viaggio->num_rows > 0) {
            echo "<p>Recensioni:</p>";
            echo "<ul>";
            while ($recensione = $result_recensioni_viaggio->fetch_assoc()) {
                echo "<li>";
                echo "Passeggero: {$recensione['nome_passeggero']}, Voto: {$recensione['voto']}, Commento: {$recensione['commento']}";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Non ci sono recensioni per questo viaggio.</p>";
        }*/

        $query_recensioni_viaggio_passeggero = "SELECT p.nome AS nome_passeggero, r.voto, r.commento, a.nome AS nome_autista
        FROM RecensioniAutisti r
        INNER JOIN Autisti a ON r.autista_email = a.email
        INNER JOIN Passeggeri p ON r.passeggero_email = p.email
        WHERE r.viaggio_id = '$viaggio_id_concluso' AND r.passeggero_email = '$email'";


        $result_recensioni_viaggio_passeggero = $conn->query($query_recensioni_viaggio_passeggero);

        if ($result_recensioni_viaggio_passeggero->num_rows > 0) {
        echo "<p>Recensioni:</p>";
        echo "<ul>";
        while ($recensione = $result_recensioni_viaggio_passeggero->fetch_assoc()) {
            echo "<li>";
            echo "Passeggero: $nome, Voto: {$recensione['voto']}, Commento: {$recensione['commento']}";
            echo "</li>";

            // Mostra la recensione dell'autista
            $query_recensione_autista = "SELECT r.voto, r.commento
    FROM RecensioniPasseggeri r
    INNER JOIN Viaggi v ON r.viaggio_id = v.id
    INNER JOIN Autisti a ON v.autista_email = a.email
    WHERE r.viaggio_id = '$viaggio_id_concluso' AND a.nome = '$nome_autista'"; // Assumi che $email sia l'email del passeggero
            $result_recensione_autista = $conn->query($query_recensione_autista);

            if ($result_recensione_autista) {
                if ($result_recensione_autista->num_rows > 0) {
                    $recensione_autista = $result_recensione_autista->fetch_assoc();
                    echo "<ul>";
                    echo "<li>";
                    echo "Autista: $nome_autista, Voto: {$recensione_autista['voto']}, Commento: {$recensione_autista['commento']}";
                    echo "</li>";
                    echo "</ul>";
                } else {
                    echo "<ul>";
                    echo "<li>Al momento non c'è nessuna recensione dell'autista.</li>";
                    echo "</ul>";
                }
            } else {
                echo "Errore nella query: " . $conn->error;
            }
            /*
            if ($result_recensione_autista->num_rows > 0) {
                $recensione_autista = $result_recensione_autista->fetch_assoc();
                echo "<ul>";
                echo "<li>";
                echo "Autista: $nome_autista, Voto: {$recensione_autista['voto']}, Commento: {$recensione_autista['commento']}";
                echo "</li>";
                echo "</ul>";
            } else {
                echo "<ul>";
                echo "<li>Al momento non c'è nessuna recensione dell'autista.</li>";
                echo "</ul>";
            }*/

        }
        echo "</ul>";
        } else {
        echo "<p>Non ci sono recensioni per questo viaggio.</p>";
        }


        echo "</div>"; // Chiudi la div del viaggio concluso

        // Aggiungi la possibilità di dare una recensione se non è già stata fatta
        $query_check_recensione = "SELECT *
        FROM RecensioniAutisti
        WHERE viaggio_id = $viaggio_id_concluso AND passeggero_email = '$email'";
        $result_check_recensione = $conn->query($query_check_recensione);

        if ($result_check_recensione) {
            if ($result_check_recensione->num_rows === 0) {
                // Nessuna recensione trovata, mostra il modulo per l'invio della recensione
                $row_email_autista = $result_email_autista->fetch_assoc();
                $email_autista = $row_email_autista['autista_email'];

                echo "<form action='../gestioneRecensioniAutista.php' method='post'>";
                echo "<input type='hidden' name='passeggero_email' value='$email'>";
                echo "<input type='hidden' name='autista_email' value='$email_autista'>";
                echo "<input type='hidden' name='viaggio_id' value='$viaggio_id_concluso'>";
                echo "<input type='number' name='voto' min='1' max='5' placeholder='Voto da 1 a 5' required>";
                echo "<input type='text' name='commento' placeholder='Commento' required>";
                echo "<input type='submit' name='invia_recensione' value='Invia Recensione'>";
                echo "</form>";
            } else {
                // Recensione già presente, mostra un messaggio appropriato
                echo "<p>Hai già inviato una recensione per questo viaggio.</p>";
            }
        } else {
            // Gestione degli errori nella query
            echo "Errore nella verifica della recensione: " . $conn->error;
        }
    }

    echo "</div>"; // Chiudi la div per i viaggi conclusi
} else {
    echo "<div>Nessun viaggio concluso al momento.</div>";
}










// Esegui la query per ottenere i viaggi disponibili
$query_viaggi = "SELECT v.id, v.luogo_partenza, v.luogo_destinazione, v.orario_partenza, a.nome AS nome_autista, AVG(r.voto) AS media_voto
FROM Viaggi v
INNER JOIN Autisti a ON v.autista_email = a.email
LEFT JOIN RecensioniAutisti r ON a.email = r.autista_email
WHERE v.is_pubblicato = TRUE AND v.concluso = FALSE
GROUP BY v.id";
$result_viaggi = $conn->query($query_viaggi);


if ($result_viaggi->num_rows > 0) {
    while ($row = $result_viaggi->fetch_assoc()) {
        $viaggio_id = $row["id"];
        $result_viaggi->data_seek(0);
        echo "<div id='viaggio_$viaggio_id'>";
        if ($result_viaggi->num_rows > 0) {
            echo "<h2>Viaggi Disponibili</h2>";
            while ($row = $result_viaggi->fetch_assoc()) {
                // Recupera l'ID del viaggio
                if(isset($row["id"])) {
                    $viaggio_id = $row["id"];
                } else {
                    // ID del viaggio non valido, passa al prossimo viaggio
                    continue;
                }
        
                $luogo_partenza = $row["luogo_partenza"];
                $luogo_destinazione = $row["luogo_destinazione"];
                $orario_partenza = $row["orario_partenza"];
                $nome_autista = $row["nome_autista"];
                if ($row["media_voto"] !== null) {
                    $media_voto = round($row["media_voto"], 1);
                } else {
                    $media_voto = "Nessuna recensione";
                }
        
                // Aggiungi l'identificatore id alla div di ogni viaggio
                echo "<div id='viaggio_$viaggio_id'>";
                echo "<p>Luogo Partenza: $luogo_partenza</p>";
                echo "<p>Luogo Destinazione: $luogo_destinazione</p>";
                echo "<p>Orario Partenza: $orario_partenza</p>";
                echo "<p>Autista: $nome_autista</p>";
                echo "<p>Media Voto Autista: $media_voto</p>";
    
                // Verifica se il passeggero sta già partecipando a un viaggio
                if ($sta_partecipando) {
                    echo "<p>Stai già partecipando a un viaggio.</p>";
                } else {
                    if (in_array($viaggio_id, $richieste_utente)) {
                        echo "<p>Hai già inviato una richiesta per questo viaggio.</p>";
                    } else {
                        echo "<form action='../richiestaPartecipazione.php' method='post'>";
                        echo "<input type='hidden' name='viaggio_id' value='$viaggio_id'>";
                        echo "<input type='submit' name='submit' value='Richiedi Partecipazione'>";
                        echo "</form>";
                    }
                }
        
                echo "</div>"; // Chiudi la div del viaggio
            }
        } else {
            echo "<div>Al momento non ci sono viaggi disponibili.</div>";
        }
        echo "</div>";
    }
}








// Mostra i viaggi disponibili
/*if ($result_viaggi->num_rows > 0) {
    echo "<h2>Viaggi Disponibili</h2>";
    while ($row = $result_viaggi->fetch_assoc()) {
        $viaggio_id = $row["id"];
        $luogo_partenza = $row["luogo_partenza"];
        $luogo_destinazione = $row["luogo_destinazione"];
        $orario_partenza = $row["orario_partenza"];
        $nome_autista = $row["nome_autista"];
        if ($row["media_voto"] !== null) {
            $media_voto = round($row["media_voto"], 1);
        } else {
            $media_voto = "Nessuna recensione";
        }

        echo "<div>";
        echo "<p>Luogo Partenza: $luogo_partenza</p>";
        echo "<p>Luogo Destinazione: $luogo_destinazione</p>";
        echo "<p>Orario Partenza: $orario_partenza</p>";
        echo "<p>Autista: $nome_autista</p>";
        echo "<p>Media Voto Autista: $media_voto</p>";

        if (in_array($viaggio_id, $richieste_utente)) {
            echo "<p>Hai già inviato una richiesta per questo viaggio.</p>";
        } else {
            echo "<form action='../richiestaPartecipazione.php' method='post'>";
            echo "<input type='hidden' name='viaggio_id' value='$viaggio_id'>";
            echo "<input type='submit' name='submit' value='Richiedi Partecipazione'>";
            echo "</form>";
        }

        echo "</div>";
    }
} else {
    echo "<div>Al momento non ci sono viaggi disponibili.</div>";
}*/


$conn->close();
?>
</body>
<script>
function searchViaggi() {
    // Prendi il valore di ricerca dalla barra di input
    var inputText = document.getElementById('inputSearch').value.toLowerCase();

    // Ottieni tutti i viaggi
    var viaggi = document.querySelectorAll('[id^="viaggio_"]');
    var noResultsMessage = document.getElementById('noResultsMessage');

    var found = false; // Flag per indicare se sono stati trovati viaggi

    // Itera sui viaggi e mostra/nascondi in base al testo di ricerca
    viaggi.forEach(function(viaggio) {
        var testoViaggio = viaggio.innerText.toLowerCase();
        if (testoViaggio.includes(inputText)) {
            viaggio.style.display = 'block'; // Mostra il viaggio
            found = true; // Viaggio trovato
        } else {
            viaggio.style.display = 'none'; // Nascondi il viaggio
        }
    });

    // Mostra il messaggio se nessun viaggio è stato trovato
    if (!found) {
        noResultsMessage.style.display = 'block';
    } else {
        noResultsMessage.style.display = 'none';
    }
}
</script>


</html>
