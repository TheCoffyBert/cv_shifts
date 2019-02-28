<?php
//TODO: Check for POST method value
if(isset($_POST['login-submit'])){
    //TODO: Check for DBH name
    require 'db_handler.php';

    //TODO: Check for POST method values
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    if(empty($email) || empty($pwd)){
        header("Location: ../login.php?error=emptyFields&email".$email);
        exit();
    } else {
        //TODO: Add comments. This is basically a part of code in which you ckeck for the connection, similar to the one in the signup form
        $sql = "SELECT * FROM users WHERE userEmail=?";
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../login.php?error=sqlError");
            exit();
        } else {
            //TODO: Better comments. Binding parameters to the SQL Query
            mysqli_stmt_bind_param($statement, "s", $email);
            mysqli_stmt_execute($statement);
            //      Storing the result
            $result = mysqli_stmt_get_result($statement);
            //      Check if there are any results
            if($row = mysqli_fetch_assoc($result)){
            //      There's a user so the real login begins
                $pwdCheck = password_verify($password, $row['userPwd']);

                if($pwdCheck == false){
                    header("Location: ../login.php?error=wrongPassword");
                    exit();
                } else if($pwdCheck == true){
                    session_start();
                    $_SESSION['UID'] = $row['userID'];
                    $_SESSION['UEM'] = $row['userEmail'];
                    //Note: Maybe I should add a session variable to store the real name of the user...

                    header("Location: ../main.php?login=success");
                    exit();
                } else {
                    header("Location: ../login.php?error=WhatTheActualFuck");
                    exit();
                }
                
            } else {
                header("Location: ../login.php?error=noUser");
                exit();
            }
        }
    }

} else {
    header("Location: ../login.php");
    exit();
}
