<?php

//Check if someone is trying to access to this page in the wrong way
if (isset($_POST['signup_submit'])){

    //Manages the connection between the website and the DB. More info in the file itself
    require 'db_handler_inc.php';

    //Storing info from the signup form
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwd_repeated = $_POST['pwd_repeated'];

    /*
     * FORM VALIDATION:
     * In this part of the code I validate every field and, if the program finds some error, send the
     * user back to the login page with a proper warning. The cases I have analyzed so far are:
     *  - User didn't fill all the required fields
     *  - User didn't write a correct email
     *  - User didn't write two identical passwords
     *  - User is already registered (if not, it automatically registers it)
    */

    if (empty($email) || empty($pwd) || empty($pwd_repeated)){
        header("Location: ../signup.php?error=emptyFields&email".$email);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidEmail&email=".$email);
        exit();
    } elseif ($pwd !== $pwd_repeated){
        header("Location: ../signup.php?error=unmatchingPasswords&email=".$email);
        exit();
    } else {
        $sql = "SELECT userEmail FROM users WHERE userEmail=?";
        $statement = mysqli_stmt_init($conn);

        //Check if the connection is working. If so, it checks if the user is already in the DB
        if (!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../signup.php?error=sqlError");
            exit();
        } else {
            mysqli_stmt_bind_param($statement, "s", $email);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement); /*NOTE TO MYSELF: it stores the result into the statement variable*/
            $resultCheck = mysqli_stmt_num_rows($statement);

            if ($resultCheck > 0){
                header("Location: ../signup.php?error=userAlreadyRegistered");
                exit();
            } else {
                $sql = "INSERT INTO users (userEmail, userPwd) VALUES (?, ?)";
                $statement = mysqli_stmt_init($conn);

                //Check if the connection is working. If so, it checks if the user is already in the DB
                if (!mysqli_stmt_prepare($statement, $sql)){
                    header("Location: ../signup.php?error=sqlError");
                    exit();
                } else {

                    //Hashing the password for obvious security reasons
                    $hashedPWD = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($statement, "ss", $email, $hashedPWD);
                    mysqli_stmt_execute($statement);
                    //Success! Returning to the signup page...
                    header("Location: ../signup.php?signup=success");
                    exit();
                }

            }
        }
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);


} else {
    header("Location: ../signup.php");
    exit();
}
