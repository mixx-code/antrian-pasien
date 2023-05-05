<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <h1 class="title-login">Login</h1>
        <form class="form-login" action="proses_login.php" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password">
            </div>
            <div class="btn-login">
                <button type="submit">Login</button>
                <a href="../registrasi/">registrasi</a>
            </div>
        </form>
    </div>
</body>

</html>