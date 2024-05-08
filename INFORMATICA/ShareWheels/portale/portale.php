<?php
    session_start(); // Avvia la sessione

    // Controlla se l'utente ha effettuato l'accesso e ha un tipo definito
    if(isset($_SESSION['user_type'])) {
        // Controlla il tipo di utente
        if ($_SESSION['user_type'] === 'autista') {
            // Reindirizza l'utente alla dashboard degli autisti
            header("Location: ../dashboardAutisti/autista.php");
            exit(); // Assicura che lo script termini qui
        } elseif ($_SESSION['user_type'] === 'passeggero') {
            // Reindirizza l'utente alla dashboard dei passeggeri
            header("Location: ../dashboardPasseggeri/passeggero.php");
            exit(); // Assicura che lo script termini qui
        }
    } else {
        // Se l'utente non ha effettuato l'accesso, reindirizzalo alla pagina di login
        header("Location: ../login/login.html");
        exit(); // Assicura che lo script termini qui
    }
