<?php
/**
 * Copyright (c) 2018 Jesse de Jong
 */

session_start();
//The lifetime of a session (How long a session is active)
ini_set('session.cookie_lifetime', 1200); //20 minuten
//Assign the cookie lifetime to a variable
$cookie_lifetime = ini_get('session.cookie_lifetime');
//Destroy session when the cookie is too old
if($cookie_lifetime > 1200){
    session_destroy();
    echo 'Your session has expired';
}

//Make database connection
//$dbc = mysqli_connect("localhost", 'root', 'root', 'database') or die ("An error has occured");
