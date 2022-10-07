<?php
require_once "classes/db.php";
$db = new DB();
if (isset($_GET["id"])) {
  $employee_id =  $_GET["id"];
  $sql = "SELECT  * FROM `event_management`.`employee` WHERE `employee_id` = $employee_id";
  $result = $db->executeQuery($sql);
  $row = mysqli_fetch_array($result);
}
if (isset($_GET["status"]) && $_GET["status"]=='200') {
  $employee_id =  $_GET["id"];
  $db = new DB();
  $sql = "DELETE FROM `event_management`.`employee` WHERE  `employee_id`= $employee_id;";
  $stmt = $db->executeQuery($sql);
  if ($stmt == 1)
    header("location: employee_listing.php?status=502");
  else {
    header("location: employee_listing.php?status=503");
  }
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="utf-8" />
  <title>Employee Delete Conformation</title>
  <meta name="keywords" content="HTML5 Template, CSS3, Mega Menu, Admin Template, Elegant HTML Theme, Vendroid, Form Validation " />
  <meta name="description" content="Form Validation  - Responsive Admin HTML Template">
  <meta name="author" content="Venmond">
  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  include('view/header.php');
  ?>
</head>

<body id="forms" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix" data-active="forms " data-smooth-scrolling="1">
  <div class="vd_body">
    <?php
    include('view/nav_header.php');
    ?>

    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <div class="vd_head-section clearfix">
            <div class="vd_panel-header">
              <ul class="breadcrumb">
                <li><a href="index.php">Home</a> </li>
                <!-- <li><a href="forms-elements.html">Forms</a> </li> -->
                <li class="active">Delete Employee </li>
              </ul>
              <div class="vd_panel-menu hidden-sm hidden-xs" data-intro="<strong>Expand Control</strong><br/>To expand content page horizontally, vertically, or Both. If you just need one button just simply remove the other button code." data-step=5 data-position="left">
                <div data-action="remove-navbar" data-original-title="Remove Navigation Bar Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-navbar-button menu"> <i class="fa fa-arrows-h"></i> </div>
                <div data-action="remove-header" data-original-title="Remove Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-header-button menu"> <i class="fa fa-arrows-v"></i> </div>
                <div data-action="fullscreen" data-original-title="Remove Navigation Bar and Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="fullscreen-button menu"> <i class="glyphicon glyphicon-fullscreen"></i> </div>
              </div>
            </div>
          </div>
          <!-- <div class="vd_title-section clearfix">
            <div class="vd_panel-header">
              <h1>Employee Creation Form </h1>
              <small class="subtitle">Form validation using jQuery Validation: <a href="http://jqueryvalidation.org/">http://jqueryvalidation.org</a>/</small> </div> 
          </div> -->
          <div class="vd_content-section clearfix">
            <!-- Panel Widget -->
            <div class="panel widget light-widget">
              <div class="panel-heading no-title"> </div>
              <div class="panel-body">
                <h1><span class="font-semibold">Confirm Deletion</span> </h1>
                <h5> Please confirm the deletion of the employee <b > <?=$row['employee_name'];?></b> with employee ID <b> <?=$row['employee_id'];?></b>?</h5>
                <div class="mgbt-xs-10">
                  <a href="employee_delete_conformation.php?id=<?=$employee_id?>&status=200" class="btn vd_btn vd_bg-red btn-lg ">Yes, Delete</a>
                  <a href="employee_listing.php?status=501" class="btn vd_btn vd_bg-green btn-lg ">No, Cancel</a>
                </div>
              </div>
            </div>
            <!-- Panel Widget -->

          </div>
          <!-- .vd_content-section -->

        </div>
        <!-- .vd_content -->
      </div>
      <!-- .vd_container -->
    </div>

    <?php
    include('view/footermain.php');
    ?>
  </div>
  <?php
  include('view/footer.php');
  ?>
  <!-- Specific Page Scripts Put Here -->
  </script>

</body>

</html>