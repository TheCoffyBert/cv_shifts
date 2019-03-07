<?php

//Check if someone is trying to access to this page in the wrong way
if (isset($_POST['delete_shift-submit'])){

    //Manages the connection between the website and the DB. More info in the file itself
    require 'db_handler_inc.php';

    //Storing info from the "modify_shift" form
    $ID = $_POST['ID'];

    //Preparing the query
    $sql = "DELETE FROM shift WHERE shiftID=?";
    $statement = mysqli_stmt_init($conn);

    //Check if the connection is working. If so, it checks if the user is already in the DB
    if (!mysqli_stmt_prepare($statement, $sql)){
        header("Location: ../modify_shift.php?error=sqlError");
        exit();
    } else {
        mysqli_stmt_bind_param($statement, "i", $ID);
        mysqli_stmt_execute($statement);
        //Success! Returning to the main page...
        header("Location: ../index.php?delete_shift=success");
        exit();
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);

} else {
    header("Location: ../index.php");
    exit();
}
