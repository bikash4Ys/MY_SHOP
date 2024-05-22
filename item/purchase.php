<?php
// DB接続
require_once '../db.php';

//セッションを開始
session_start();
session_regenerate_id(true);


// ログインユーザがいなければ、ログイン画面にリダイレクト
if (empty($_SESSION['my_shop']['user'])) {
    header('Location: ../login/');
    exit;
}

// ユーザ情報取得
$user = $_SESSION['my_shop']['user'];

// 商品カート取得
$cart_items = $_SESSION['my_shop']['cart'];

// 商品購入
purchase($pdo, $user, $cart_items, $_POST['amount']);

// 完了画面にリダイレクト
header('Location: complete.php');

function purchase($pdo, $user, $cart_items, $item_amounts) {
    $index = 0;
    foreach ($cart_items as $cart_item) {
        $amount = $item_amounts[$index];
        $index++;

        $data['user_id'] = $user['id'];
        $data['item_id'] = $cart_item['id'];
        $data['amount'] = $amount;
        $data['total_price'] = $cart_item['price'] * $amount;

        $sql = "INSERT INTO user_items (user_id, item_id, amount, total_price)
                VALUES (:user_id, :item_id, :amount, :total_price)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
    }
}
?>