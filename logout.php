<?php
session_start();
session_destroy();
header("Location: home.html");
exit();

$_SESSION['logout'] = "You have been logged out successfully!";
header("Location: home.html");
?>