<?php
session_start();
if (isset($_COOKIE['alert'])) {
    $message = $_COOKIE['alert'];
    echo "<script type='text/javascript'>alert('$message');</script>";
}
// Require file trong commons
require_once './commons/env.php';
require_once './commons/helper.php';
require_once './commons/connect-db.php';
require_once './commons/model.php';

// Require file trong controllers và models
require_file(PATH_CONTROLLER);
require_file(PATH_MODEL);

// Điều hướng
$act = $_GET['act'] ?? '/';

// Biến này cần khai báo được link cần đăng nhập mới vào được
$arrRouteNeedAuth = [
    '/',
    'lock',
    'danh-sach-thuong-hieu',
    'them-thuong-hieu',
    'chinh-sua-thuong-hieu',
    'xoa-thuong-hieu',

    'kho-hang',
    'chinh-sua-kho-hang',
    'xoa-kho-hang',

    'nhap-hang',
    'tao-don-nhap-hang',
    'chi-tiet-don-nhap',

    'xuat-hang',
    'tao-don-xuat-hang',
    'chi-tiet-don-xuat',

    'danh-sach-san-pham',
    'them-moi-san-pham',
    'chinh-sua-san-pham',
    'xoa-san-pham',

    'danh-sach-nha-cung-cap',
    'them-moi-nha-cung-cap',
    'chinh-sua-nha-cung-cap',
    'xoa-nha-cung-cap',

    'danh-sach-don-vi-tinh',
    'them-don-vi-tinh',
    'chinh-sua-don-vi',
    'xoa-don-vi',
];

// Kiểm tra xem user đã đăng nhập chưa
middleware_auth_check($act, $arrRouteNeedAuth);

match ($act) {
    '/' => homeIndex(),
    'login' => authenShowFormLogin(),
    'logout' => authenLogout(),
    'register' => register(),
    'lock' => lockAccount(),

    'danh-sach-thuong-hieu' => brand(),
    'them-thuong-hieu' => createBrandPage(),
    'chinh-sua-thuong-hieu' => editBrandPage($_GET['id']),
    'xoa-thuong-hieu' => deleteBrand($_GET['id']),

    'kho-hang' => warehouse(),
    'chinh-sua-kho-hang' => warehouseEditPage($_GET['id']),
    'xoa-kho-hang' => warehouseDelete($_GET['id']),

    'nhap-hang' => import(),
    'tao-don-nhap-hang' => pageImport(),
    'chi-tiet-don-nhap' => importDetailsPage($_GET['id']),
    'phe-duyet-hoa-don' => pendingPage(),
    'cap-nhat-trang-thai-hoa-don' => processingUpdate($_GET['id']),
    'xac-thuc-hoa-don' => processingPage(),
    'xac-thuc-hoa-don-thanh-cong' => successUpdate($_GET['id']),
    'sua-hoa-don' => editImport($_GET['id']),
    'xoa-hoa-don' => deleteImport($_GET['id']),

    'xuat-hang' => delivery(),
    'tao-don-xuat-hang' => deliveryPage(),
    'chi-tiet-don-xuat' => deliveryDetailsPage($_GET['id']),

    'danh-sach-san-pham' => product(),
    'them-moi-san-pham' => createProductPage(),
    'chinh-sua-san-pham' => editProductPage($_GET['id']),
    'xoa-san-pham' => productDelete($_GET['id']),

    'danh-sach-nha-cung-cap' => supplier(),
    'them-moi-nha-cung-cap' => createSupplierPage(),
    'chinh-sua-nha-cung-cap' => editSupplierPage($_GET['id']),
    'xoa-nha-cung-cap' => supplierDelete($_GET['id']),

    'danh-sach-phuong-thuc-thanh-toan' => payment(),
    'them-moi-phuong-thuc' => createPaymentPage(),
    'chinh-sua-phuong-thuc-thanh-toan' => editPaymentPage($_GET['id']),
    'xoa-phuong-thuc-thanh-toan' => deletePayment($_GET['id']),

    'danh-sach-don-vi-tinh' => unit(),
    'them-don-vi-tinh' => createUnitPage(),
    'chinh-sua-don-vi' => editUnitPage($_GET['id']),
    'xoa-don-vi' => deleteUnit($_GET['id']),

    'phan-quyen-quan-tri' => decentralizeAdmin(),
    'xoa-quyen-quan-tri' => deleteDecentralizeAdmin($_GET['id']),

    'danh-sach-nhan-vien' => staff(),
    'them-moi-nhan-vien' => createStaffPage(),
    'chinh-sua-nhan-vien' => editStaffPage($_GET['id']),
    'xoa-nhan-vien' => deleteStaff($_GET['id']),
};

require_once './commons/disconnect-db.php';