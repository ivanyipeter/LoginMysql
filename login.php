<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
      <title>Login</title>
</head>
<body>
<?php include('authenticate.php'); ?>
<div class="jumbotron vertical-center">
    <div class="container">
        <div class="row">
            <div class="col-sm">
            </div>
            <div class="col-sm">
                <h2>LOGIN</h2>
                <div class="login-alert-fixed">
                    <p><?php echo $alert ?></p>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">USERNAME</label>
                        <input type="text" class="form-control" name="username" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="password">PASSWORD</label>
                        <input type="password" class="form-control" name="password" value="" required>
                    </div>
                    <input type="submit" class="btn btn-outline-light" name="login" value="LOG IN">
                    <a class="btn btn-outline-light" href="register.php" role="button">SIGN-UP</a>
                </form>
            </div>
            <div class="col-sm">
            </div>
        </div>
    </div>
</div>
</body>
</html>


