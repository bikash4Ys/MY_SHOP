<?php
// データベースに接続
require_once '../db.php';

// 商品IDを取得
$item_id = $_GET['id'];

// 商品データを指定したidで取得SQL
$sql = "SELECT * FROM items WHERE id = {$item_id};";

// SQLを実行
$stmt = $pdo->prepare($sql);
$stmt->execute();

// データ取得
$item = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2 class="h2">商品編集</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?= $item['id'] ?>">

            <div class="mb-3 form-floating">
                <input id="code" type="text" class="form-control" name="code" value="<?= @$item['code'] ?>">
                <label for="code">商品コード</label>
                <p class="text-danger pt-2"><?= @$errors['code'] ?></p>
            </div>
            <div class="mb-3 form-floating">
                <input id="name" type="text" class="form-control" name="name" value="<?= @$item['name'] ?>">
                <label for="name">商品名</label>
                <p class="text-danger pt-2"><?= @$errors['name'] ?></p>
            </div>
            <div class="mb-3 form-floating">
                <input id="price" type="text" class="form-control" name="price" value="<?= @$item['price'] ?>">
                <label for="price">価格</label>
                <p class="text-danger pt-2"><?= @$errors['price'] ?></p>
            </div>
            <div class="mb-3 form-floating">
                <input id="stock" type="text" class="form-control" name="stock" value="<?= @$item['stock'] ?>">
                <label for="stock">在庫</label>
                <p class="text-danger pt-2"><?= @$errors['stock'] ?></p>
            </div>
            <button class="btn btn-primary">更新</button>
            <a class="btn btn-outline-primary" href="./">戻る</a>
        </form>

        <div class="mt-4">
            <form action="delete.php" method="post">
                <!-- 削除する商品IDを送信(hidden) -->
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <button class="btn btn-danger">削除</button>
            </form>
        </div>
    </div>
</body>

</html>