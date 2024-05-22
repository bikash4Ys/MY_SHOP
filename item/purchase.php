<?php
//セッションを開始
session_start();
session_regenerate_id(true);

// ログインユーザがいなければ、ログイン画面にリダイレクト
if (empty($_SESSION['my_shop']['user'])) {
    header('Location: ../login/');
    exit;
}
?>