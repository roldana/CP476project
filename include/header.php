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
            <?php if (!(basename($_SERVER['PHP_SELF']) == "index.php")) {?>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Account
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="account.php">My Account</a>
                    <a class="dropdown-item" href="group-list.php">Join Groups</a>
                    <a class="dropdown-item" href="message-centre.php">Message Centre</a>
                </div>
            </li>
            <a class="nav-link nav-link" href="info.php">About Calendar</a>
            <a class="nav-link nav-link" href="#">Other</a>  
            <form class="navbar-form" action="group-list.php">
              <div class="form-group float-l">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
        <?php } else {?>
            <a class="nav-link nav-link" href="php/info.php">About Calendar</a>
        <?php } ?>
    </nav>