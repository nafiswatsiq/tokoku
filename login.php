<?php
require_once 'kredensial/koneksi.php';
require_once 'kredensial/toko.php';
?>
<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icon/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/vendors/animate-animated-css/animate.min.css" />
    <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="assets/vendors/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />

    <title>Login</title>
    <!-- Untuk Chrome & Opera -->
    <meta name="theme-color" content="#ff8800"/>
    <!-- Untuk Safari iOS -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#ff8800"/>
    <!-- Untuk Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#ff8800"/>
    <!-- OG Tags Start -->
    <link rel="icon" type="image/png" href="<?php echo $icon;?>">
    <meta property="og:url" content="<?php echo $url;?>" />
    <meta property="og:title" content="<?php echo $title;?>" />
    <meta property="og:image" content="<?php echo $icon;?>" />
    <meta property="og:description" content='<?php echo $description;?>'>
    <meta name="description" content='<?php echo $description;?>'>
    <!-- OG Tags end -->
</head>

<body class="login-body">
    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="svg/logo.svg" width="50px" alt="Logo" class="d-inline-block">
                    <span class="logo-text"><?php echo $nama_toko;?></span>
                </a>
            </div>
        </nav>
    </section>
    <section id="login" class="top-lihat" style="height: 450px;display: flex;align-items: center;">
        <div class="container">
            <div class="col-12 text-center mt-4 mb-2">
                <span class="fw-bold h4 color">Login <i class="bi bi-person-fill"></i></span>
            </div>
            <div class="card-login">
                <div class="row p-3">
                    <div class="col-12 text-center">
                        <lord-icon
                        src="https://cdn.lordicon.com/dxjqoygy.json"
                        trigger="loop"
                        colors="primary:#ffb81f,secondary:#ff9100"
                        style="width:80px;height:80px">
                    </lord-icon>
                    </div>
                    <div class="col-12">
                        <form class="form" name="login" onSubmit="return validasi()" method="POST" action="auth/login.php">
                            <label for="username" class="username">
                                <input type="text" name="username" id="username"
                                    placeholder="Username/Email">
                                <span class="">Username/Email</span>
                            </label>
                            <label for="password" class="password">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <input type="password" name="password" id="password" placeholder="Password">
                                <span>Password</span>
                            </label>
                            <button type="submit" class="">Login <i class="fa fa-circle-o-notch" aria-hidden="true"></i></button>
                            <!-- loading-active -->
                        </form>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <a href="register.php" class="login-text-option">Register</a>
                            </div>
                            <div class="col-6 text-end">
                                <a href="/" class="login-text-option">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/lordIcon/lord-icon-2.1.0.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/my.js"></script>
    <script>
        $( "#username" ).click(function() {
            $( ".username" ).removeClass( "invalid" );
            $( ".username span" ).removeClass( "invalid" );
            $( ".form button" ).removeClass( "loading-active" );
        });
        $( "#password" ).click(function() {
            $( ".password" ).removeClass( "invalid" );
            $( ".password span" ).removeClass( "invalid" );
            $( ".form button" ).removeClass( "loading-active" );
        });

        function validasi() {
        $( ".form button" ).addClass( "loading-active" );
        
            if (document.forms["login"]["username"].value == "") {
                $( ".username" ).addClass( "invalid" );
                $( ".username span" ).addClass( "invalid" );
                $( ".form button" ).removeClass( "loading-active" );
                return false;
            }
            if (document.forms["login"]["password"].value == "") {
                $( ".password" ).addClass( "invalid" );
                $( ".password span" ).addClass( "invalid" );
                $( ".form button" ).removeClass( "loading-active" );
                return false;
            } 
        };
    </script>
</body>

</html>