<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
            body {
        background-color: #7a1de2;
        color: white;
        text-shadow: 1px 2px 0px rgba(0, 0, 0, 1);
        font-family: Arial, sans-serif;
        margin: 0;
    }

    .container {
        margin: 20px;
    }

    input[type=submit] {
        display: inline-block;
        padding: 10px 20px;
        background-color: #d24141;
        color: #ffffff;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border-radius: 15px;
        margin: 10px;
    }

    .hamburger-menu {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }

    .hamburger-icon {
        cursor: pointer;
        font-size: 35px;
        padding: 10px;
        color: black;
        border-radius: 50%;
        text-shadow: none;
    }

    .menu-content {
        display: none;
        position: fixed;
        top: 80px;
        right: 50px;
        border: 2px solid #ccc;
        padding: 20px;
        z-index: 1001;
        background-color: white;
        color: black;
        text-shadow: none;
        font-weight: bold;
    }

    /* Aggiunta stili per la barra di ricerca */
    #inputSearch {
        padding: 10px;
        margin-bottom: 10px;
        width: 200px;
    }

    #noResultsMessage {
        color: red;
        font-weight: bold;
        margin-top: 10px;
    }

    </style>
</head>
<body>
<div class="container">
<div class="hamburger-menu">
    <div class="hamburger-icon" onclick="toggleMenu()">&#9776;</div>
    <div class="menu-content" id="menuContent">
        
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
            $query = "SELECT codice_fiscale, nome, cognome, email, numero_telefono FROM passeggeri WHERE email='$email'";
            $result = $conn->query($query);
            

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $codice_fiscale = $row["codice_fiscale"];
                $nome = $row["nome"];
                $cognome = $row["cognome"];
                $email = $row["email"];
                $numero_telefono = $row["numero_telefono"];

                // Mostra i dati di ricerca
                echo "<p>Nome: $nome</p>";
                echo "<p>Cognome: $cognome</p>";
                echo "<p>Email: $email</p>";
                echo "<p>Numero di telefono: $numero_telefono</p>";
                echo "<p>Codice Fiscale: $codice_fiscale</p>";
                echo "<p>Ruolo: Passeggero</p><br>";

            // Calcola la media dei voti delle recensioni del passeggero
        $query_media_voto = "SELECT AVG(voto) AS media_voto FROM recensionipasseggeri WHERE passeggero_email='$email'";
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

        $conn->close();
        ?>
        <form action="../accountManagement.php" method="post">
    <input type="submit" name="logout" value="Logout">
    <input type="submit" name="delete_account" value="Elimina Account">
</form>
    </div>
</div>

<script>
    function toggleMenu() {
        var menuContent = document.getElementById("menuContent");
        menuContent.style.display = (menuContent.style.display === "block") ? "none" : "block";
    }
</script>

</body>
</html>
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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Query per ottenere i dati del passeggero
    $query = "SELECT codice_fiscale, nome, cognome, email, numero_telefono FROM passeggeri WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $codice_fiscale = $row["codice_fiscale"];
        $nome = $row["nome"];
        $cognome = $row["cognome"];
        $email = $row["email"];
        $numero_telefono = $row["numero_telefono"];

        // Mostra i dati di ricerca
        echo "<h1 style='text-align: center; margin-bottom:50px; font-family: Arial, sans-serif; font-size: 48px; font-weight: bold; color: white; line-height: 1.2;'>Ciao $nome!</h1>";
    } else {
        echo "Nessun risultato trovato per l'email $email.";
    }
} else {
    echo "Utente non autenticato.";
}

$sta_partecipando = false;

// Controllo delle richieste inviate dall'utente
// Controllo delle richieste inviate dall'utente
$query_richieste_utente = "SELECT viaggio_id FROM richieste WHERE passeggero_email='$email'";
$result_richieste_utente = $conn->query($query_richieste_utente);

$richieste_utente = [];
if ($result_richieste_utente->num_rows > 0) {
    while ($row_richiesta = $result_richieste_utente->fetch_assoc()) {
        $richieste_utente[] = $row_richiesta['viaggio_id'];
    }
}
$query_viaggi = "SELECT viaggi.id, luogo_partenza, luogo_destinazione, orario_partenza, nome AS nome_autista, AVG(r.voto) AS media_voto
FROM viaggi 
INNER JOIN autisti ON viaggi.autista_email = autisti.email
LEFT JOIN recensioniautisti r ON autisti.email = r.autista_email
WHERE viaggi.concluso = FALSE
GROUP BY viaggi.id";
$result_viaggi = $conn->query($query_viaggi);
if ($result_viaggi->num_rows > 0) {
    echo "<h2 style='text-align: center;';>Viaggi Disponibili</h2>";
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
        echo "<div style='text-align: center;'>";
        echo "<div style='margin: 10px auto; font-size:20px; text-shadow:none; font-weight:bold; color: black; width: 80%; background-color: #f9f9f9; padding: 10px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>";
        echo "<p style='text-align: center;'><span style=''>Luogo Partenza:</span> $luogo_partenza</p>";
        echo "<p style='text-align: center;'><span style=''>Luogo Destinazione:</span> $luogo_destinazione</p>";
        echo "<p style='text-align: center;'><span style=''>Orario Partenza:</span> $orario_partenza</p>";
        echo "<p style='text-align: center;'><span style=''>Autista: </span>$nome_autista</p>";
        echo "<p style='text-align: center;'><span style=''>Media Voto Autista: </span>$media_voto</p>";
      


        // Verifica se il viaggio è concluso
        $query_viaggio_concluso = "SELECT concluso FROM viaggi WHERE id = $viaggio_id";
        $result_viaggio_concluso = $conn->query($query_viaggio_concluso);
        $viaggio_concluso = $result_viaggio_concluso->fetch_assoc()["concluso"];

        // Verifica se l'utente sta già partecipando a questo viaggio
        if ($viaggio_concluso) {
            echo "<p>Questo viaggio è già concluso.</p>";
        } else {
            // Verifica se l'utente ha già inviato una richiesta per questo viaggio
            if (in_array($viaggio_id, $richieste_utente)) {
                echo "<p style='color: red;'>Hai già inviato una richiesta per questo viaggio.</p>";
            } else {
                
                echo "<form action='../richiestaPartecipazione.php' method='post'>";
                echo "<input type='hidden' name='viaggio_id' value='$viaggio_id'>";
                echo "<input type='submit' name='submit' value='Richiedi Partecipazione'>";
                echo "</form>";
            }
        }

        echo "</div>";
        echo "</div>";
    }
}



 
    else {

    echo "<p style='margin-left: 150px'>Al momento non ci sono viaggi disponibili.</p>";
}
// Controlla se l'utente ha partecipato a un viaggio che è stato concluso
$query_viaggi_conclusi = "SELECT vi.id FROM viaggi vi 
    INNER JOIN richieste r ON vi.id = r.viaggio_id 
    WHERE r.passeggero_email = '$email' AND vi.concluso = TRUE";
$result_viaggi_conclusi = $conn->query($query_viaggi_conclusi);

if ($result_viaggi_conclusi->num_rows > 0 || !empty($richieste_utente)) {
    $sta_partecipando = true;
} else {
    $sta_partecipando = false;
}


// Esegui la query per ottenere i viaggi disponibili
$query_viaggi = "SELECT v.id, v.luogo_partenza, v.luogo_destinazione, v.orario_partenza, a.nome AS nome_autista, AVG(r.voto) AS media_voto
FROM viaggi v
INNER JOIN autisti a ON v.autista_email = a.email
LEFT JOIN recensioniautisti r ON a.email = r.autista_email
WHERE v.is_pubblicato = TRUE
GROUP BY v.id";
$result_viaggi = $conn->query($query_viaggi);

// Mostra la barra di ricerca per i viaggi

// Mostra il messaggio se non ci sono viaggi corrispondenti alla ricerca
echo "<div style='text-align: center;'>";
echo "<p id='noResultsMessage' style='display:none;'>Nessun viaggio trovato.</p>";

// Controlla se l'utente ha partecipato a un viaggio che è stato concluso
$query_check_viaggio_concluso = "SELECT vi.id FROM viaggi vi 
    INNER JOIN richieste r ON vi.id = r.viaggio_id 
    WHERE r.passeggero_email = '$email' AND vi.concluso = TRUE";
$result_check_viaggio_concluso = $conn->query($query_check_viaggio_concluso);

$result_viaggi = $conn->query($query_viaggi);

$result_viaggi = $conn->query($query_viaggi);

if ($result_viaggi !== false && $result_viaggi->num_rows > 0) {
    while ($row = $result_viaggi->fetch_assoc()) {
        $viaggio_id = $row["id"];
        
        
$query_email_autista = "SELECT autista_email FROM Viaggi WHERE id = '$viaggio_id'";
$result_email_autista = $conn->query($query_email_autista);

// Esegui la query per ottenere i viaggi conclusi a cui il passeggero ha partecipato
$query_viaggi_conclusi = "SELECT v.id, v.luogo_partenza, v.luogo_destinazione, v.orario_partenza, a.nome AS nome_autista
    FROM viaggi v
    INNER JOIN autisti a ON v.autista_email = a.email
    INNER JOIN Richieste r ON v.id = r.viaggio_id
    WHERE v.is_pubblicato = TRUE AND v.concluso = TRUE AND r.passeggero_email = '$email'";
$result_viaggi_conclusi = $conn->query($query_viaggi_conclusi);
}
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

        echo "<div style='text-align: center;'>";
        echo "<div style='margin: 10px auto; font-size:20px; text-shadow:none; font-weight:bold; color: black; width: 80%; background-color: #f9f9f9; padding: 10px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>";
        echo "<p>Luogo Partenza: $luogo_partenza</p>";
        echo "<p>Luogo Destinazione: $luogo_destinazione</p>";
        echo "<p>Orario Partenza: $orario_partenza</p>";
        echo "<p>Autista: $nome_autista</p>";

        $query_recensioni_viaggio_passeggero = "SELECT p.nome AS nome_passeggero, r.voto, r.commento, a.nome AS nome_autista
        FROM recensioniautisti r
        INNER JOIN autisti a ON r.autista_email = a.email
        INNER JOIN passeggeri p ON r.passeggero_email = p.email
        WHERE r.viaggio_id = '$viaggio_id_concluso' AND r.passeggero_email = '$email'";

        $result_recensioni_viaggio_passeggero = $conn->query($query_recensioni_viaggio_passeggero);

        if ($result_recensioni_viaggio_passeggero->num_rows > 0) {
            echo "<p style='color: blue; margin-top: 50px'>Recensioni:</p>";
            echo "<ul>";
            while ($recensione = $result_recensioni_viaggio_passeggero->fetch_assoc()) {
                
                echo "Passeggero: $nome, Voto: {$recensione['voto']}, Commento: {$recensione['commento']}";
                

                // Mostra la recensione dell'autista
                $query_recensione_autista = "SELECT r.voto, r.commento
    FROM recensionipasseggeri r
    INNER JOIN viaggi v ON r.viaggio_id = v.id
    INNER JOIN autisti a ON v.autista_email = a.email
    WHERE r.viaggio_id = '$viaggio_id_concluso' AND a.nome = '$nome_autista'"; // Assumi che $email sia l'email del passeggero
                $result_recensione_autista = $conn->query($query_recensione_autista);

                if ($result_recensione_autista->num_rows > 0) {
                    $recensione_autista = $result_recensione_autista->fetch_assoc();
                    echo "<ul>";
                    
                    echo "Autista: $nome_autista, Voto: {$recensione_autista['voto']}, Commento: {$recensione_autista['commento']}";
            
                    echo "</ul>";
                } else {
                    echo "<ul>";
                    echo "<p>Al momento non c'è nessuna recensione dell'autista.</p>";
                    echo "</ul>";
                }
            }
            echo "</ul>";
        } else {
            echo "<p style='color: red;'>Non ci sono recensioni per questo viaggio.</p>";
        }

         // Chiudi la div del viaggio concluso

        // Aggiungi la possibilità di dare una recensione se non è già stata fatta
        $query_check_recensione = "SELECT *
        FROM recensioniautisti
        WHERE viaggio_id = $viaggio_id_concluso AND passeggero_email = '$email'";
        $result_check_recensione = $conn->query($query_check_recensione);

        if ($result_check_recensione->num_rows === 0) {
            // Nessuna recensione trovata, mostra il modulo per l'invio della recensione
            $row_email_autista = $result_email_autista->fetch_assoc();
            $email_autista = $row_email_autista['autista_email'];

            echo "<form action='../gestioneRecensioniAutista.php' method='post'>";
            echo "<input type='hidden' name='passeggero_email' value='$email'>";
            echo "<input type='hidden' name='autista_email' value='$email_autista'>";
            echo "<input type='hidden' name='viaggio_id' value='$viaggio_id_concluso'>";
            echo "<input style='padding: 10px; border: 2px solid #ccc; border-radius: 6px;' type='number' name='voto' min='1' max='5' placeholder='Voto' required>";
            echo "<input style='padding: 10px; border: 2px solid #ccc; border-radius: 6px;' type='text' name='commento' placeholder='Commento' required>";
            echo "<input type='submit' name='invia_recensione' value='Invia Recensione'>";
            echo "</div>"; 
            echo "</div>";
            echo "</form>";
        } else {
            // Recensione già presente, mostra un messaggio appropriato
            echo "<p style='color: red;'>Hai già inviato una recensione per questo viaggio.</p>";
           
        }
    }

    echo "</div>"; // Chiudi la div per i viaggi conclusi
} else {
    echo "<div>Nessun viaggio concluso al momento.</div>";
}

}
$conn->close();
?>
