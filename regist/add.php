<?php
// データベースに接続
require_once '../db.php';

// セッションを開始
session_start();
session_regenerate_id(true);

// セッションデータを取得
if (!empty($_SESSION['my_shop']['regist'])) {
    $regist = $_SESSION['my_shop']['regist'];
    // パスワードのハッシュ化
    $regist['password'] = password_hash($regist['password'], PASSWORD_DEFAULT);
}
// usersテーブルにレコード追加するSQLを作成
$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";

// SQLを実行
$stmt = $pdo->prepare($sql);
$stmt->execute($regist);

// 完了画面にリダイレクトする
header('Location: complete.php');