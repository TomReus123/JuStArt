<?php
require "vendor/autoload.php";

//FUNCTION TO SEND EMAILS TO OWNER
function sendMailToOwner($name, $email, $subject, $content){
    $mail = new \PHPMailer\PHPMailer\PHPMailer();
//Debugger setting (TURN OFF WHEN GOING LIVE)
    $mail->SMTPDebug = 0;
//Let PHPMailer use SMTP
    $mail->isSMTP();
//SMTP needs authentication
    $mail->SMTPAuth = true;
//Provide login credentials
    $mail->Username = "";
    $mail->Password = "";
//Setup encryption
    $mail->SMTPSecure = "ssl";
//Set TCP Port
    //OPTIONAL
//Add email information
    $mail->From = "";
    $mail->FromName = "";
//Add emailadress for information relay to site owner
    $mail->addAddress("", "");
//Set HTML Mail structure
    $mail->isHTML(true);
//Add email markup
    $mail->Subject = "Contact";

    $mail->Body = "<p>Contactaanvraag<br><br><br>
                                              Contact details: <br>
                                              Naam: " . $name . "<br>
                                              Email: " . $email . "<br>
                                              Onderwerp: " . $subject . "<br>
                                              Bericht: " . nl2br($content) . "<br>
                                           </p>";;
    $mail->AltBody = "$name + $email + $subject + $content";
//Send email and show error in case of a failed attempt
    $data = "sendMailToUser";
    if(!$mail->send()){
        logError($mail, $data);
    }else{
        echo "Message has been sent successfully";
    }
}

//FUNCTION TO SEND CONFIRMATION MAIL TO USER
function sendMailToUser($name, $email){
//See first function for in depth explanation
    $mail = new \PHPMailer\PHPMailer\PHPMailer();

//SMTP Settings
    $mail->SMTPDebug = 0; //TURN OFF WHEN GOING LIVE
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
//Username and password for email account
    $mail->Username = "";
    $mail->Password = "";
//Port
    $mail->Port = 0; //CHANGE THIS
//Add email information
    $mail->From = "";
    $mail->FromName = "";
//Add email adress to send confirmation to user
    $mail->addAddress("$email","$name");
//Set HTML mail structure
    $mail->isHTML(true);
//Add HTML markup
    $mail->Subject = "Bevestiging contactaanvraag";
    $mail->Body = "Bedankt voor het contact $name !";
    $mail->AltBody = "<!--ALTERNATIVE PLAIN TEXT EMAIL-->";
//Send email and log if an error occures
    $data = "sendMailToUser";
    if(!$mail->send()){
        logError($mail, $data);
    }else{
        echo "Message has been sent successfully";
    }
}

//Function for logging errors
function logError($mail, $data){
    echo "Something went wrong";
    //All info for log
    //Date
    $date = date("Y-m-d");
    //Name of logfile (New one everyday)
    $logname = "stats/" . $date. ".txt";
    //What went wrong
    $event = $mail->ErrorInfo;
    //What page
    $page = "functions.php";
    //Time
    $time = date("H:i:s");
    //Assemble line
    $log = $time . "|" . $page . "|" . $event. "|" . $data . PHP_EOL;
    //Append log line to file
    file_put_contents($logname, $log, FILE_APPEND);
    die();
}

