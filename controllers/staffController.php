<?php

function staff(){
    unsetSession();
    $users = staffList();
    require_once PATH_VIEW . 'users/staff-list.php';
}

function createStaffPage(){
    checkRoleAdmin();
    $roles = listAll('role');
    if(isset($_POST)){
        createStaff();
    }
    require_once PATH_VIEW . 'users/create-staff.php';
}

function createStaff(){
    if(!empty($_POST)){
        $createStaff = [
            'full_name' => $_POST['full_name'],
            'name' => $_POST['name'],
            'email'=> $_POST['email'],
            'password' => $_POST['password'],
            'phone_number' => $_POST['phone_number'],
            'address' => $_POST['address'],
            'role_id' => $_POST['role_id'],
        ];
        $error = validateCreateStaff($createStaff);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['createStaff'] = $createStaff;
            header('Location: ' . BASE_URL . '?act=them-moi-nhan-vien');
            exit();
        }
        insert('users', $createStaff);
        header("Location: " . BASE_URL . '?act=danh-sach-nhan-vien');
        exit();
    }
}

function editStaffPage($id){
    checkRoleAdmin();
    $getOne = showOne('users',$id);
    $roles = listAll('role');
    if(!empty($_POST)){
        editStaff($id);
    };
    require_once PATH_VIEW . 'users/edit-staff.php';
}

function editStaff($id){
    if(!empty($_POST)){
        $editStaff = [
            'full_name' => $_POST['full_name'],
            'name' => $_POST['name'],
            'email'=> $_POST['email'],
            'password' => $_POST['password'],
            'phone_number' => $_POST['phone_number'],
            'address' => $_POST['address'],
            'is_active' => $_POST['is_active'],
            'role_id' => $_POST['role_id'],
        ];
        $error = validateEditStaff($editStaff);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['editStaff'] = $editStaff;
            header('Location: ' . BASE_URL . '?act=chinh-sua-nhan-vien&id=' . $id);
            exit();
        }
        update('users',$id ,$editStaff);
        header("Location: " . BASE_URL . '?act=danh-sach-nhan-vien');
        exit();
    }
}

function deleteStaff($id)
{
    checkRoleAdmin();
    $softDelete = [
        'is_delete' => 1,
    ];
    update('users',$id,$softDelete);
    header('Location: ' . BASE_URL . '?act=danh-sach-nhan-vien');
}


// Validate create-staff
function validateCreateStaff($createStaff){
    $error = [];
    $usersList = listAll('users');
    if (empty($createStaff['full_name'])) {
        $error['full_name'] = 'Bạn cần nhập họ và tên';
    }
    if (empty($createStaff['name'])) {
        $error['name'] = "Bạn cần nhập UserName ";
    }
    if (empty($createStaff['phone_number'])) {
        $error['phone_number'] = 'Bạn cần nhập số điện thoại';
    }
    if (empty($createStaff['address'])) {
        $error['address'] = 'Bạn cần nhập địa chỉ';
    }
    if (empty($createStaff['email'])) {
        $error['email'] = 'Bạn cần nhập email';
    }
    //check username,email trùng lặp hay không
    foreach ($usersList as $listCheck) {
        if ($_POST['name'] == $listCheck['name']) {
            // Nếu có thì hiện ra thông báo
            $error['name'] = "Username của bạn đã bị trùng vui lòng đặt tên khác";
        }
        if ($_POST['email'] == $listCheck['email']) {
            // Nếu có thì hiện ra thông báo
            $error['email'] = "Email của bạn đã được dùng vui lòng dùng email khác";
        }
    }
    //Validate password
    if (empty($_POST['password'])) {
        $error['password'] = "Password không được để trống";
    }
    if (empty($_POST['password2'])) {
        $error['password2'] = "Pasword không được để trống";
    }
    if($_POST['password'] != $_POST['password2']){
        $error['password2'] = 'Password không trùng nhau';
    }
    return $error;
}

//Validate edit
function validateEditStaff($editStaff){
    $error = [];
    $usersList = listAll('users');
    if (empty($editStaff['full_name'])) {
        $error['full_name'] = 'Bạn cần nhập họ và tên';
    }
    if (empty($editStaff['name'])) {
        $error['name'] = "Bạn cần nhập UserName";
    }
    if (empty($editStaff['phone_number'])) {
        $error['phone_number'] = 'Bạn cần nhập số điện thoại';
    }
    if (empty($editStaff['address'])) {
        $error['address'] = 'Bạn cần nhập địa chỉ';
    }
    if (empty($editStaff['email'])) {
        $error['email'] = 'Bạn cần nhập email';
    }
    //Validate password
    if (empty($_POST['password'])) {
        $error['password'] = "Password không được để trống";
    }
    if (empty($_POST['password2'])) {
        $error['password2'] = "Pasword không được để trống";
    }
    if($_POST['password'] != $_POST['password2']){
        $error['password2'] = 'Password không trùng nhau';
    }
    return $error;
}


// Viết câu lệnh truy vấn lấy ra danh sách nhân viên
if (!function_exists('staffList')) {
    function staffList()
    {
        try {
            $sql = "SELECT *
            FROM `users`
            WHERE users.is_delete = 0 AND users.role_id = 2 OR users.role_id = 3
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}