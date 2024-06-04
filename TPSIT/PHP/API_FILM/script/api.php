<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connessione al database
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "db_film";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

$sql = "SELECT movie.title, movie.duration, movie.released_year, movie.synopsis, director.first_name, director.last_name AS director
        FROM movie
        JOIN movie_director ON movie.id = movie_director.movie_id
        JOIN director ON movie_director.director_id = director.id
        WHERE movie.title LIKE '%$query%'";


$result = $conn->query($sql);

$movies = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}

$conn->close();

echo json_encode($movies);
?>
