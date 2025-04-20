<?php
// Define database credentials
define('DB_SERVER', '127.0.0.1'); // Use 127.0.0.1 instead of "localhost"
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root'); // Use "root" since it's set as your password
define('DB_NAME', 'wp_project');
define('DB_PORT', 3307); // Specify the port explicitly

// Connect to MySQL database
$database = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

// Check the connection
if (!$database) {
    die('Error: Cannot connect. ' . mysqli_connect_error());
}
?>
