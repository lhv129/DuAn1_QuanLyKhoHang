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
            <div class="row">
                <div class="box-logo"><img class="logo" src="uploads/products/logo.png"></div>
                <div class="box-text">
                    <h3>HV Shop - Những gì bạn cần thì chúng tôi có</h3>
                    <p>Phần mềm quản lý kho nhanh chóng hiệu quả hihii<br>Giúp các bạn có niềm tin, hành trang vững vàng
                        trên con đường trở thành nhà kinh doanh</p>
                </div>
            </div>
            <div class="card-check-details">
                <h3>Thông tin đơn hàng</h3>
                <div class="row">
                    <div class="card-left">
                        <p>Nhà Cung Cấp:</p>
                    </div>
                    <div class="card-right">
                        <h5><?= $getOne['supplier_name'] ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="card-left">
                        <p>Ngày lập:</p>
                    </div>
                    <div class="card-right">
                        <h5><?= $getOne['created_at'] ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="card-left">
                        <p>Nhân viên:</p>
                    </div>
                    <div class="card-right">
                        <h5><?= $getOne['user_name'] ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="card-left">
                        <p>Tổng thành tiền:</p>
                    </div>
                    <div class="card-right">
                        <h5><?=number_format( $getOne['total_price']); ?>đ</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="card-left">
                        <p>Phương thức thanh toán:</p>
                    </div>
                    <div class="card-right">
                        <h5><?= $getOne['payment_name'] ?></h5>
                    </div>
                </div>
                <h3>Chi tiết đơn hàng</h3>
                <div class="list-add">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Gía nhập</th>
                            <th>Đơn Vị</th>
                            <th>Đơn giá</th>
                        </tr>
                        <?php
                        $total_price = 0;
                        foreach ($importDetails as $arrayImportDetails) {
                            $stt = 0;
                            ?>
                            <tr>
                                <td><?= $arrayImportDetails['product_name'] ?></td>
                                <td><?= $arrayImportDetails['quantity'] ?></td>
                                <td><?= number_format($arrayImportDetails['entry_price']); ?>đ</td>
                                <td><?= $arrayImportDetails['unit_name'] ?></td>
                                <td>
                                    <?= number_format($arrayImportDetails['sub_total']);
                                    $total_price += $arrayImportDetails['sub_total'] ?>đ
                                </td>
                                <?php
                        }
                        ?>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center;">Tổng số lượng tiền</td>
                            <td><?= number_format($total_price); ?>đ</td>
                        </tr>
                    </table>
                </div>
            </div>
            <button class="btn btn-primary print">Print</button>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->

         <!-- PRINT -->
         <div id="page-detail" class="container-fluid display-none">
            <div class="row">
                <div class="box-logo"><img class="logo" src="uploads/products/logo.png"></div>
                <div class="box-text">
                    <h3>HV Shop - Những gì bạn cần thì chúng tôi có</h3>
                    <p>Phần mềm quản lý kho nhanh chóng hiệu quả hihii<br>Giúp các bạn có niềm tin, hành trang vững vàng
                        trên con đường trở thành nhà kinh doanh</p>
                </div>
            </div>
            <div class="card-check-details">
                <h3>Thông tin đơn hàng</h3>
                <div class="row">
                    <div class="card-left">
                        <p>Nhà Cung Cấp:</p>
                    </div>
                    <div class="card-right">
                        <h5><?= $getOne['supplier_name'] ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="card-left">
                        <p>Ngày lập:</p>
                    </div>
                    <div class="card-right">
                        <h5><?= $getOne['created_at'] ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="card-left">
                        <p>Nhân viên:</p>
                    </div>
                    <div class="card-right">
                        <h5><?= $getOne['user_name'] ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="card-left">
                        <p>Tổng thành tiền:</p>
                    </div>
                    <div class="card-right">
                        <h5><?= number_format($getOne['total_price']); ?>đ</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="card-left">
                        <p>Phương thức thanh toán:</p>
                    </div>
                    <div class="card-right">
                        <h5><?= $getOne['payment_name'] ?></h5>
                    </div>
                </div>
                <h3>Chi tiết đơn hàng</h3>
                <div class="list-add">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Gía nhập</th>
                            <th>Đơn Vị</th>
                            <th>Đơn giá</th>
                        </tr>
                        <?php
                        $total_price = 0;
                        foreach ($importDetails as $arrayImportDetails) {
                            $stt = 0;
                            ?>
                            <tr>
                                <td><?= $arrayImportDetails['product_name'] ?></td>
                                <td><?= $arrayImportDetails['quantity'] ?></td>
                                <td><?= number_format($arrayImportDetails['entry_price']); ?>đ</td>
                                <td><?= $arrayImportDetails['unit_name'] ?></td>
                                <td>
                                    <?= number_format($arrayImportDetails['sub_total']);
                                    $total_price += $arrayImportDetails['sub_total'] ?>đ
                                </td>
                                <?php
                        }
                        ?>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center;">Tổng số lượng tiền</td>
                            <td><?= number_format($total_price); ?>đ</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="user-print">
                <h5>Người xuất hóa đơn</h5>
                <p>Kí rõ họ tên</p>
            </div>
        </div>
         <!-- end print -->

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
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min."></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>
    <script src="dist/js/main.js"></script>
</body>

</html>