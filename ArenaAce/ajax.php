<?php
require('./config.php');

if (isset($_POST['sid']) && isset($_POST['aid'])) {
    $arena_id = $_POST['aid'];
    $sport_id = $_POST['sid'];
    $sql = "SELECT courts.court_id, courts.name as court_name,courts.price,sport.name as sport_name,arena.name as arena_name from courts inner join assign_court on (courts.court_id = assign_court.court_id) inner join sport on (sport.s_id = assign_court.sport_id) inner join arena on (arena.a_id = assign_court.arena_id) where arena.a_id = $arena_id and sport.s_id = $sport_id";
    $result = mysqli_query($con, $sql);
    $response = [];

    // $response['num']=mysqli_num_rows($result);

    if ($result) {


        // Loop through the results to create options
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = '<option value="' . $row['court_id'] . '">' . $row['court_name'] . '(@Rs. ' . $row['price'] . ')</option>';
        }
    }

    echo json_encode($response);
}



if (isset($_POST['cid']) && isset($_POST['date'])) {
    $date = $_POST['date'];
    $cid = $_POST['cid'];
    // print_r($_POST);exit;
    // error_log($date,$cid);

    $response = [];
    $sql = "SELECT time_slots.time, courts.name, CASE WHEN isBooked = 1 THEN 1 ELSE 0 END as isBooked
    FROM time_slots
    INNER JOIN courts ON (time_slots.court_id = courts.court_id)
    WHERE time_slots.court_id = $cid and time_slots.date = '$date'";
    $TimeResult = mysqli_query($con, $sql);
    
    if ($TimeResult) {
        $i = 1;

        $msg = "";
        // error_log(print_r($TimeResult));

        while($res = mysqli_fetch_assoc($TimeResult)) {
            $i++;
            // error_log("Processing row: " . print_r($res, true));
            // $msg = "hello";
            $Time_Slot =  $res['time'];
            $isBooked = $res['isBooked'];
            $statusLabel = $isBooked ? "Booked" : date("h:i A", strtotime($Time_Slot));
            $statusClass = $isBooked ? "btn btn-danger" : "btn btn-outline-primary";
            $isDisabled = $isBooked ? "disabled" :'';

            $msg .= '<div class="form-check"><input type="radio" name="time" id="time' . $i . '" value="' . $Time_Slot . '" ' . $isDisabled . '>';
            $msg .= '<label for="time' . $i . '" class="btn btn-outline-primary ' . $statusClass . '">' . date("h:i A", strtotime($Time_Slot)) . '</label></div>';
        }

        if (!empty($msg)) {
            $response[] = $msg;
        } else {
            $response[] = "No time slots available for the selected date.";
        }

        // $response[] = $msg;
    }
    echo json_encode($response);
}
