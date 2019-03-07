<?php

//Check if someone is trying to access to this page in the wrong way
if (isset($_POST['modify_shift-submit'])){

    //Manages the connection between the website and the DB. More info in the file itself
    require 'db_handler_inc.php';

    //Storing info from the "new shift" form
    $ID = $_POST['ID'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    //I need to store the difference between the two timestamps in seconds in order to calculate how much time I spend there
    $time = strtotime($end) - strtotime($start);
    //From here, every variable equal to 0 will be stored as NULL, only because it'll make the table look better (and I don't need any of those data anyway...)
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
    if ($services == ''){
        $services = NULL;
    }

    /*
     * FORM VALIDATION:
     * In this part of the code I validate every field and, if the program finds some error, send the
     * user back to the index page* with a proper warning. I'm planning to check if:
     *  - The user didn't fill the start and end fields
     *  - The user didn't write a service description;
     *  TODO: The user changed the ID in the modify form
    */

    if (empty($start) || empty($end)){
        //TODO: Send back the end time too
        header("Location: ../add_shift.php?error=emptyFields&start".$start);
        exit();
        //TODO: Send back all the non-empty fields
    } elseif($services != NULL && empty($service_description)){
        header("Location: ../add_shift.php?error=missingDescription");
        exit();
    } else {
        $sql = "UPDATE shifts SET shiftStart=?, shiftEnd=?, shiftTotalTime=?, shiftEmergencies=?, shiftTransports=?, shiftServices=?, shiftServiceDescription=?) WHERE shiftID=?";
        $statement = mysqli_stmt_init($conn);

        //Check if the connection is working. If so, it checks if the user is already in the DB
        if (!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../add_shift.php?error=sqlError");
            exit();
        } else {
            mysqli_stmt_bind_param($statement, "ssiiiisi", $start, $end, $time, $emergencies, $transports, $services, $service_description, $ID);
            mysqli_stmt_execute($statement);
            //Success! Returning to the main page...
            header("Location: ../index.php?add_shift=success");
            exit();
        }
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);

} else {
    header("Location: ../index.php");
    exit();
}
