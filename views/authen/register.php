<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div>
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db"><img src="assets/images/logo.png" alt="logo" /></span>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" method="POST">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i
                                                class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Họ và tên" name="full_name" value="<?php if(isset($_POST['full_name'])) echo $_POST['full_name']; ?>">
                                </div>
                                <!-- Thông báo validate fullfull_name -->
                                <?php if (isset($_SESSION['errorRS']['full_name'])): ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-warning"
                                            style="font-size:25px;color:red;margin-right:10px"></i><?= $_SESSION['errorRS']['full_name'] ?>
                                    </div>
                                    <?php unset($_SESSION['errorRS']['full_name']); ?>
                                <?php endif; ?>
                                <!-- end thông báo fullname -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i
                                                class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Username" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
                                </div>
                                <!-- Thông báo validate username -->
                                <?php if (isset($_SESSION['errorRS']['name'])): ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-warning"
                                            style="font-size:25px;color:red;margin-right:10px"></i><?= $_SESSION['errorRS']['name'] ?>
                                    </div>
                                    <?php unset($_SESSION['errorRS']['name']); ?>
                                <?php endif; ?>
                                <!-- end thông báo username -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Phone Number" name="phone_number" value="<?php if(isset($_POST['phone_number'])) echo $_POST['phone_number']; ?>">
                                </div>
                                <!-- Thông báo validate phone_number -->
                                <?php if (isset($_SESSION['errorRS']['phone_number'])): ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-warning"
                                            style="font-size:25px;color:red;margin-right:10px"></i><?= $_SESSION['errorRS']['phone_number'] ?>
                                    </div>
                                    <?php unset($_SESSION['errorRS']['phone_number']); ?>
                                <?php endif; ?>
                                <!-- end thông báo phone_number -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-address-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Address" name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>">
                                </div>
                                <!-- Thông báo validate address -->
                                <?php if (isset($_SESSION['errorRS']['address'])): ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-warning"
                                            style="font-size:25px;color:red;margin-right:10px"></i><?= $_SESSION['errorRS']['address'] ?>
                                    </div>
                                    <?php unset($_SESSION['errorRS']['address']); ?>
                                <?php endif; ?>
                                <!-- end thông báo address -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white"><i
                                                class="ti-email"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Email Address" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                                </div>
                                <!-- Thông báo validate email -->
                                <?php if (isset($_SESSION['errorRS']['email'])): ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-warning"
                                            style="font-size:25px;color:red;margin-right:10px"></i><?= $_SESSION['errorRS']['email'] ?>
                                    </div>
                                    <?php unset($_SESSION['errorRS']['email']); ?>
                                <?php endif; ?>
                                <!-- end thông báo email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white"><i
                                                class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>">
                                </div>
                                <!-- Thông báo nếu lỗi validate password -->   
                                <?php if (isset($_SESSION['errorRS']['password'])): ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-warning"
                                            style="font-size:25px;color:red;margin-right:10px"></i><?= $_SESSION['errorRS']['password'] ?>
                                    </div>
                                    <?php unset($_SESSION['errorRS']['password']); ?>
                                <?php endif; ?>
                                <!-- END Thông báo nếu lỗi validate password --> 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white"><i
                                                class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder=" Confirm Password" name="password2" value="<?php if(isset($_POST['password2'])) echo $_POST['password2']; ?>">
                                </div>
                                <!-- Thông báo nếu lỗi validate passwordConfirm -->   
                                <?php if (isset($_SESSION['errorRS']['password2'])): ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-warning"
                                            style="font-size:25px;color:red;margin-right:10px"></i><?= $_SESSION['errorRS']['password2'] ?>
                                    </div>
                                    <?php unset($_SESSION['errorRS']['password2']); ?>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['errorRS']['passwordCF'])): ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-warning"
                                            style="font-size:25px;color:red;margin-right:10px"></i><?= $_SESSION['errorRS']['passwordCF'] ?>
                                    </div>
                                    <?php unset($_SESSION['errorRS']['passwordCF']); ?>
                                <?php endif; ?>
                                <!-- END Thông báo nếu lỗi validate passwordConfirm --> 
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
</body>

</html>