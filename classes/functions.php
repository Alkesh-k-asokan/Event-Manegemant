<?php

// Error Printing Snippet
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "db.php";
$db =  $sql = NULL;

//creating employee
if (isset($_POST["submit"]) == "submit-employee-create" && $_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $email = $flag = $row =  $phone = $sec_phone = $designation = $blood_group = $address = $company = NULL;
  $db = new DB();
  $flag = true;
  // getting variable values
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $sec_phone = $_POST['sec_phone'];
  $designation = $_POST['designation'];
  $blood_group = $_POST['blood_group'];
  $address = $_POST['address'];
  $company = $_POST['company'];

  // checking for duplicate email and phone number
  $select_query_1 = " SELECT  `employee_id`, `employee_email_id`, `employee_phone` FROM `event_management`.`employee`; ";
  $result = $db->executeQuery($select_query_1);
  while ($row = mysqli_fetch_array($result)) {
    if ($row['employee_email_id'] == $email) {
      $flag = "email";
      header("location: ../employee_create.php?status=448");
    }
    if ($row['employee_phone'] == $phone) {
      $flag = "phone";
      header("location: ../employee_create.php?status=449");
    }
  }

  if ($flag == true) {
    // executing the insert query
    $sql = "INSERT INTO `event_management`.`employee` (`employee_name`, `employee_email_id`, `employee_address`, `employee_phone`,  `employee_sec_phone`,`employee_designation`, `employee_blood_group`, `employee_company_id`) VALUES ('$name', '$email', '$address', '$phone', '$sec_phone','$designation', '$blood_group', '1');";
    $stmt = $db->executeQuery($sql);
    if ($stmt == 1)
      header("location: ../employee_create.php?status=200");
    else {
      header("location: ../employee_create.php?status=417");
    }
  }
}

//creating event
if (isset($_POST["submit-event-create"]) == "submit-event-create" && $_SERVER["REQUEST_METHOD"] == "POST") {
  $event_name = $event_type = $event_date = $event_description = $event_points = $select_query = $result = $row = NULL;
  $db = new DB();

  $event_name = $_POST['event-name'];
  $event_type = $_POST['event-type'];
  $event_date = $_POST['event-date'];
  $event_description = $_POST['event-description'];
  $event_points = $_POST['event-points'];

  $select_query = "SELECT `event_type_id`,`event_name` FROM `event_management`.`event`";
  echo $select_query;
  $result = $db->executeQuery($select_query);
  while ($row = mysqli_fetch_array($result)) {
    if ($row['event_name'] === $event_name && $row['event_type_id'] == $event_type) {
      header("location: ../event_create.php?status=450");
    }
  }
  $sql = "INSERT INTO `event_management`.`event` (`event_type_id`, `event_name`, `event_description`, `event_points`, `event_date`) VALUES ('$event_type', '$event_name', '$event_description', '$event_points', '$event_date')";
  $stmt = $db->executeQuery($sql);
  if ($stmt == 1)
    header("location: ../event_create.php?status=200");
  else {
    header("location: ../event_create.php?status=417");
  }
}

//creating a team and adding members to it
if (isset($_POST["submit-team-create"]) == "submit-team-create" && $_SERVER["REQUEST_METHOD"] == "POST") {
  $db = new DB();
  $team_name = $team_description = $sql = NULL;
  
  
  $team_name = $_POST['team-name'];
  $team_description = $_POST['team-description'];
  if(isset($_POST['team-members'])){
    $team_members = $_POST['team-members'];
  }

  //checking for duplicate teams
  $select_query = "SELECT  `team_name` FROM `event_management`.`team` WHERE `team_name` LIKE '$team_name'";
  $result = $db->executeQuery($select_query);
  if (mysqli_num_rows($result)!=0) { 
    header("location: ../team_create.php?status=448");
  }
  else{

  //inserting into the table
  $sql = "INSERT INTO `event_management`.`team` (`team_name`, `team_description`) VALUES ('$team_name', '$team_description')";
  $stmt = $db->executeQuery($sql);
  if ($stmt == 1) {
    
    //getting the team id
    $select_query2 = "SELECT `team_id` FROM `event_management`.`team` WHERE `team_name` = '$team_name'";
    $result2 = $db->executeQuery($select_query2);
    $row = mysqli_fetch_array($result2);
    $team_id = $row['team_id'];

    if (mysqli_num_rows($result2)!=0){
      foreach ($team_members as $member) {
        $sql2 = "INSERT INTO `event_management`.`team_members` (`team_id`, `employee_id`) VALUES ('$team_id', '$member')";
        $stmt1 = $db->executeQuery($sql2);
        if ($stmt1 != 1)
          header("location: ../team_create.php?status=450");
      }
    }

    }else{
    header("location: ../team_create.php?status=417");
    }
  }
 }

//employee edit
if (isset($_POST["submit"]) == "submit-employee-edit-conform" && $_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $email = $flag = $row =  $phone = $sec_phone = $designation = $blood_group = $address = $company = NULL;
  $db = new DB();
  $flag = true;
  // getting variable values
  $employee_id = $_POST['employee_id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $sec_phone = $_POST['sec_phone'];
  $designation = $_POST['designation'];
  $blood_group = $_POST['blood_group'];
  $address = $_POST['address'];
  $company = $_POST['company'];

  // checking for duplicate email and phone number
  $select_query_1 = " SELECT  `employee_id`, `employee_email_id` FROM `event_management`.`employee` WHERE `employee_email_id` = '$email'; ";
  $result = $db->executeQuery($select_query_1);

  $select_query_2 = " SELECT  `employee_id`,`employee_phone` FROM `event_management`.`employee` WHERE `employee_phone` = '$phone'; ";
  $result_2 = $db->executeQuery($select_query_2);
  

  if (mysqli_num_rows($result)>1) {
    header("location: ../employee_listing.php?status=448");
  }
  if (mysqli_num_rows($result_2)>1) {
    header("location: ../employee_listing.php?status=449");
  }


  if ($flag == true) {
    // executing the insert query
    $sql = "UPDATE `event_management`.`employee` SET `employee_name`='$name', `employee_email_id`='$email', `employee_address`='$address', `employee_phone`='$phone', `employee_sec_phone`='$sec_phone', `employee_designation`='$designation', `employee_blood_group`='$blood_group',`employee_company_id`='$company' WHERE  `employee_id`= $employee_id";
    $stmt = $db->executeQuery($sql);
    if ($stmt == 1)
      header("location: ../employee_listing.php?status=200");
    else {
      header("location: ../employee_listing.php?status=417");
    }
  }
}

//editing team and adding new members to it
if (isset($_POST["submit-team-edit"]) == "submit-team-edit" && $_SERVER["REQUEST_METHOD"] == "POST") {
  $db = new DB();
  $team_name = $team_description = $sql = $team_id = NULL;

  $team_id = $_POST['team-id'];
  $team_name = $_POST['team-name'];
  $team_description = $_POST['team-description'];
  if(isset($_POST['team-members'])){
    $team_members = $_POST['team-members'];
  }

  //checking for duplicate teams
  $select_query = "SELECT  `team_name` FROM `event_management`.`team` WHERE `team_name` LIKE '$team_name'";
  $result = $db->executeQuery($select_query);
  if (mysqli_num_rows($result)>1) {
    header("location: ../team_listing.php?status=448");
  }
  else{

    //inserting into the table
    $sql = "UPDATE `event_management`.`team` SET `team_name`='$team_name', `team_description`='$team_description' WHERE  `team_id`= $team_id";
    $stmt = $db->executeQuery($sql);

    if(isset($team_members)){
    foreach ($team_members as $member) {
      $sql2 = "INSERT INTO `event_management`.`team_members` (`team_id`, `employee_id`) VALUES ('$team_id', '$member')";
      $stmt1 = $db->executeQuery($sql2);
    }
      if ($stmt1 != 1)
        header("location: ../team_listing.php?status=450");
    }elseif($stmt1 == 1 or $stmt == 1) {
      header("location: ../team_listing.php?status=200");
    }else{
      header("location: ../team_listing.php?status=417");
    }
  }
}

