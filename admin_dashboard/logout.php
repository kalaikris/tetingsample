<?php
setcookie("azAdmin_Token", "", time() + (86400 * 30), "/");
header("Location:login.php");
?>