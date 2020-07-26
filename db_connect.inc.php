<?php

$server_name = 'localhost';
$username = 'root';
$password = 'long';
$db_name = 'loginsysphp';

$connect = mysqli_connect($server_name, $username, $password, $db_name);
if (!$connect){
    die('Error '.mysqli_connect_error());
}else{
    echo 'Success';

}
