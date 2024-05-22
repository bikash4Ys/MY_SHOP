<?php
// セッションを開始
session_start();
// セッションIDを再発行
session_regenerate_id(true);

// セッションがあれば取得
if (!empty($_SESSION['my_shop']['regist'])) {
    $regist = $_SESSION['my_shop']['regist'];
}

// セッションからデータを取得
$regist = !empty($_SESSION['my_shop']['regist']) ? $_SESSION['my_shop']['regist'] : [];
$errors = !empty($_SESSION['my_shop']['errors']) ? $_SESSION['my_shop']['errors'] : [];

// Check if email already exists in the database
if (!empty($regist['email'])) {
    require_once '../db.php'; // Include your database connection file

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $regist['email']);
    $stmt->execute();
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        $errors['email'] = 'Email is already in use.';
        $_SESSION['my_shop']['errors'] = $errors;
        header('Location: input.php'); // Redirect back to input page with error message
        exit;
    }
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
    <main class="container">
        <h2 class="text-center p-3">Register</h2>
        <form action="confirm.php" method="post">
            <div>
                <label class="form-label" for="">Name</label>
                <input class="form-control" type="text" name="name" value="<?= @$regist['name'] ?>">
                <div class="text-danger mt-2 mb-2"><?= @$errors['name'] ?></div>
            </div>
            <div>
                <label class="form-label" for="">Email</label>
                <input class="form-control" type="text" name="email" value="<?= @$regist['email'] ?>">
                <div class="text-danger mt-2 mb-2"><?= @$errors['email'] ?></div>
            </div>
            <div>
                <label class="form-label" for="">Password</label>
                <input class="form-control" type="password" name="password">
                <div class="text-danger mt-2 mb-2"><?= @$errors['password'] ?></div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary">Next</button>
            </div>
        </form>
    </main>
</body>

</html>
