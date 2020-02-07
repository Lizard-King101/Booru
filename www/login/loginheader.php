<?php
//PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
session_start();
if (!isset($_SESSION['username']) && basename($_SERVER['PHP_SELF']) == 'account.php') {
    
    return header("location:index.php");
}
?>