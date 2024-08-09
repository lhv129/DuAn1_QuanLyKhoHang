<?php
function product()
{
    //Xóa tất cả bộ nhớ đệm
    unsetSession();
    $products = listAllProduct();
    require_once PATH_VIEW . 'products/products.php';
}
function createProductPage()
{
    $brands = listAll('brands');
    $units = listAll('units');
    if ($_POST) {
        createProduct();
    }
    require_once PATH_VIEW . 'products/create-product.php';
}

function createProduct()
{
    if (!empty($_POST)) {
        $createProduct = [
            'brand_id' => $_POST['brand_id'] ?? null,
            'name' => $_POST['name'] ?? null,
            'unit_id' => $_POST['unit_id'] ?? null,
            'image' => $_POST['image'] ?? null,
            'entry_price' => $_POST['entry_price'] ?? null,
            'retail_price' => $_POST['retail_price'] ?? null,
            'slug' => $_POST['slug'] ?? null,
        ];

        //Validate khi thêm mới 1 sản phẩm
        $error = validateCreateProduct($createProduct);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['createProduct'] = $createProduct;
            header('Location: ' . BASE_URL . '?act=them-moi-san-pham');
            exit();
        }

        $image = $_FILES['image'] ?? null;
        if (!empty($image)) {
            $createProduct['image'] = upload_file($image, 'uploads/products/');

        }
        insert('products', $createProduct);
        header("Location: " . BASE_URL . '?act=danh-sach-san-pham');
        exit();
    }
}

function editProductPage($id)
{
    checkRoleAdmin();
    $brands = listAll('brands');
    $units = listAll('units');
    $getOne = showOne('products', $id);
    if ($_POST) {
        editProduct($id);
    }
    require_once PATH_VIEW . 'products/edit-product.php';
}
function editProduct($id)
{
    if (!empty($_POST)) {
        $editProduct = [
            'brand_id' => $_POST['brand_id'] ?? null,
            'name' => $_POST['name'] ?? null,
            'unit_id' => $_POST['unit_id'] ?? null,
            'image' => $_POST['image'] ?? null,
            'entry_price' => $_POST['entry_price'] ?? null,
            'retail_price' => $_POST['retail_price'] ?? null,
            'slug' => $_POST['slug'] ?? null,
        ];

        //Validate khi sửa 1 sản phẩm
        $error = validateEditProduct($editProduct);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['editProduct'] = $editProduct;
            header('Location: ' . BASE_URL . '?act=chinh-sua-san-pham&id=' . $id);
            exit();
        }

        $image = $_FILES['image'] ?? null;
        if (!empty($image)) {
            $editProduct['image'] = upload_file($image, 'uploads/products/');

        }
        update('products', $id, $editProduct);
        header("Location: " . BASE_URL . '?act=danh-sach-san-pham');
        exit();
    }
}
function productDelete($id)
{
    $softDelete = [
        'is_delete' => 1
    ];
    update('products', $id, $softDelete);
    header("Location: " . BASE_URL . '?act=danh-sach-san-pham');
    exit();
}

// Câu lệnh truy vấn
if (!function_exists('listAllProduct')) {
    function listAllProduct()
    {
        try {
            $sql = "SELECT products.id,brands.name AS brand_name,products.name,units.name AS unit_name,image,entry_price,retail_price
            FROM products
            INNER JOIN `brands` ON products.brand_id = brands.id
            INNER JOIN `units` ON products.unit_id = units.id
            WHERE products.is_delete = 0
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}


//Validate
function validateCreateProduct($createProduct)
{
    $error = [];
    if (empty($createProduct['name'])) {
        $error['name'] = 'Bạn cần tên sản phẩm';
    }
    if (empty($createProduct['entry_price'])) {
        $error['entry_price'] = 'Bạn cần nhập giá nhập sản phẩm';
    }
    if (empty($createProduct['retail_price'])) {
        $error['retail_price'] = 'Bạn cần nhập giá bán sản phẩm';
    }
    if (empty($createProduct['slug'])) {
        $error['slug'] = 'Bạn cần nhập slug';
    }

    // Validate ảnh create,edit, product
    // $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];
    // if ($createProduct['image']['size'] > 500000) {
    //     $error['image'] = 'Ảnh sản phẩm có dung lượn quá lớn';
    // } else if (!in_array($createProduct['image']['type'], $typeImage)) {
    //     $error['image'] = 'Chỉ chấp nhận file: PNG, JPG, JPEG';
    // }
    return $error;
}
function validateEditProduct($editProduct)
{
    $error = [];
    if (empty($editProduct['name'])) {
        $error['name'] = 'Bạn cần tên sản phẩm';
    }
    if (empty($editProduct['entry_price'])) {
        $error['entry_price'] = 'Bạn cần nhập giá nhập sản phẩm';
    }
    if (empty($editProduct['retail_price'])) {
        $error['retail_price'] = 'Bạn cần nhập giá bán sản phẩm';
    }
    if (empty($editProduct['slug'])) {
        $error['slug'] = 'Bạn cần slug';
    }
    // Validate ảnh create,edit, product
    // $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];
    // if ($editProduct['image']['size'] > 250000) {
    //     $error['image'] = 'Ảnh sản phẩm có dung lượn quá lớn';
    // }else if (!in_array($editProduct['image']['type'], $typeImage)) {
    //     $error['image'] = 'Chỉ chấp nhận file: PNG, JPG, JPEG';
    // }
    return $error;
}