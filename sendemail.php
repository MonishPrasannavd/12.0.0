<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Set content type to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $company = isset($_POST['company']) ? trim($_POST['company']) : '';
    $industry = isset($_POST['industry']) ? trim($_POST['industry']) : '';
    $revenue = isset($_POST['revenue']) ? trim($_POST['revenue']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($company) || empty($industry) || empty($revenue)) {
        echo json_encode([
            'response' => 'error',
            'errorMessage' => 'Please fill in all required fields.'
        ]);
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'response' => 'error',
            'errorMessage' => 'Please enter a valid email address.'
        ]);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; // Disable verbose debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send email
        $mail->SMTPAuth = true;
        $mail->Username = 'monish.vadlamudi@ikonostechnologies.com'; // SMTP username
        $mail->Password = 'yvyl iwue gphl cmwb'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('monish.vadlamudi@ikonostechnologies.com', 'Contact Form');
        $mail->addAddress('monish.vadlamudi@ikonostechnologies.com', 'Recipient Name'); // Add a recipient
        $mail->addReplyTo($email, $name); // Add reply-to address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Contact Form';
        $mail->Body = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>
            <p><strong>Company:</strong> " . htmlspecialchars($company) . "</p>
            <p><strong>Industry:</strong> " . htmlspecialchars($industry) . "</p>
            <p><strong>Annual Revenue:</strong> " . htmlspecialchars($revenue) . "</p>
            <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
        ";

        $mail->send();
        echo json_encode([
            'response' => 'success'
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'response' => 'error',
            'errorMessage' => 'Message could not be sent. Please try again later.',
            'responseText' => 'Mailer Error: ' . $mail->ErrorInfo
        ]);
    }
} else {
    echo json_encode([
        'response' => 'error',
        'errorMessage' => 'Invalid request method.'
    ]);
}
?>
