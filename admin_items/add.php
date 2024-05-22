<?php
// データベースに接続
require_once '../db.php';

// POSTデータ取得
$item = $_POST;

// 商品コード重複チェック
$sql = "SELECT * FROM items WHERE code = :code";
$stmt = $pdo->prepare($sql);
$stmt->execute(['code' => $item['code']]);
$duplicate_item = $stmt->fetch(PDO::FETCH_ASSOC);

// 商品コードが重複していたら入力画面にリダイレクト
if ($duplicate_item) {
   header('Location: input.php');
   exit;
}


// itemsテーブルにレコード追加するSQLを作成
$sql = "INSERT INTO items (code, name, price, stock) 
        VALUES (:code, :name, :price, :stock)";

// SQLを実行
$stmt = $pdo->prepare($sql);
$stmt->execute($item);

// 一覧画面にリダイレクトする
header('Location: ./');