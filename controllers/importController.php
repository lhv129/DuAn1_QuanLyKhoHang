<?php

function import()
{
    // $storage = storage('warehousing');
    $import = importList();
    require_once PATH_VIEW . 'import/import.php';
}

function pageImport()
{
    unsetSession();
    $users = staffListActive(); 
    $suppliers = listAll('suppliers');
    $payments = listAll('payments');
    $products = listAll('products');
    if ($_POST) {
        createImport();
    }
    require_once PATH_VIEW . 'import/create-import.php';
}
function createImport()
{
    if (!empty($_POST)) {
        $createImport = [
            'supplier_id' => $_POST['supplier_id'] ?? null,
            'user_id' => $_POST['user_id'] ?? null,
            'payment_id' => $_POST['payment_id'] ?? null,
            'total_price' => $_POST['total_price'] ?? null,
            'created_at' => $_POST['created_at'] ?? null,
            'status' => 'Pending',
        ];
        insert('goods_receipt_note', $createImport);
        $lastID = get_last_id('goods_receipt_note');
        //Lấy ra product để lấy giá nhập
        $getProduct = showOne('products',$_POST['product_id']);
        //Lấy ra giá nhập rồi truyền vào chi tiết hóa đơn
        $getEntry_price = $getProduct['entry_price'];
        foreach ($lastID as $newLastID) {
            $createImportDetails = [
                'goods_receipt_note_id' => $newLastID['LastID'],
                'product_id' => $_POST['product_id'] ?? null,
                'quantity' => $_POST['quantity'] ?? null,
                'sub_total' => ($getEntry_price * $_POST['quantity']) ?? null,
            ];
            insert('goods_receipt_note_details', $createImportDetails);
        }
    }
    //Cập nhật lại total_price
    updateTotalPriceImport();
    header("Location: " . BASE_URL . '?act=phe-duyet-hoa-don');
}

function updateTotalPriceImport(){
    $totalPrice = 0;
    //Lấy ra ID của hóa đơn tạo mới nhất
    $lastID = get_last_id('goods_receipt_note');
    foreach ($lastID as $newLastID) {
        $id = $newLastID['LastID'];
    }
    // Lấy ra sub_total của chi tiết hóa đơn đó
    $importDetails = get_sub_total_receipt_note_details($id);
    // Duyệt mảng để tính ra tổng giá tiền của hóa đơn đó
    foreach ($importDetails as $item) {
        $totalPrice += $item['sub_total'];
    }
    // Cập nhật giá tiền vào databases
    $updateTotalPrice = [
        'total_price' => $totalPrice,
    ];
    update('goods_receipt_note',$id,$updateTotalPrice);
}
// Validate create-import

function validateCreateImport($createImport){
    $error = [];
    if (empty($createImport['created_at'])) {
        $error['created_at'] = 'Bạn cần nhập ngày tháng năm';
    }
    return $error;
}

function importDetailsPage($id)
{
    $importDetails = receipt_note_details($id);
    $getOne = get_one_receipt_note($id);
    require_once PATH_VIEW . 'import/import-details.php';
}



// Câu lệnh truy vấn
if (!function_exists('get_one_receipt_note')) {
    function get_one_receipt_note($id)
    {
        try {
            $sql = "SELECT goods_receipt_note.id,created_at,users.name AS user_name,suppliers.name AS supplier_name,payments.name AS payment_name,total_price
            FROM `goods_receipt_note`
            INNER JOIN `users` ON  goods_receipt_note.user_id = users.id
            INNER JOIN `suppliers` ON  goods_receipt_note.supplier_id = suppliers.id
            INNER JOIN `payments` ON  goods_receipt_note.payment_id = payments.id
            WHERE goods_receipt_note.id = :id
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

// Viết câu lệnh truy vấn lấy ra tất cả danh sách nhập hàng
if (!function_exists('importList')) {
    function importList()
    {
        try {
            $sql = "SELECT goods_receipt_note.id,created_at,users.name AS user_name,suppliers.name AS supplier_name,payments.name AS payment_name,total_price
            FROM `goods_receipt_note`
            INNER JOIN `users` ON  goods_receipt_note.user_id = users.id
            INNER JOIN `suppliers` ON  goods_receipt_note.supplier_id = suppliers.id
            INNER JOIN `payments` ON  goods_receipt_note.payment_id = payments.id
            WHERE goods_receipt_note.is_delete = 0 AND goods_receipt_note.status = 'Success' 
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

// Lấy ra 1 hóa đơn và các chi tiết hóa đơn của hóa đơn đó
if (!function_exists('receipt_note_details')) {
    function receipt_note_details($id)
    {
        try {
            $sql = "SELECT goods_receipt_note_details.id, goods_receipt_note_details.goods_receipt_note_id,products.name AS product_name,goods_receipt_note_details.quantity,products.entry_price,units.name AS unit_name,sub_total
            FROM `goods_receipt_note_details`
            INNER JOIN products ON goods_receipt_note_details.product_id = products.id
            INNER JOIN units ON products.unit_id = units.id
            WHERE goods_receipt_note_details.goods_receipt_note_id = :id AND goods_receipt_note_details.is_delete = 0
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
if (!function_exists('get_one_receipt_note_last')) {
    function get_one_receipt_note_last($id)
    {
        try {
            $sql = "SELECT goods_receipt_note_details.goods_receipt_note_id AS id,products.id AS product_id,quantity
            FROM `goods_receipt_note_details`
            INNER JOIN `products` ON  goods_receipt_note_details.product_id = products.id
            WHERE goods_receipt_note_details.goods_receipt_note_id = :id AND goods_receipt_note_details.is_delete = 0
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

// Câu lệnh truy vấn để cập nhật số lượng 

if (!function_exists('get_product_warehouse_id')) {
    function get_product_warehouse_id($id)
    {
        try {
            $sql = "SELECT id,product_id,quantity
            FROM `warehousing`
            WHERE warehousing.product_id = :id
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

// Câu lệnh truy vấn lấy ra tất cả subtotal của chi tiết hóa đơn trong 1 hóa đơn
if (!function_exists('get_sub_total_receipt_note_details')) {
    function get_sub_total_receipt_note_details($id)
    {
        try {
            $sql = "SELECT id,goods_receipt_note_id,sub_total
            FROM `goods_receipt_note_details`
            WHERE goods_receipt_note_details.goods_receipt_note_id = :id AND goods_receipt_note_details.is_delete = 0
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

// Viết câu lệnh truy vấn lấy ra danh sách nhân viên đang hoạt động
if (!function_exists('staffListActive')) {
    function staffListActive()
    {
        try {
            $sql = "SELECT *
            FROM `users`
            WHERE users.is_delete = 0 AND users.is_active = 1 AND users.role_id = 2 OR users.role_id = 3
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
