<?php

$recaptcha_secret = '6LcYhhcrAAAAAO_WwHq0jrVu66TtZtodmGO_Cum7'; 
$thank_you_page = 'thank-you.html'; 
$to_email = 'antonietta.jimenez@gmail.com';
$email_from = 'ant@antjimenez.com';


$name = htmlspecialchars(trim($_POST['name']));
$visitor_email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$message = htmlspecialchars(trim($_POST['message']));
$recaptcha_response = $_POST['g-recaptcha-response'];


if (empty($name) || empty($visitor_email) || empty($recaptcha_response)) {
    echo "All fields are required, including CAPTCHA.";
    exit;
}


$verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
$response_data = json_decode($verify_response);

if (!$response_data->success) {
    echo "Captcha verification failed. Please try again.";
    exit;
}

$email_subject = "New Form Submission";
$email_body = "You have received a new message from:\n\n".
              "Name: $name\n".
              "Email: $visitor_email\n\n".
              "Message:\n$message\n";

$headers = "From: $email_from\r\n";
$headers .= "Reply-To: $visitor_email\r\n";


$success = mail($to_email, $email_subject, $email_body, $headers);

if ($success) {
    
    header("Location: $thank_you_page");
    exit;
} else {
    echo "Message failed to send. Please try again later.";
}
?>
