<?php
    include("../include/header.php");
?>

<div class="content-container">

    <div class="login-form-wrap">
        <form id="sign-up-form" method="POST" action="group-list.php">
            <span class="form-title">
				Sign Up
			</span>
            <div class="wrap-input">
                <input class="input-box" type="text" name="username" placeholder="Username">
            </div>

            <div class="wrap-input">
                <input class="input-box" type="text" name="email" placeholder="Email">
            </div>
            
            <div class="wrap-input">
                <input class="input-box" type="text" name="affiliation" placeholder="Affiliation (School/Workplace)">
            </div>

            <div class="wrap-input" >
                <input class="input-box" type="password" id="pass1" name="pass1" placeholder="Password">
            </div>

            <div class="wrap-input">
                <input class="input-box" type="password" id="pass2" name="pass2" placeholder="Repeat Password">
            </div>
            <div class="wrap-checkbox">
                <div >
                    <input id="agree" type="checkbox" name="agree">
                    <label for="agree">
                        I agree to the <a href="#" class="txt1">terms and conditions</a>
                    </label>
                </div>
            </div>

            <div class="container-login-submit">
                <button class="login-btn btn btn-primary btn-lg">
                    Sign Up
                </button>
            </div>
        </form>
    </div>
</div>

    <script src="../js/sign-up.js"></script>

<?php
    include("../include/footer.php");
?>