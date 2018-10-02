<?php
$dbUsername = "ariano";
$dbPassword = "ariano";
$dbServer= "localhost";
$dbName = "ecw database";

$connection = new mysqli($dbServer, $dbUsername, $dbPassword, $dbName);

if($connection->connect_errno)
{
    die("Database Connection Failed. Reason".$connection->connect_errno);
}

$query = "SELECT id, company_name, first_name, name_addition, last_name,
transport_type, customer_email, phone_number FROM vervoerders ORDER BY company_name";
$resultObj = $connection->query($query);

?>