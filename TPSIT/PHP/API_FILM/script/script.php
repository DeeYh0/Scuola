<?php
$localhost = "127.0.0.1";
$username = "admin";
$password = "admin";
$dbname = "db_film";

$connection = new mysqli($localhost, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

function getAllMovies() {
    global $connection;

    $query = "
        SELECT 
            movie.title, movie.released_year, CONCAT(director.first_name, ' ', director.last_name) as director, genre.name as genre, movie.synopsis
        FROM 
            movie
        JOIN 
            director ON movie.id = director.id
        JOIN 
            genre ON movie.id = genre.id
    ";

    $result = $connection->query($query);
    $movies = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
    }

    return $movies;
}

function getAMovie($title) {
    global $connection;

    $query = $connection->prepare("
        SELECT 
            movie.title, movie.released_year, CONCAT(director.first_name, ' ', director.last_name) as director, genre.name as genre, movie.synopsis
        FROM 
            movie
        JOIN 
            director ON movie.id = director.id
        JOIN 
            genre ON movie.id = genre.id
        WHERE 
            movie.title = ?
    ");

    $query->bind_param("s", $title);
    $query->execute();
    $result = $query->get_result();
    $movies = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
    }
    return $movies;
}

function getActor($name) {
    global $connection;

    $query = $connection->prepare("
        SELECT 
            movie.title AS movie_title,
            movie.released_year AS release_year,
            CONCAT(actor.first_name, ' ', actor.last_name) AS actor_name
        FROM 
            actor
        JOIN 
            movie ON actor.id = movie.id
        WHERE 
            CONCAT(actor.first_name, ' ', actor.last_name) = ?
    ");

    $query->bind_param("s", $name);
    $query->execute();
    $result = $query->get_result();
    $actor = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $actor[] = $row;
        }
    }
    return $actor;
}

function getGenre($genre) {
    global $connection;

    $query = $connection->prepare("
        SELECT genre.name as genre, movie.title as title, movie.synopsis as description
        FROM
            movie
        JOIN 
            genre ON movie.id = genre.id
        WHERE 
            genre.name = ?
    ");

    $query->bind_param("s", $genre);
    $query->execute();
    $result = $query->get_result();
    $genres = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $genres[] = $row;
        }
    }
    return $genres;
}
?>
