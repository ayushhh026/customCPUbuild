<?php
session_start();

if (!isset($_SESSION['customer'])) {
    header("Location: login.php");
    exit();
}

require 'libs/razorpay-php/Razorpay.php';
require 'connect_database.php';

use Razorpay\Api\Api;

$keyId = ''; // your razor api key
$keySecret = ''; //your secret key
$api = new Api($keyId, $keySecret);

$user_id = $_SESSION['customer'];

$user_query = "SELECT email FROM user WHERE email = ?";
$stmt = $database->prepare($user_query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

if (!$user) {
    die("User not found.");
}

$user_data_query = "SELECT firstname, lastname, `mobile-number` FROM user_data WHERE user_id = ?";
$stmt = $database->prepare($user_data_query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$user_data_result = $stmt->get_result();
$user_data = $user_data_result->fetch_assoc();

if (!$user_data) {
    die("User data not found.");
}

$name = $user_data['firstname'] . ' ' . $user_data['lastname'];
$email = $user['email'];
$phone = $user_data['mobile-number'];
$amount = isset($_SESSION['total_price']) ? $_SESSION['total_price'] * 100 : 0; 

if ($amount <= 0) {
    die("Invalid amount. Amount must be greater than 0.");
}

$orderData = [
    'receipt'         => uniqid(),
    'amount'          => $amount,
    'currency'        => 'INR',
    'payment_capture' => 1
];

$order = $api->order->create($orderData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {
            background-color: black;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .pay-text {
            color: green;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        #payBtn {
            background-color: rgb(51, 1, 109);
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #payBtn:hover {
            background-color: green;
        }
    </style>
</head>
<body>

    <div class="pay-text">CLICK HERE TO PROCEED TO PAY!!!</div>
    <button id="payBtn">Pay ₹<?php echo isset($_SESSION['total_price']) ? number_format($_SESSION['total_price'], 2) : "0.00"; ?></button>

    <script>
    var options = {
        "key": "<?php echo $keyId; ?>",
        "amount": "<?php echo $order['amount']; ?>",
        "currency": "INR",
        "name": "PC Assembly Hub",
        "description": "Order Payment",
        "order_id": "<?php echo $order['id']; ?>",
        "handler": function (response) {
            window.location.href = "placeorder.php?payment_id=" + response.razorpay_payment_id;
        },
        "prefill": {
            "name": "<?php echo $name; ?>",
            "email": "<?php echo $email; ?>",
            "contact": "<?php echo $phone; ?>"
        },
        "theme": {
            "color": "#3399cc"
        },
        "modal": {
            "ondismiss": function () {
                window.location.href = "payment_failed.php";
            }
        }
    };

    var rzp = new Razorpay(options);
    document.getElementById('payBtn').onclick = function(e) {
        rzp.open();
        e.preventDefault();
    };
    </script>

</body>
</html>
