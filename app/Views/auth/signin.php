<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>

</head>

<body class="authentication-bg">

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <a href="<?php echo base_url(); ?>" class="mb-5 d-block auth-logo">
                        <img src="assets/images/logo.gif" alt="" height="150" class="logo logo-dark">
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p class="text-muted">เข้าใช้งานระบบ</p>
                        </div>
                        <?php if(session()->getFlashdata('msg')):?>
                            <div class="alert alert-warning">
                                <?= session()->getFlashdata('msg') ?>
                            </div>
                        <?php endif;?>
                        <div class="p-2 mt-4">
                            <form action="<?php echo base_url(); ?>/Signin/loginAuth" method="post">

                                <div class="mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?= set_value('username') ?>">
                                </div>

                                <div class="mb-3">
                                    <div class="float-end">
                                        <a href="<?php echo base_url(); ?>/auth/recoverpw" class="text-muted">Forgot password?</a>
                                    </div>
                                    <label class="form-label" for="userpassword">Password</label>
                                    <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Enter password">
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="auth-remember-check">
                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                </div>

                                <div class="mt-3 text-end">
                                    <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Log In</button>
                                </div>



<!--                                <div class="mt-4 text-center">-->
<!--                                    <div class="signin-other-title">-->
<!--                                        <h5 class="font-size-14 mb-3 title">Sign in with</h5>-->
<!--                                    </div>-->
<!---->
<!---->
<!--                                    <ul class="list-inline">-->
<!--                                        <li class="list-inline-item">-->
<!--                                            <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">-->
<!--                                                <i class="mdi mdi-facebook"></i>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                        <li class="list-inline-item">-->
<!--                                            <a href="javascript:void()" class="social-list-item bg-info text-white border-info">-->
<!--                                                <i class="mdi mdi-twitter"></i>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                        <li class="list-inline-item">-->
<!--                                            <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">-->
<!--                                                <i class="mdi mdi-google"></i>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </div>-->

<!--                                <div class="mt-4 text-center">-->
<!--                                    <p class="mb-0">Don't have an account ? <a href="auth-register" class="fw-medium text-primary"> Signup now </a> </p>-->
<!--                                </div>-->
                            </form>
                        </div>

                    </div>
                </div>

<!--                <div class="mt-5 text-center">-->
<!--                    <p>© <script>-->
<!--                            document.write(new Date().getFullYear())-->
<!--                        </script> Minible. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>-->
<!--                </div>-->

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

<?= $this->include('partials/vendor-scripts') ?>

<script src="assets/js/app.js"></script>

</body>

</html>
