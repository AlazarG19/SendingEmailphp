<?php

use PHPMailer\PHPMailer\PHPMailer;

include "PHPMailer/PHPMailer.php";
include "PHPMailer/Exception.php";
include "PHPMailer/SMTP.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit-btn'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $userpassword = $_POST["password"];  // your mail password
        $name = "Title of Text";  // Name of your website or yours
        $to = "$email";  // mail of reciever
        $subject = "Subject of Mail";  // subject of mail
        $body = "Your User Name is {$username} and your Password is {$userpassword}";
        $from = "alazarthenew@gmail.com";  // you mail
        $password = "xaohsucjdtmrtxrx";  // your mail password
        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com"; // smtp address of your email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 587;  // port
        $mail->SMTPSecure = "tls";  // tls or ssl
        $mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // enter email address whom you want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            echo "Email is sent!";
        } else {
            echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Sending Email</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="contact-box">
            <div class="right">
                <form method="post">
                    <h2>Sending Email</h2>
                    <input name="username" type="text" class="field" placeholder="Your User Name">
                    <input name="email" type="text" class="field" placeholder="Your Email">
                    <input name="email" type="text" class="field" placeholder="Email sent from alazarthenew@gmail.com" disabled>
                    <?php
                    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                    $pass = array(); //remember to declare $pass as an array
                    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                    for ($i = 0; $i < 8; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                    $password = implode($pass); //turn the array into a string

                    echo "<input type = 'hidden' value = '{$password}' name='password' >"
                    ?>
                    <!-- <input name = "emai type="text" class="field" placeholder="Email Sent to"> -->
                    <button type="submit" name="submit-btn" class="btn">Send</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>