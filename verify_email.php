<?php

session_start();

include("db.php");

if (isset($_GET["token"])) {
    $token = $_GET["token"];
    $sql = $pdo->prepare("SELECT * FROM user WHERE token=?");
    $sql->execute([$token]);
    $user = $sql->fetch();
    if ($user && $token == $user["token"]) {
        $sql_set_user_active = $pdo->prepare("UPDATE user SET active=1 WHERE token=?");
        $sql_set_user_active->execute([$token]);
        $user_activated = $sql->fetch();

        echo '<html>';
        echo '<head>';
        echo '<meta charset="UTF - 8">';
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">';
        echo '<link rel = "stylesheet" href = "style.css" >';
        echo '</head >';
        echo "<hr>";
        echo "<p style='color: white; display: inline'>Your account has been activated. Please </p><a href='login.php'>LOGIN</a>";
        echo "<hr>";
        echo "</html>";
    } else {
        echo "Invalid token!";
    }
}
