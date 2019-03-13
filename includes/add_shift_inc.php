<?php

//Check if someone is trying to access to this page in the wrong way
if (isset($_POST['add_shift-submit'])){

    //Manages the connection between the website and the DB. More info in the file itself
    require 'db_handler_inc.php';

    //Storing info from the "add_shift" form
    $start = $_POST['start'];
    $end = $_POST['end'];
    //  I need to store the difference between the two timestamps in seconds in order to calculate how much time I spend there
    $time = strtotime($end) - strtotime($start);
    //  The add_shift form stores unwritten values as 0, so this part sets them to NULL
    $emergencies = $_POST['emergencies'];
    if ($emergencies == 0){
        $emergencies = NULL;
    }
    $transports = $_POST['transports'];
    if ($transports == 0){
        $transports = NULL;
    }
    $services = $_POST['services'];
    if ($services == 0){
        $services = NULL;
    }
    $service_description = $_POST['service_description'];
    if ($service_description == ''){
        $service_description = NULL;
    }

    /* FORM VALIDATION:
     * In this part of the code I validate every field and, if the program finds some error, send the user back to the
     * add_shift page with a proper warning, otherwhise it sends the user back to the main page. So far, the program
     * checks for:
     *  - Empty start or end fields;
     *  - Empty service description if there's at least a service;
     * - There's already a service that matches both start and end time
    */

    if (empty($start) || empty($end)){
        header("Location: ../add_shift.php?error=emptyFields&start=".$start."&end=".$end);
        exit();
    } elseif($services != NULL && empty($service_description)){
        //I decided to send back only the service variable because it doesn't make sense to fill all the other fields when there's a service
        header("Location: ../add_shift.php?error=missingDescription&start=".$start."&end=".$end."&services=".$services);
        exit();
    } else {

        $sql = "SELECT * FROM shifts WHERE shiftStart=? AND shiftEnd=?";
        $statement = mysqli_stmt_init($conn);

        //Check if the connection is working. If so, it checks if the user is already in the DB
        if (!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../add_shift.php?error=sqlError");
            exit();
        } else {

            mysqli_stmt_bind_param($statement, "ss", $start, $end);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement); /*NOTE TO MYSELF: it stores the result into the statement variable*/
            $resultCheck = mysqli_stmt_num_rows($statement);

            if ($resultCheck > 0) {
                header("Location: ../add_shift.php?error=shiftAlreadyExists");
                exit();
            } else {

                $sql = "INSERT INTO shifts (shiftStart, shiftEnd, shiftTotalTime, shiftEmergencies, shiftTransports, shiftServices, shiftServiceDescription) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $statement = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($statement, $sql)){
                    header("Location: ../add_shift.php?error=sqlError");
                    exit();
                } else {

                    mysqli_stmt_bind_param($statement, "ssiiiis", $start, $end, $time, $emergencies, $transports, $services, $service_description);
                    mysqli_stmt_execute($statement);
                    //Success! Returning to the signup page...
                    header("Location: ../index.php?add_shift=success");
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);

} else {
    header("Location: ../index.php");
    exit();
}
