<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body{
            background-color: #7a1de2;
            color: white;
            text-shadow: 1px 2px 0px rgba(0,0,0,1);
            font-weight: bold;
            font-family: Arial, sans-serif;
            margin-left: 20px;
        }
        
        input[type=submit]{
            display: inline-block;
            padding: 10px 20px;
            background-color: #d24141;
            color: #FFFFFF;
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
            $query = "SELECT nome, cognome, email, numeroTelefono, scadenzaPatente, datiAutomobile FROM autisti WHERE email='$email'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nome = $row["nome"];
                $cognome = $row["cognome"];
                $email = $row["email"];
                $numeroTelefono = $row["numeroTelefono"];
                $scadenzaPatente = $row["scadenzaPatente"];
                $datiAutomobile = $row["datiAutomobile"];

                // Mostra i dati di ricerca
                echo "<p>Nome: $nome</p>";
                echo "<p>Cognome: $cognome</p>";
                echo "<p>Email: $email</p>";
                echo "<p>Numero di telefono: $numeroTelefono</p>";
                echo "<p>Scadenza patente: $scadenzaPatente</p>";
                echo "<p>Dati dell'automobile: $datiAutomobile</p>";
                echo "<p>Ruolo: Autista</p><br>";
                
                $query_media_voto = "SELECT AVG(voto) AS media_voto FROM recensioniAutisti WHERE autista_email='$email'";
                $result_media_voto = $conn->query($query_media_voto);

                if ($result_media_voto->num_rows > 0) {
                    $row_media_voto = $result_media_voto->fetch_assoc();
                    $media_voto = $row_media_voto["media_voto"];
                    if ($media_voto !== null) {
                        $media_voto_rounded = round($media_voto, 1);
                        echo "<p>Media Voto: $media_voto_rounded stelle</p>";
                    } else {
                        echo "<p>Non ci sono recensioni per questo autista.</p>";
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

    // Query per ottenere i dati dell'autista
    $query = "SELECT nome, cognome, email, numeroTelefono, scadenzaPatente, datiAutomobile FROM autisti WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $cognome = $row["cognome"];
        $email = $row["email"];
        $numeroTelefono = $row["numeroTelefono"];
        $scadenzaPatente = $row["scadenzaPatente"];
        $datiAutomobile = $row["datiAutomobile"];

        // Mostra i dati dell'autista
        echo "<h1 style='text-align: center; margin-bottom:50px; font-family: Arial, sans-serif; font-size: 48px; font-weight: bold; color: white; line-height: 1.2;'>Ciao $nome!</h1>";
            } else {
                echo "Nessun risultato trovato per l'email $email.";
            }
        } else {
            echo "Utente non autenticato.";
        }

$email_autista = $_SESSION['email']; // Assumi che l'email dell'autista sia salvata in sessione

// Mostra il form per pubblicare un nuovo viaggio

echo "<div style='max-width: 400px; margin: 0 auto;'>";
echo "<h2 style='text-align: center;'>Pubblica Nuovo Viaggio</h2>";
echo "<form action='../creazioneViaggi.php' method='post'>";
echo "<label for='luogo_partenza' style='display: block; margin-bottom: 10px;'>Luogo Partenza:</label>";
echo "<input type='text' id='luogo_partenza' name='luogo_partenza' style='width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;' required><br>";
echo "<label for='luogo_destinazione' style='display: block; margin-bottom: 10px;'>Luogo Destinazione:</label>";
echo "<input type='text' id='luogo_destinazione' name='luogo_destinazione' style='width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;' required><br>";
echo "<label for='orario_partenza' style='display: block; margin-bottom: 10px;'>Orario Partenza:</label>";
echo "<input type='datetime-local' id='orario_partenza' name='orario_partenza' style='width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;' required><br>";
echo "<input type='submit' name='submit' value='Pubblica Viaggio' style='width: 100%; margin-left:-0.2px; padding: 10px; border: none; border-radius: 5px; background-color: #007bff; color: #fff; cursor: pointer;'>";
echo "</form>";
echo "</div>";





// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["concludi_viaggio"])) {
    // Ottieni l'id del viaggio da concludere
    $viaggio_id = $_POST['viaggio_id'];

        // Controlla se ci sono passeggeri che partecipano al viaggio
        $query_check_passeggeri = "SELECT * FROM richieste WHERE viaggio_id = $viaggio_id";
        $result_check_passeggeri = $conn->query($query_check_passeggeri);
    
        if ($result_check_passeggeri->num_rows > 0) {
            // Ci sono passeggeri che partecipano al viaggio, non è possibile concluderlo
        } else {
            // Non ci sono passeggeri che partecipano al viaggio, elimina il viaggio dal database
            $query_elimina_viaggio = "DELETE FROM Viaggi WHERE id = $viaggio_id";
            if ($conn->query($query_elimina_viaggio) === TRUE) {
                
            } else {
                echo "Errore durante l'eliminazione del viaggio: " . $conn->error;
            }
        }

    // Esegui l'aggiornamento del viaggio nel database impostando la colonna 'concluso' a TRUE
    $query_concludi = "UPDATE Viaggi SET concluso = TRUE WHERE id = $viaggio_id";
    $result_concludi = $conn->query($query_concludi);


    // Query per ottenere l'email del passeggero
    $query_email_passeggeri = "SELECT passeggero_email FROM Richieste WHERE viaggio_id = $viaggio_id";
    $result_email_passeggeri = $conn->query($query_email_passeggeri);

    if ($result_email_passeggeri->num_rows > 0) {
        while ($row_email_passeggero = $result_email_passeggeri->fetch_assoc()) {
            $passeggero_email = $row_email_passeggero['passeggero_email'];
    
            // Aggiorna la richiesta di partecipazione al viaggio come conclusa per questo passeggero
        $query_aggiorna_conclusa = "UPDATE Richieste SET conclusa = TRUE WHERE passeggero_email = '$passeggero_email' AND viaggio_id = $viaggio_id";
        if ($conn->query($query_aggiorna_conclusa) === TRUE) {
            echo "Richiesta conclusa per il passeggero: $passeggero_email <br>";
        } else {
            echo "Errore nell'aggiornamento della richiesta per il passeggero: $passeggero_email <br>";
        }
        }
    }
}



// Esegui la query per ottenere i viaggi conclusi dall'autista
$query_viaggi_conclusi = "SELECT id, luogo_partenza, luogo_destinazione, orario_partenza, concluso FROM Viaggi WHERE autista_email = '$email_autista' AND concluso = TRUE";
$result_viaggi_conclusi = $conn->query($query_viaggi_conclusi);

if ($result_viaggi_conclusi->num_rows > 0) {
    // Mostra i viaggi conclusi dall'autista
    echo "<div style='max-width: 1250px; margin: 0 auto; color: black; text-shadow:none; margin: 20px auto; padding: 20px; background-color: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);' >";
    echo "<h1 style='color: Black; text-align: center;'>Viaggi Conclusi</h1>";

    while($row_concluso = $result_viaggi_conclusi->fetch_assoc()) {
        $viaggio_id_concluso = $row_concluso["id"];
        $luogo_partenza_concluso = $row_concluso["luogo_partenza"];
        $luogo_destinazione_concluso = $row_concluso["luogo_destinazione"];
        $orario_partenza_concluso = $row_concluso["orario_partenza"];

        // Mostra i dettagli del viaggio concluso
        echo "<div style='margin: 20px auto; padding: 20px; background-color: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);' >";
        echo "<p>Luogo Partenza: $luogo_partenza_concluso</p>";
        echo "<p>Luogo Destinazione: $luogo_destinazione_concluso</p>";
        echo "<p>Orario Partenza: $orario_partenza_concluso</p>";

        // Mostra le recensioni per questo viaggio
        $query_recensioni_concluso = "SELECT r.voto, r.commento, p.nome, p.cognome 
        FROM RecensioniAutisti r 
        INNER JOIN Passeggeri p ON r.passeggero_email = p.email 
        WHERE r.viaggio_id = $viaggio_id_concluso";
    
        $result_recensioni_concluso = $conn->query($query_recensioni_concluso);

        if ($result_recensioni_concluso->num_rows > 0) {
            echo "<div>";
            echo "<h3>Recensioni ricevute</h3>";

            while ($row_recensione_concluso = $result_recensioni_concluso->fetch_assoc()) {
                $voto_recensione = $row_recensione_concluso["voto"];
                $commento_recensione = $row_recensione_concluso["commento"];
                $nome_passeggero = $row_recensione_concluso["nome"];
                $cognome_passeggero = $row_recensione_concluso["cognome"];

                echo "<p>Passeggero: $nome_passeggero $cognome_passeggero - Voto: $voto_recensione - Commento: $commento_recensione</p>";
            }

            echo "</div>"; // Chiudi div recensioni
        } else {
            echo "<p>Nessuna recensione per questo viaggio.</p>";
        }

         // Esegui la query per ottenere i passeggeri per questo viaggio
         $query_passeggeri_viaggio = "SELECT p.email, p.nome, p.cognome
         FROM Passeggeri p
         INNER JOIN Richieste r ON p.email = r.passeggero_email
         WHERE r.viaggio_id = $viaggio_id_concluso";
$result_passeggeri_viaggio = $conn->query($query_passeggeri_viaggio);

if ($result_passeggeri_viaggio->num_rows > 0) {
    // Mostra i passeggeri che hanno partecipato al viaggio
    while ($row_passeggero = $result_passeggeri_viaggio->fetch_assoc()) {
        $email_passeggero = $row_passeggero["email"];
        $nome_passeggero = $row_passeggero["nome"];
        $cognome_passeggero = $row_passeggero["cognome"];

        // Mostra i dettagli del passeggero
        echo "<div>";
        echo "<p>Passeggero: $nome_passeggero $cognome_passeggero ($email_passeggero)</p>";

        // Mostra il form per la recensione se l'autista non ha ancora recensito questo passeggero
        $query_check_recensione = "SELECT * FROM RecensioniPasseggeri WHERE viaggio_id='$viaggio_id_concluso' AND autista_email='$email_autista' AND passeggero_email='$email_passeggero'";
        $result_check_recensione = $conn->query($query_check_recensione);

        if ($result_check_recensione->num_rows === 0) {
            echo "<div id='formRecensione_$viaggio_id_concluso-$email_passeggero'>";
            echo "<form action='../gestioneRecensioniAutista.php' method='post'>";
            echo "<input type='hidden' name='passeggero_email' value='$email_passeggero'>";
            echo "<input type='hidden' name='autista_email' value='$email_autista'>";
            echo "<input type='hidden' name='viaggio_id' value='$viaggio_id_concluso'>";
            echo "<input style='padding: 10px; border: 2px solid #ccc; border-radius: 6px;' type='number' name='voto' min='1' max='5' placeholder='Voto da 1 a 5' required>";
            echo "<input style='padding: 10px; border: 2px solid #ccc; border-radius: 6px;' type='text' name='commento' placeholder='Commento' required>";
            echo "<input type='submit' name='invia_recensione' value='Invia Recensione'>";
            echo "</form>";
            echo "</div>"; // Chiudi div form recensione
        } else {
            echo "<p style='color: red;'>Hai già inviato una recensione per questo passeggero.</p>";
        }

        echo "</div>"; // Chiudi div passeggero
    }
} else {
    echo "<p>Nessun passeggero ha partecipato a questo viaggio.</p>";
}

        echo "</div>"; // Chiudi div viaggio concluso
    }

    echo "</div>"; // Chiudi div viaggi conclusi
} else {
    echo "<p style='text-align:center; margin-top:70px;'>Nessun viaggio concluso al momento.</p>";
}

echo "<br><br><br>";









echo "<div style='text-shadow: none; color: black; padding: 20px; margin-right:100px; margin-left:100px; background-color: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>";


// Esegui la query per ottenere i viaggi creati dall'autista
$query_viaggi = "SELECT id, luogo_partenza, luogo_destinazione, orario_partenza, concluso FROM viaggi WHERE autista_email = '$email_autista'";
$result_viaggi = $conn->query($query_viaggi);


echo "<h1 style='color: Black; text-align: center;'>Viaggi in Corso</h2>";
if ($result_viaggi->num_rows > 0) {
    // Mostra i viaggi creati dall'autista
    while($row = $result_viaggi->fetch_assoc()) {
        $viaggio_id = $row["id"];
        $luogo_partenza = $row["luogo_partenza"];
        $luogo_destinazione = $row["luogo_destinazione"];
        $orario_partenza = $row["orario_partenza"];
        $concluso = $row["concluso"];

        
        if (!$concluso) {
            // Mostra il div per il viaggio con le opzioni per gestire le richieste
            echo "<div>";
            echo "<p>Luogo Partenza: $luogo_partenza</p>";
            echo "<p>Luogo Destinazione: $luogo_destinazione</p>";
            echo "<p>Orario Partenza: $orario_partenza</p>";

            //concludi
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='viaggio_id' value='{$row['id']}'>";
            echo "<input style='background: red;' type='submit' name='concludi_viaggio' value='Concludi' id='pulsanteConcludi_$viaggio_id'>";
            echo "</form>";


            // Esegui la query per ottenere le richieste per questo viaggio
        $query_richieste = "SELECT id, passeggero_email, is_accettata FROM richieste WHERE viaggio_id = $viaggio_id";
        $result_richieste = $conn->query($query_richieste);

        if ($result_richieste->num_rows > 0) {
            // Mostra le richieste per questo viaggio
            echo "<div id='richieste_$viaggio_id'>";
            echo "<h3 style='font-size:25px;'>Richieste dei Passeggeri</h3>";
            while ($row_richiesta = $result_richieste->fetch_assoc()) {
                $richiesta_id = $row_richiesta["id"];
                $passeggero_email = $row_richiesta["passeggero_email"];
                $is_accettata = $row_richiesta["is_accettata"];

                // Aggiungiamo la classe 'richiesta-in-attesa' se la richiesta non è stata accettata
                $classeRichiesta = $is_accettata ? '' : ' richiesta-in-attesa';
                echo "<div class='richiesta richiesta_$richiesta_id$classeRichiesta'>";
        

                    echo "Richiesta da Passeggero Email: $passeggero_email";
        
                    // Esegui la query per ottenere la media delle recensioni del passeggero
                    $query_recensioni = "SELECT AVG(voto) AS media_voto FROM RecensioniPasseggeri WHERE passeggero_email='$passeggero_email'";
                    $result_recensioni = $conn->query($query_recensioni);
        
                    if ($result_recensioni->num_rows > 0) {
                        $row_recensione = $result_recensioni->fetch_assoc();
                        $media_voto = $row_recensione["media_voto"];
        
                        if ($media_voto !== null) {
                            $media_voto_rounded = round($media_voto, 1);
                            echo " - Media Voto: $media_voto_rounded";
                        } else {
                            echo " - Nessuna recensione";
                        }
                    } else {
                        echo " - Nessuna recensione";
                    }
        
                    echo "<div class='pulsanti-richieste'>";
        
                    // Mostra i pulsanti Accetta e Rifiuta
                    echo "<form action='../gestioneRichiesteAutista.php' method='post'>";
                    echo "<input type='hidden' name='richiesta_id' value='$richiesta_id'>";
                    echo "<input type='hidden' name='viaggio_id' value='$viaggio_id'>";
                    echo "<input style='background: #2CAF33;'type='submit' name='accetta' value='Accetta'>";
                    echo "<input type='submit' name='rifiuta' value='Rifiuta'>";
                    echo "</form>";
        
                    echo "</div>"; // Chiudi il div della richiesta
            }
            echo "</div>"; // Chiudi il div delle richieste
        } else {
            echo "<p>Nessuna richiesta per questo viaggio al momento.</p>";
            echo "----------------------------------------------------------------------------------------------------";
        }
        } else {
            
        }
    }
}

echo "</div>"; // Chiudi il div del viaggio


function countAcceptedRequests($conn, $viaggio_id) {
    $query_accettate = "SELECT COUNT(*) AS num_accettate FROM Richieste WHERE viaggio_id = $viaggio_id AND is_accettata = 1";
    $result_accettate = $conn->query($query_accettate);
    if ($result_accettate->num_rows > 0) {
        $row_accettate = $result_accettate->fetch_assoc();
        return intval($row_accettate["num_accettate"]);
    }
    return 0;
}


$conn->close();
?>
</div>
</body>

<script>
    function mostraFormRecensione(viaggioId) {
        document.getElementById('formRecensione_' + viaggioId).style.display = 'block';
        document.getElementById('pulsanteConcludi_' + viaggioId).style.display = 'none';
    }
</script>


</html>
