<?php
    include("../include/header.php");
?>

<div class="content-container">

    <div class="login-form-wrap">
        <form method="POST" action="group-list.php">
            <span class="form-title">
				Sign Up
			</span>
            <div class="wrap-input">
                <input class="input-box" type="text" name="username" placeholder="Username">
            </div>

            <div class="wrap-input">
                <input class="input-box" type="text" name="email" placeholder="Email">
            </div>

            <div class="wrap-input" >
                <input class="input-box" type="password" name="pass1" placeholder="Password">
            </div>

            <div class="wrap-input">
                <input class="input-box" type="password" name="pass2" placeholder="Repeat Password">
            </div>
            <div class="wrap-checkbox">
                <div >
                    <input id="ckb1" type="checkbox" name="agree">
                    <label for="ckb1">
                        I agree to the <a href="#" class="txt1">terms and conditions</a>
                    </label>
                </div>
            </div>

            <div class="container-login-submit">
                <button class="login-submit">
                    Sign Up
                </button>
            </div>
        </form>
    </div>
</div>

<?php
    include("../include/footer.php");
?>