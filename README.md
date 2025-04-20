# 💻 PC Building Website

This is a PC Building Website where users can have a great experience creating custom PCs with parts of their choice. The website is designed to give a smooth and interactive interface for both beginners and enthusiasts looking to assemble a custom rig.

---

## 🚀 Features

- 🧩 **Custom PC Builder** – Select from a wide range of components like CPU, GPU, RAM, Storage, etc.
- 💳 **Razorpay Payment Integration** – Secure payment processing using Razorpay.
- 🧾 **Invoice Generation (PDF)** – Generate and download tax invoices using the **TCPDF** library.
- 🔒 **User Authentication** – Secure login system with hashed passwords and PHP sessions.
- 📦 **Cart Functionality** – Users can add parts to their cart and view the total before checking out.
- 📧 **Email Confirmation** – Sends confirmation emails to users via SMTP.

---

## 🧑‍💻 Technologies Used

- **PHP**
- **MySQL**
- **HTML / CSS**
- **JavaScript** (for dynamic UI)
- **TCPDF** (for invoice generation)
- **Razorpay API** (for payments)

---

## 🖼️ Design Previews

### 🏠 Home Page with Scrollable Banner
![Index Preview 1](./design/Index1.JPG)
![Index Preview 2](./design/Index2.JPG)

This is the home page where we have implemented scrollable banners using checkbox-based logic and styled transitions.

---

### 🔧 Custom PC Builder Page
![Options Preview](./design/options.JPG)

On this page, users can select from a variety of PC parts along with pricing options to customize their own build.

---

### 🛒 Cart Page
![Cart Preview](./customCPUbuild/design/WhatsApp%20Image%202025-04-20%20at%207.18.21%20PM.jpeg)

The cart shows selected components along with total pricing. Users can modify their cart before proceeding to payment.

---

### 🔐 Login Page
![Login Preview](./design/login.JPG)

This is the login page. Here, the user has entered invalid credentials.

- We implemented user authentication using `PHP $_SESSION` variables.
- User passwords are securely stored in the database using hashing (e.g., `password_hash()` function).

---

### 💳 Payment Method Page
![Payment Methods](./design/WhatsApp%20Image%202025-04-20%20at%207.18.23%20PM.jpeg)

The website supports multiple payment options, and Razorpay is used for online transactions.

---

### 🚀 Razorpay Payment Gateway
![Razorpay Preview](./design/Screenshot%202025-03-31%20101742.png)

When a user proceeds to payment, this is the Razorpay checkout page shown for transaction processing.

---

### ✅ Order Successful Page
![Order Success Preview](./design/WhatsApp%20Image%202025-04-20%20at%207.18.23%20PM%20(1).jpeg)

This page is shown once payment is successful, confirming that the order has been placed.

---

### 📄 Invoice PDF
![Invoice Preview](./design/Screenshot%202025-03-31%20101824.png)

Once the payment is complete, a PDF invoice is generated with user details and part-wise breakdown.

---

## 📁 Project Structure Overview

- `home.php` – Landing page
- `custom_rigs.php` – Component selection for building PC
- `cart.php` – Shows items added to cart
- `checkout.php` – Integrates Razorpay payment
- `generate_invoice.php` – PDF invoice generation using TCPDF
- `connect_database.php` – MySQL connection
- `send_mail.php` – Sends confirmation mail via SMTP
- `about_us.php` / `contact.php` – Informational pages

---

## ⚙️ Configuration Notes

> ✅ Before running the project, make sure you configure the following:

- In **`checkout.php`**, **add your Razorpay API Key ID and Secret**:
  ```php
  $apiKey = 'your_razorpay_api_key';
  $apiSecret = 'your_razorpay_secret';

In send_mail.php, add your app-specific email password and sender details:
  ```php
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'your_email@gmail.com'; // Your email address
  $mail->Password   = 'your_app_specific_password'; // App password, not your email password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 587;
  $mail->setFrom('your_email@gmail.com', 'Your Name');
  $mail->addAddress($userEmail); // Receiver's email address

⚠️ Important: For Gmail, make sure to enable 2-step verification and generate an App Password to use here. Do not use your regular email password.


📌 Setup Instructions
Clone the repository:
git clone https://github.com/yourusername/pc-building-website.git

Configure your .env or connect_database.php with your DB credentials.

Install TCPDF library (already included).

Add your Razorpay API keys in checkout.php.

Add your email and app password in send_mail.php.

Run it on a local server using XAMPP / LAMP.





