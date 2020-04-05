<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'phptest';
$DATABASE_PASS = 'phptest';
$DATABASE_NAME = 'webtest';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (!$con) {
    exit('Failed to connect to DB');
}
?>
