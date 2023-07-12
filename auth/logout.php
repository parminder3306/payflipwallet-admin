<?php
session_start();
session_destroy();
unset($_SESSION['adminsession']);
header("Location:/admin/login");
?>