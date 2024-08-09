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
    <title>Thêm mới sản phẩm</title>
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
                    <h4 class="page-title">Thêm mới sản phẩm</h4>
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
                            <label for="" class="col-sm-3 text-right control-label col-form-label">Thương hiệu</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="brand_id">
                                    <?php foreach ($brands as $arrayBrand) {
                                        ?>
                                        <option value="<?= $arrayBrand['id'] ?>">
                                            <?php echo $arrayBrand['name'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Tên sản
                                phẩm</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name"
                                    placeholder="Nhập tên sản phẩm ở đây" value="<?php if (isset($_SESSION['createProduct']['name'])) {
                                        echo $_SESSION['createProduct']['name'];
                                    } ?>">
                                <?php if (isset($_SESSION['errors']['name'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['name']; ?></a>
                                    <?php unset($_SESSION['errors']['name']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 text-right control-label col-form-label">Đơn vị</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="unit_id">
                                    <?php foreach ($units as $arrayUnit) {
                                        ?>
                                        <option value="<?php echo $arrayUnit['id'] ?>">
                                            <?php echo $arrayUnit['name'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Ảnh</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="image" placeholder="Nhập số lượng ở đây">
                                <?php if (isset($_SESSION['errors']['image'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['image']; ?></a>
                                    <?php unset($_SESSION['errors']['image']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Gía nhập</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="entry_price"
                                    placeholder="Nhập giá nhập ở đây" value="<?php if (isset($_SESSION['createProduct']['entry_price'])) {
                                        echo $_SESSION['createProduct']['entry_price'];
                                    } ?>">
                                <?php if (isset($_SESSION['errors']['entry_price'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['entry_price']; ?></a>
                                    <?php unset($_SESSION['errors']['entry_price']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Gía bán</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="retail_price"
                                    placeholder="Nhập giá bán ở đây" value="<?php if (isset($_SESSION['createProduct']['retail_price'])) {
                                        echo $_SESSION['createProduct']['retail_price'];
                                    } ?>">
                                <?php if (isset($_SESSION['errors']['retail_price'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['retail_price']; ?></a>
                                    <?php unset($_SESSION['errors']['retail_price']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Slug</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="slug" placeholder="vd: vot-cau-long"
                                    value="<?php if (isset($_SESSION['createProduct']['slug'])) {
                                        echo $_SESSION['createProduct']['slug'];
                                    } ?>">
                                <?php if (isset($_SESSION['errors']['slug'])): ?>
                                    <a style="color:red"><i style="margin-top:10px;margin-right:5px"
                                            class="fa fa-warning"></i><?= $_SESSION['errors']['slug']; ?></a>
                                    <?php unset($_SESSION['errors']['slug']); ?>
                                <?php endif; ?>
                            </div>
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

</body>

</html>