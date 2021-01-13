<?php

session_start();
include('db.php');
include('send_email.php');

global $username_exists, $email_exists, $email_invalid, $password_invalid, $password_verify_error, $verification_message;
global $username, $email;
$errors = 0;
$verification_message = "";
$show_errors = array();

if (isset($_POST["register"])) {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $verify_password = $_POST["verify-password"];
    $token = bin2hex(random_bytes(50));

    $verify_user_sql = $pdo->prepare("SELECT * FROM user WHERE email =:email or username =:username");
    $verify_user_sql->bindValue(":username", $username);
    $verify_user_sql->bindValue(":email", $email);
    $verify_user_sql->execute();
    $result = $verify_user_sql->fetchAll();

    if ($result) {
        foreach ($result as $item) {
            if ($item["username"] == $username) {
                $username_exists = '<p style="color: red">Username already exists</p>';
                $errors += 1;
            }
            if ($item["email"] == $email) {
                $email_exists = "<p style=\"color: red\">Email address already exists</p>";
                $errors += 1;
            }
        }
    }

    if (strcmp($password, $verify_password)) {
        $password_verify_error = "<p style=\"color: red\">Passwords do not match</p>";
        $errors += 1;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_invalid = "<p style=\"color: red\">Invalid email address</p>";
        $errors += 1;
    }

    if ($errors == 0) {
        $save_user_sql = $pdo->prepare("INSERT INTO user (username, password, email,token, active) VALUES (?,?,?,?,?)");
        $save_user_sql->execute([$username, password_hash($password, PASSWORD_DEFAULT), $email, $token, '0']);
        $get_user_id_sql = $pdo->prepare("SELECT id FROM user WHERE username =:username");
        $get_user_id_sql->bindValue(":username", $username);
        $get_user_id_sql->execute();
        $result = $get_user_id_sql->fetch();

        if (send_verification_email($email, $token)) {
            $verification_message = '<div class="alert alert-light">Verification email has been sent.</div>';
        } else {
            $verification_message = '<div class="alert alert-light">Verification email has been not sent.</div>';
        }

//      Setting user role to USER(1 = admin, 2 = user, 3 = superadmin)
        $save_user_role_sql = $pdo->prepare("INSERT INTO userrole (userid, roleid) VALUES (? ,?)");
        $save_user_role_sql->execute([$result["id"], 2]);

        $username = "";
        $email = "";
    }
}

