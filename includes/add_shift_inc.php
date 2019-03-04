<?php

//Check if someone is trying to access to this page in the wrong way
if (isset($_POST['add_shift-submit'])){

    //Manages the connection between the website and the DB. More info in the file itself
    require 'db_handler_inc.php';

    //Storing info from the "new shift" form
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
    //TODO: Actually use this variable. At this moment it's useless
    $service_description = $_POST['service_description'];

    /*
     * FORM VALIDATION:
     * In this part of the code I validate every field and, if the program finds some error, send the
     * user back to the index page* with a proper warning. I'm planning to check if:
     *  - The user didn't fill the start and end fields (done);
     *  - The user didn't write a service description;
     *
     *   *I'm wondering if it's better to send the user back to the "new shift" page. I'll test it in the next couple of days
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
        $sql = "INSERT INTO shifts (shiftStart, shiftEnd, shiftTotalTime, shiftEmergencies, shiftTransports, shiftServices, shiftServiceDescription) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = mysqli_stmt_init($conn);

        //Check if the connection is working. If so, it checks if the user is already in the DB
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

    mysqli_stmt_close($statement);
    mysqli_close($conn);

} else {
    header("Location: ../index.php");
    exit();
}
