<?php
    include ("_header.php");
?>
<div class="section-login section-outer">
    <div class="section-inner">
        <h1>My account</h1>
        <div class="section-login__buttons">
            <div class="section-login__buttons-background">
            </div>

            <div class="section-login__buttons-signin">
                Sign in
            </div>

            <div class="section-login__buttons-register">
                Register
            </div>
        </div>
        <div class="section-login__form slider">
            <div class="slider-line">

                <form name="register_form" method="post" class="section-login__form-register">
                    <div class="name__block">
                        <div class="name__block-item">
                            <input type="text" placeholder="First Name" class="register__first_name name mandatory" name="first_name">
                            <div class="error error_text"></div>
                        </div>
                        <div class="name__block-item">
                        <input type="text" placeholder="Last Name"
                               class="register__last_name name mandatory" name="last_name">
                        <div class="error error_text"></div>
                        </div>
                    </div>
                    <input type="email" class="register__email mandatory" placeholder="Email" name="email">
                    <div class="error error_text email"></div>
                    <input type="password" placeholder="Password" class="register__password mandatory" name="password">
                    <button class="register-form__button" type = "button">Register</button>
                </form>

                <form name="login_form" method="post" class="section-login__form-login">
                    <input type="email" class="login__email mandatory" placeholder="Email" name="email">
                    <div class="error error_text email_login"></div>
                    <input type="password" class="login__password mandatory" placeholder="Password" name="password">
                    <div class="error error_text password"></div>
                    <input type="checkbox" name="Remember" id="remember">
                    <label for="remember">Remember me</label>
                    <button class="login-form__button" type = "button">Sign in</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php
include("_footer.php");
?>
<script src="../javascript_additional/login.js"></script>
</body>
</html>
