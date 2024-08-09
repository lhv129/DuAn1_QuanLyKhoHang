<?php
function unit()
{
    unsetSession();
    $units = listAll('units');
    require_once PATH_VIEW . 'units/units.php';
}

function createUnitPage(){
    if($_POST){
        createUnit();
    }
    require_once PATH_VIEW . 'units/create-unit.php';
}

function createUnit(){
    if(!empty($_POST)){
        $createUnit = [
            'name' => $_POST['name'] ??null
        ];
        //Validate
        $error = validateCreateUnit($createUnit);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['createUnit'] = $createUnit;
            header('Location: ' . BASE_URL . '?act=them-don-vi-tinh');
            exit();
        }
        insert('units', $createUnit);
        header("Location: " . BASE_URL . '?act=danh-sach-don-vi');
        exit();
    }
}

function editUnitPage($id){
    $getOne = showOne('units',$id);
    if($_POST){
        editUnit($id);
    }
    require_once PATH_VIEW . 'units/edit-unit.php';
}

function editUnit($id){
    if(!empty($_POST)){
        $editUnit = [
            'name'=> $_POST['name'] ??null
        ];
        //Validate
        $error = validateEditUnit($editUnit);
        if (!empty($error)) {
            $_SESSION['errors'] = $error;
            $_SESSION['editUnit'] = $editUnit;
            header('Location: ' . BASE_URL . '?act=chinh-sua-don-vi&id=' . $id);
            exit();
        }
        update('units',$id ,$editUnit);
        header("Location: " . BASE_URL . '?act=danh-sach-don-vi-tinh');
        exit();
    }
}

function deleteUnit($id){
    $softDelete = [
        'is_delete' => 1
    ];
    update('units',$id,$softDelete);
    header("Location: " . BASE_URL . '?act=danh-sach-don-vi-tinh');
    exit();
}

//Validate

function validateCreateUnit($createUnit){
    $error = [];
    $units = listAll('units');
    if(empty($createUnit['name'])){
        $error['name'] = 'Mời bạn nhập tên đơn vị tính';
    }
    foreach($units as $check){
        if($check['name'] == $createUnit['name']){
            $error['name'] = 'Tên đơn vị đã được tạo';
        }
    }
    return $error;
}

function validateEditUnit($editUnit){
    $error = [];
    $units = listAll('units');
    if(empty($editUnit['name'])){
        $error['name'] = 'Mời bạn nhập tên đơn vị tính';
    }
    foreach($units as $check){
        if($check['name'] == $editUnit['name']){
            $error['name'] = 'Tên đơn vị đã được tạo';
        }
    }
    return $error;
}