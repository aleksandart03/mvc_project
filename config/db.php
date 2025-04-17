<?php


function getConnect()
{
    $conn = new mysqli("localhost", "root", "", "mvc_project");
    if ($conn->connect_error) {
        die("Greška pri konekciji: " . $conn->connect_error);
    }
    return $conn;
}
