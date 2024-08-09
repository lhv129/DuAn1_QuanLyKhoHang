<?php

function delivery(){
    $delivery = deliveryList();
    require_once PATH_VIEW . 'delivery/delivery.php';
}

function deliveryPage(){
    $users = staffListActive(); // lấy từ importController
    $payments = listAll('payments');
    $products = listAll('products');
    if($_POST){
        createDelivery();
    }
    require_once PATH_VIEW . 'delivery/create-delivery.php';
}

function createDelivery(){
    if (!empty($_POST)) {
        $createDelivery = [
            'user_id' => $_POST['user_id'] ?? null,
            'customer' => $_POST['customer'] ?? null,
            'payment_id' => $_POST['payment_id'] ?? null,
            'total_price' => $_POST['total_price'] ?? null,
            'created_at' => $_POST['created_at'] ?? null
        ];
        insert('goods_delivery_note', $createDelivery);
        $lastID = get_last_id('goods_delivery_note');
        //Lấy ra product để lấy giá nhập
        $getProduct = showOne('products',$_POST['product_id']);
        //Lấy ra giá nhập rồi truyền vào chi tiết hóa đơn
        $getRetail_price = $getProduct['retail_price'];
        foreach ($lastID as $newLastID) {
            $createDeliveryDetails = [
                'goods_delivery_note_id' => $newLastID['LastID'],
                'product_id' => $_POST['product_id'] ?? null,
                'quantity' => $_POST['quantity'] ?? null,
                'sub_total' => ($getRetail_price * $_POST['quantity']) ?? null,
            ];
            insert('goods_delivery_note_details', $createDeliveryDetails);
        }
    }
    //Cập nhật lại total_price
    updateTotalPriceDelivery();

    // Kiểm tra đơn nhập hàng
    // Nếu đơn xuất hàng có sản phẩm này rồi thì update số lượng
    // Nếu số lượng sản phẩm xuất mà lớn hơn trong kho thì tbao không đủ số lương
    checkQuantityInWarehouse();
}

function updateTotalPriceDelivery(){
    $totalPrice = 0;
    //Lấy ra ID của hóa đơn tạo mới nhất
    $lastID = get_last_id('goods_delivery_note');
    foreach ($lastID as $newLastID) {
        $id = $newLastID['LastID'];
    }
    // Lấy ra sub_total của chi tiết hóa đơn đó
    $importDetails = get_sub_total_delivery_note_details($id);
    // Duyệt mảng để tính ra tổng giá tiền của hóa đơn đó
    foreach ($importDetails as $item) {
        $totalPrice += $item['sub_total'];
    }
    $updateTotalPrice = [
        'total_price' => $totalPrice,
    ];
    update('goods_delivery_note',$id,$updateTotalPrice);
}
function checkQuantityInWarehouse(){
    // Lấy ra ID hóa đơn nhập cuối cùng
    $lastID = get_last_id('goods_delivery_note');
    foreach ($lastID as $newLastID) {
        $_SESSION['create_delivery_note'] = get_one_delivery_note_last($newLastID['LastID']);
    }
    // Viết câu lệnh truy vấn xem có sản phẩm đó trong kho (table warehousing)
    foreach($_SESSION['create_delivery_note'] as $item){
        $id = $item['product_id'];
        $storage = get_product_warehouse_id($id);       
    }
    // Nếu sản phẩm đó chưa có trong kho thì thông báo sản phẩm này không có trong kho
    if(empty($storage)){
        foreach($_SESSION['create_delivery_note'] as $item){
            $id = $item['id'];
            $softDelete = [
                'is_delete' => 1
            ];
            update('goods_delivery_note',$id,$softDelete);
            update('goods_delivery_note_details',$id,$softDelete);       
            setcookie('alert','Sản phẩm này không có trong kho', time()+1,"/","",0);
            header("Location: " . BASE_URL . '?act=kho-hang');+ 
            exit();        
        }
    }
    // Nếu sản phẩm đó có trong kho thì cập nhật lại số lượng trong kho
    if(!empty($storage)){
        foreach ($_SESSION['create_delivery_note'] as $item){
            if($storage['quantity'] >= $item['quantity']){
                $newQuantity = ($storage['quantity'] - $item['quantity']);
                $editQuantityStorage = [
                    'quantity' => $newQuantity,
                ];
                // table goods_delivery_note với table goods_delivery_note_details cùng 1 ID thì mới dùng được cách cập nhật này
                update('warehousing',$storage['id'],$editQuantityStorage);
                header("Location: " . BASE_URL . '?act=xuat-hang');
                exit();
            }else{
                foreach($_SESSION['create_delivery_note'] as $item){
                    $id = $item['id'];
                    $softDelete = [
                        'is_delete' => 1
                    ];
                    // table goods_delivery_note với table goods_delivery_note_details cùng 1 ID thì mới dùng được cách cập nhật này
                    update('goods_delivery_note',$id,$softDelete);
                    update('goods_delivery_note_details',$id,$softDelete);       
                    setcookie('alert','Sản phẩm này không số lượng đủ để xuất hàng', time()+1,"/","",0);
                    header("Location: " . BASE_URL . '?act=kho-hang');+ 
                    exit();        
                }
            }
        }
    }
}

function deliveryDetailsPage($id){
    $deliveryDetails = delivery_note_details($id);
    $getOne = get_one_delivery_note($id);
    require_once PATH_VIEW . 'delivery/delivery-details.php';
}

// Câu lệnh truy vấn lấy ra danh sách xuất hàng
if (!function_exists('deliveryList')) {
    function deliveryList()
    {
        try {
            $sql = "SELECT goods_delivery_note.id,created_at,users.name AS user_name,customer,payments.name AS payment_name,total_price
            FROM `goods_delivery_note`
            INNER JOIN `users` ON  goods_delivery_note.user_id = users.id
            INNER JOIN `payments` ON  goods_delivery_note.payment_id = payments.id
            WHERE goods_delivery_note.is_delete = 0
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

// Câu lệnh truy vấn lấy ra đơn xuất theo ID
if (!function_exists('get_one_delivery_note')) {
    function get_one_delivery_note($id)
    {
        try {
            $sql = "SELECT goods_delivery_note.id,created_at,users.name AS user_name,customer,payments.name AS payment_name,total_price
            FROM `goods_delivery_note`
            INNER JOIN `users` ON  goods_delivery_note.user_id = users.id
            INNER JOIN `payments` ON  goods_delivery_note.payment_id = payments.id
            WHERE goods_delivery_note.id = :id
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return $stmt->fetch();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

// Lấy ra 1 hóa đơn và các chi tiết hóa đơn của hóa đơn đó
if (!function_exists('delivery_note_details')) {
    function delivery_note_details($id)
    {
        try {
            $sql = "SELECT goods_delivery_note_details.id, goods_delivery_note_details.goods_delivery_note_id,products.name AS product_name,goods_delivery_note_details.quantity,products.retail_price,units.name AS unit_name,sub_total
            FROM `goods_delivery_note_details`
            INNER JOIN products ON goods_delivery_note_details.product_id = products.id
            INNER JOIN units ON products.unit_id = units.id
            WHERE goods_delivery_note_details.goods_delivery_note_id = :id AND goods_delivery_note_details.is_delete = 0
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

//Viết câu lệnh truy vấn lấy ra đơn nhập hàng,chi tiết đơn khi được thêm vào cuối cùng 
if (!function_exists('get_one_delivery_note_last')) {
    function get_one_delivery_note_last($id)
    {
        try {
            $sql = "SELECT goods_delivery_note_details.goods_delivery_note_id AS id,products.id AS product_id,quantity
            FROM `goods_delivery_note_details`
            INNER JOIN `products` ON  goods_delivery_note_details.product_id = products.id
            WHERE goods_delivery_note_details.goods_delivery_note_id = :id AND goods_delivery_note_details.is_delete = 0
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
// Câu lệnh truy vấn lấy ra tất cả subtotal của chi tiết hóa đơn trong 1 hóa đơn xuất
if (!function_exists('get_sub_total_delivery_note_details')) {
    function get_sub_total_delivery_note_details($id)
    {
        try {
            $sql = "SELECT id,goods_delivery_note_id,sub_total
            FROM `goods_delivery_note_details`
            WHERE goods_delivery_note_details.goods_delivery_note_id = :id AND goods_delivery_note_details.is_delete = 0
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

