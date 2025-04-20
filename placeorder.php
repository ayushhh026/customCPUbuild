<?php
session_start();
include 'connect_database.php';

// Check if payment is via Razorpay or COD
$mode_of_payment = isset($_GET['payment_id']) ? "Online Payment" : "Cash on Delivery";

// Retrieve order details from session
$total_price = $_SESSION['total_price'];
$cabinet = $_SESSION['cabinet_full_name'];
$cpu = $_SESSION['cpu_full_name'];
$gpu = $_SESSION['gpu_full_name'];
$ram = $_SESSION['ram_full_name'];
$mb = $_SESSION['mb_full_name'];
$ssd = $_SESSION['ssd_full_name'];
$hdd = $_SESSION['hdd_full_name'];
$ps = $_SESSION['power_supply_full_name'];
$cpu_cooler = $_SESSION['cpu_cooler_full_name'];
$userid = $_SESSION['customer'];

// Validate session data
if (empty($userid) || empty($total_price)) {
    die("Session expired. Please try again.");
}

// Insert order into database (Removed `payment_id`)
$sql = "INSERT INTO `product_details` (`userid`, `model_name`, `cpu_id`, `gpu_id`, `ram_id`, `mb_id`, `ssd_id`, `hdd_id`, `ps_id`, `cooler_id`, `total_price`, `mode_of_payment`, `timestamp`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $database->prepare($sql);
$stmt->bind_param("ssssssssssis", $userid, $cabinet, $cpu, $gpu, $ram, $mb, $ssd, $hdd, $ps, $cpu_cooler, $total_price, $mode_of_payment);

if ($stmt->execute()) {
    // Redirect to success page
    header("Location: order_success.php");
    exit();
} else {
    echo "Database error: " . $stmt->error;
}
?>
