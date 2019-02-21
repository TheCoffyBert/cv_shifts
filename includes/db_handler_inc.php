<?php

//TODO: add information about my server. And please, future self, don't upload your personal info on GitHub
//Variables used to store information required in order to access the DB
$server_name = "";
$DB_username = "";
$DB_PWD = "";
$DB_name = "";

//Connection to DB
$conn = mysqli_connect($server_name, $DB_username, $DB_PWD, $DB_name);

//Check for possible errors during the connection
if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
