<?php
// POST以外はアクセスできない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //強制終了
    exit;
}

// セッションを開始
session_start();
// セッションIDを再発行
session_regenerate_id(true);

// POSTデータをセッションに登録
$_SESSION['my_shop']['regist'] = $_POST;

// POSTデータ取得
$posts = sanitize($_POST);
// var_dump($posts);

// バリデーション（データチェック）
$errors = validate($posts);
if ($errors) {
    $_SESSION['my_shop']['errors'] = $errors;
    // 入力画面にリダイレクト
    header('Location: input.php');
    exit;
}

/**
 * サニタイズ
 */
function sanitize($posts)
{
    if (empty($posts)) return;
    foreach ($posts as $key => $value) {
        $posts[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    return $posts;
}

function validate(array $posts)
{
    $errors = [];
    if (empty($posts['name'])) {
        $errors['name'] = 'Nameを入力してください';
    }
    if (empty($posts['email'])) {
        $errors['email'] = 'Emailを入力してください';
    }
    if (empty($posts['password'])) {
        $errors['password'] = 'Passwordを入力してください';
    }
    // エラーメッセージを返す
    return $errors;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>


<body>
    <main class="m-auto w-50 p-3 m-3">
        <h2 class="text-center p-3">Register</h2>
        <p>この内容で登録しますか？</p>
        <form action="add.php" method="post">
            <div>
                <label class="form-label" for="">Name</label>
                <p><?= $posts['name'] ?></p>
            </div>
            <div>
                <label class="form-label" for="">Email</label>
                <p><?= $posts['email'] ?></p>
            </div>
            <div>
                <button class="btn btn-primary">Regist</button>
                <a class="btn btn-outline-primary" href="input.php">Back</a>
            </div>
        </form>
    </main>
</body>

</html>