<?php
session_start();
session_destroy();//выходим из аккаунта
setcookie('authtoken', null, time() - 100);// убираем куку
header('Location: index');
exit();
?>