<?php

// include connection module
include('includes/connection.php');

// create a session
session_start();
// check if table messages exists or not
$sql = "DESCRIBE `messages`";
$result = mysqli_query($conn, $sql);
// if not, create table
if ($result === FALSE) {
    // create a table with user_name, user_email, user_message
    $query = "CREATE TABLE messages (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_name VARCHAR(30) NOT NULL,
        user_email VARCHAR(50) NOT NULL,
        user_message VARCHAR(500) NOT NULL
    )";
    // execute query
    $result = mysqli_query($conn, $query);
    // check if any error occured
    if ($result === FALSE) {
        echo '
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <p>Failed to create table: ' . mysqli_error($conn) . '</p>
            </div>
        </div>';
    }
}

// check if form is submitted
if($_SERVER['REQUEST_METHOD']=='POST') {
    // get name from contact form
    $name = $_POST['name'];
    // get email from contact form
    $email = $_POST['email'];
    // get message from contact form
    $message = $_POST['message'];

    // create a query
    $query = "INSERT INTO messages (user_name, user_email, user_message) VALUES ('$name', '$email', '$message')";
    $response = mysqli_query($conn, $query);
    // clean up variable cache
    $name = $email = $message = "";
    // if any error occured
    if ($response === FALSE) {
        echo '
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <p>Failed to insert data: ' . mysqli_error($conn) . '</p>
            </div>
        </div>';
    } else {
        echo '
        <div class="container">
            <div class="alert alert-success" role="alert">
                <p>message sent successfully</p>
            </div>
        </div>';
    }
}


// close connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <!-- include bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div>
            <h3>
            <small class="d-flex justify-content-center">CONTACT FORM</small>
            </h3>
        </div>
        <div>
            <form method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" value="click" class="btn btn-primary">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- include bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>