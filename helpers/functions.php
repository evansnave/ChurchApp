<?php

function listOfDepartments($db)
{
    $query = "SELECT * FROM activity_groups WHERE group_status = 'active' ORDER BY name ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
    }
    return $output;
}

function nameOfDepartment($db , $department_id)
{
    $query = "SELECT * FROM activity_groups WHERE group_status = 'active' AND id = $department_id ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $output =  $result["name"];
    return $output;

}
function ministries($db)
{
    $query = "SELECT * FROM ministries WHERE ministry_status = 'active' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $data) {
        $output .= '<option value="' . $data["id"] . '">' . $data["name_of_ministry"] . '</option>';
    }
    return $output;
}

function countMembersInMinistries($db,$ministries_id)
{
    $query = "SELECT * FROM members WHERE member_status = 'active' AND ministries = $ministries_id";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}
function countMembersInDepartment($db,$department_id)
{
    $query = "SELECT * FROM members WHERE member_status = 'active' AND department = $department_id";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}
function sendSms($phone,$msg)
{
    // $send = new send();
    // $send->key = 'Big9n43UFNsIstBeFuENYVC2h';
    // $send->message = $msg;
    // $send->numbers = $phone;
    // $send->sender = 'CE Wa';
    // $response = $send->sendMessage();
}

function countFirstTimersAddedOnADay($db, $date)
{
    $actual_date = date('Y-m-d', $date);
    $query = "SELECT * FROM first_timers WHERE firstTimer_status = 'active' AND date_added = '$actual_date' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countMembers($db)
{
    $query = "SELECT * FROM members WHERE member_status ='active'";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countFirstTimers($db)
{
    $query = "SELECT * FROM first_timers WHERE firstTimer_status ='active'";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countFirstTimersAddedThisWeek($db)
{
    $thisWeek = date("W") - 1;
    $query = "SELECT * FROM first_timers WHERE firstTimer_status='active' AND week(date_added) = $thisWeek";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countFirstTimersAddedToday($db)
{
    $today = date('Y-m-d');
    $query = "SELECT * FROM first_timers WHERE firstTimer_status='active' AND date_added = '$today' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countFirstTimersFromCellMeetings($db)
{
    $query = "SELECT * FROM cell_first_timers WHERE firstTimer_status ='active'";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countInviteesForAProgram($db , $program_name)
{
    $table_name = 'program_'.$program_name;
    $query = "SELECT * FROM `$table_name` WHERE `invitee_status` = 'active'";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countCellFirstTimersAddedOnADay($db, $date)
{
    $actual_date = date('Y-m-d', $date);
    $query = "SELECT * FROM cell_first_timers WHERE firstTimer_status = 'active' AND date_added = '$actual_date' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countMemberInACell($db, $cell_id)
{
    $query = "SELECT * FROM members WHERE member_status = 'active' AND cell = $cell_id";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countAssignedFirstTimers($db, $cell_id)
{
    $query = "SELECT * FROM first_timers WHERE firstTimer_status = 'active' AND senior_cell = $cell_id";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countCellFirstTimers($db, $cell_id)
{
    $query = "SELECT * FROM cell_first_timers WHERE firstTimer_status = 'active' AND cell = $cell_id";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countMembersPresent($db, $column_name)
{
    $query = "SELECT * FROM members_attendance WHERE `$column_name` != 0 ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countLeadersPresent($db, $column_name)
{
    $query = "SELECT * FROM leaders_attendance WHERE `$column_name` != 0 ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countMembersAbsent($db, $column_name)
{
    $query = "SELECT * FROM members_attendance WHERE `$column_name` = 0";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countLeadersAbsent($db, $column_name)
{
    $query = "SELECT * FROM leaders_attendance WHERE `$column_name` = 0";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countFirstTimersPresent($db, $column_name)
{
    $query = "SELECT * FROM first_timers_attendance WHERE `$column_name` != 0";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function listOfMembers($db)
{
    $query = "SELECT * FROM members WHERE member_status = 'active' ORDER BY fullname ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["id"] . '">' . $row["fullname"] . '</option>';
    }
    return $output;
}

function listOfCells($db)
{
    $query = "SELECT * FROM cells WHERE cell_status = 'active' ORDER BY name_of_cell ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["id"] . '">' . $row["name_of_cell"] . '</option>';
    }
    return $output;
}

function listOfTeachers($db)
{
    $query = "SELECT * FROM foundation_school_teachers WHERE teacher_status = 'active' ORDER BY fullname ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["fullname"] . '">' . $row["fullname"] . '</option>';
    }
    return $output;
}

function seletedCells($db,$cell_id)
{
    $query = "SELECT * FROM cells WHERE cell_status = 'active' AND id = $cell_id ORDER BY name_of_cell ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["id"] . '" selected>' . $row["name_of_cell"] . '</option>';
    }
    return $output;
}

function listOfActivityGroups($db)
{
    $query = "SELECT * FROM activity_groups WHERE group_status = 'active' ORDER BY name ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
    }
    return $output;
}

function simpleDate($date)
{
    return date('l, M j, Y', $date);
}

function simpletime($db, $time)
{
    return date('H:i A', $time);
}

function cellLeader($db, $id)
{
    $query = "SELECT * FROM members WHERE member_status = 'active' AND id = $id ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $output =  $result["title"] .' ' .$result["fullname"] ;
    return $output;
}

function nameOfProgram($db, $program_date)
{
    $query = "SELECT * FROM programs WHERE program_status = 'active' AND date_of_program = '$program_date' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $output = strtoupper($result["name_of_program"]) ;
    return $output;
}

function nameOfFistTImer($db, $id)
{
    $query = "SELECT * FROM first_timers WHERE firstTimer_status = 'active' AND id = $id ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $output =  $result["fullname"] ;
    return $output;
}

function numberOfFistTImer($db, $id)
{
    $query = "SELECT * FROM first_timers WHERE firstTimer_status = 'active' AND id = $id ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $output =  $result["phone_number"];
    return $output;
}

function nameOfCell($db, $cell_id)
{
    $query = "SELECT * FROM cells WHERE cell_status = 'active' AND id = $cell_id ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $output =  $result["name_of_cell"];
    return $output;
}

function nameOfActivityGroup($db, $group_id)
{
    $query = "SELECT * FROM activity_groups WHERE id = $group_id ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $output =  $result["name"];
    return strtoupper($output);
}

function counter($db, $token, $table, $percentage)
{
    $query = "SELECT * FROM $table WHERE first_timer = $token AND status = 'active'" ;
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $result = ($count / $percentage) * 100;
    return $result;
}

function countFoundationSchool($db)
{
    $query = "SELECT * FROM members WHERE foundation_school = 'completed' AND member_status = 'active'";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function countBaptism($db)
{
    $query = "SELECT * FROM members WHERE baptism = 'baptised' AND member_status = 'active'";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function checkAttendanceState($db)
{
    $today = date('Y-m-d');
    $date =strtotime($today);
    $query = "SELECT * FROM attendance WHERE service_date = $date AND session = 'ongoing' AND status = 'active' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $output = '';
    if ($count == 0) {
        $output .= '<a href="#" class=" btn btn-dark" id="start"  href="javascript:void(0)">Start Registration</a>';
    }else {
        $output .= '<a href="registration.php?date='.$date.'" class=" btn btn-success">View Registration</a>';
    }    
     return $output;
}

function checkLAttendanceState($db)
{
    $today = date('Y-m-d');
    $date =strtotime($today);
    $query = "SELECT * FROM attendance_leaders WHERE service_date = $date AND session = 'ongoing' AND status = 'active' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $output = '';
    if ($count == 0) {
        $output .= '<a href="#" class=" btn btn-dark" id="start"  href="javascript:void(0)">Start Registration</a>';
    }else {
        $output .= '<a href="leaders_registration.php?date='.$date.'" class=" btn btn-success">View Registration</a>';
    }    
     return $output;
}

function checkLAttendance($db)
{
    $today = date('Y-m-d');
    $date = strtotime($today);
    $query = "SELECT * FROM attendance_leaders WHERE service_date = $date AND session = 'ongoing' AND status = 'active' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}
function checkAttendance($db)
{
    $today = date('Y-m-d');
    $date = strtotime($today);
    $query = "SELECT * FROM attendance WHERE service_date = $date AND session = 'ongoing' AND status = 'active' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
}

function serviesAttended($db, $id)
{
    $query = "SELECT * FROM service_logger WHERE first_timer_id = $id  AND logger_stats = 'active' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $row = $statement->fetch();
    return $row['service_count'];
}

function foundationSchool($db)
{
    $query = "SELECT * FROM `members` WHERE member_status = 'active' ORDER BY foundation_school desc ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
    $output = '';
    if ($count == 0 && empty($rows)) {
        $output .= "<h3 class=\"text-center text-muted\">No data available</h3>";
    } else {
        $output .= '
		<table id="myTable" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">S/N</th>
					<th>Name</th>
					<th>Phone Number</th>
					<th>Foundation School</th>
				</tr>
			</thead>
			<tbody>
		';

        foreach ($rows as $result) {
            $output .= '
				<tr>
					<td class="text-center">' . $i . '</td>
					<td>' . strtoupper($result['fullname']) . '</td>
					<td>' . $result['phone_number'] . '</td>
					<td>' . strtoupper($result['foundation_school']) . '</td>
				</tr>
			';
            $i++;
        }
        $output .= '
				</tbody>
			</table>
		';
    }

    return $output;
}

function baptism($db)
{
    $query = "SELECT * FROM `members` WHERE member_status = 'active' ORDER BY baptism desc ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
    $output = '';
    if ($count == 0 && empty($rows)) {
        $output .= "<h3 class=\"text-center text-muted\">No data available</h3>";
    } else {
        $output .= '
		<table id="myTable" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">S/N</th>
					<th>Name</th>
					<th>Phone Number</th>
					<th>Baptism</th>
				</tr>
			</thead>
			<tbody>
		';

        foreach ($rows as $result) {
            $output .= '
				<tr>
					<td class="text-center">' . $i . '</td>
					<td>' . strtoupper($result['fullname']) . '</td>
					<td>' . $result['phone_number'] . '</td>
					<td>' . strtoupper($result['baptism']) . '</td>
				</tr>
			';
            $i++;
        }
        $output .= '
				</tbody>
			</table>
		';
    }

    return $output;
}
function upcomingBirthdays($db)
{
    $month = date('m');
    $day = date('d');
    $query = "SELECT * FROM `members` WHERE member_status = 'active' AND month(dob) = $month AND day(dob) > $day ORDER BY day(dob)";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
    $output = '';
    if ($count == 0 && empty($rows)) {
        $output .= "<label class=\"label theme-bg text-white f-14 f-w-400 float-right\">$count</label>";
    } else {

        $output .= '
        <div class="col-auto">
                <label class="label theme-bg text-white f-14 f-w-400 float-right">'.$count.'</label>
            </div>
        </div><br>
        <div class="table-responsive">
		<table class="table table-hover">
			<tbody>
		';

        foreach ($rows as $result) {
            $output .= '
            <tr class="unread">
                <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user"></td>
                <td>
                    <h6 class="mb-1">' . strtoupper($result['fullname']) . '</h6>
                    <p class="m-0">Phone : ' . $result['phone_number'] . '</p>
                </td>
                <td>
                    <h6 class="text-muted">' . simpleDate(strtotime($result['dob'])) . '</h6>
                </td>
            </tr>
			';
            $i++;
        }
        $output .= '
				</tbody>
			</table>
		';
    }

    return $output;
}

function recentMembers($db)
{
    $query = "SELECT * FROM `members` WHERE member_status = 'active' ORDER BY date_added desc LIMIT 5 ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
    $output = '';
    if ($count == 0 && empty($rows)) {
        $output .= "<h4 class=\"text-center\">No data available</h4>";
    } else {
        $output .= '
		<table class="table table-hover">
			<tbody>
		';

        foreach ($rows as $result) {
            $output .= '
            <tr class="unread">
                <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user"></td>
                <td>
                    <h6 class="mb-1">' . strtoupper($result['fullname']) . '</h6>
                    <p class="m-0">Phone : ' . $result['phone_number'] . '</p>
                </td>
                <td>
                    <h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>' . simpleDate(strtotime($result['date_added'])) . '</h6>
                </td>
                <td><a href="members.php" class="label theme-bg2 text-white f-12">View</a><td>
            </tr>
			';
            $i++;
        }
        $output .= '
				</tbody>
			</table>
		';
    }

    return $output;
}

function recentFirstTimers ($db)
{
    $query = "SELECT * FROM `first_timers` WHERE firstTimer_status = 'active' ORDER BY date_added desc LIMIT 5 ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
    $output = '';
    if ($count == 0 && empty($rows)) {
        $output .= "<h4 class=\"text-center\">No data available</h4>";
    } else {
        $output .= '
		<table class="table table-hover">
			<tbody>
		';

        foreach ($rows as $result) {
            $output .= '
            <tr class="read">
                <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user"></td>
                <td>
                    <h6 class="mb-1">' . strtoupper($result['fullname']) . '</h6>
                    <p class="m-0">Phone : ' . $result['phone_number'] . '</p>
                </td>
                <td>
                    <h6 class="text-muted"><i class="fas fa-circle text-c-red f-10 m-r-15"></i>' . simpleDate(strtotime($result['date_added'])) . '</h6>
                </td>
                <td><a href="report.php?token='.$result['id'].'" class="label theme-bg text-white f-12">View</a><td>
            </tr>
			';
            $i++;
        }
        $output .= '
				</tbody>
			</table>
		';
    }

    return $output;
}

function firstTimerMigration($db)
{
    $query = "SELECT * FROM `service_logger` WHERE service_count >= 3 AND logger_stats = 'active' ORDER BY service_count desc LIMIT 5 ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
    $output = '';
    if ($count == 0 && empty($rows)) {
        $output .= "<h4 class=\"text-center text-muted\">First timers ready for migration will be displayed here </h4>";
    } else {
        $output .= '
		<table class="table table-hover">
			<tbody>
		';
        foreach ($rows as $result) {
            $first_timer_id = $result['first_timer_id'];
            $query = "SELECT * FROM first_timers WHERE id = $first_timer_id ";
            $statement = $db->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();
            $first_timers = $statement->fetch();
            $output .= '
            <tr class="unread">`
                <td></td>
                <td></td>
                <td>
                    <h6 class="mb-1">' . strtoupper($first_timers['fullname']) . '</h6>
                    <p class="m-0">Phone : ' . $first_timers['phone_number'] . '</p>
                </td>
                <td>
                    <h6 class="text-muted "><i class="fas fa-circle text-c-green f-10 m-r-15"></i>' . simpleDate(lastServiceAttended($db, $first_timer_id)) . '</h6>
                    <small class="">Last Service Attended</small>                    
                </td>
                <td>
                    <a href="#" name="update" id= '.$first_timer_id .'" class="label theme-bg2 text-white f-12 update">Migrate</a>
                    <a href="report.php?token='.$first_timer_id.'" class="label theme-bg text-white f-12">View</a>
                <td>
            </tr>
			';
            $i++;
        }
        $output .= '
				</tbody>
			</table>
		';
    }

    return $output;
}

function lastServiceAttended($db, $token)
{
    $query = "SELECT * FROM service_attendance WHERE first_timer = $token AND status = 'active' ORDER BY service_day desc LIMIT 1 ";
    $statement = $db->prepare($query);
    $statement->execute();
    $rows = $statement->fetch();
    $service_date = $rows['service_day'];
    return strtotime($service_date);
}