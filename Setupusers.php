<?php //setupUsers.php


//phpinfo();

require_once 'server.php';
require_once 'fatalerror.php';



$conn =  mysqli_connect($servername, $user,$password, $database);

//custom error message "error_connect_error"
if($connection->connect_error)die($connection->error_connect_error);



    

//table to setup users // commented because it is already in database
/*
$query = "CREATE TABLE logers(
forename VARCHAR(32) NOT NULL,
surename VARCHAR(32) NOT NULL,
username VARCHAR (32) NOT NULL UNIQUE,
password VARCHAR(32) NOT NULL)";



$result = $connection ->query($query);
if(!$result) die ($connection->error);
*/



$salt1 = "qm&h*";
$salt2 = "pg!@";


$forename = 'Bob';
$surename = 'bill';
$username = 'bobill';
$password = 'topone';

$token = hash('ripemd128', "$salt1$password$salt2");


add_user($connection, $forename, $surename, $username, $token);


$forename = 'john';
$surname = 'brown';
$username = 'jbrown';
$password = 'secrettwo';

 
$token = hash('ripemd128', "$salt1$password$salt2");

add_user($connection, $forename, $surname, $username, $token);

function add_user( $connection, $fn, $sn, $un, $pw) {
    
    $query = "INSERT INTO logers VALUES
    
    ('$fn', '$sn', '$un', '$pw')";
    
    
    $result = $connection->query($query);
    
    if (!$result) die($connection->error);

}








?>