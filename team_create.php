<?php

$event_type = $status = NULL;

require_once "classes/db.php";
$db = new DB();
$sql = "SELECT  `employee_id`,`employee_name` FROM `event_management`.`employee` WHERE `employee`.`employee_id` NOT IN (SELECT `employee_id` FROM `event_management`.`team_members`) ";
$result = $db->executeQuery($sql);

$result_msg = NULL;
if (isset($_GET["status"])) {
  $status = $_GET["status"];
  if ($status == '200') {
    $result_msg = '<div class="alert alert-success"><i class="fa fa-check-circle vd_green"></i>' . '&nbsp;&nbsp;The Team have been created and the members were added.' . ' </div>';
  } elseif ($status == '450') {
    $result_msg = '<div id="vd_login-error" class="alert alert-danger"><i class="fa fa-exclamation-circle fa-fw"></i>' . '&nbsp;&nbsp;The Team have been created and the members adding failed.' . ' </div>';
  } elseif ($status == '448') {
    $result_msg = '<div id="vd_login-error" class="alert alert-danger"><i class="fa fa-exclamation-circle fa-fw"></i>' . '&nbsp;&nbsp;The Team already exists.' . ' </div>';
  } elseif ($status == '417') {
    $result_msg = '<div id="vd_login-error" class="alert alert-danger"><i class="fa fa-exclamation-circle fa-fw"></i>' . '&nbsp;&nbsp;The Team creation failed.' . ' </div>';
  }

  $status = NULL;
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="utf-8" />
  <title>Team Create</title>
  <meta name="keywords" content="HTML5 Template, CSS3, Mega Menu, Admin Template, Elegant HTML Theme, Vendroid, Form Validation " />
  <meta name="description" content="Employee Create">
  <meta name="author" content="Venmond">
  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                <li class="active">Add New Team </li>
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
                <h2 class="mgbt-xs-20">Add New Team</h2>
                <form class="form-horizontal" action="classes/functions.php" method="POST" role="form" id="register-form-event-creation">

                  <div class="alert alert-danger vd_hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap!</strong> Change a few things up and try submitting again.
                  </div>
                  <div class="alert alert-success vd_hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span><strong>Well done!</strong>.
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="label-wrapper">
                        <label class="control-label">Team Name<span class="vd_red">*</span></label>
                      </div>
                      <div class="controls">
                        <input type="text" placeholder="Team Name" class="required" required name="team-name" id="team-name">
                        <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="label-wrapper">
                        <label class="control-label">Team Description<span class="vd_red">*</span></label>
                      </div>
                      <div class="controls">
                        <textarea rows="3" class="width-100 required" required name="team-description" id="team-description"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="label-wrapper">
                        <label class="control-label">Select Team Members<span class="vd_red">*</span></label>
                      </div>
                      <select class="width-100 select required" required multiple="multiple" name="team-members[]" id="team-members">
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                          echo '<option value =' . $row['employee_id'] . '>' . $row['employee_name'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                  <div><?= $result_msg; ?></div>
                  <div class="form-group">
                    <div class="col-md-12 mgbt-xs-5">
                      <button class="btn vd_bg-green vd_white" type="submit" id="submit" name="submit-team-create" value="submit-team-create">Create Team</button>
                    </div>
                    <div class="col-md-12 mgbt-xs-5">
                    </div>
                </form>
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
  <script type="text/javascript">
    $(document).ready(function() {
      "use strict";

      var form_register = $('#register-form');
      var error_register = $('.alert-danger', form_register);
      var success_register = $('.alert-success', form_register);

      form_register.validate({
        errorElement: 'div', //default input error message container
        errorClass: 'vd_red', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
          name: {
            minlength: 3,
            required: true
          },
          email: {
            required: true,
            email: true
          },
          website: {
            required: true,
            url: true
          },
          company: {
            minlength: 3,
            required: true
          },
          member: {
            required: true
          },
          password: {
            required: true
          },
          confirmpass: {
            required: true
          },
        },

        errorPlacement: function(error, element) {
          if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")) {
            element.parent().append(error);
          } else if (element.parent().hasClass("vd_input-wrapper")) {
            error.insertAfter(element.parent());
          } else {
            error.insertAfter(element);
          }
        },

        invalidHandler: function(event, validator) { //display error alert on form submit              
          success_register.fadeOut(500);
          error_register.fadeIn(500);
          scrollTo(form_register, -100);

        },

        highlight: function(element) { // hightlight error inputs

          $(element).addClass('vd_bd-red');
          $(element).siblings('.help-inline').removeClass('help-inline fa fa-check vd_green mgl-10');

        },

        unhighlight: function(element) { // revert the change dony by hightlight
          $(element)
            .closest('.control-group').removeClass('error'); // set error class to the control group
        },

        success: function(label, element) {
          label
            .addClass('valid').addClass('help-inline fa fa-check vd_green mgl-10') // mark the current input as valid and display OK icon
            .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
          $(element).removeClass('vd_bd-red');
        },

        submitHandler: function(form) {
          success_register.fadeIn(500);
          error_register.fadeOut(500);
          scrollTo(form_register, -100);
        }
      });



      var form_register_2 = $('#register-form-2');
      var error_register_2 = $('.alert-danger', form_register_2);
      var success_register_2 = $('.alert-success', form_register_2);

      form_register_2.validate({
        errorElement: 'div', //default input error message container
        errorClass: 'vd_red', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
          firstname: {
            minlength: 3,
            required: true
          },
          lastname: {
            minlength: 3,
            required: true
          },
          email: {
            required: true,
            email: true
          },
          website: {
            required: true,
            url: true
          },
          company: {
            minlength: 3,
            required: true
          },
          country: {
            required: true
          },
          phone: {
            required: true
          },
          password: {
            required: true
          },
          confirmpass: {
            required: true
          },
        },

        errorPlacement: function(error, element) {
          if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")) {
            element.parent().append(error);
          } else if (element.parent().hasClass("vd_input-wrapper")) {
            error.insertAfter(element.parent());
          } else {
            error.insertAfter(element);
          }
        },

        invalidHandler: function(event, validator) { //display error alert on form submit              

          success_register_2.fadeOut(500);
          error_register_2.fadeIn(500);
          scrollTo(form_register_2, -100);

        },

        highlight: function(element) { // hightlight error inputs

          $(element).addClass('vd_bd-red');
          $(element).parent().siblings('.help-inline').removeClass('help-inline hidden');
          if ($(element).parent().hasClass("vd_checkbox") || $(element).parent().hasClass("vd_radio")) {
            $(element).siblings('.help-inline').removeClass('help-inline hidden');
          }

        },

        unhighlight: function(element) { // revert the change dony by hightlight
          $(element)
            .closest('.control-group').removeClass('error'); // set error class to the control group
        },

        success: function(label, element) {
          label
            .addClass('valid').addClass('help-inline hidden') // mark the current input as valid and display OK icon
            .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
          $(element).removeClass('vd_bd-red');
        },

        //   submitHandler: function (form) {
        // success_register_2.fadeIn(500);
        // error_register_2.fadeOut(500);
        // scrollTo(form_register_2,-100);

        //   }
      });


      $('.width-100.select.required').select2({
        placeholder: 'Select Team members'
      });

    });
  </script>
  <script type="text/javascript" src="js/date-picker.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>