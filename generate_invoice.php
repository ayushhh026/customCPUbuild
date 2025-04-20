<?php
error_reporting(0); // Disable error reporting to prevent output before PDF generation

// Start session
session_start();

// Include the database connection file
include 'connect_database.php';  // Ensure this path is correct

// Check if user is logged in
if (!isset($_SESSION['customer'])) {
    die("Error: User not logged in.");
}

$username = $_SESSION['customer']; // Retrieve the username from the session

// Check the database connection
if (!$database) {
    die("Error: Database connection failed: " . mysqli_connect_error());
}

// Fetch user details from 'user_data'
$user_query = mysqli_query($database, "SELECT firstname, lastname, address, city, state, country, zip_code, `mobile-number` FROM user_data WHERE user_id='$username'");
if (!$user_query) {
    die("Error: Could not fetch user details: " . mysqli_error($database));
}

$user = mysqli_fetch_assoc($user_query);
$userName = $user['firstname'] . ' ' . $user['lastname'];
$billingAddress = $user['address'] . ', ' . $user['city'] . ', ' . $user['state'] . ', ' . $user['country'] . ' - ' . $user['zip_code'];
$userMobile = $user['mobile-number'];

// Shipping Address (Static)
$shippingAddress = "Sector 19, road, opp. Khandoba Temple Road, Sector 3, Airoli, Navi Mumbai, Maharashtra 400708";

// Fetch the latest order details from 'product_details'
$order_query = mysqli_query($database, "SELECT * FROM product_details WHERE userid='$username' ORDER BY id DESC LIMIT 1");
if (!$order_query) {
    die("Error: Could not fetch order details: " . mysqli_error($database));
}

$order = mysqli_fetch_assoc($order_query);
if (!$order) {
    die("Error: No orders found.");
}

// Order details
$order_id = $order['id'];
$totalAmount = $order['total_price'];
$billingMethod = $order['mode_of_payment']; // Fetch billing method

// Fetch product details
$products = [
    ['Product' => 'Cabinet', 'Name' => $order['model_name']],
    ['Product' => 'CPU', 'Name' => $order['cpu_id']],
    ['Product' => 'GPU', 'Name' => $order['gpu_id']],
    ['Product' => 'RAM', 'Name' => $order['ram_id']],
    ['Product' => 'Motherboard', 'Name' => $order['mb_id']],
    ['Product' => 'SSD', 'Name' => $order['ssd_id']],
    ['Product' => 'HDD', 'Name' => $order['hdd_id']],
    ['Product' => 'Power Supply', 'Name' => $order['ps_id']],
    ['Product' => 'CPU Cooler', 'Name' => $order['cooler_id']],
];
require_once('libs/tcpdf/tcpdf.php');

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10); // Reduce margins (left, top, right)
$pdf->SetAutoPageBreak(false); // Disable auto page break
$pdf->SetFont('helvetica', 'B', 16);

// **Title (Tax Invoice) Centered**
$pdf->Cell(0, 10, "Tax Invoice", 0, 1, 'C');

// **Move to Top Right Corner for Order ID & Barcode**
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetXY(150, 20); // Adjust position for Order ID
$pdf->Cell(50, 10, "Order ID: $order_id", 0, 1, 'C');

// **Barcode Directly Below Order ID**
$pdf->SetXY(163, 30); // Adjust Y position for barcode
$pdf->write1DBarcode($order_id, 'C39', '', '', 50, 15, 0.4, [], 'N'); 

$pdf->Ln(5); // Add some space

// **Billing Address**
$pdf->Cell(0, 10, "Billing Address:", 0, 1);
$pdf->MultiCell(0, 5, "Name: $userName\nAddress: $billingAddress\nMobile: $userMobile", 0, 'L');
$pdf->Ln(5);

// **Shipping Address**
$pdf->Cell(0, 10, "Shipping Address:", 0, 1);
$pdf->MultiCell(0, 5, $shippingAddress, 0, 'L');
$pdf->Ln(5);

// **Billing Method**
$pdf->Cell(0, 10, "Billing Method: $billingMethod", 0, 1);
$pdf->Ln(5);

// **Table Header**
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(60, 10, "Product", 1, 0, 'C');
$pdf->Cell(120, 10, "Product Name", 1, 1, 'C');

// **Product List using MultiCell for Better Formatting**
$pdf->SetFont('helvetica', '', 12);
foreach ($products as $product) {
    if (!empty($product['Name'])) {
        $pdf->Cell(60, 10, $product['Product'], 1, 0, 'C');
        $pdf->MultiCell(120, 10, $product['Name'], 1, 'C');
    }
}

// **Total Price**
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(60, 10, "Total Price (INR)", 1, 0, 'C');
$pdf->Cell(120, 10, number_format($totalAmount, 2), 1, 1, 'C');

// Move to bottom (Adjust the Y position as needed)
$pdf->Ln(10);
// Add "Thank You" message above the image
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, "Thank you for ordering with us!", 0, 1, 'C');

// Reduce space to prevent page overflow
$pdf->Ln(0);

// Add the image (adjust X, Y, width, height as needed)
$pdf->Image('images/invoicelogo.jpg', 60, $pdf->GetY(), 90, 25, 'JPG');  

// Move cursor to bottom for disclaimer
$pdf->SetY(-15); 

// Set font size smaller for disclaimer
$pdf->SetFont('helvetica', '', 8);

// Add the text centered
$pdf->Cell(0, 10, "This is a computer-generated bill.", 0, 1, 'C');
// **Output PDF**
$pdf->Output("invoice_$order_id.pdf", "D");

?>