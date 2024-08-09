<?php 

// Khai báo các biến môi trường dùng Global
define('PATH_CONTROLLER',   __DIR__ . '/../controllers/');
define('PATH_MODEL',        __DIR__ . '/../models/');
define('PATH_VIEW',         __DIR__ . '/../views/');

define('PATH_UPLOAD',       __DIR__ . '/../');

define('BASE_URL',          'http://localhost/hv_warehouse/');

define('DB_HOST',           'localhost');
define('DB_PORT',           '3306');
define('DB_USERNAME',       'root');
define('DB_PASSWORD',       '');
define('DB_NAME',           'hv_warehouse');

define('STATUS_DELIVERY_WFC',       0);     // WAITING FOR CONFIRMATION - chờ xác nhận
define('STATUS_DELIVERY_WFP',       1);     // WAITING FOR PICKUP - chờ lấy hàng
define('STATUS_DELIVERY_WFD',       2);     // WAITING FOR DELIVERY - chờ giao hàng
define('STATUS_DELIVERY_ED',        3);     // DELIVERED - đã giao
define('STATUS_DELIVERY_CED',       -1);    // CANCELED - đã hủy

define('STATUS_PAYMENT_UNPAID',     0);     // chưa thanh toán
define('STATUS_PAYMENT_PAID',       1);     // đã thanh toán
define('STATUS_PAYMENT_CANCELED',   -1);    // đơn hàng đã hủy	

