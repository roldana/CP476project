<?php 
$prefix="";
if ((basename($_SERVER['PHP_SELF']) == "index.php")) {
    $prefix="php/"; 
}

session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <?php if ((basename($_SERVER['PHP_SELF']) == "index.php")) { ?>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css"> 
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/jquery/jquery.validate.min.js"></script>
    <?php } else { ?>
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/styles.css"> 
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../vendor/jquery/jquery.validate.min.js"></script>
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
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Account
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo $prefix; ?>account.php">My Account</a>
                    <a class="dropdown-item" href="<?php echo $prefix; ?>group-list.php">Join Groups</a>
                    <a class="dropdown-item" href="<?php echo $prefix; ?>message-centre.php">Message Centre</a>
                </div>
            </li>
            <a class="nav-link" href="<?php echo $prefix; ?>info.php">About Calendar</a>
            <a class="nav-link" href="<?php echo $prefix; ?>contact.php">Contact Us</a>
            <a class="nav-link" href="<?php echo $prefix; ?>logout.php">Logout</a>              
            <form class="navbar-form form-inline" action="<?php echo $prefix; ?>group-list.php">
              <div class="form-group float-l">
                <input type="text" class="form-control mr-sm-2" placeholder="Search for a group">
              </div>
              <button type="submit" class="btn btn-outline-success">Search</button>
            </form>
        </div>
        <?php } else {?>
            <a class="nav-link" href="<?php echo $prefix; ?>info.php">About Calendar</a>
            <a class="nav-link" href="<?php echo $prefix; ?>contact.php">Contact Us</a>
            <a class="nav-link" href="<?php if (!$prefix) { echo "../";} ?>index.php">Login</a>
            <a class="nav-link" href="<?php echo $prefix; ?>sign-up.php">Sign Up</a>
        <?php } ?>
    </nav>