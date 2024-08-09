<?php

function decentralizeAdmin(){
    checkRoleAdmin();
    $user = decentralizeListAdmin();
    require_once PATH_VIEW . 'decentralize/decentralize-admin.php';
}

function deleteDecentralizeAdmin($id){
    $softDelete = [
        'role_id' => 2,
    ];
    update('users',$id,$softDelete);
    header("Location: " . BASE_URL . '?act=phan-quyen-quan-tri');
}

// Câu lệnh truy vấn, lấy ra list danh sách admin
if (!function_exists('decentralizeListAdmin')) {
    function decentralizeListAdmin()
    {
        try {
            $sql = "SELECT *
            FROM `users`
            WHERE users.is_delete = 0 AND users.role_id = 3
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
