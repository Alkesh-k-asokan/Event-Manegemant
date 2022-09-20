<?php
require_once "db.php";
  $db = $name = $email = $phone = $sec_phone = $designation = $blood_group = $address = $company = $sql = NULL ;
  if (isset($_POST["submit"]) == "submit" && $_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new DB();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sec_phone = $_POST['sec_phone'];
    $designation = $_POST['designation'];
    $blood_group = $_POST['blood_group'];
    $address = $_POST['address'];
    $company = $_POST['company'];
    $sql = "INSERT INTO `event_management`.`employee` (`employee_name`, `employee_email_id`, `employee_address`, `employee_phone`,  `employee_sec_phone`,`employee_designation`, `employee_blood_group`, `employee_company_id`) VALUES ('$name', '$email', '$address', '$phone', '$sec_phone','$designation', '$blood_group', '1');";
    $stmt = $db->executeQuery($sql);
    if($stmt == 1)
      header("location: ../employee_create.php?execution-status=true");
    else{
      header("location: ../employee_create.php?execution-status=false");
    }
}
?>