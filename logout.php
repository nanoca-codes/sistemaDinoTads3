<?php
session_start(); 

$_SESSION = array();

session_destroy();

header("Location: formLogin.php?logout=sucesso");
exit();
?>