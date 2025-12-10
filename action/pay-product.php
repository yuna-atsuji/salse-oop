<?php
session_start();

$total    = $_POST['total'];     // 合計金額
$payment  = $_POST['payment'];   // お客さんが払った金額
$name     = $_POST['product_name'];

if ($payment < $total) {
    // お金が足りないとき
    $_SESSION['pay_error'] = "Payment is not enough. You need \$$total but paid \$$payment.";
    header("location: ../views/dashboard.php?buy=success&pay=error");
    exit;
}

$change = $payment - $total;

// 結果を保存しておく
$_SESSION['pay_result'] = [
    'name'    => $name,
    'total'   => $total,
    'payment' => $payment,
    'change'  => $change,
];

header("location: ../views/dashboard.php?pay=success");
exit;
