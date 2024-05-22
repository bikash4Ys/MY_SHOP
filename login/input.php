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
        <h2 class="text-center p-3">Sign In</h2>
        <form action="auth.php" method="post">
            <div>
                <label class="form-label" for="">Email</label>
                <input class="form-control" type="email" name="email" value="<?= @$regist['email'] ?>">
            <div>
                <label class="form-label" for="">Password</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="mt-3">
                <button class="btn btn-primary">Sign in</button>
                <a class="btn btn-outline-primary" href="../">戻る</a>
            </div>
        </form>
    </main>
</body>

</html>