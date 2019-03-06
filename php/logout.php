<?php

session_start();

unset($_SESSION['LoggedIn']);

header("Location: ../index.php");

?>