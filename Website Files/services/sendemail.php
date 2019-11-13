<?php 
function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
$to_email = 'greenify@devepi.com';
$subject = 'Contact Us From Greenify';
$message = "<html><body>FROM: " .$_POST['firstname']. " " . $_POST['lastname']. "<br>EMAIL: ".$_POST['email']. "<br>CONTACT NUMBER: ".$_POST['contact']."<br>CONTENT: ". $_POST['textarea']."</body><html>";
$headers = 'From: greenify@devepi.com' . "\r\n";
$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//check if the email address is invalid $secure_check
$secure_check = sanitize_my_email($to_email);
if ($secure_check == false) {
    echo "Invalid input";
} else { //send email 
    mail($to_email, $subject, $message, $headers);
    echo "Thank you for contacting us!";
}
?>