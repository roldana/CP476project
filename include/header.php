<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V10</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/styles.css">    
<!--===============================================================================================-->
</head>
<body>
	
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a href="#"class="navbar-brand">Calendar Thing</a>
        
        <div class="navbar-nav ml-auto">    
            <?php if ((basename($_SERVER['PHP_SELF']) == "index.php")) {?>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Account
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">View Groups</a>
                    <a class="dropdown-item" href="#">Join Groups</a>
                    <a class="dropdown-item" href="#">Account Details</a>
                </div>
            </li>
            <a class="nav-link nav-link" href="#">About Calendar</a>
            <a class="nav-link nav-link" href="#">Other</a>                
        </div>
        <?php } else {?>
            <a class="nav-link nav-link" href="#">About Calendar</a>
        <?php } ?>
    </nav>