<?php

$db_host = "localhost";
$db_user = "admin";
$db_password = "admin";
$db_name = "db_film";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function execute_query($conn, $query)
{
    $result = $conn->query($query);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}


function get_actors($conn)
{
    $query = "SELECT * FROM actor";
    return execute_query($conn, $query);
}

function get_directors($conn)
{
    $query = "SELECT * FROM director";
    return execute_query($conn, $query);
}

function get_genres($conn)
{
    $query = "SELECT * FROM genre";
    return execute_query($conn, $query);
}

function get_movies($conn)
{
    $query = "SELECT * FROM movie";
    return execute_query($conn, $query);
}


$actors = get_actors($conn);
echo "Attori:<br>";
foreach ($actors as $actor) {
    echo $actor['first_name'] . " " . $actor['last_name'] . " - " . $actor['birthday_date'] . "<br>";
}

echo "<br>";

$directors = get_directors($conn);
echo "Registi:<br>";
foreach ($directors as $director) {
    echo $director['first_name'] . " " . $director['last_name'] . " - " . $director['birthday_date'] . "<br>";
}

echo "<br>";

$genres = get_genres($conn);
echo "Generi:<br>";
foreach ($genres as $genre) {
    echo $genre['name'] . "<br>";
}

echo "<br>";


$movies = get_movies($conn);
echo "Titoli dei film:<br>";
foreach ($movies as $movie) {
    echo $movie['title'] . "<br>";
}

$conn->close();

?>
