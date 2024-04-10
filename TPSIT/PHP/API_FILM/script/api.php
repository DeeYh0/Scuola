<?php

require_once("script.php");


function handle_movies_request() {
    $movies = get_movies();
    respond_with_data($movies);
}

function handle_actors_request() {
    $actors = get_actors();
    respond_with_data($actors);
}

function handle_directors_request() {
    $directors = get_directors();
    respond_with_data($directors);
}

function handle_genres_request() {
    $genres = get_genres();
    respond_with_data($genres);
}

function handle_request($path) {
    switch ($path) {
        case '/movies':
            handle_movies_request();
            break;
        case '/actors':
            handle_actors_request();
            break;
        case '/directors':
            handle_directors_request();
            break;
        case '/genres':
            handle_genres_request();
            break;
        default:
            respond_with_message("Request OK, but no endpoint specified", 200);
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    handle_request($path);
} else {
    respond_with_message("Method Not Allowed", 405);
}

function respond_with_data($data) {
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode([
        "status" => "200",
        "message" => "OK",
        "payload" => $data
    ]);
}

function respond_with_message($message, $status) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode([
        "status" => strval($status),
        "message" => $message,
        "payload" => []
    ]);
}

exit;
?>
