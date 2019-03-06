<?php

session_start();

$_SESSION['LoggedIn'] = True;

header("Location: account.php");

?>