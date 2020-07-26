<?php
if (isset($_POST['button_signup'])){
    require_once '../db_connect.inc.php';

    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_check = $_POST['password_check'];

    if (empty($user_name) || empty($email) ||empty($password) ||empty($password_check)){
        header("Location: ../templates/signup.php?error=nullFields&username=".$user_name."&email=".$email);
        exit('Error');
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match("/^[a-zA-Z0-9]*$/", $user_name)){
        header("Location: ../templates/signup.php?error=invalid&username=".$user_name."&email=".$email);
        exit('Error');
    }
    else if ($password !== $password_check) {
        header("Location: ../templates/signup.php?error=passwordNotCheck?username=".$user_name."&email=".$email);
        exit('Error');
    }else{
        $sql = "Select username from user_login where username = ?";
        $stmt = mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../templates/signup.php?error=sqlerror1');
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, 's', $user_name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_num_rows($stmt);
            if ($result > 0){
                header('Location: ../templates/signup.php?error=UsernameExists&email='.$email);
                exit();
            }else{
                $sql = "insert into user_login(username, email, password_user) values(?, ?, ?)";
                $stmt = mysqli_stmt_init($connect);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header('Location: ../templates/signup.php?error=sqlerror2');
                    exit();
                }else{
                    $hash_pass = password_hash($password, PASSWORD_BCRYPT);
                    mysqli_stmt_bind_param($stmt, 'sss' , $user_name, $email, $hash_pass);
                    mysqli_stmt_execute($stmt);
                    header('Location: ../templates/signup.php?signup=success');
                    exit();
                }
            }
        }
    }
}
