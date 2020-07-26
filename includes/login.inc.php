<?php
    if (isset($_POST['username'])){
        require_once '../db_connect.inc.php';
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($_POST['username']) || empty( $_POST['password'])){
            header('Location: ../templates/index.php?error=nullFields&username='.$username);
            exit();
        }else{
            $sql  = 'select * from user_login where username=? or email=?';
            $stmt =  mysqli_stmt_init($connect);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                header('Location: ../templates/index.php?error=sqlError');
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, 'ss', $username, $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row=mysqli_fetch_assoc($result)){
                    $password_check = password_verify($password, $row['password_user']);
                    if ($password_check == true){
                        session_start();
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['user_id'] = $row['id'];
                        header('Location: ../templates/index.php?login=success');
                        exit();
                    }else{
                        header('Location: ../templates/index.php?error=wrongPassword');
                        exit();
                    }
                }
            }
        }
    }else{
        header('Location: ../templates/index.php');
    }

