<?php

function pendingPage(){
    $pending = importListPending();
    require_once PATH_VIEW . 'status/pending.php';
}

function processingPage(){
    $processing = importListProcessing();
    require_once PATH_VIEW . 'status/processing.php';
}

function processingUpdate($id){
    checkRoleAdmin();
    $processing = [
        'status' => 'Processing'
    ];
    update('goods_receipt_note',$id, $processing);
    header('Location: ' . BASE_URL . '?act=phe-duyet-hoa-don');
}

function successUpdate($id){
    $success = [
        'status' => 'Success'
    ];
    update('goods_receipt_note',$id, $success);
    // Kiểm tra đơn nhập hàng
    // Nếu đơn nhập hàng có sản phẩm này rồi thì update số lượng
    // Nếu không thì tạo ra 1 bản ghi cho sản phẩm đó
    checkProductInWarehouse();
}

function editImport($id){
    $check = showOne('goods_receipt_note',$id);
    if($check['status'] === 'Pending'){
        setcookie("alert", "Có thể sửa!", time()+1, "/","", 0);
    }else{
        setcookie("alert", "Đơn hàng đang trong trạng thái xử lý,không thể sửa!", time()+1, "/","", 0);
        header('Location: ' . BASE_URL . '?act=xac-thuc-hoa-don');
    }
}

function deleteImport($id){
    $check = showOne('goods_receipt_note',$id);
    if($check['status'] === 'Pending'){
        $softDelete = [
            'is_delete' => 1,
        ];
        update('goods_receipt_note',$id,$softDelete);
        header('Location: ' . BASE_URL . '?act=phe-duyet-hoa-don');
    }else{
        setcookie("alert", "Đơn hàng đang trong trạng thái xử lý,không thể xóa!", time()+1, "/","", 0);
        header('Location: ' . BASE_URL . '?act=xac-thuc-hoa-don');
    }
}


function checkProductInWarehouse(){
    // Lấy ra ID hóa đơn nhập cuối cùng của hóa đơn nhập hàng (table goods_receipt_note)
    $lastID = get_last_id('goods_receipt_note');
    foreach ($lastID as $newLastID) {
        $_SESSION['create_receipt_note'] = get_one_receipt_note_last($newLastID['LastID']);
    }
    // Viết câu lệnh truy vấn kiểm tra xem có sản phẩm đó trong kho (table warehousing)
    foreach($_SESSION['create_receipt_note'] as $item){
        $id = $item['product_id'];
        $storage = get_product_warehouse_id($id);       
    }
    // Nếu sản phẩm đó chưa có trong kho thì tạo ra 1 bản ghi mới
    if(empty($storage)){
        foreach ($_SESSION['create_receipt_note'] as $item){
            $updateCheckStorage = [
                'product_id' => $item['product_id'],
                'quantity'=> $item['quantity'],
            ];
            insert('warehousing', $updateCheckStorage);
            header("Location: " . BASE_URL . '?act=nhap-hang');
            exit();       
        }
    }
    if(!empty($storage)){
        foreach ($_SESSION['create_receipt_note'] as $item){
            $newQuantity = ($item['quantity'] + $storage['quantity']);
            $editCheckStorage = [
                'quantity' => $newQuantity,
            ];
            update('warehousing',$storage['id'],$editCheckStorage);
            header("Location: " . BASE_URL . '?act=nhap-hang');
            exit();
        }
    }
};

//Lấy ra danh sách hóa đơn trạng thái Pending
if (!function_exists('importListPending')) {
    function importListPending()
    {
        try {
            $sql = "SELECT goods_receipt_note.id,created_at,users.name AS user_name,suppliers.name AS supplier_name,payments.name AS payment_name,total_price
            FROM `goods_receipt_note`
            INNER JOIN `users` ON  goods_receipt_note.user_id = users.id
            INNER JOIN `suppliers` ON  goods_receipt_note.supplier_id = suppliers.id
            INNER JOIN `payments` ON  goods_receipt_note.payment_id = payments.id
            WHERE goods_receipt_note.is_delete = 0 AND goods_receipt_note.status = 'Pending' 
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

//Lấy ra hóa đơn trạng thái Processing
if (!function_exists('importListProcessing')) {
    function importListProcessing()
    {
        try {
            $sql = "SELECT goods_receipt_note.id,created_at,users.name AS user_name,suppliers.name AS supplier_name,payments.name AS payment_name,total_price
            FROM `goods_receipt_note`
            INNER JOIN `users` ON  goods_receipt_note.user_id = users.id
            INNER JOIN `suppliers` ON  goods_receipt_note.supplier_id = suppliers.id
            INNER JOIN `payments` ON  goods_receipt_note.payment_id = payments.id
            WHERE goods_receipt_note.is_delete = 0 AND goods_receipt_note.status = 'Processing' 
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}