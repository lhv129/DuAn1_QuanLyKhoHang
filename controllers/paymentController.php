<?php

function payment(){
    unsetSession();
    $payment = listAll('payments');
    require_once PATH_VIEW . 'payments/payments.php';
}

function createPaymentPage(){
    if($_POST){
        createPayment();
    }
    require_once PATH_VIEW . 'payments/create-payment.php';
}

function createPayment(){
    if(!empty($_POST)){
        $createPayment = [
            'name' => $_POST['name'] ?? null,
        ];
        //Validate
        $error = validateCreatePayment($createPayment);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['createPayment'] = $createPayment;
            header('Location: ' . BASE_URL . '?act=them-moi-phuong-thuc');
            exit();
        }
        insert('payments', $createPayment);
        header("Location: " . BASE_URL . '?act=danh-sach-phuong-thuc-thanh-toan');
        exit();
    }
}

function editPaymentPage($id)
{
    $getOne = showOne('payments', $id);
    if ($_POST) {
        editPayment($id);
    }
    require_once PATH_VIEW . 'payments/edit-payment.php';
}

function editPayment($id)
{
    if (!empty($_POST)) {
        $editPayment = [
            'name' => $_POST['name'] ?? null,
        ];
        //Validate
        $error = validateEditPayment($editPayment);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['editPayment'] = $editPayment;
            header('Location: ' . BASE_URL . '?act=chinh-sua-phuong-thuc-thanh-toan&id=' . $id);
            exit();
        }
        update('payments', $id, $editPayment);
        header("Location: " . BASE_URL . '?act=danh-sach-phuong-thuc-thanh-toan');
        exit();
    }
}

function deletePayment($id)
{
    $softDelete = [
        'is_delete' => 1
    ];
    update('payments', $id, $softDelete);
    header("Location: " . BASE_URL . '?act=danh-sach-phuong-thuc-thanh-toan');
    exit();
}


function validateCreatePayment($createPayment){
    $error = [];
    $payments = listAll('payments');
    if (empty($createPayment['name'])) {
        $error['name'] = 'Bạn cần tên nhà cung cấp';
    }
    foreach ($payments as $check) {
        if ($_POST['name'] == $check['name']) {
            $error['name'] = "Phương thức thanh toán này đã có";
        }
    }
    return $error;
}

function validateEditPayment($editPayment)
{
    $error = [];
    if (empty($editPayment['name'])) {
        $error['name'] = 'Bạn cần tên nhà cung cấp';
    }
    return $error;
}