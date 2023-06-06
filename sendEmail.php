<?php
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception;
    class sendEmail
    {
        function send($code, $Email)
        {
            include 'PHPMailer/src/Exception.php';
            include 'PHPMailer/src/PHPMailer.php';
            include 'PHPMailer/src/SMTP.php';
            // create object of PHPMailer class with boolean parameter which sets/unsets exception.
            $mail = new PHPMailer(true);                              

            try {
                $mail->isSMTP(); // using SMTP protocol                                     
                $mail->Host = 'sandbox.smtp.mailtrap.io'; // SMTP host as gmail 
                $mail->SMTPAuth = true;  // enable smtp authentication                             
                $mail->Username = 'f4050677ac0293';              
                $mail->Password = '79857e0f9a4e72';                          
                $mail->SMTPSecure = 'tls';                             
                $mail->Port = 587;      
                $mail->isHTML(true); 
                $mail->setFrom('iamanshulanand@gmail.com', "Anshul"); 
                $mail->addAddress($Email, "User");  
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
                $mail->Subject = 'Email Verification';
                $mail->Body    = 'Please use this code to verify & reset your account password: '.$code ;

                $mail->send();
                echo 'Message has been sent';
            } 
            catch (Exception $e) { // handle error.
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }
    }
    $sendMI = new sendEmail();
?>