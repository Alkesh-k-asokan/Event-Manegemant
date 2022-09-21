<?php
require_once "db.php";
  $db =  $sql = NULL ;
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
      if($row['employee_email_id'] == $email ){
        $flag = "email";
        header("location: ../employee_create.php?status=448");
      }
      if($row['employee_phone'] == $phone ){
        $flag = "phone";
        header("location: ../employee_create.php?status=449");
      }
    }

    if($flag == true){
      // executing the insert query
      $sql = "INSERT INTO `event_management`.`employee` (`employee_name`, `employee_email_id`, `employee_address`, `employee_phone`,  `employee_sec_phone`,`employee_designation`, `employee_blood_group`, `employee_company_id`) VALUES ('$name', '$email', '$address', '$phone', '$sec_phone','$designation', '$blood_group', '1');";
      $stmt = $db->executeQuery($sql);
      if($stmt == 1)
        header("location: ../employee_create.php?status=200");
      else{
        header("location: ../employee_create.php?status=417");
      }
    }
      
}


if (isset($_POST["submit-event-create"]) == "submit-event-create" && $_SERVER["REQUEST_METHOD"] == "POST") {
  $event_name = $event_type = $event_date = $event_description = $event_points = $select_query = $result = $row = NULL ;
  $db = new DB();
  
  $event_name = $_POST['event-name'];
  $event_type = $_POST['event-type'];
  $event_date = $_POST['event-date'];
  $event_description = $_POST['event-description'];
  $event_points = $_POST['event-points'];
  

 
  $select_query = "SELECT `event_type_id`,`event_name` FROM `event_management`.`event`";
  echo $select_query;
  $result = $db->executeQuery($select_query);
  print_r($result);
  while ($row = mysqli_fetch_array($result)) {
    if($row['event_name'] === $event_name && $row['event_type_id'] == $event_type ){
      header("location: ../event_create.php?status=450");
    }
  }
  $sql= "INSERT INTO `event_management`.`event` (`event_type_id`, `event_name`, `event_description`, `event_points`, `event_date`) VALUES ('$event_type', '$event_name', '$event_description', '$event_points', '$event_date')";
  $stmt = $db->executeQuery($sql);
  if($stmt == 1)
    header("location: ../event_create.php?status=200");
  else{
    header("location: ../event_create.php?status=417");
  }

}
?>