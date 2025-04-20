<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles/contact_us.css" />
    <style>
        /* Add some spacing and alignment for the form */
        .form form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .form label {
            font-weight: bold;
            color: white;
        }
        .form input, .form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form textarea {
            height: 100px;
            resize: vertical;
        }
        .form button {
            background-color:rgb(51, 1, 109);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <!-- header -->
    <?php include 'navigation.php'; ?>

    <!-- main content -->
    <div class="flex-container">
        <div class="contact">
            <h2 style='color:white;margin-bottom:30px;'>Contact Us</h2>
            <p>
                405/406/407,Ayush towers, Saki vihar road, Hiranandani, Mumbai 400072, India<br />
                Email : <a href="mailto:ayushprojects26@gmail.com">ayushprojects26@gmail.com</a>
            </p>
            <br />
            <p>Office Timings : From 10 AM - 6 PM, MON-SAT.</p>
            <br />
            <p>Contact Us</p>
            <br />
            <p>
                Phone Number: 0124-*******/0124-******* (From 10AM - 6PM) MON-SAT.
            </p>
            <p>
                <b>Bank Details</b><br />
                BANK NAME : RAZORPAY BANK<br />
                ACCOUNT NUMBER : 0000000000000<br />
                ACCOUNT HOLDER NAME : PC ASSEMBLY HUB RETAIL LLP<br />
                ACCOUNT TYPE : CURRENT <br />
                IFSC CODE: SCAN000****<br />
                BRANCH : Airoli
            </p>
        </div>

        <div class="form">
            <h2 style='color:white;margin-bottom:30px;'>Feedback</h2>
            <form action="send_mail.php" method="POST">
                <label for="first_name">Name</label>
                <input type="text" placeholder="Enter your name" name="first_name" id="first_name" required />

                <label for="phone">Phone Number</label>
                <input type="text" placeholder="Enter phone number" name="phone" id="phone" required />

                <label for="email">Email</label>
                <input type="email" placeholder="Enter your email" name="email" id="email" required />

                <label for="message">Message</label>
                <textarea placeholder="Enter your message" name="message" id="message" required></textarea>

                <button type="submit">Send Message</button>
            </form>
            <p style='margin: 30px 0;'>
                Have questions, feedback, or need assistance? We’d love to hear from you! 
                Feel free to reach out to us via email, phone, or by filling out the contact form below. 
                Our team is available to help and will get back to you as soon as possible.
            </p>
        </div>
    </div>

    <!-- main content end -->

    <!-- footer -->
    <?php include 'footer.php'; ?>

</body>
</html>
