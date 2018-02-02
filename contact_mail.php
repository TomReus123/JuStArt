<?php
/**
 * Copyright (c) 2018 Jesse de Jong
 */

//This file uses functions from the file "functions.php", please do not remove the file link
//because it will prevent the script from working correctly or prevent it from working at all

require_once 'functions.php';

//Assign values from GET to variables that are usable inside the mail functions
$name = $_POST['userName'];
$email = $_POST['userEmail'];
$subject = $_POST['subject'];
$content = $_POST['content'];

//Call on mail functions and give them the variables needed to send the email
sendMailToOwner($name, $email, $subject, $content);
sendMailToUser($name, $email);
