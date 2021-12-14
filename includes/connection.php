<?php
// define variables for db connection and set to empty values
$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "example";
$db_name = "test";
// connect to local mysql database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// check connection
if (mysqli_connect_errno()) {
    echo '
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <p>Failed to connect to MySQL: ' . mysqli_connect_error() . '</p>
        </div>
    </div>';
}
?>