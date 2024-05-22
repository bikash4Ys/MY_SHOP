<?php
// セッション開始
session_start();
session_regenerate_id(true);

// 商品ID（GETパラメータ）を取得
$item_id = $_GET['item_id'];

// もしセッションに商品IDがあれば
if (isset($_SESSION['my_shop']['cart'][$item_id])) {
    unset($_SESSION['my_shop']['cart'][$item_id]);
}

// ショッピングカートにリダイレクト
header('Location: cart.php');