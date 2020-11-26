<?php
/*
if(! isset($_SESSION["login"]))
{
	header("location:login.php");
	exit();
}
*/
date_default_timezone_set('Asia/Dhaka');
//require_once("header.php");
require_once("config/rmns_config.php");
require_once("function/general_fn.php");
require_once("function/database.php");
require_once("function/ia_general_fn.php");
isset($_REQUEST['success'])?$success=$_REQUEST['success']:die('Error');
$tracking_id=$_REQUEST["tracking_id"]; 
$success==1?$msg="<p>You have successfully submitted your Applicatin.Your tracking id is <font color=\"blue\"><strong>$tracking_id</strong></font>.</p> <p><font size=\"3\">*Please keep this Tracking ID saved for future
reference and seeing progress of your Application's approval":$msg="Error! Applicatin is not submited</font></p>";
?>
<!DOCTYPE html>
<html>

<?php require_once("header.php");  ?>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
	<?php require_once("sidebar.php");  ?>
    

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
		<?php require_once("topbar.php");  ?>
        
        <!-- Begin Page Content -->
        <div class="container-fluid">
		

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Submission Status</h1>
		 
		  
				<div class="row">
                <div class="col-md-10  col-md-offset-1">
                    
				   <?php echo "<h4>$msg</h4>"; ?>
				   <a href="ia-form.php">Apply for another application</a>
				
				  
				
				
               
                </div>
				</div>
		  

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
     <?php require_once("footer.php") ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php require_once("logout-modal.php") ?>

  
  <!-- Bootstrap core JavaScript-->
  <?php require_once("core-script.php")?>
  
  <!-- Page level plugins -->
  
  <!-- Page level custom scripts -->
  <script >
  
  
  </script>
  
</body>

</html>
