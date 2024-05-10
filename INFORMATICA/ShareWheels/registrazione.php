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

// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $numero_telefono = $_POST['nt'];

    // Se il campo nPatente è stato compilato, assumiamo che l'utente sia un autista
    if (isset($_POST['nPatente'])) {
        echo "<body style='background: #7a1de2; color: white; padding: 20px; border-radius: 10px; text-align: center; font-size: 18px;'>";
        echo "<span style='font-size: 50px'><strong>Benvenuto Autista!</strong><br></span>";
        $nPatente = $_POST['nPatente'];
        $scadenzaPatente = $_POST['scadenzaPatente'];
        $datiAuto = $_POST['datiAuto'];

        // Query per verificare se l'email è già registrata in Autisti
        $check_query_autisti = "SELECT * FROM autisti WHERE email='$email' OR numeroTelefono='$numero_telefono'";
        $result_autisti = $conn->query($check_query_autisti);

        if ($result_autisti->num_rows > 0) {
            echo "<span style='color: white; font-size: 30px'>L'utente con l'email o numero di telefono specificati è già registrato come autista.</span>";
        } else {
            // Query per inserire l'utente nel database come autista
            $sql = "INSERT INTO autisti (nome, cognome, email, password, numeroTelefono, numeroPatente, scadenzaPatente, datiAutomobile) 
            VALUES ('$nome', '$cognome', '$email', '$password', '$numero_telefono', '$nPatente', '$scadenzaPatente', '$datiAuto')";

            if ($conn->query($sql) === TRUE) {
                echo "<span style='color: white; font-size: 30px'>La tua registrazione è avvenuta con successo!</span>";
                // Reindirizzamento dopo 3 secondi
                echo "<script>setTimeout(function() { window.location.href = 'login/login.html'; }, 3000);</script>";
            } else {
                echo "<span style='color: red; font-size: 30px'>Errore durante la registrazione come autista: " . $conn->error . "</span>";
            }
        }
        echo "</body>";
    } else {
        echo "<body style='background: #7a1de2; color: white; padding: 30px; border-radius: 10px; text-align: center; font-size: 18px;'>";
        echo "<span style='font-size: 50px'><strong>Benvenuto Passeggero!</strong><br></span>";
        $codice_fiscale = $_POST['cf'];

        // Query per verificare se l'email è già registrata in Passeggeri
        $check_query_passeggeri = "SELECT * FROM passeggeri WHERE email='$email' OR numero_telefono='$numero_telefono'";
        $result_passeggeri = $conn->query($check_query_passeggeri);

        if ($result_passeggeri->num_rows > 0) {
            echo "<span style='color: white; font-size: 30px'>L'utente con l'email o numero di telefono specificati è già registrato come passeggero.</span>";
        } else {
            // Query per inserire l'utente nel database come passeggero
            $sql = "INSERT INTO passeggeri (codice_fiscale, nome, cognome, password, email, numero_telefono) 
            VALUES ('$codice_fiscale', '$nome', '$cognome', '$password', '$email', '$numero_telefono')";

            if ($conn->query($sql) === TRUE) {
                echo "<span style='color: white; font-size: 30px'>La tua registrazione è avvenuta con successo!</span>";
                // Reindirizzamento dopo 3 secondi
                echo "<script>setTimeout(function() { window.location.href = 'login/login.html'; }, 3000);</script>";
            } else {
                echo "<span style='color: red; font-size: 30px'>Errore durante la registrazione come passeggero: " . $conn->error . "</span>";
            }
        }
        echo "</body>";
    }
}

$conn->close();
?>
