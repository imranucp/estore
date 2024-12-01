<?php
// Database credentials
$host = 'localhost';
// Database host
$username = 'root';
// Database username
$password = '';
// Database password
$database = 'bicycle';
// Database name

// Create a connection
$connection = new mysqli( $host, $username, $password, $database );

// Check the connection
if ( $connection->connect_error ) {
    die( 'Connection failed: ' . $connection->connect_error );
}

?>
