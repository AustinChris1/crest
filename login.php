<?php

require_once "includes/nav.php";
require_once "includes/message.php";
require_once "includes/un_auth.php";
require_once "googlelogin.php";
include "databases/captcha.php";
?>
<style>
    #success,
    #error {
        display: none;
    }
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <span class="breadcrumb-item active">Login</span>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Login</span></h2>

    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <form method="POST" action="#" id="loginForm" class="form bg-light p-30">
                <div id="success" class="alert alert-success" role="alert">
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                </div>
                <div id="error" class="alert alert-danger" role="alert">
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="g-recaptcha" data-sitekey="<?=$sitekey?>"></div>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-user btn-block" type="submit" id="loginBtn" name="login">Login</button>
                    </div>
                    <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <a href="<?= $client->createAuthUrl();?>" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <!-- <a href="" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register">Create an Account!</a>
                                    </div>

                </div>
            </form>
        </div>
        <div class="col-lg-5 mb-5">
            <div class="p-30 mb-30">
                <img src="asset/crest.png" class="img-fluid w-100" alt="crest">
            </div>
        </div>

    </div>
</div>
<script src="js/login.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<?php

include "includes/footer.php";
?>