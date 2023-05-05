<?php
session_start();
unset($_SESSION['usr_token']);
session_destroy();
header('Location: index.php');
?>