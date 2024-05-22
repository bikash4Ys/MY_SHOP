<?php
// CRUD
// Create: INSERT INTO ...
// Read: SELECT xx FROM ...
// Update: UPDATE xxx SET xxx = xxx... WHERE ...
// Delete: DELETE FROM xxxx WHERE xxxx

// データベースに接続
require_once '../db.php';

// 商品IDを取得
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // 商品IDでitemsのレコードを削除するSQL
    $sql = "DELETE FROM items WHERE id = {$id};";

    // SQLを実行
    $stmt = $pdo->prepare($sql);
    $stmt->execute($item);

    // 一覧画面にリダイレクトする
    header('Location: ./');
}