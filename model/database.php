<?php

$dsn = 'mysql:host=localhost;dbname=allstarauto_pos';
$username = 'mgs_user';
$password = 'pa55word';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);    
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include 'errors/error_view.php';
    exit;
}

/*
function display_db_error($error_message) {
    global $app_path;
    include 'errors/db_error.php';
    exit;
}
*/

?>