<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'mvc_project';


$conn = new mysqli($host, $user, $pass, $dbname);


if ($conn->connect_error) {
    die("Greska u konekciji:" . $conn->connect_error);
}
