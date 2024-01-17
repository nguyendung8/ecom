<?php require_once ('inc/header.php') ?>
<?php require_once ('inc/nav.php') ?>
    
    <!-- login start -->
    <section class="section-tb-padding">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="register-area">
                        <div class="register-box">
                            <h1>Create account</h1>
                            <p>Please register below account detail</p>
                            <form method="post">
                                <input type="text" id="name" name="name" placeholder="Name">
                                <input type="email" id="email" name="email" placeholder="Email">
                                <input type="password" id="password" name="password" placeholder="Password">
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                <div class="text-danger" id="error_msg"></div>
                                <a id="btn_register" class="btn-style1">Create</a>
                            </form>
                        </div>
                        <div class="register-account">
                            <h4>Already an account holder?</h4>
                            <a href="login.php" class="ceate-a">Log in</a>
                            <div class="register-info">
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