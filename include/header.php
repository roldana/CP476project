<?php 

session_start();

if ((basename($_SERVER['PHP_SELF']) != "index.php" and basename($_SERVER['PHP_SELF']) != "sign-up.php" and basename($_SERVER['PHP_SELF']) != "contact.php" and basename($_SERVER['PHP_SELF']) != "info.php" and basename($_SERVER['PHP_SELF']) != "error.php") and (!isset($_SESSION['LoggedIn']) or $_SESSION['LoggedIn'] == False)) {
    header("Location: ../index.php"); 
    exit;
} else if (basename($_SERVER['PHP_SELF']) == "index.php" and (isset($_SESSION['LoggedIn'])) and ($_SESSION['LoggedIn'] == True)){
    header("Location: php/account.php");
    exit;
} else if (basename($_SERVER['PHP_SELF']) == "sign-up.php" and (isset($_SESSION['LoggedIn'])) and ($_SESSION['LoggedIn'] == True)){
    header("Location: account.php"); 
    exit;
}

$prefix="";
if ((basename($_SERVER['PHP_SELF']) == "index.php")) {
    $prefix="php/"; 
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php
    if ((basename($_SERVER['PHP_SELF']) == "index.php")) {echo "Index";}
    else if ((basename($_SERVER['PHP_SELF']) == "sign-up.php")) {echo "Sign Up";}
    else if ((basename($_SERVER['PHP_SELF']) == "group-list.php")) {echo "Group List";}
    else if ((basename($_SERVER['PHP_SELF']) == "group-schedule-view.php")) {echo "Group Schedule View";}
    else if ((basename($_SERVER['PHP_SELF']) == "calendar-view.php")) {echo "Calendar View";}
    else if ((basename($_SERVER['PHP_SELF']) == "create-group.php")) {echo "Create Group";}
    else if ((basename($_SERVER['PHP_SELF']) == "message-centre.php")) {echo "Message Centre";}
    else if ((basename($_SERVER['PHP_SELF']) == "account.php")) {echo "Account";}
    else if ((basename($_SERVER['PHP_SELF']) == "contact.php")) {echo "Contact";}
    else if ((basename($_SERVER['PHP_SELF']) == "info.php")) {echo "Info";}
    else {echo "Page";}
    ?>
    </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
      
    <?php if ((basename($_SERVER['PHP_SELF']) == "index.php")) { ?>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css"> 
    <link rel="stylesheet" type="text/css" href="css/util.css">  
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/jquery/jquery.validate.min.js"></script>
    <?php } else { ?>
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/util.css">     
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../vendor/jquery/jquery.validate.min.js"></script>
    <script src="../js/header-notify.js"></script> 
    <?php } ?>
<!--===============================================================================================-->
</head>
<body>
    
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a href="info.php"class="navbar-brand">Calendar Thing</a>
        
        <div class="navbar-nav ml-auto">    
            <?php if ((isset($_SESSION['LoggedIn'])) && $_SESSION['LoggedIn'] == True) {?>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Account
                    <span class="badge badge-success count"></span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo $prefix; ?>account.php">My Account</a>
                    <a class="dropdown-item" href="<?php echo $prefix; ?>group-list.php">Join Groups</a>
                    <a class="dropdown-item" href="<?php echo $prefix; ?>message-centre.php">Message Centre
                        <span class="badge badge-success count"></span>
                    </a>
                </div>
            </li>
            <a class="nav-link" href="<?php echo $prefix; ?>info.php">About Calendar</a>
            <a class="nav-link" href="<?php echo $prefix; ?>contact.php">Contact Us</a>              
            <form class="navbar-form form-inline" action="<?php echo $prefix; ?>group-list.php" method="GET">
              <div class="form-group mr-1">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for a group">
                    <div class="input-group-btn input-group-append">
                        <button type="submit" class="btn btn-outline-success">Search</button>
                    </div>
                </div>
              </div>
            </form>
            <a class="nav-link btn btn-danger text-white m-1" href="<?php echo $prefix."functions/"; ?>logout.php">Logout</a>
        </div>
        <?php } else {?>
            <a class="nav-link" href="<?php echo $prefix; ?>info.php">About Calendar</a>
            <a class="nav-link" href="<?php echo $prefix; ?>contact.php">Contact Us</a>
            <a class="nav-link" href="<?php if (!$prefix) { echo "../";} ?>index.php">Login</a>
            <a class="nav-link" href="<?php echo $prefix; ?>sign-up.php">Sign Up</a>
        <?php } ?>
    </nav>