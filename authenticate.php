<?php
session_start();

include('db.php');

global $alert;
$errors = 0;

if (isset($_POST["login"])) {

    $user_sql = $pdo->prepare("SELECT * FROM user WHERE username =:name");
    $user_sql->bindValue(":name", $_POST['username']);
    $user_sql->execute();
    $user_result = $user_sql->fetch();

    if ((isset($user_result["active"])) && (!$user_result["active"] == 1)) {
        $errors += 1;
        $alert = '<p style="color: red">Your account has not activated yet. Please click the link in the email we sent you.</p>';
    }

    if (!($user_result && password_verify($_POST["password"], $user_result["password"]))) {
        $errors += 1;
        $alert = '<p style="color: red">Invalid username or password</p>';
    }

    if ($errors == 0) {
        $user_role_sql = $pdo->prepare("SELECT role FROM role LEFT JOIN userrole ON id = roleid  WHERE userid =:id");
        $user_role_sql->bindValue(":id", $user_result[0]);
        $user_role_sql->execute();
        $user_role_result = $user_role_sql->fetchAll();

        $user_roles = array();
        foreach ($user_role_result as $item) {
            $user_roles[] = $item[0];
        }

        if (in_array("superadmin", $user_roles)) {
            $_SESSION["user_role"] = "superadmin";
            $_SESSION["username"] = $user_result["username"];
            Header("Location: dashboard.php");
            exit;
        } else
            if (in_array("admin", $user_roles)) {
                $_SESSION["user_role"] = "admin";
                $_SESSION["username"] = $user_result["username"];
                Header("Location: dashboard.php");
                exit;
            } else
                if (in_array("user", $user_roles)) {
                    $_SESSION["user_role"] = "user";
                    $_SESSION["username"] = $user_result["username"];
                    Header("Location: dashboard.php");
                    exit;
                }
    }
}









