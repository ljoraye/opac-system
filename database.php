<?php
require_once 'load_env.php';

// Check for Render database environment variables first
if (isset($_ENV['RENDER_DB_HOST'])) {
    $host = $_ENV['RENDER_DB_HOST'];
    $user = $_ENV['RENDER_DB_USER'] ?? 'opac_user';
    $password = $_ENV['RENDER_DB_PASSWORD'] ?? '';
    $dbname = $_ENV['RENDER_DB_NAME'] ?? 'opac_db';
} else {
    // Fallback to local environment variables
    $host = $_ENV['DB_HOST'] ?? "localhost";
    $user = $_ENV['DB_USER'] ?? "root";
    $password = $_ENV['DB_PASSWORD'] ?? "";
    $dbname = $_ENV['DB_NAME'] ?? "opac_db";
}

$conn = mysqli_connect($host, $user, $password, $dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
