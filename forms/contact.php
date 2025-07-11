<?php

// Tedi Africa Contact Form Handler
$receiving_email_address = 'maleshstanley@gmail.com';

if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = isset($_POST['name']) ? $_POST['name'] : '';
$contact->from_email = isset($_POST['email']) ? $_POST['email'] : '';
// The form uses 'sbject' as the field name for subject
$subject = isset($_POST['sbject']) ? $_POST['sbject'] : '';
$contact->subject = 'Tedi Africa Contact Form: ' . $subject;
$contact->add_message($contact->from_name, 'From');
$contact->add_message($contact->from_email, 'Email');
if (isset($_POST['phone'])) {
    $contact->add_message($_POST['phone'], 'Phone');
}
$contact->add_message(isset($_POST['message']) ? $_POST['message'] : '', 'Message', 10);

// Add a Tedi Africa footer to the message
$contact->add_message("\n---\nMessage sent via the Tedi Africa website (https://tediafrica.org)", '');

echo $contact->send();
?>
