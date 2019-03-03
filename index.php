<?php

    include("include/header.php");

?>

	<div class="content-container">      

			<div class="login-form-wrap">
				<form id="login-form" method="POST" action="php/group-list.php">
					<span class="form-title">
						Login to Calendar
					</span>
		
					<div class="wrap-input">
						<input class="input-box" type="text" name="username" placeholder="Username">
					</div>
							
					<div class="wrap-input">
						<input class="input-box" type="password" name="pass" placeholder="Password">
					</div>
					
					<div class="wrap-checkbox">
						<div >
							<input id="ckb1" type="checkbox" name="remember-me">
							<label for="ckb1">
								Remember me
							</label>
						</div>
						<div>
							<a href="#" class="txt1">
								Forgot?
							</a>
						</div>
					</div>

					<div class="container-login-submit">
						<button class="login-btn btn btn-primary btn-lg">
							Login
						</button>
					</div>
                    
					<div class="wrap-checkbox">
                        <p>Don't have an account? </p><a href="php/sign-up.php" class="txt1">Sign Up</a>
                    </div>
				</form>
			</div>
            
	</div>

    <script src="js/login.js"></script>
    
<?php

    include("include/footer.php");

?>