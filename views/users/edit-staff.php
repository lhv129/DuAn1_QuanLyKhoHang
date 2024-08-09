<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Chỉnh sửa nhân viên</title>
    <!-- Custom CSS -->
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="public/main.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <?php require "public/include/header-admin.php" ?>
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Chỉnh sửa nhân viên</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Library</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="card">
                <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                    <div class="card-body">
                        <h4 class="card-title">Thêm mới</h4>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Họ và tên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="full_name" placeholder="Nhập họ và tên ở đây" 
                                value="<?php if (isset($_SESSION['editStaff']['full_name'])) {
                                        echo $_SESSION['editStaff']['full_name'];
                                    }else{
                                        echo $getOne['full_name'];
                                    } ?>">
                                <?php if (isset($_SESSION['errors']['full_name'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px" class="fa fa-warning"></i><?= $_SESSION['errors']['full_name']; ?></a>
                                    <?php unset($_SESSION['errors']['full_name']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="Nhập username ở đây" 
                                value="<?php if (isset($_SESSION['editStaff']['name'])) {
                                        echo $_SESSION['editStaff']['name'];
                                    }else{
                                        echo $getOne['name'];
                                    } ?>">
                                <?php if (isset($_SESSION['errors']['name'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px" class="fa fa-warning"></i><?= $_SESSION['errors']['name']; ?></a>
                                    <?php unset($_SESSION['errors']['name']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Email Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" placeholder="Nhập email ở đây" 
                                value="<?php if (isset($_SESSION['editStaff']['email'])) {
                                        echo $_SESSION['editStaff']['email'];
                                    }else{
                                        echo $getOne['email'];
                                    } ?>">
                                <?php if (isset($_SESSION['errors']['email'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['email']; ?></a>
                                    <?php unset($_SESSION['errors']['email']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" placeholder="Nhập password ở đây" id="password-field"
                                value="<?php if (isset($_SESSION['editStaff']['password'])) {
                                        echo $_SESSION['editStaff']['password'];
                                    }else{
                                        echo $getOne['password'];
                                    } ?>">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <?php if (isset($_SESSION['errors']['password'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['password']; ?></a>
                                    <?php unset($_SESSION['errors']['password']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Password Confirm</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password2" placeholder="Xác thực password ở đây"
                                value="<?php if (isset($_SESSION['editStaff']['password2'])) {
                                        echo $_SESSION['editStaff']['password2'];
                                    }else{
                                        echo $getOne['password'];
                                    } ?>">
                                <?php if (isset($_SESSION['errors']['password2'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['password2']; ?></a>
                                    <?php unset($_SESSION['errors']['password2']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Số điện thoại</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone_number" placeholder="Nhập số điện thoại ở đây" 
                                value="<?php if (isset($_SESSION['editStaff']['phone_number'])) {
                                        echo $_SESSION['editStaff']['phone_number'];
                                    }else{
                                        echo $getOne['phone_number'];
                                    } ?>">
                                <?php if (isset($_SESSION['errors']['phone_number'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['phone_number']; ?></a>
                                    <?php unset($_SESSION['errors']['phone_number']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ ở đây" 
                                value="<?php if (isset($_SESSION['editStaff']['address'])) {
                                        echo $_SESSION['editStaff']['address'];
                                    }else{
                                        echo $getOne['address'];
                                    } ?>">
                                <?php if (isset($_SESSION['errors']['address'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['address']; ?></a>
                                    <?php unset($_SESSION['errors']['address']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 text-right control-label col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="role_id">
                                    <?php foreach ($roles as $arrayRole) {
                                        ?>
                                        <option value="<?= $arrayRole['id'] ?>" <?php if($getOne['role_id'] === $arrayRole['id']){echo "selected";} ?> ><?php echo $arrayRole['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">isActive</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="is_active">
                                    <option value="1" <?php if($getOne['is_active'] === 1){echo "selected";}?> >True</option>
                                    <option value="0" <?php if($getOne['is_active'] === 0){echo "selected";}?> >False</option>
                                </select>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php require "public/include/footer-admin.php" ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="assets/libs/flot/excanvas.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>
    <script src="dist/js/main.js"></script>

</body>

</html>