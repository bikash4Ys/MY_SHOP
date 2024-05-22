<?php
// データベースに接続
require_once '../db.php';

session_start();
session_regenerate_id(true);

// セッションからユーザ情報取得
$user = $_SESSION['my_shop']['user'];

// もしユーザ情報がなければ、ログインページにリダイレクト
if (!$user) {
    header('Location: ../login/');
}

// 購入履歴 user_items をすべて取得するSQL
$sql = "SELECT 
            items.id,
            items.name,
            items.price,
            user_items.amount,
            user_items.total_price
        FROM user_items 
        JOIN items ON items.id = user_items.item_id
        WHERE user_id = {$user['id']};";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$user_items = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $user_items[] = $row;
}

// ダメなプログラム N+1問題
// foreach ($user_items as $user_item) {
//     $sql = "SELECT * FROM items WHERE id = {$user_item['item_id']};";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute();
//     $items[]= $stmt->fetch(PDO::FETCH_ASSOC);
// }

$result['total_price'] = calculateTotalPrice($pdo, $user);

// 購入金額の合計をだすSQL
function calculateTotalPrice($pdo, $user)
{
    $sql = "SELECT SUM(total_price) AS total_price FROM user_items 
        WHERE user_id = {$user['id']}";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_price'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="p-3">
            <a href="../item/">商品一覧</a>
            |
            <a href="../item/cart.php">カート</a>
            |
            <a href="./">ユーザホーム</a>
            |
            <a href="purchase_history.php">購入履歴</a>
            <a class="btn btn-sm btn-outline-primary" href="logout.php">Sign out</a>
        </div>
        <h2>購入履歴</h2>
        <h3>合計金額</h3>
        <p>&yen;<?= number_format($result['total_price']) ?></p>
        <table class="table">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>個数</th>
                    <th>購入金額</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_items as $item) : ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['amount'] ?></td>
                        <td><?= $item['total_price'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>