<?php

function brand(){
    unsetSession();
    $brands = listAll('brands');
    require_once PATH_VIEW . 'brands/brands.php';
}

function createBrandPage(){
    if($_POST){
        createBrand();
    };
    require_once PATH_VIEW . 'brands/create-brand.php';
}

function createBrand(){
    if($_POST){
        $createBrand = [
            'name' => $_POST['name']??null,
        ];
        //Validate
        $error = validateCreateBrand($createBrand);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['createBrand'] = $createBrand;
            header('Location: ' . BASE_URL . '?act=them-thuong-hieu');
            exit();
        }
        insert('brands', $createBrand);
        header("Location: " . BASE_URL . '?act=danh-sach-thuong-hieu');
        exit();
    }
};

function editBrandPage($id){
    $getOne = showOne('brands',$id);
    if($_POST){
        editBrand($id);
    }; 
    require_once PATH_VIEW . 'brands/edit-brand.php';
}

function editBrand($id){
    if(!empty($_POST)){
        $editBrand = [
            'name'=> $_POST['name']??null,
        ];
        //Validate
        $error = validateEditBrand($editBrand);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['editBrand'] = $editBrand;
            header('Location: ' . BASE_URL . '?act=chinh-sua-thuong-hieu&id=' . $id);
            exit();
        }
        update('brands',$id ,$editBrand);
        header("Location: " . BASE_URL . '?act=danh-sach-thuong-hieu');
        exit();
    }
}

function deleteBrand($id){
    $softDelete = [
        'is_delete' => 1,
    ];
    update('brands',$id,$softDelete);
    header("Location: " . BASE_URL . '?act=danh-sach-thuong-hieu');
    exit();
}



//Validate
function validateCreateBrand($createBrand){
    $error = [];
    $brands = listAll('brands');
    if(empty($createBrand['name'])){
        $error['name'] = 'Mời bạn nhập tên thương hiệu';
    }
    foreach($brands as $check){
        if($check['name'] == $createBrand['name']){
            $error['name'] = 'Tên thương hiệu đã được tạo';
        }
    }
    return $error;
}

function validateEditBrand($editBrand){
    $error = [];
    $brands = listAll('brands');
    if(empty($editBrand['name'])){
        $error['name'] = 'Mời bạn nhập tên thương hiệu';
    }
    foreach($brands as $check){
        if($check['name'] == $editBrand['name']){
            $error['name'] = 'Tên thương hiệu đã được tạo';
        }
    }
    return $error;
}