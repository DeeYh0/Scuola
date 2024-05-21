<?php
require_once("script.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    switch ($_SERVER["PATH_INFO"]) {
        case "/movies":
            handle_movies_request();
            break;
        case "/actors":
            handle_actors_request();
            break;
        case "/getmovie":
            handle_getmovie_request();
            break;
        case "/getgenres":
            handle_genres_request();
            break;
        default:
            respond_with_message("Endpoint not found", 404);
            break;
    }
} else {
    respond_with_message("Method Not Allowed", 405);
}

function handle_movies_request() {
    $result = getAllMovies();
    respond_with_data($result);
}

function handle_actors_request() {
    $result = getActor("Checco Zalone");
    respond_with_data($result);
}

function handle_getmovie_request() {
    $result = getAMovie("Shrek");
    respond_with_data($result);
}

function handle_genres_request() {
    $result = getGenre("Commedia");
    respond_with_data($result);
}

function respond_with_data($data) {
    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode([
        "status" => 200,
        "message" => "",
        "payload" => $data
    ]);
}

function respond_with_message($message, $status) {
    http_response_code($status);
    header("Content-Type: application/json");
    echo json_encode([
        "status" => $status,
        "message" => $message,
        "payload" => []
    ]);
}
?>
