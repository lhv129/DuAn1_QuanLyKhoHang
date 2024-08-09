<?php

function warehouse()
{
    $storage = storage('warehousing');
    require_once PATH_VIEW . 'warehouse/warehouse.php';
}

function warehouseEditPage($id)
{
    checkRoleAdmin();
    $products = listAll('products');
    $getOne = showOne('warehousing', $id);
    if ($_POST) {
        warehouseEdit($id);
    }
    require_once PATH_VIEW . 'warehouse/edit-warehouse.php';
}

function warehouseEdit($id)
{
    if (!empty($_POST)) {
        $warehousingEdit = [
            'product_id' => $_POST['product_id'] ?? null,
            'quantity' => $_POST['quantity'] ?? null
        ];
    }
    update('warehousing', $id, $warehousingEdit);
    header("Location: " . BASE_URL . '?act=kho-hang');
    exit();
}

function warehouseDelete($id)
{
    checkRoleAdmin();
    $softDelete = [
        'is_delete' => 1
    ];
    update('warehousing', $id, $softDelete);
    header("Location: " . BASE_URL . '?act=kho-hang');
    exit();
}

if (!function_exists('storage')) {
    function storage($tableName)
    {
        try {
            $sql = "SELECT warehousing.id,products.id AS product_id,brands.name AS brand_name,products.name,units.name AS unit_name,image,entry_price,retail_price,quantity,products.is_delete
            FROM $tableName INNER JOIN `products` ON `warehousing`.`product_id` = `products`.`id`
            INNER JOIN `brands` ON products.brand_id = brands.id
            INNER JOIN `units` ON products.unit_id = units.id
            WHERE warehousing.is_delete = 0
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

