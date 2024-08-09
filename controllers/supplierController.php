<?php

function supplier()
{
    unsetSession();
    $suppliers = listAll('suppliers');
    require_once PATH_VIEW . 'suppliers/suppliers.php';
}

function createSupplierPage()
{
    if ($_POST) {
        createSupplier();
    }
    require_once PATH_VIEW . 'suppliers/create-supplier.php';
}
function createSupplier()
{
    if (!empty($_POST)) {
        $createSupplier = [
            'name' => $_POST['name'] ?? null,
            'email' => $_POST['email'] ?? null,
            'phone_number' => $_POST['phone_number'] ?? null,
        ];
        //Validate
        $error = validateCreateSupplier($createSupplier);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['createSupplier'] = $createSupplier;
            header('Location: ' . BASE_URL . '?act=them-moi-nha-cung-cap');
            exit();
        }
        insert('suppliers', $createSupplier);
        header("Location: " . BASE_URL . '?act=danh-sach-nha-cung-cap');
        exit();
    }
}

function editSupplierPage($id)
{
    $getOne = showOne('suppliers', $id);
    if ($_POST) {
        editSupplier($id);
    }
    require_once PATH_VIEW . 'suppliers/edit-supplier.php';
}

function editSupplier($id)
{
    if (!empty($_POST)) {
        $editSupplier = [
            'name' => $_POST['name'] ?? null,
            'email' => $_POST['email'] ?? null,
            'phone_number' => $_POST['phone_number'] ?? null
        ];
        //Validate
        $error = validateEditSupplier($editSupplier);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['editSupplier'] = $editSupplier;
            header('Location: ' . BASE_URL . '?act=chinh-sua-nha-cung-cap&id=' . $id);
            exit();
        }
        update('suppliers', $id, $editSupplier);
        header("Location: " . BASE_URL . '?act=danh-sach-nha-cung-cap');
        exit();
    }
}

function supplierDelete($id)
{
    $softDelete = [
        'is_delete' => 1
    ];
    update('suppliers', $id, $softDelete);
    header("Location: " . BASE_URL . '?act=danh-sach-nha-cung-cap');
    exit();
}

//Validate 
function validateCreateSupplier($createSupplier)
{
    $error = [];
    $suppliers = listAll('suppliers');
    if (empty($createSupplier['name'])) {
        $error['name'] = 'Bạn cần tên nhà cung cấp';
    }
    foreach ($suppliers as $check) {
        if ($_POST['name'] == $check['name']) {
            $error['name'] = "Tên nhà cung cấp này đã được tạo";
        }
    }
    if (empty($createSupplier['email'])) {
        $error['email'] = 'Bạn cần nhập email';
    }
    if (empty($createSupplier['phone_number'])) {
        $error['phone_number'] = 'Bạn cần số điện thoại';
    }
    return $error;
}
function validateEditSupplier($editSupplier)
{
    $error = [];
    if (empty($editSupplier['name'])) {
        $error['name'] = 'Bạn cần tên nhà cung cấp';
    }
    if (empty($editSupplier['email'])) {
        $error['email'] = 'Bạn cần nhập email';
    }
    if (empty($editSupplier['phone_number'])) {
        $error['phone_number'] = 'Bạn cần số điện thoại';
    }
    return $error;
}