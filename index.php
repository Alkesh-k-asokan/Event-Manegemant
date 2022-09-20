<!-- PHP Start -->
<?php

// Initialize the session
require_once "classes/db.php";
session_start();
$db = new DB();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: admin_dashboard.php");
  exit;
}

// Include config file


// Define variables and initialize with empty values
$user_email = $password = $fetched_username = $fetched_password = "";
$error_msg = $temp = null;
// Processing form data when form is submitted
if (isset($_POST["login"]) == "submit" && $_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["email"]) && ($_POST["password"])) {
    //getting the values
    $user_email = $_POST["email"];
    $password = $_POST["password"];

    // Validate credentials
    // Prepare a select statement
    $sql = "SELECT user_name,user_password FROM event_users WHERE user_name='$user_email' AND user_password = '$password';";

    if ($stmt = $db->executeQuery($sql)) {
      //Check if username exists, if yes then verify password
      if (($stmt->num_rows == 1)) {
        $row = $stmt->fetch_assoc();
        $fetched_username = $row['user_name'];
        $fetched_password = $row['user_password'];
        if (($fetched_username == $user_email) && ($fetched_password == $password)) {
          // Password is correct, so start a new session
          session_start();
          // Store data in session variables
          $_SESSION["loggedin"] = true;
          $_SESSION["id"] = $id;
          $_SESSION["username"] = $username;
          // Redirect user to welcome page
          header("location: admin_dashboard.php");
        }
      } else {
        $error_msg = "Please check the UserId and Password";
        $temp = NULL;
      }
    }
  }
}
?>

<!-- PHP Ends -->


<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="utf-8" />
  <title>Login Pages HTML Template - Responsive Multipurpose Admin Templates | Vendroid</title>
  <meta name="keywords" content="HTML5 Template, CSS3, All Purpose Admin Template, Vendroid" />
  <meta name="description" content="Login Pages - Responsive Admin HTML Template">
  <meta name="author" content="Venmond">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  include('view/header.php');
  ?>
</head>

<body id="pages" class="full-layout no-nav-left no-nav-right  nav-top-fixed background-login responsive remove-navbar login-layout   clearfix" data-active="pages " data-smooth-scrolling="1">
  <div class="vd_body">
    <!-- Header Start -->

    <!-- Header Ends -->
    <div class="content">
      <div class="container">

        <!-- Middle Content Start -->

        <div class="vd_content-wrapper">
          <div class="vd_container">
            <div class="vd_content clearfix">
              <div class="vd_content-section clearfix">
                <div class="vd_login-page">
                  <div class="heading clearfix">
                    <div class="logo">
                      <h2 class="mgbt-xs-5"><img src="img/logo.png" alt="logo"></h2>
                    </div>
                    <h4 class="text-center font-semibold vd_grey">LOGIN TO YOUR ACCOUNT</h4>
                  </div>
                  <div class="panel widget">
                    <div class="panel-body">
                      <div class="login-icon entypo-icon"> <i class="icon-key"></i> </div>
                      <form class="form-horizontal" id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form">
                        <div class="alert alert-danger vd_hidden">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                          <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap!</strong> Change a few things up and try submitting again.
                        </div>
                        <div class="alert alert-success vd_hidden">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                          <span class="vd_alert-icon"><i class="fa fa-check-circle vd_red"></i></span><strong>Wrong Username or password!</strong>.
                        </div>
                        <div class="form-group  mgbt-xs-20">
                          <div class="col-md-12">
                            <div class="label-wrapper sr-only">
                              <label class="control-label" for="email">Email</label>
                            </div>
                            <div class="vd_input-wrapper" id="email-input-wrapper"> <span class="menu-icon"> <i class="fa fa-envelope"></i> </span>
                              <input type="email" placeholder="Email" id="email" name="email" class="required" value="<?= $temp ?>" required>
                            </div>
                            <div class="label-wrapper">
                              <label class="control-label sr-only" for="password">Password</label>
                            </div>
                            <div class="vd_input-wrapper" id="password-input-wrapper"> <span class="menu-icon"> <i class="fa fa-lock"></i> </span>
                              <input type="password" placeholder="Password" id="password" name="password" class="required" required>
                            </div>
                          </div>
                        </div>
                        <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                        <div class="form-group">
                          <div class="col-md-12 text-center mgbt-xs-5">
                            <button class="btn vd_bg-green vd_white width-100" type="submit" name="login" value="submit" id="login-submit">Login</button>
                          </div>
                          <div class="col-md-12 text-center mgbt-xs-5" id="php_error_msg">
                            <?= $error_msg; ?>
                          </div>
                          <div class="col-md-12">
                            <div class="row">
                        <!--  // commenting the Remember me button
                        <div class="col-xs-6">
                                <div class="vd_checkbox">
                                  <input type="checkbox" id="checkbox-1" value="1">
                                  <label for="checkbox-1"> Remember me</label>
                                </div>
                              </div> -->
                             <!-- <div class="col-xs-6 text-right"> -->
                              <div class="col-xs-6">
                                <div class=""> <a href="pages-forget-password.html">Forget Password? </a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- Panel Widget -->
                  <div class="register-panel text-center font-semibold"> <a href="pages-register.html">CREATE AN ACCOUNT<span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a> </div>
                </div>
                <!-- vd_login-page -->

              </div>
              <!-- .vd_content-section -->

            </div>
            <!-- .vd_content -->
          </div>
          <!-- .vd_container -->
        </div>
        <!-- .vd_content-wrapper -->

        <!-- Middle Content End -->

      </div>
      <!-- .container -->
    </div>
    <!-- .content -->

    <!-- Footer Start -->
    <?php
    include('view/footermain.php');
    ?>
    <!-- Footer END -->

  </div>
  <?php
  include('view/footer.php');
  ?>
  <!-- Specific Page Scripts Put Here -->
  <script type="text/javascript">
    $(document).ready(function() {

      "use strict";

      $("#php_error_msg").fadeOut(10000);

      var form_register_2 = $('#login-form');
      var error_register_2 = $('.alert-danger', form_register_2);
      var success_register_2 = $('.alert-success', form_register_2);

      form_register_2.validate({
        errorElement: 'div', //default input error message container
        errorClass: 'vd_red', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {

          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
            minlength: 6
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
          success_register_2.hide();
          error_register_2.show();


        },

        highlight: function(element) { // hightlight error inputs
          $("#php_error_msg").hide();
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


      });


    });
  </script>

  <!-- Specific Page Scripts END -->
</body>

</html>