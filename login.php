<?php require_once ('inc/header.php') ?>
<?php require_once ('inc/nav.php') ?>

    <!-- login start -->
    <section class="section-tb-padding">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="login-area">
                        <div class="login-box">
                            <h1>Login</h1>
                            <p>Please login below account detail</p>
                            <form method="post">
                                <label>Email</label>
                                <input type="text" id="email" name="email" placeholder="Email">
                                <label>Password</label>
                                <input type="password" id="password" name="password" placeholder="Password">
                                <div class="text-danger" id="error_msg"></div>
                                <a id="btn_login" class="btn-style1">Sign in</a>
                                <a href="forgot-password.html" class="re-password">Forgot your password?</a>
                            </form>
                        </div>
                        <div class="login-account">
                            <h4>Don't have an account?</h4>
                            <a href="register.php" class="ceate-a">Create account</a>
                            <div class="login-info">
                                <a href="terms-conditions.html" class="terms-link"><span>*</span> Terms &
                                    conditions.</a>
                                <p>Your privacy and security are important to us. For more information on how we use
                                    your data read our <a href="privacy-policy.html">privacy policy</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login end -->


<?php require_once ('inc/footer.php') ?>