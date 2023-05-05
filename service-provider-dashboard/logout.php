<?php
setcookie("service_token", "", time() + (86400 * 30), "/");
header("Location:login.php");
?>