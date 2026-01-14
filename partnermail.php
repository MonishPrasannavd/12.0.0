<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Set content type to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input - Partner Form Fields
    $firm_name = isset($_POST['firm_name']) ? trim($_POST['firm_name']) : '';
    $firm_activities = isset($_POST['firm_activities']) ? trim($_POST['firm_activities']) : '';
    $director_name = isset($_POST['director_name']) ? trim($_POST['director_name']) : '';
    $country = isset($_POST['country']) ? trim($_POST['country']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $contact_no = isset($_POST['contact_no']) ? trim($_POST['contact_no']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $total_employees = isset($_POST['total_employees']) ? trim($_POST['total_employees']) : '';
    $interest_reason = isset($_POST['interest_reason']) ? trim($_POST['interest_reason']) : '';
    $team_structure = isset($_POST['team_structure']) ? trim($_POST['team_structure']) : '';

    // Basic validation - check all required fields
    if (empty($firm_name) || empty($firm_activities) || empty($director_name) || 
        empty($country) || empty($address) || empty($contact_no) || 
        empty($email) || empty($total_employees) || empty($interest_reason) || 
        empty($team_structure)) {
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

    // Validate total employees is a positive number
    if (!is_numeric($total_employees) || intval($total_employees) < 1) {
        echo json_encode([
            'response' => 'error',
            'errorMessage' => 'Please enter a valid number of employees (minimum 1).'
        ]);
        exit;
    }

    // Handle file upload
    $attachmentPath = null;
    $attachmentName = null;
    if (isset($_FILES['firm_profile']) && $_FILES['firm_profile']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['firm_profile'];
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];
        $allowedExtensions = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $fileType = $file['type'];
        
        // Validate file type
        if (!in_array($fileExtension, $allowedExtensions) || !in_array($fileType, $allowedTypes)) {
            echo json_encode([
                'response' => 'error',
                'errorMessage' => 'Invalid file type. Please upload PDF, DOC, DOCX, JPG, or PNG files only.'
            ]);
            exit;
        }
        
        // Validate file size (max 5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
        if ($file['size'] > $maxFileSize) {
            echo json_encode([
                'response' => 'error',
                'errorMessage' => 'File size exceeds 5MB limit. Please upload a smaller file.'
            ]);
            exit;
        }
        
        // Create uploads directory if it doesn't exist
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Generate unique filename
        $attachmentName = $file['name'];
        $uniqueFileName = time() . '_' . uniqid() . '_' . basename($attachmentName);
        $attachmentPath = $uploadDir . $uniqueFileName;
        
        // Move uploaded file
        if (!move_uploaded_file($file['tmp_name'], $attachmentPath)) {
            echo json_encode([
                'response' => 'error',
                'errorMessage' => 'Failed to upload file. Please try again.'
            ]);
            exit;
        }
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; // Disable verbose debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send email
        $mail->SMTPAuth = true;
        $mail->Username = 'info@compseqr.com'; // SMTP username
        $mail->Password = 'ncrp rjkm alcv ganq'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('info@compseqr.com', $director_name . ' <' . $email . '>');
        $mail->addAddress('info@compseqr.com', 'Recipient Name'); // Add a recipient
        $mail->addReplyTo($email, $director_name); // Add reply-to address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Partner Application - ' . htmlspecialchars($firm_name);
        $mail->Body = "
            <h2>New Partner Application</h2>
            <p><strong>Name of the Firm:</strong> " . htmlspecialchars($firm_name) . "</p>
            <p><strong>Director/Partner Name:</strong> " . htmlspecialchars($director_name) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Contact No:</strong> " . htmlspecialchars($contact_no) . "</p>
            <p><strong>Country:</strong> " . htmlspecialchars($country) . "</p>
            <p><strong>Address:</strong><br>" . nl2br(htmlspecialchars($address)) . "</p>
            <p><strong>Total No of Employees:</strong> " . htmlspecialchars($total_employees) . "</p>
            <p><strong>Firm Activities:</strong><br>" . nl2br(htmlspecialchars($firm_activities)) . "</p>
            <p><strong>Why Are You Interested?</strong><br>" . nl2br(htmlspecialchars($interest_reason)) . "</p>
            <p><strong>Team Structure of Your Firm:</strong><br>" . nl2br(htmlspecialchars($team_structure)) . "</p>
        ";
        
        // Attach file if uploaded
        if ($attachmentPath && file_exists($attachmentPath)) {
            $mail->addAttachment($attachmentPath, $attachmentName);
        }

        $mail->send();
        
        // Clean up uploaded file after sending email
        if ($attachmentPath && file_exists($attachmentPath)) {
            unlink($attachmentPath);
        }
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
