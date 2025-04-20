<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <style>
        body {
            background-color: black;
            color: green;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        h1 {
            font-size: 32px;
            font-weight: bold;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        img {
            width: 200px; /* Adjust size as needed */
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: rgb(51, 1, 109);
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: 0.3s;
        }
        a:hover {
            background-color: green;
        }
    </style>
</head>
<body>

    <img src="images/attention.png" alt="Payment Failed"> <!-- Ensure the image is inside the images folder -->
    <h1>Payment Failed</h1>
    <p>Your payment was not successful. Please try again.</p>
    <a href="cart.php">Go Back to Cart</a>

</body>
</html>
