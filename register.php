<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
<?php include('reg.php'); ?>
<div class="jumbotron vertical-center">
    <div class="container">
        <div class="row">
            <div class="col-sm">
            </div>
            <div class="col-sm">
                <h2>CREATE ACCOUNT</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">USERNAME</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="<?php echo $username; ?>"
                               required>
                        <?php echo $username_exists; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">EMAIL</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" required>
                        <?php echo $email_exists; ?>
                        <?php echo $email_invalid; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">PASSWORD</label>
                        <input type="password" class="form-control" name="password" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="verify-password">VERIFY PASSWORD</label>
                        <input type="password" class="form-control" name="verify-password" value="" required>
                        <?php echo $password_verify_error; ?>
                    </div>
                    <input type="submit" class="btn btn-outline-light" name="register" value="REGISTER">
                </form>
                <div class="register-alert-fixed">
                    <p><?php echo $verification_message; ?></p>
                </div>
            </div>

            <div class="col-sm">
            </div>
        </div>
    </div>

</div>
</body>
</html>


