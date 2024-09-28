<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

    //new mailer instance
    $mail = new PHPMailer(true);

    try{
        // // //debugging
        //  $mail ->SMTPDebug = 2;
        //  $mail ->Debugoutput ='html';

        // setting up the server
         $mail ->isSMTP();
         //<!-- we are using gmail -->
         $mail ->Host = 'smtp.gmail.com';
         $mail ->SMTPAuth = true;
         //<!-- setup email credentials -->
         $mail ->Username = 'danielwairimu16@gmail.com';
         $mail ->Password = 'asvv pgsw ollt tbva';
         $mail->SMTPSecure ='tls';
         $mail ->Port = 587;

        //validate the email address
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            throw new Exception('Invalid email address!');
        }

        //set users email address
        $mail ->setFrom($email,$name);

        // <!-- email receiving the message -->
         $mail ->addAddress('danielwairimu16@gmail.com');

         //<!-- content -->
          $mail ->isHTML(true);
          $mail ->Subject = 'New Applicant';
          $mail ->Body = "<b>Name:</b> $name<br><b>Email:</b> $email<br><b>Message:</b><br>$message";
          $mail ->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message";

          $mail ->send();
          echo 'sent!';
    }catch (Exception $e){
        echo "Not sent!!.Mailer Error:{$mail->ErrorInfo}";
    }
    }else{
        echo 'invalid request!';
    }

    
