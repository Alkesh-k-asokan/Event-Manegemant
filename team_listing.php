<?php
require_once "classes/db.php";
$db = new DB();
$sql = "SELECT  * FROM `event_management`.`team`";
$result = $db->executeQuery($sql);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET["id"]) && isset($_GET["conformation"])){
  $id = $_GET["id"];
  $conformation = $_GET["conformation"];

  if($conformation == 'true'){
      $sql_delete_members = "DELETE FROM `event_management`.`team_members` WHERE `team_members`.`team_id`=$id";
      $stmt_1 = $db->executeQuery($sql_delete_members);
      if($stmt_1 == 1) {
        $sql_delete = "DELETE FROM `event_management`.`team` WHERE `team`.`team_id`=$id";
        $stmt = $db->executeQuery($sql_delete);
        if ($stmt == 1) {
          header("location: team_listing.php?status=501");
        } else {
          header("location: team_listing.php?status=502");
        }
      } else {
        header("location: team_listing.php?status=502");
      }
  }

}

$result_msg = NULL;
if (isset($_GET["status"])) {
  $status = $_GET["status"];
  if ($status == '200') {
    $result_msg = '<div class="alert alert-success"><i class="fa fa-check-circle vd_green"></i>' . '&nbsp;&nbsp;The Team have been updated' . ' </div>';
  } elseif ($status == '417') {
    $result_msg = '<div id="vd_login-error" class="alert alert-danger"><i class="fa fa-exclamation-circle fa-fw"></i>' . '&nbsp;&nbsp;The Team edit failed.' . ' </div>';
  } elseif ($status == '450') {
    $result_msg = '<div id="vd_login-error" class="alert alert-danger"><i class="fa fa-exclamation-circle fa-fw"></i>' . '&nbsp;&nbsp;Adding New Member has been failed.' . ' </div>';
  } elseif ($status == '448') {
    $result_msg = '<div id="vd_login-error" class="alert alert-danger"><i class="fa fa-exclamation-circle fa-fw"></i>' . '&nbsp;&nbsp;The name already exist.' . ' </div>';
  } elseif ($status == '500') {
    $result_msg = '<div id="vd_login-error" class="alert alert-warning"><i class="fa fa-exclamation-triangle vd_yellow"></i>' . '&nbsp;&nbsp;Changes Discarded.' . ' </div>';
  } elseif ($status == '501') {
    $result_msg = '<div class="alert alert-success"><i class="fa fa-check-circle vd_green"></i>' . '&nbsp;&nbsp;The Team have been deleted.' . ' </div>';
  } elseif ($status == '502') {
    $result_msg = '<div id="vd_login-error" class="alert alert-warning"><i class="fa fa-exclamation-triangle vd_yellow"></i>' . '&nbsp;&nbsp;The Tea, Deletion failed.' . ' </div>';
  }


  $status = NULL;
}
?>

<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8" />
  <title>Team Listing</title>
  <meta name="keywords" content="HTML5 Template, CSS3, All Purpose Admin Template, Vendroid" />
  <meta name="description" content="Data Tables - Responsive Admin HTML Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">       
  <?php
    include('view/header.php');
  ?>    
</head>    

<body id="tables" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix" data-active="tables "  data-smooth-scrolling="1">     
<div class="vd_body">
<!-- Header Start -->
<?php
  include('view/nav_header.php');
?>  
<!-- Header Ends --> 
<div class="content">
  <div class="container">

    <!-- Middle Content Start -->
    
    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <div class="vd_head-section clearfix">
            <div class="vd_panel-header">
              <ul class="breadcrumb">
                <li><a href="index-2.html">Home</a> </li>
                <li><a href="listtables-tables-variation.html">List &amp; Tables</a> </li>
                <li class="active">Data Tables</li>
              </ul>
              <div class="vd_panel-menu hidden-sm hidden-xs" data-intro="<strong>Expand Control</strong><br/>To expand content page horizontally, vertically, or Both. If you just need one button just simply remove the other button code." data-step=5  data-position="left">
    <div data-action="remove-navbar" data-original-title="Remove Navigation Bar Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-navbar-button menu"> <i class="fa fa-arrows-h"></i> </div>
      <div data-action="remove-header" data-original-title="Remove Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-header-button menu"> <i class="fa fa-arrows-v"></i> </div>
      <div data-action="fullscreen" data-original-title="Remove Navigation Bar and Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="fullscreen-button menu"> <i class="glyphicon glyphicon-fullscreen"></i> </div>
      
</div>
 
            </div>
          </div>
          <!-- <div class="vd_title-section clearfix">
            <div class="vd_panel-header">
              <h1>Employees</h1>
            </div>
          </div> -->
          <div class="vd_content-section clearfix">
            <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
                  <div class="panel-heading vd_bg-grey">
                    <h3 class="panel-title">Team</h3>
                  </div>
                  <div><?= $result_msg; ?></div>
                  <div class="panel-body table-responsive">
                    <table class="table table-striped" id="data-tables">
                      <thead>
                        <tr>
                          <th>Team Name</th>
                          <th>Description</th>
                          <th>Points Earned</th>
                          <th class='no-sort'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        while ($row = mysqli_fetch_array($result)) {
                          $id = NULL;
                          echo '<tr class="odd gradeX">';
                          echo '<td>'.$row['team_name'].'</td>';
                          echo '<td>'.$row['team_description'].'</td>';
                          echo '<td>'.$row['team_total_points'].'</td>';
                          $id=$row["team_id"];
                          echo '<td class="menu-action">
                                <a data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-green vd_green"> <i class="fa fa-eye"></i> </a> 
                                <a data-original-title="Add Members" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow"> <i class="fa fa-plus"></i> </a> 
                                <a href=team_edit.php?id='.$id.'  data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow"> <i class="fa fa-pencil"></i> </a> 
                                <a  onclick="team_delete_conformation('.$id.');"  data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-red vd_red"> <i class="fa fa-times"></i> </a></td>';
                          echo '</tr>';
                            } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- Panel Widget --> 
              </div>
              <!-- col-md-12 --> 
            </div>
            <!-- row --> 
            
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

<!-- .vd_body END  -->
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>

<?php
include('view/footer.php');
?>
<!-- Specific Page Scripts Put Here -->

<script type="text/javascript" src="plugins/dataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="plugins/dataTables/dataTables.bootstrap.js"></script>

<script type="text/javascript">
		$(document).ready(function() {
				"use strict";
				$('#data-tables').dataTable();
		} );

        function team_delete_conformation(id) {
            var result = confirm("Proceed With the Deletion?\nThis action cannot be undone!");
            if (result) {
                window.location.href = "team_listing.php?id=<?= $id ?>&conformation=true";
            }
        }

</script>
<!-- Specific Page Scripts END -->
</body>

</html>