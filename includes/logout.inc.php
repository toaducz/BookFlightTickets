<?php
session_start();
setcookie('Uname', '',time() - 3600, "/");
setcookie('Upwd', '',time() - 3600, "/");   
session_unset();
unset($_SESSION['firstname']);
unset($_SESSION['midname']);
unset($_SESSION['lastname']);
unset($_SESSION['phone']);
unset($_SESSION['date']);
session_destroy();
header('Location: ../index.php');
