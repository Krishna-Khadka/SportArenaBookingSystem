<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login || ArenaAce</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/all.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        #reg {
            position: relative;
            height: 100vh;
        }

        #reg .background-container {
            background: linear-gradient(#0007, #0008), url(assets/images/loginBg2.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
            position: absolute;
            filter: blur(10px);
            z-index: -1;
            width: 100%;
        }

        #reg .reg-images {
            width: 100%;
            height: 100%;
            padding: 10px 5px;
        }

        #reg .reg-images img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            overflow: hidden;
            border-top-left-radius: 40px;
            border-bottom-left-radius: 40px;
        }

        #reg .reg-container {
            background-color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            margin: 0 auto;
            border-radius: 40px;
        }

        #reg .reg-right {
            background-color: #fff;
            color: #000;
            text-align: center;
            margin-left: -50px;
            border-top-left-radius: 60px;
            border-bottom-left-radius: 60px;
        }

        #reg .reg-right .form-content {
            padding: 60px 0;
            padding-left: 20px;
            overflow: hidden;
        }

        #reg .reg-right .form-top h2 {
            font-size: 1.6rem;
            font-weight: 700;
        }

        #reg .reg-right .form-top h2 span {
            color: #A70500;
        }

        #reg .reg-right .form-top .google {
            outline: none;
            background-color: #fff;
            border: 2px solid #555555;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 8px 50px;
            border-radius: 5px;
            margin: 12px 0;
        }

        #reg .reg-right .form-top p {
            font-size: 0.9rem;
            font-weight: 600;
            position: relative;
        }

        #reg .reg-right .form-top p::before {
            content: '';
            position: absolute;
            height: 3px;
            width: 60px;
            background-color: #000;
            left: 135px;
            top: 11px;
        }

        #reg .reg-right .form-top p::after {
            content: '';
            position: absolute;
            height: 3px;
            width: 60px;
            background-color: #000;
            right: 135px;
            top: 11px;
        }

        #reg .reg-right .form-mid input {
            height: 40px;
        }

        #reg .reg-right .form-mid .form-control:focus {
            background-color: #FFF;
            outline: none;
            box-shadow: none;
        }

        #reg .reg-right .form-mid button {
            background-color: #A70500;
            color: #FFF;
            padding: 10px 0;
            border-radius: 20px;
            font-weight: 600;
        }

        #reg .reg-right .form-bottom {
            margin-top: 10px;
        }

        #reg .reg-right .form-bottom p {
            font-size: 0.9rem;
            font-weight: 500;
        }

        #reg .reg-right .form-bottom span a {
            color: #A70500;
        }

        #reg .reg-right .form-bottom ul li {
            display: inline-block;
            margin-right: 15px;
        }

        #reg .reg-right .form-bottom ul li i {
            font-size: 1.2rem;
        }
    </style>
</head>

<body>

    <?php
    require('config.php');

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $emailSearch = "SELECT * FROM user WHERE email = '$email' ";
        $query = mysqli_query($con, $emailSearch);
        $emailCount = mysqli_num_rows($query);
        // print_r($emailCount);
        if ($emailCount) {
            $email_pass = mysqli_fetch_assoc($query);
            $db_pass = $email_pass['password'];
            $_SESSION['username'] = $email_pass['fullname'];
            $_SESSION['id'] = $email_pass['id'];
            $_SESSION['user_role'] = "client";
            $_SESSION['USER'] = $email_pass;
            if ($password == $db_pass) {

                echo "<script>
                alert('login successful');
                window.location.href = 'index.php';
            </script>";
            } else {
                // echo "<script>
                //     alert('password incorrectl');
                //     window.location.href = 'userLogin.php';
                // </script>";
            }
        } else {
            echo "<script>
                alert('invalid email');
                window.location.href = 'userLogin.php';
            </script>";
        }
    }
    ?>

    <!-- <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="#" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Arena Ace</span>
                                </a>
                            </div>

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to an Account</h5>
                                        <p class="text-center small">Enter your login details to sign in</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate
                                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                                        enctype="multipart/form-data">

                                        <div class="col-12 mb-3">
                                            <label for="yourEmail" class="form-label">Your Email</label>
                                            <input type="email" name="email" class="form-control" id="yourEmail"
                                                required>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <button class="btn btn-primary w-100" type="submit"
                                                name="login">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have an account? <a
                                                    href="userRegister.php">Register</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main> -->

    <?php include 'navbar.php'; ?>

    <section id="reg">
        <div class="background-container"></div>
        <div class="container">
            <div class="reg-container">
                <div class="row">
                    <div class="col-lg-6 reg-left">
                        <div class="reg-images">
                            <img src="assets/images/loginBg2.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 reg-right">
                        <div class="form-content">
                            <div class="form-top">
                                <h2>Log in to <span>ArenaAce</span></h2>
                            </div>
                            <div class="form-mid mt-5">
                                <form class="row g-3 needs-validation" novalidate
                                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email Address" autocomplete="off">
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Password" autocomplete="off">
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="form-control" name="login">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="form-bottom">
                                <p>Don't have an account? <span><a href="userRegister.php">Register</a></span></p>
                                <div class="reg-social">
                                    <ul>
                                        <li><a href="#">
                                                <i class="fa-brands fa-facebook"></i>
                                            </a></li>
                                        <li><a href="#">
                                                <i class="fa-brands fa-instagram"></i>
                                            </a></li>
                                        <li><a href="#">
                                                <i class="fa-brands fa-github"></i>
                                            </a></li>
                                        <li><a href="#">
                                                <i class="fa-brands fa-linkedin"></i>
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>