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
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Hàng Hóa</title>
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
                    <h4 class="page-title">Tạo Đơn Nhập Hàng</h4>
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
                <form class="form-horizontal" method="POST">
                    <div class="card-body">
                        <h4 class="card-title">Tạo phiếu</h4>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label col-form-label">Nhân viên</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="user_id">
                                    <option value="<?php echo $_SESSION['user']['id'] ?>"><?php echo $_SESSION['user']['name'] ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label col-form-label">Nhà cung
                                cấp</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="supplier_id">
                                    <?php foreach ($suppliers as $arraySupplier) {
                                        ?>
                                        <option value="<?php echo $arraySupplier['id'] ?>">
                                            <?php echo $arraySupplier['name'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label col-form-label">Thời gian lập
                                phiếu</label>
                            <div class="box-date">
                                <input class="form-control" type="datetime-local" name="created_at" />
                                <?php if (isset($_SESSION['errors']['created_at'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['created_at']; ?></a>
                                    <?php unset($_SESSION['errors']['created_at']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 control-label col-form-label">Phương thức thanh
                                toán</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="payment_id">
                                    <?php foreach ($payments as $arrayPayment) {
                                        ?>
                                        <option value="<?php echo $arrayPayment['id'] ?>">
                                            <?php echo $arrayPayment['name'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <h4 class="card-title">Chi tiết đơn hàng</h4>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 control-label col-form-label">Sản phẩm</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="input-product" name="product_id">
                                    <?php foreach ($products as $arrayProduct) {
                                        ?>
                                        <option value="<?php echo $arrayProduct['id'] ?>">
                                            <?php echo $arrayProduct['name'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 control-label col-form-label">Số lượng</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="input-quantity" name="quantity" value=""
                                    placeholder="Nhập số lượng ở đây">
                            </div>
                            <button id="create-btn" type="button" class="btn btn-danger">create</button>
                            <button type="button" onclick="handleDeleteAll()"></button>
                        </div>
                        <div class="list-add">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="list-products">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
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