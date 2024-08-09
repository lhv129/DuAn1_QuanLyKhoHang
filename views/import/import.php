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
                    <h4 class="page-title">Đơn Nhập Hàng</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Library</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="menu-mini">
                        <div class="menu-mini-box">
                            <a href="<?= BASE_URL . '?act=phe-duyet-hoa-don' ?>"><button class="btn btn-primary">Phê duyệt hóa đơn</button></a>
                        </div>
                        <div class="menu-mini-box">
                            <a href="<?= BASE_URL . '?act=xac-thuc-hoa-don' ?>"><button class="btn btn-primary">Xác thực hóa đơn</button></a>
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
            <div class="list">
                <table>
                    <tr>
                        <th>Số TT</th>
                        <th>Thời Gian</th>
                        <th>Nhân Viên</th>
                        <th>Nhà Cung Cấp</th>
                        <th>Phương Thức Thanh Toán</th>
                        <th>Tổng Tiền</th>
                        <th>Chức năng</th>
                    </tr>
                    <?php
                    $stt = 0;
                    $sumTotalPrice = 0;
                    foreach ($import as $arrayImport) {
                        $stt++;
                        ?>
                        <tr>
                            <td><?= $stt ?></td>
                            <td><?= $arrayImport['created_at'] ?></td>
                            <td><?= $arrayImport['user_name'] ?></td>
                            <td><?= $arrayImport['supplier_name'] ?></td>
                            <td><?= $arrayImport['payment_name'] ?></td>
                            <td><?php echo number_format($arrayImport['total_price']); $sumTotalPrice += $arrayImport['total_price'];?>đ</td>
                            <td><a href="<?= BASE_URL . '?act=chi-tiet-don-nhap&id=' . $arrayImport['id'] ?>"><button
                                        class="btn btn-primary">Chi
                                        tiết</button></a>
                                <!-- <a href="#"><button class="btn btn-info">Sửa</button></a>
                                <a href="#"><button class="btn btn-danger">Xóa</button></a> -->
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            <div class="card-check-details">
                <h3>Thông tin chi tiết</h3>
                <div class="row">
                    <div class="card-left">
                        <p>Tổng giá trị nhập hàng:</p>
                    </div>
                    <div class="card-right">
                        <h5><?= number_format($sumTotalPrice); ?>đ</h5>
                    </div>
                </div>
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

</body>

</html>