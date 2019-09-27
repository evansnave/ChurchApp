<?php include_once "partials/_head.php"; ?>
<div class="auth-wrapper">
    <div class="auth-content">
        <div class="auth-bg">
            <span class="r"></span>
            <span class="r s"></span>
            <span class="r s"></span>
            <span class="r"></span>
        </div>

        <div class="card">
            <center>
            <img src="assets/images/pci.jpg" alt="" style="height:100px;width:100px; margin-top:-50px;border-radius:50%">
            </center>
            <form method="POST" id="login_form">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <h3></h3>
                        <h3 class="text-muted">
                            Perez Chapel International-Rehoboth Temple
                        </h3>
                    </div>
                    <h3 class="mb-4">
                        <i class="feather icon-unlock auth-icon"></i>
                        Login
                    </h3>
                    <div id="alert"></div>
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" id="password" name="password" class="form-control" placeholder="**********">
                    </div>
                    <button type="submit" id="btn_login" name="btn_login" class="btn btn-primary shadow-2 mb-4">Login</button>
                </div>
            </form>
        </div>

    </div>
</div>
<?php include_once "partials/_footer.php"; ?>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/login.js"></script>