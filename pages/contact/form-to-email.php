<?php



$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];



if(empty($name) || empty($visitor_email)) {
    echo "Name and e-mail are required fields.";
    exit;
}



$email_from = 'ant@antjimenez.com';

$email_subject = "New Form submission";

$email_body = "You have received a new message from the user $name.\n". 
    "Here is the message:\n $message";




    $to = "antonietta.jimenez@gmail.com";

    $headers = "From: $email_from \r\n";
  
    $headers .= "Reply-To: $visitor_email \r\n";
  
    mail($to,$email_subject,$email_body);







?>