<?php
session_start();
require_once('class.phpmailer.php');
require_once('class.smtp.php');
if($_POST) {
    //if( !isset($_SESSION['alreadysent']) ) {
        if( isset( $_POST['contactname'] ) && !empty( $_POST['contactname'] ) ):
            $name = filter_var(trim($_POST['contactname']), FILTER_SANITIZE_STRING);
        else:
          echo $error = 'Name is empty!';
           return;
        endif;        
        
        if( isset( $_POST['email'] ) && !empty( $_POST['email'] ) ):
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                if( !filter_var( $email , FILTER_VALIDATE_EMAIL ) ):
                   echo $error = 'Email is not valid!';
                    return;
                endif;
        else:
            echo $error = 'Email is empty!';
          return;
        endif;

        if( isset( $_POST['phonenumber'] ) && !empty( $_POST['phonenumber'] ) ):
            $phonenumber = filter_var(trim($_POST['phonenumber']), FILTER_SANITIZE_STRING);
        else:
            echo $error = 'Phone Number is empty!';
          return;
        endif;

        if( isset( $_POST['questionsconcerns'] ) && !empty( $_POST['questionsconcerns'] ) ):
            $questionsconcerns = filter_var(trim($_POST['questionsconcerns']), FILTER_SANITIZE_STRING);
        else:
            echo $error = 'Questions and Concerns is empty!';
          return;
        endif;

        if( isset( $_POST['zip'] ) && !empty( $_POST['zip'] ) ):
            $zip = filter_var(trim($_POST['zip']), FILTER_SANITIZE_STRING);
        else:
            echo $error = 'Zipcode is empty!';
          return;
        endif;

       if(!isset($error)) {
           $message = "NAME: {$name} <br /> Phone: {$phonenumber} <br /> Email: {$email} <br /> Questions/Concerns: {$questionsconcerns}";
           
           $message .= "<br />";
           $message .= "DueDate: {$_POST['duedate']}";
           $message .= "<br />";
           $message .= "Address: {$_POST['address']}";
           $message .= "<br />";
           $message .= "{$_POST['city']}";
           $message .= " ";
           $message .= "{$_POST['zip']}";
           $message .= "<br />";
           $message .= "Partner/Spouse: : {$_POST['partner']}";
           $message .= "<br />";
           $message .= "Additional Phone: {$_POST['additionalphone']}";
           $message .= "<br />";
           $message .= "Hospital or Home Birth: {$_POST['homehospital']}";
           $message .= "<br />";
           $message .= "Hospital Name: {$_POST['hospitalname']}";
           $message .= "<br />";
           $message .= "Midwife/Doctor: {$_POST['provider']}";
           $message .= "<br />";
           $message .= "First Birth: {$_POST['firstbirthgroup']}";
           $message .= "<br />";
           $message .= "About other births: {$_POST['aboutotherbirth']}";
           $message .= "<br />";
           $message .= "How did you hear about us: {$_POST['howdidyouhear']}";
           $message .= "<br />";
           $message .= "<br />";

           $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';
            $mail->Host = "smtp.labortubs.com";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = "info@labortubs.com";
            $mail->Password = "ha1bb2ak3ks4TUBS!";
            $mail->setFrom($email, $name);
            $mail->AddReplyTo($email,$name);
            $mail->addAddress('info@labortubs.com', 'Info Labortubs');
            $mail->addAddress('steve@bargelt.com', 'Testing Steve');
           
            $mail->Subject = $subject;
            $mail->Subject = 'Labor Tubs Inquiry';
            $mail->msgHTML($message);           
            // Send mail and report the result
            if($mail->send()):
                $_SESSION['alreadysent'] = 'alreadysent';
                echo 'success';
            else:
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                unset( $_SESSION['alreadysent'] );
            endif;
        }
//    } 
//    else {
//        echo 'already';
//    }
}
?>