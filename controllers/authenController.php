<?php
function authenShowFormLogin()
{
    if ($_POST) {
        authenLogin();
    }

    require_once PATH_VIEW . 'authen/login.php';
}

function authenLogin()
{
    $usersList = listAll('users'); // Lấy dữ liệu trong Database

    $user = getUserClientByEmailAndPassword($_POST['email'], $_POST['password']);
    //Validate đăng nhập
    if (empty($_POST['email']) && empty($_POST['password'])) {
        $_SESSION['error'] = 'Mời bạn nhập email và password!';
        header('Location: ' . BASE_URL . '?act=login');
        exit();
    }
    if (empty($_POST['email']) && !empty($_POST['password'])) {
        $_SESSION['error'] = 'Mời bạn nhập email!';
        header('Location: ' . BASE_URL . '?act=login');
        exit();
    }
    if (empty($_POST['password'] && !empty($_POST['email']))) {
        $_SESSION['error'] = 'Mời bạn nhập password!';
        header('Location: ' . BASE_URL . '?act=login');
        exit();
    }
    $email = $_POST['email']; // Lấy dữ liệu từ ô input
    $password = $_POST['password']; // Lấy dữ liệu từ ô input
    // Check email có tồn tại không
    if (empty($user)) {
        $_SESSION['error'] = 'Email không tồn tại!';
    }
    // Check email và password có trùng khớp với tài khoản đã tạo
    foreach ($usersList as $check) {
        if ($email == $check['email'] && $password != $check['password']) {
            $_SESSION['error'] = 'Password bạn vừa nhập chưa chính xác!';
        }
        if ($email == $check['email'] && $password == $check['password']) {
            $_SESSION['user'] = $user;
            $activeCheck = $_SESSION['user']['is_active'];
            if ($activeCheck === 1) {
                header('Location: ' . BASE_URL);
                exit();
            }else {
                header('Location: ' . BASE_URL . '?act=lock');
                exit();
            }
        }
    }
}

function register()
{
    $usersList = listAll('users');
    if ($_POST) {
        authenRegister();
    }
    require_once PATH_VIEW . 'authen/register.php';
}

function authenRegister()
{
    $usersList = listAll('users');
    if (empty($_POST['full_name'])) {
        $_SESSION['errorRS']['full_name'] = "Bạn cần nhập Họ và tên";
    }else {
        $full_name = $_POST['full_name'];
    }
    if (empty($_POST['name'])) {
        $_SESSION['errorRS']['name'] = "Bạn cần nhập UserName ";
    }
    //Validate username không được để trống và không được dài hơn 8 kí tự
    $roleUserName = preg_replace('/[^a-zA-Z0-9]/m', '', $_POST['name']);
    $checkUserName = strlen($roleUserName);
    if ($checkUserName > 8) {
        $_SESSION['errorRS']['name'] = "Username không được dài hơn 8 kí tự";
    }
    //phone_number không được để trống
    if (empty($_POST['phone_number'])) {
        $_SESSION['errorRS']['phone_number'] = "Bạn cần nhập Phone Number";
    }else{
        $phone_number = $_POST['phone_number'];
    }
    //address không được để trống
    if (empty($_POST['address'])) {
        $_SESSION['errorRS']['address'] = "Bạn cần nhập Address";
    }else{
        $address = $_POST["address"];
    }
    //Email không được để trống
    if (empty($_POST['email'])) {
        $_SESSION['errorRS']['email'] = "Bạn cần nhập Email";
    }
    //Email không được để trống
    if (empty($_POST['email'])) {
        $_SESSION['errorRS']['email'] = "Bạn cần nhập Email";
    }
    //END VALIDATE EMAIL
    // Check xem username có bị trùng lặp không
    foreach ($usersList as $listCheck) {
        if ($_POST['name'] == $listCheck['name']) {
            // Nếu có thì hiện ra thông báo
            $_SESSION['errorRS']['name'] = "Username của bạn đã bị trùng vui lòng đặt tên khác";
        } else {
            $name = $_POST['name'];
        }
        if ($_POST['email'] == $listCheck['email']) {
            // Nếu có thì hiện ra thông báo
            $_SESSION['errorRS']['email'] = "Email của bạn đã được dùng vui lòng dùng email khác";
        } else {
            $email = $_POST['email'];
        }
    }
    //Password không được để trống
    if (empty($_POST['password'])) {
        $_SESSION['errorRS']['password'] = "Password không được để trống";
    } else {
        $password = $_POST['password'];
    }
    if (empty($_POST['password2'])) {
        $_SESSION['errorRS']['password2'] = "Pasword không được để trống";
    } else {
        $password2 = $_POST['password2'];
    }
    // Validate Password và confirmPassword trùng nhau
    if (isset($password) && (isset($password2))) {
        if ($password != $password2) {
            $_SESSION['errorRS']['passwordCF'] = "Mật khẩu không trùng nhau";
        } else {
            $passConfirm = $password;
            insert('users', [
                'full_name' => $full_name,
                'name' => $name,
                'email' => $email,
                'password' => $passConfirm,
                'phone_number' => $phone_number,
                'address' => $address,
                'role_id' => 1,
            ]);
            setcookie("alert", "Đăng ký thành công!", time()+1, "/","", 0);
            header('Location: ' . BASE_URL . '?act=login');
        }
    }
}

function authenLogout()
{
    if (!empty($_SESSION['user'])) {
        session_destroy();
    }
    header('Location: ' . BASE_URL);
    exit();
}

function checkRoleAdmin(){
    if(isset($_SESSION['user'])){
        if($_SESSION['user']['role_id'] === 1){
            setcookie("alert", "Bạn không có đủ quyền hạn để truy cập!", time()+1, "/","", 0);
            header('Location: ' . BASE_URL);
            exit();
        }
        if($_SESSION['user']['role_id'] === 2){
            setcookie("alert", "Bạn không có đủ quyền hạn để truy cập!", time()+1, "/","", 0);
            header('Location: ' . BASE_URL);
            exit();
        }
    }
}

function lockAccount(){
    require_once PATH_VIEW . 'authen/lock.php';
}

if (!function_exists('getUserClientByEmailAndPassword')) {
    function getUserClientByEmailAndPassword($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email AND password = :password";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);

            $stmt->execute();

            return $stmt->fetch();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
