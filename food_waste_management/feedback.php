<?php
session_start();
include 'connection.php';

if (isset($_POST['send'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $msg = $_POST['message'];

    $sanitized_emailid =  mysqli_real_escape_string($connection, $email);
    $sanitized_name =  mysqli_real_escape_string($connection, $name);
    $sanitized_msg =  mysqli_real_escape_string($connection, $msg);

    $query = "INSERT INTO user_feedback(name, email, message) VALUES('$sanitized_name', '$sanitized_emailid', '$sanitized_msg')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        // Show Thank You Page
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Thank You</title>
            <style>
                body {
                    background: linear-gradient(to right, #b2fefa, #0ed2f7);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    font-family: "Segoe UI", sans-serif;
                    overflow: hidden;
                }
                .thankyou-container {
                    text-align: center;
                    animation: fadeIn 1s ease-in-out;
                }
                h1 {
                    font-size: 48px;
                    color: #fff;
                    animation: colorFlash 2s infinite;
                }
                p {
                    font-size: 20px;
                    color: #fff;
                }
                @keyframes fadeIn {
                    from { opacity: 0; transform: scale(0.9); }
                    to { opacity: 1; transform: scale(1); }
                }
                @keyframes colorFlash {
                    0% { color: #fff; }
                    50% { color: #ffeaa7; }
                    100% { color: #fff; }
                }
            </style>
            <script>
                // Redirect to contact.html after 5 seconds
                setTimeout(function() {
                    window.location.href = "contact.html";
                }, 5000);
            </script>
        </head>
        <body>
            <div class="thankyou-container">
                <h1>🎉 Thank You for Contacting Us!</h1>
                <p>We appreciate your feedback. Redirecting in 5 seconds...</p>
            </div>
        </body>
        </html>
        ';
        exit();
    } else {
        echo '<script>alert("Data not saved"); window.location.href="contact.html";</script>';
    }
}
?>

