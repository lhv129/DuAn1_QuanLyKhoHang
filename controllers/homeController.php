<?php

function homeIndex() {
    $products = listAll('products');
    $countImport = countImport();
    $countDelivery = countDelivery();
    $countQuantity = listAll('warehousing');
    $sumTotalImport = sumTotalImport();
    $sumTotalDelivery = sumTotalDelivery();
    require_once PATH_VIEW . 'home.php';
}


if (!function_exists('countImport')) {
    function countImport()
    {
        try {
            $sql = "SELECT COUNT(*) AS `Number of records`
            FROM `goods_receipt_note`
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

if (!function_exists('countDelivery')) {
    function countDelivery()
    {
        try {
            $sql = "SELECT COUNT(*) AS `Number of records`
            FROM `goods_delivery_note`
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

if (!function_exists('countQuantityWarehouse')) {
    function countQuantityWarehouse()
    {
        try {
            $sql = "SELECT COUNT(quantity) AS `Number of records`
            FROM `warehousing`
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

if (!function_exists('sumTotalImport')) {
    function sumTotalImport()
    {
        try {
            $sql = "SELECT total_price
            FROM `goods_receipt_note`
            WHERE goods_receipt_note.is_delete = 0
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('sumTotalDelivery')) {
    function sumTotalDelivery()
    {
        try {
            $sql = "SELECT total_price
            FROM `goods_delivery_note`
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

